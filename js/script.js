function getCookie(name) {
  let matches = document.cookie.match(
    new RegExp(
      "(?:^|; )" +
        name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
        "=([^;]*)"
    )
  );
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

// отображение капчи
function onloadCallback() {
  let key = $(".g-recaptcha").data("sitekey");
  let ids = ["author-captcha", "registr-captcha"];
  ids.forEach((id) => {
    let widgetId = grecaptcha.render(id, {
      sitekey: key,
      callback: function (response) {
        $(`#${id} textarea`).eq(0).text(response);
      },
    });
    $("#" + id).data("widgetId", widgetId);
  });
}

$(document).ready(function () {
  if (getCookie("theme") === "dark") {
    switchTheme();
  }

  // смена темы
  $("#theme-switcher").click(function () {
    switchTheme(getCookie("theme") !== "dark");
  });

  function switchTheme(toDark = true) {
    if (toDark) {
      $("#theme-switcher").addClass("btn-secondary");
      $("#theme-switcher")
        .find("i")
        .addClass("fa-moon-o")
        .removeClass("fa-sun-o");
      $("#theme-switcher").find("span").text("Тёмная тема");

      $("body").addClass("bg-dark").addClass("text-white");
      $("main").addClass("bg-secondary").addClass("border-secondary");
      $("button.nav-link").addClass("tabs-dark");

      $(".form-text").addClass("tips-dark");
      $("main button").addClass("btn-dark");

      $(".error-message").removeClass("text-danger").addClass("text-warning");
      $("input").addClass("dark");

      $(".loader img").attr("src", "../img/loader-dark.svg");

      document.cookie =
        encodeURIComponent("theme") + "=" + encodeURIComponent("dark");
    } else {
      $("#theme-switcher").removeClass("btn-secondary");
      $("#theme-switcher")
        .find("i")
        .addClass("fa-sun-o")
        .removeClass("fa-moon-o");
      $("#theme-switcher").find("span").text("Светлая тема");

      $("body").removeClass("bg-dark").removeClass("text-white");
      $("main").removeClass("bg-secondary").removeClass("border-secondary");
      $("button.nav-link").removeClass("tabs-dark");

      $(".form-text").removeClass("tips-dark");
      $("main button").removeClass("btn-dark");

      $(".error-message").addClass("text-danger").removeClass("text-warning");
      $("input").removeClass("dark");

      $(".loader img").attr("src", "../img/loader.svg");

      document.cookie =
        encodeURIComponent("theme") + "=" + encodeURIComponent("light");
    }
  }

  // показать/скрыть пароль
  $(".password-group button").click(function () {
    let input = $(this).parent().find("input");
    let eye = $(this).find("i");

    if (input.attr("type") === "text") {
      input.attr("type", "password");
      eye.addClass("fa-eye-slash");
      eye.removeClass("fa-eye");
    } else {
      input.attr("type", "text");
      eye.removeClass("fa-eye-slash");
      eye.addClass("fa-eye");
    }
  });

  // валидация
  $("form").on("submit", function (e) {
    e.preventDefault();

    let form = $(this);
    let firstErrorInput;

    form.find("input").each(function () {
      let input = $(this);

      // убираем выделение ошибочного ввода, оставшееся с предыдущей отправки формы
      hide_error_message(input);

      // проверка на то, что обязательные поля заполнены
      if (input.attr("required")) {
        if (input.attr("type") === "checkbox" && !input[0].checked) {
          show_error_message(input);
        } else {
          let value = input.val().trim();
          input.val(value);

          if (value === "") {
            show_error_message(input);
          }
        }
      }
    });

    if (!firstErrorInput && form.attr("id") === "registr-form") {
      // проверка равенства полей "Пароль" и "Повторите пароль"
      let password = $("#registr-input-password").val();
      let passwordCheck = $("#registr-input-password-check").val();
      if (password !== passwordCheck) {
        show_error_message(
          $("#registr-input-password-check"),
          "Пароли не совпадают."
        );
      }
    }

    // проверка капчи
    let captcha = $(
      form.attr("id") === "author-form" ? "#author-captcha" : "#registr-captcha"
    );

    hide_error_message(captcha);

    let widgetId = captcha.data("widgetId");
    let captchaResult = grecaptcha.getResponse(widgetId);

    if (!captchaResult.length) {
      show_error_message(captcha);
    }

    // если все обязательные поля заполнены - проверка на сервере
    if (!firstErrorInput) {
      $.ajax({
        url: "../handlers/login.php",
        type: "POST",
        data: form.serialize() + "&form=" + form.attr("id"),
        beforeSend: function () {
          form.find(".loader").fadeIn();
        },
        success: function (response) {
          form.find(".loader").fadeOut("slow", function () {
            try {
              response = JSON.parse(response);
            } catch {
              alert("Ошибка сервера: " + response);
            }
            if (response.status === "OK") {
              window.location = "http://wp6-lab1/views/index.php";
            } else {
              response.errors.forEach((error) => {
                let input = form.find(`input[name=${error.name}]`);
                if (input.length) {
                  show_error_message(input, error.message);
                } else {
                  alert(error.message);
                }
              });
            }
          });
        },
        error: function () {
          alert("Не удалось подключиться к серверу.");
        },
      });
    }

    // фокус (скролл) на первый инпут с ошибкой

    
    // if (firstErrorInput) {
    //   $([document.documentElement, document.body]).scrollTop(
    //     firstErrorInput.top - 100
    //   );
    // }

    if (firstErrorInput) {
      firstErrorInput.focus();
    }

    function hide_error_message(input) {
      input.removeClass("border-error");
      $(`[data-input~="${input.attr("id")}"]`).addClass("d-none");
    }

    function show_error_message(input, message) {
      input.addClass("border-error");

      let error_message_block = $(`[data-input~="${input.attr("id")}"]`);

      if (message !== "") {
        error_message_block.text(message);
      }

      error_message_block.removeClass("d-none");

      if (!firstErrorInput) {
        firstErrorInput = input;
      }
    }
  });
});
