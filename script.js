$(document).ready(function () {
  // смена темы
  $('#theme-switcher').click(function () {    
    if ($(this).data('theme') === 'light') {
      $(this).data('theme', 'dark')

      $(this).addClass('btn-secondary')
      $(this).find('i').addClass('fa-moon-o').removeClass('fa-sun-o')
      $(this).find('span').text('Тёмная тема')

      $('body').addClass('text-white')
      $('body').addClass('bg-dark')

      $('#login-tab-control').addClass('bg-secondary')
      $('#login-tab-control').addClass('border-secondary')
      $('button.nav-link').addClass('tabs-dark')

      $('.form-text').addClass('tips-dark')
      $('.password-group button').addClass('btn-dark')
      $('button[type="submit"]').addClass('btn-dark')
    }
    else {
      $(this).data('theme', 'light')

      $(this).removeClass('btn-secondary')
      $(this).find('i').addClass('fa-sun-o').removeClass('fa-moon-o')
      $(this).find('span').text('Светлая тема')

      $('body').removeClass('text-white')
      $('body').removeClass('bg-dark')

      $('#login-tab-control').removeClass('bg-secondary')
      $('#login-tab-control').removeClass('border-secondary')
      $('button.nav-link').removeClass('tabs-dark')

      $('.form-text').removeClass('tips-dark')
      $('.password-group button').removeClass('btn-dark')
      $('button[type="submit"]').removeClass('btn-dark')
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
})
