$(document).ready(function () {
  // смена темы
  $('#theme-switcher').click(function () {    
    if ($(this).data('theme') === 'light') {
      $(this).data('theme', 'dark')

      $(this).addClass('btn-secondary')
      $(this).find('i').addClass('fa-moon-o').removeClass('fa-sun-o')
      $(this).find('span').text('Тёмная тема')

      $('body').addClass('bg-dark').addClass('text-white')
      $('main').addClass('bg-secondary').addClass('border-secondary')
      $('button.nav-link').addClass('tabs-dark')

      $('.form-text').addClass('tips-dark')
      $('main button').addClass('btn-dark')
    } else {
      $(this).data('theme', 'light')

      $(this).removeClass('btn-secondary')
      $(this).find('i').addClass('fa-sun-o').removeClass('fa-moon-o')
      $(this).find('span').text('Светлая тема')

      $('body').removeClass('bg-dark').removeClass('text-white')
      $('main').removeClass('bg-secondary').removeClass('border-secondary')
      $('button.nav-link').removeClass('tabs-dark')

      $('.form-text').removeClass('tips-dark')
      $('main button').removeClass('btn-dark')
    }
  })

  // показать/скрыть пароль
  $('.password-group button').click(function() {
    let input = $(this).parent().find('input')
    let eye = $(this).find('i')

    if (input.attr('type') === 'text') {
      input.attr('type', 'password')
      eye.addClass('fa-eye-slash')
      eye.removeClass('fa-eye')
    } else {
      input.attr('type', 'text')
      eye.removeClass('fa-eye-slash')
      eye.addClass('fa-eye')
    }
  })

  // валидация
  $('form').on('submit', function(e) {
    e.preventDefault()

    let form = $(this)
    let firstErrorInput

    form.find('input').each(function() {
      let input = $(this)

      // убираем выделение ошибочного ввода, оставшееся с предыдущей отправки формы
      hide_error_message(input)

      // проверка на то, что обязательные поля заполнены
      if (input.attr('required')) {
        let value = input.val().trim()
        input.val(value)

        console.log(input.attr('id') + ' ' + value)
  
        if (value === '') {
          show_error_message(input)
  
          if (!firstErrorInput) {
            firstErrorInput = input
          }
        }
      }
    })

    // если все обязательные поля заполнены - проверка на сервере
    if (!firstErrorInput) {
      $.ajax({
        url: 'login.php',
        type: 'POST',
        data: form.serialize() + '&form=' + form.attr('id'),
        success: function(response) {
          try {
            response = JSON.parse(response)
          } catch (error) {
            alert('Ошибка сервера: ' + error.message)
          }
          if (response.status === 'OK') {
            alert('всё ок!')
          }
          else {
            response.errors.forEach(error => {
              let input = form.find(`input[name=${error.name}]`)
              if (input.length) {
                show_error_message(input, error.message)
              }
              else {
                alert(error.message)
                location.reload()
              }
            })
          }
        },
        error: function () {
          alert('Ошибка сервера')
        }
      })
    }

    if (firstErrorInput) {
      $([document.documentElement, document.body]).scrollTop(
        firstErrorInput.top - 100
      )
    }
  })

  function hide_error_message(input) {
    input.removeClass('border-danger')
    $(`[data-input="${input.attr('id')}"]`).addClass('d-none')
  }

  function show_error_message(input, message) {
    input.addClass('border-danger')

    let error_message_block = $(`[data-input="${input.attr('id')}"]`)

    if (message !== '') {
      error_message_block.text(message)
    }

    error_message_block.removeClass('d-none')
  }
})
