<?php
// session_start();
/* TODO:
рефакторинг:
    именование
    семантическая вёртска
    стили в css
    js
    prettier
    data.php классы
    строковые константы
    сообщения об ошибке - в клиентскую часть
тестирование
учитывать ограничения из бд
не учитывать в regex концевые пробелы
запретить вносить в бд данные изменённые на клиенте
favicon
showErrorMessage принимать id
отметить * обязательные поля
*/

require_once __DIR__ . './incs/data.php';
require_once __DIR__ . './conf.php';

if (!empty($_POST)) {
    // sleep(1);
    $response = [
        'status' => 'OK',
        'errors' => []
    ];

    // определям, какая форма отправлена (авторизация или регистрация)
    switch ($_POST['form']) {
        case 'author-form':
            $data = $authorFormData;
            break;
        case 'registr-form':
            $data = $registrFormData;
            break;
        default:
            $response['status'] = 'ERROR';
            $response['errors'][] = [
                'name' => $_POST['form'],
                'message' => 'Неправильное название формы. Пожалуйста, обновите страницу.'
            ];
            exit(json_encode($response));
    }

    // проверка на соответствие шаблону (при наличии)
    foreach ($_POST as $k => $v) {
        if (array_key_exists($k, $data) && array_key_exists('pattern', $data[$k])) {
            $pattern = $data[$k]['pattern'];
            if (!preg_match($pattern, $v)) {
                $response['status'] = 'ERROR';
                $response['errors'][] = [
                    'name' => $k,
                    'message' => "Пожалуйста, заполните поле \"" .
                    "{$data[$k]['fieldName']}\" в соответствии с указанными правилами."
                ];
            }
        }
    }

    // проверка на то, что данные приняты из всех input
    $requiredData = array_filter(
        $data,
        function ($v, $k) {
            return array_key_exists('required', $v);
        },
        ARRAY_FILTER_USE_BOTH
    );
    $missedData = array_diff(array_keys($requiredData), array_keys($_POST));

    foreach ($missedData as $k) {
        $response['status'] = 'ERROR';
        $response['errors'][] = [
            'name' => $k,
            'message' => "Обязательное поле \"{$data[$k]['fieldName']}\" " .
            "не заполнено либо отсутствует на форме. Пожалуйста, заполните его либо обновите страницу."
        ];
    }

    exit(json_encode($response));
}
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
    <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>
    <link rel="icon" href="icon.svg">
    <title>PHP Авторизация/Регистрация</title>
</head>

