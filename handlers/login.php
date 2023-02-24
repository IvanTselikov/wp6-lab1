<?php
session_start();

require_once __DIR__ . '../incs/data.php';
require_once __DIR__ . '../incs/conf.php';

if (!empty($_POST)) {
    $response = ['status' => 'OK'];

    // определям, какая форма отправлена (авторизация или регистрация)
    switch ($_POST['form']) {
        case 'author-form':
            $data = $authorFormData; // из data.php
            break;
        case 'registr-form':
            $data = $registrFormData; // из data.php
            break;
        default:
            $response['status'] = 'ERROR';
            $response['errors'] = [
                'name' => $_POST['form'],
                'message' => 'Неправильное название формы. Пожалуйста, обновите страницу.'
            ];
            exit(json_encode($response));
    }

    foreach ($_POST as $k => $v) {
        if (array_key_exists($k, $data)) {
            $data[$k]['value'] = trim($v);

            // проверка на соответствие шаблону (при наличии)
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

    if ($response['status'] === 'OK') {
        // подключение к БД
        $db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($db->connect_error) {
            exit('Ошибка подключения к БД (' . $db->connect_errno . ') ' . $db->connect_error);
        }

        $login = $data['login']['value'];

        $stmt = $db->prepare("SELECT * FROM `users` WHERE `login` = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();

        // $user = $db->query("SELECT * FROM `users` WHERE `login` = '$login'")->fetch_assoc();

        $user = $stmt->get_result()->fetch_assoc();

        if ($_POST['form'] === 'author-form') {
            // авторизация
            if ($user && password_verify($data['password']['value'], $user['password'])) {
                // запоминаем данные о посетителе для их отображения в личном кабинете
                $_SESSION['userName'] = $user['firstName'] . ' ' . $user['lastName'];
            } else {
                $response['status'] = 'ERROR';
                $response['errors'] = [
                    'name' => 'login',
                    'message' => 'Неверный логин или пароль.'
                ];
            }
        } else {
            // регистрация
            if ($user) {
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

                $values = implode(',', array_map(function ($i) {
                    return "'" . $i['value'] . "'";
                }, $registrationData));

                $template = substr(str_repeat('?,', count($registrationData)), 0, -1);

                $stmt = $db->prepare("INSERT INTO `users` ($fields) VALUES($template)");
                $stmt->bind_param("s", $login);
                $stmt->execute();
        
                // $user = $db->query("SELECT * FROM `users` WHERE `login` = '$login'")->fetch_assoc();
        
                $user = $stmt->get_result()->fetch_assoc();


                $success = $db->query("INSERT INTO `users` ($fields) VALUES($values)");

                if (!$success) {
                    $response['status'] = 'ERROR';
                    $response['errors'] = [
                        'name' => 'login',
                        // TODO: не login
                        'message' => 'Не удалось зарегистрировать пользователя. Ошибка сервера.'
                    ];
                } else {
                    $_SESSION['userName'] = $data['firstName']['value'] . ' ' . $data['lastName']['value'];
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