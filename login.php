<?php
// session_start();
/* TODO:
Адаптивность
именование
семантическая вёртска
рефакторинг
тестирование
учитывать ограничения из бд
не учитывать в regex концевые пробелы
другой выпадающий список
оформление формы bootstrap
bootstrap валидация
стили в css
в js табуляция 4 символа
добро пожаловать поменять
тёмная тема на главной странице
подпись "Возраст"
асинхронность, колёсико
инвертировать цвета
svg в отдельный файл
переписать без jquery
prettier
*/
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>PHP Авторизация/Регистрация</title>
</head>

<body>
    <header class="d-flex justify-content-end">
        <button id="theme-switcher" class="btn btn-primary m-3" data-theme="light">
            <i class="fa fa-sun-o me-1" aria-hidden="true"></i>
            <span>Светлая тема</span>
        </button>
    </header>
    <main class="w-50 mx-auto mb-5 px-5 py-4 border"
        style="border-radius: 0.75rem; background-color: rgb(245, 245, 245);">
        <h3 class="text-center mb-5 mt-4">Добро пожаловать!</h3>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="author-tab-btn" data-bs-toggle="tab"
                    data-bs-target="#author-tab-content" type="button" role="tab" aria-controls="author-tab-content"
                    aria-selected="true">Войти</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="registr-tab-btn" data-bs-toggle="tab" data-bs-target="#registr-tab-content"
                    type="button" role="tab" aria-controls="registr-tab-content"
                    aria-selected="false">Зарегистрироваться</button>
            </li>
        </ul>
        <div class="tab-content" id="main-tab-panel">
            <div class="tab-pane fade show active" id="author-tab-content" role="tabpanel"
                aria-labelledby="author-tab-btn">
                <form id="author-form" novalidate>
                    <div class="mt-4 mb-3">
                        <label for="author-input-login" class="col-form-label">Логин</label>
                        <input type="text" class="form-control" id="author-input-login" autocomplete="off" required>
                        <div class="error-message text-danger d-none" data-input="author-input-login">
                            Пожалуйста, введите логин.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="author-input-password" class="col-form-label">Пароль</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="author-input-password" autocomplete="off"
                                aria-describedby="author-show-password" required>
                            <button class="btn btn-primary" type="button" id="author-show-password">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="error-message text-danger d-none" data-input="author-input-password">
                            Пожалуйста, введите пароль.
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" form="author-form" class="btn btn-primary btn-block my-2">Войти</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="registr-tab-content" role="tabpanel" aria-labelledby="registr-tab-btn">
                <form id="registr-form">
                    <div class="mt-4 mb-3">
                        <label for="registr-input-first-name" class="col-form-label">Имя</label>
                        <input type="text" class="form-control" id="registr-input-first-name"
                            pattern="[a-zA-Zа-яА-ЯЁё\s'-]{2,15}" autocomplete="off" required>
                        <div class="form-text">только текст, не менее 2 символов, не более 15</div>
                    </div>

                    <div class="mb-3">
                        <label for="registr-input-second-name" class="col-form-label">Фамилия</label>
                        <input type="text" class="form-control" id="registr-input-second-name"
                            pattern="[a-zA-Zа-яА-ЯЁё\s'-]{2,15}" autocomplete="off" required>
                        <div class="form-text">только текст, не менее 2 символов, не более 15</div>
                    </div>

                    <div class="mb-3">
                        <label for="registr-input-email" class="col-form-label">Email</label>
                        <input type="text" class="form-control" id="registr-input-email"
                            pattern="[a-zA-Z0-9]+@[a-zA-Z]+\.[a-z]+" placeholder="username@service.com"
                            title="username@service.com" autocomplete="off" required>
                    </div>

                    <div class="mb-3">
                        <label for="registr-input-login" class="col-form-label">Логин</label>
                        <input type="text" class="form-control" id="registr-input-login" pattern="[^\s]{6,}"
                            autocomplete="off" required>
                        <div class="form-text">не менее 6 символов</div>
                    </div>

                    <div class="mb-3">
                        <label for="registr-input-password" class="col-form-label">Придумайте пароль</label>
                        <div class="password-group input-group mb-3">
                            <input type="password" class="form-control" id="registr-input-password"
                                aria-describedby="registr-show-password"
                                pattern="/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_=+]).{8,}/gm" autocomplete="off"
                                required>
                            <button class="btn btn-primary" type="button" id="registr-show-password">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="form-text">не менее 8 символов, обязательно совместное использование
                            прописных, строчных букв, цифр, символов !@#$%^&*_=+</div>
                    </div>

                    <div class="mb-4">
                        <label for="registr-input-password-check" class="col-form-label">Повторите
                            пароль</label>
                        <div class="password-group input-group mb-3">
                            <input type="password" class="form-control" id="registr-input-password-check"
                                aria-describedby="registr-show-password-check" autocomplete="off" required>
                            <button class="btn btn-primary" type="button" id="registr-show-password-check">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="mb-2">Пол</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="male" name="gender" value="male" required>
                            <label class="form-check-label" for="male">Мужской</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="female" name="gender" value="female">
                            <label class="form-check-label" for="female">Женский</label>
                        </div>
                    </div>

                    <select class="mb-4 form-select" name="is-adult" id="age-select">
                        <option selected value="not-adult">Мне нет 18 лет</option>
                        <option value="adult">Мне исполнилось 18 лет</option>
                    </select>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" name="rules" required>
                        <label class="form-check-label" for="rules">Принимаю Пользовательское соглашение</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" form="registr-form" class="btn btn-primary my-3">Регистрация</button>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>