<body>
    <header class="d-flex justify-content-end">
        <button id="theme-switcher" class="btn btn-primary m-3">
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
                <form action="#" id="author-form" method="POST" novalidate>
                    <div class="mt-4 mb-3">
                        <label for="login" class="col-form-label">Логин</label>
                        <input name="login" type="text" class="form-control" id="author-input-login" autocomplete="off"
                            required>
                        <div class="error-message text-danger d-none" data-input="author-input-login">
                            Пожалуйста, введите логин.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="col-form-label">Пароль</label>
                        <div class="password-group input-group mb-3">
                            <input name="password" type="password" class="form-control" id="author-input-password"
                                autocomplete="off" aria-describedby="author-show-password" required>
                            <button class="btn btn-primary" type="button" id="author-show-password">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="error-message text-danger d-none" data-input="author-input-password">
                            Пожалуйста, введите пароль.
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="g-recaptcha" id="author-captcha" data-sitekey=<?= RECAPTCHA_KEY ?>></div>
                        <div class="error-message text-danger d-none" data-input="author-captcha">
                            Пожалуйста, подтвердите, что Вы человек.
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button name="submitAuthor" value="author" type="submit"
                            class="btn btn-primary btn-block my-2">Войти</button>
                    </div>

                    <div class="loader">
                        <img src="loader.svg" alt="loading...">
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="registr-tab-content" role="tabpanel" aria-labelledby="registr-tab-btn">
                <form id="registr-form" novalidate>
                    <div class="mt-4 mb-3">
                        <label for="registr-input-first-name" class="col-form-label">Имя</label>
                        <input name="firstName" type="text" class="form-control" id="registr-input-first-name"
                            autocomplete="off" required>
                        <div class="error-message text-danger d-none" data-input="registr-input-first-name">
                            Пожалуйста, введите имя.
                        </div>
                        <div class="form-text">только текст, не менее 2 символов, не более 15</div>
                    </div>

                    <div class="mb-3">
                        <label for="registr-input-last-name" class="col-form-label">Фамилия</label>
                        <input name="lastName" type="text" class="form-control" id="registr-input-last-name"
                            autocomplete="off" required>
                        <div class="error-message text-danger d-none" data-input="registr-input-last-name">
                            Пожалуйста, введите фамилию.
                        </div>
                        <div class="form-text">только текст, не менее 2 символов, не более 15</div>
                    </div>

                    <div class="mb-3">
                        <label for="registr-input-email" class="col-form-label">Адрес электронной почты</label>
                        <input name="email" type="text" class="form-control" id="registr-input-email"
                            placeholder="username@service.com" autocomplete="off" required>
                        <div class="error-message text-danger d-none" data-input="registr-input-email">
                            Пожалуйста, введите адрес электронной почты.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="registr-input-login" class="col-form-label">Логин</label>
                        <input name="login" type="text" class="form-control" id="registr-input-login" autocomplete="off"
                            required>
                        <div class="error-message text-danger d-none" data-input="registr-input-login">
                            Пожалуйста, введите логин.
                        </div>
                        <div class="form-text">не менее 6 символов</div>
                    </div>

                    <div class="mb-3">
                        <label for="registr-input-password" class="col-form-label">Придумайте пароль</label>
                        <div class="password-group input-group mb-3">
                            <input name="password" type="password" class="form-control" id="registr-input-password"
                                aria-describedby="registr-show-password" autocomplete="off" required>
                            <button class="btn btn-primary" type="button" id="registr-show-password">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="error-message text-danger d-none" data-input="registr-input-login">
                            Пожалуйста, введите пароль.
                        </div>
                        <div class="form-text">не менее 8 символов, обязательно совместное использование
                            прописных, строчных букв, цифр, символов !@#$%^&*_=+</div>
                    </div>

                    <div class="mb-4">
                        <label for="registr-input-password-check" class="col-form-label">Повторите
                            пароль</label>
                        <div class="password-group input-group mb-3">
                            <input name="passwordCheck" type="password" class="form-control"
                                id="registr-input-password-check" aria-describedby="registr-show-password-check"
                                autocomplete="off" required>
                            <button class="btn btn-primary" type="button" id="registr-show-password-check">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="error-message text-danger d-none" data-input="registr-input-login">
                            Пожалуйста, повторите пароль.
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="mb-2">Пол</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="male-radio" name="gender" value="male"
                                required>
                            <label class="form-check-label" for="male-radio">Мужской</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="female-radio" name="gender" value="female">
                            <label class="form-check-label" for="female-radio">Женский</label>
                        </div>
                    </div>

                    <select name="is_adult" class="mb-4 form-select" name="is-adult" id="age-select">
                        <option selected value="not-adult">Мне нет 18 лет</option>
                        <option value="adult">Мне исполнилось 18 лет</option>
                    </select>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="accept-checkbox" name="accept" required>
                        <label class="form-check-label" for="accept">Принимаю Пользовательское соглашение</label>
                        <div class="error-message text-danger d-none" data-input="accept-checkbox">
                            Вам нужно принять соглашение, чтобы продолжить.
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="g-recaptcha" id="registr-captcha" data-sitekey=<?= RECAPTCHA_KEY ?>></div>
                        <div class="error-message text-danger d-none" data-input="registr-captcha">
                            Пожалуйста, подтвердите, что Вы человек.
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" form="registr-form" class="btn btn-primary my-3">Регистрация</button>
                    </div>

                    <div class="loader">
                        <img src="loader.svg" alt="loading...">
                    </div>
                </form>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
    <script type="text/javascript" src="script.js"></script>
</body>

</html>
