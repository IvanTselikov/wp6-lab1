<?php
?>

<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Авторизация/Регистрация</title>
    </head>
    <body class="min-vh-100 d-flex flex-column justify-content-between" style="scroll-behavior: smooth;">
        <main>
            <button class="btn btn-dark">Тёмная тема</button>
            <form id="author-form">
                <h1 class="text-center">Регистрация</h1>
                <div class="w-75 mx-auto">
                    <div class="mb-3 d-flex justify-content-between">
                        <label for="author-input-login" class="col-form-label">Имя:</label>
                        <div class="w-75">
                            <input type="text" class="form-control" id="author-input-login" required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <label for="author-input-password" class="col-form-label">Фамилия:</label>
                        <div class="w-75">
                            <input type="password" class="form-control" id="author-input-password" required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <label for="author-input-password" class="col-form-label">Email:</label>
                        <div class="w-75">
                            <input type="password" class="form-control" id="author-input-password" required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <label for="author-input-password" class="col-form-label">Логин:</label>
                        <div class="w-75">
                            <input type="password" class="form-control" id="author-input-password" required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <label for="author-input-password" class="col-form-label">Придумайте пароль:</label>
                        <div class="w-75">
                            <input type="password" class="form-control" id="author-input-password" required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <label for="author-input-password" class="col-form-label">Повторите пароль:</label>
                        <div class="w-75">
                            <input type="password" class="form-control" id="author-input-password" required>
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="rules">
                        <label for="rules">Принимаю Пользовательское соглашение</label>
                    </div>
                    <select name="is-adult">
                        <option selected value="not-adult">Нет 18 лет</option>
                        <option value="adult">Мне 18 лет</option>
                    </select>
                    <div>
                        <input type="radio" id="male" name="gender" value="male">
                        <label for="male">Мужской</label>
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">Женский</label>
                    </div>
                    <input type="submit" value="Зарегистрироваться">
                </div>
            </form>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
    </body>
</html>