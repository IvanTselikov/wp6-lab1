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


  // проверка на заполнение обязательных полей
  $('form').submit(function(e) {
    e.preventDefault()

    if (is_validated($(this))) {

    }
  })

  function is_validated(form) {
    form.find('input[required]').each(function() {
      let value = $(this).val().trim()
      if (value === '') {
        $(this).addClass('border-danger')
        // $(this).parent().find('.error-message').removeClass('d-none')
        $(`[data-input="${$(this).attr('id')}"]`).removeClass('d-none')
      }
    })
  }
})
