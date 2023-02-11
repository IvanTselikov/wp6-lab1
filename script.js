$(document).ready(function () {
  $('#theme-switcher').click(function () {
    // TODO: data- атрибут
    if ($(this).text() === 'Светлая тема') {
      $(this).text('Тёмная тема')
      $('body').addClass('text-white')
      $('body').addClass('bg-dark')
      $('#login-tab-control').addClass('bg-secondary')
      $('#login-tab-control').addClass('border-secondary')
      $(this).addClass('btn-secondary')
      $('button[type="submit"]').addClass('btn-dark')
      $('button.nav-link').addClass('tabs-dark')
      $('.form-text').addClass('tips-dark')
      // $('body').addClass('bg-secondary')
      // $('#login-tab-control').addClass('bg-dark')
      // $('#login-tab-control').addClass('border-dark')
      // $(this).addClass('btn-dark')
    }
    else {
      $(this).text('Светлая тема')
      $('body').removeClass('text-white')
      $('body').removeClass('bg-dark')
      $('#login-tab-control').removeClass('bg-secondary')
      $('#login-tab-control').removeClass('border-secondary')
      $(this).removeClass('btn-secondary')
      $('button[type="submit"]').removeClass('btn-dark')
      $('button.nav-link').removeClass('tabs-dark')
      $('.form-text').removeClass('tips-dark')
      // $('body').removeClass('bg-secondary')
      // $('#login-tab-control').removeClass('bg-dark')
      // $('#login-tab-control').removeClass('border-dark')
      // $(this).removeClass('btn-dark')
    }

  })
})
