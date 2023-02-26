<?php
require_once dirname(__DIR__, 1) . '/incs/data.php';
require_once dirname(__DIR__, 1) . '/incs/conf.php';
require_once dirname(__DIR__, 1) . '/incs/functions.php';

function rememberUser($userData)
{
    $_SESSION['userName'] = $userData['firstName']['value'] . ' ' . $userData['lastName']['value'];
}


session_start();

if (!empty($_POST)) {
    $response = ['status' => 'OK', 'errors' => []];

    // валидация
    $formName = $_POST['form'];

    if (array_key_exists($formName, $forms)) {
        $data = $forms[$formName];

        foreach ($post as $k => $v) {
            if (array_key_exists($k, $data)) {
                $data[$k]['value'] = trim($v);

                // проверка на соответствие регулярному выражению (при наличии)
                if (array_key_exists('pattern', $data[$k])) {
                    $pattern = $data[$k]['pattern'];

                    if (!preg_match($pattern, $v)) {
                        $response['status'] = 'ERROR';
                        $response['errors'] = [
                            'name' => $k,
                            'message' => "Пожалуйста, заполните поле \"" .
                            "{$data[$k]['fieldName']}\" в соответствии с указанными правилами."
                        ];
                    }
                } else if (array_key_exists('type', $data[$k]) && $data[$k]['type'] === 'email') {
                    // проверка email
                    if (!filter_var($v, FILTER_VALIDATE_EMAIL)) {
                        $response['status'] = 'ERROR';
                        $response['errors'] = [
                            'name' => $k,
                            'message' => "E-mail адрес '$v' указан неверно."
                        ];
                    }
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
            $response['errors'] = [
                'name' => $k,
                'message' => "Обязательное поле \"{$data[$k]['fieldName']}\" " .
                "не заполнено либо отсутствует на форме. Пожалуйста, заполните его либо обновите страницу."
            ];
        }
    } else {
        $response['status'] = 'ERROR';
        $response['errors'][] = [
            'message' => 'Неправильное название формы. Пожалуйста, обновите страницу.'
        ];
    }

    if ($response['status'] === 'OK') {
        // подключение к БД
        $db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($db->connect_error) {
            $response['status'] = 'ERROR';
            $response['errors'][] = [
                'message' => 'Невозможно подключиться к базе данных. Пожалуйста, повторите попытку позже.'
            ];
        }

        $login = $data['login']['value'];

        $stmt = $db->prepare("SELECT * FROM `users` WHERE `login` = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();

        $user = $stmt->get_result()->fetch_assoc();

        if ($formName === 'author-form') {
            // авторизация
            if ($user && password_verify($data['password']['value'], $user['password'])) {
                // запоминаем данные о посетителе для их отображения в личном кабинете
                rememberUser($data);
            } else {
                $response['status'] = 'ERROR';
                $response['errors'] = [
                    'name' => 'login',
                    'message' => 'Неверный логин или пароль.'
                ];
            }
        } else {
            // регистрация
            if (!$user) {
                // отбираем с формы данные, необходимые для записи в БД
                $registrationData = array_filter($data, function ($v, $k) {
                    return array_key_exists('dbField', $v) && array_key_exists('value', $v);
                }, ARRAY_FILTER_USE_BOTH);

                // хеширование пароля
                $password = password_hash($data['password']['value'], PASSWORD_BCRYPT, ['cost' => 12]);
                $registrationData['password']['value'] = $password;

                $fields = implode(',', array_map(function ($i) {
                    return '`' . $i['dbField'] . '`';
                }, $registrationData));

                $types = implode(array_map(function ($i) {
                    return $i['dbType'];
                }, $registrationData));

                $values = array_map(function ($i) {
                    return $i['value'];
                }, $registrationData);

                $template = substr(str_repeat('?,', count($registrationData)), 0, -1);

                $stmt = $db->prepare("INSERT INTO `users` ($fields) VALUES($template)");
                $stmt->bind_param($types, ...$login);
                $stmt->execute();

                $success = $stmt->get_result();
                if (!$success) {
                    $response['status'] = 'ERROR';
                    $response['errors'] = [
                        'message' => 'Не удалось зарегистрировать пользователя. Ошибка сервера.'
                    ];
                } else {
                    rememberUser($data);
                }
            } else {
                $response['status'] = 'ERROR';
                $response['errors'] = [
                    'name' => 'login',
                    'message' => 'Данный логин уже используется.'
                ];
            }
        }

        $db->close();
    }

    exit(json_encode($response));
}