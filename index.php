<?php
/* TODO:
Адаптивность
Градиентный фон
авторизация/регистрация на одном окне (возм., React)
именование
семантическая вёртска
рефакторинг
тестирование
показать пароль
учитывать ограничения из бд
не учитывать в regex концевые пробелы
*/
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>PHP Авторизация/Регистрация</title>
</head>

<body>
    <header>
        <button class="btn btn-dark">Тёмная тема</button>
    </header>
    <main>

        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registr-modal">Зарегистрироваться</button>
        <button class="btn btn-dark">Войти</button>

        <div class="modal fade" id="registr-modal" tabindex="-1" aria-labelledby="registr-modal-label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="registr-modal-label">Регистрация</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <form id="registr-form">
                            <div class="mb-3">
                                <label for="author-input-first-name" class="col-form-label">Имя</label>
                                <input type="text" class="form-control" id="author-input-first-name"
                                    pattern="[a-zA-Zа-яА-ЯЁё\s'-]{2,15}" autocomplete="off" required>
                                <div class="form-text">только текст, не менее 2 символов, не более 15</div>
                            </div>

                            <div class="mb-3">
                                <label for="author-input-second-name" class="col-form-label">Фамилия</label>
                                <input type="text" class="form-control" id="author-input-second-name"
                                    pattern="[a-zA-Zа-яА-ЯЁё\s'-]{2,15}" autocomplete="off" required>
                                <div class="form-text">только текст, не менее 2 символов, не более 15</div>
                            </div>

                            <div class="mb-3">
                                <label for="author-input-email" class="col-form-label">Email</label>
                                <input type="text" class="form-control" id="author-input-email"
                                    pattern="[a-zA-Z0-9]+@[a-zA-Z]+\.[a-z]+" placeholder="username@service.com"
                                    title="username@service.com" autocomplete="off" required>
                            </div>

                            <div class="mb-3">
                                <label for="author-input-login" class="col-form-label">Логин</label>
                                <input type="text" class="form-control" id="author-input-login" pattern="[^\s]{6,}"
                                    autocomplete="off" required>
                                <div class="form-text">не менее 6 символов</div>
                            </div>

                            <div class="mb-3">
                                <label for="author-input-password" class="col-form-label">Придумайте пароль</label>
                                <input type="password" class="form-control" id="author-input-password"
                                    pattern="/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_=+]).{8,}/gm"
                                    autocomplete="off" required>
                                <div class="form-text">не менее 8 символов, обязательно совместное использование
                                    прописных, строчных букв, цифр, символов !@#$%^&*_=+</div>
                            </div>

                            <div class="mb-3">
                                <label for="author-input-password-check" class="col-form-label">Повторите
                                    пароль</label>
                                <input type="password" class="form-control" id="author-input-password-check"
                                    autocomplete="off" required>
                            </div>

                            <div class="mb-3">
                                <p class="mb-2">Пол</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="male" name="gender" value="male"
                                        required>
                                    <label class="form-check-label" for="male">Мужской</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="female" name="gender"
                                        value="female">
                                    <label class="form-check-label" for="female">Женский</label>
                                </div>
                            </div>

                            <select class="mb-3 form-select" name="is-adult">
                                <option selected value="not-adult">Мне нет 18 лет</option>
                                <option value="adult">Мне исполнилось 18 лет</option>
                            </select>

                            <div class="mb-1 form-check">
                                <input type="checkbox" class="form-check-input" name="rules" required>
                                <label class="form-check-label" for="rules">Принимаю Пользовательское соглашение</label>
                            </div>                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" form="registr-form" class="btn btn-primary">Зарегистрироваться</button>
                        <!-- <input type="submit" form="registr-form" value="Зарегистрироваться"> -->
                        <!-- <button type="button" class="btn btn-primary">Зарегистрироваться</button> -->
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>