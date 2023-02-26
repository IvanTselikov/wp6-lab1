<?php

session_start();

require_once dirname(__DIR__, 1) . '/incs/data.php';

function validateForm($formName, $post)
{
    $response = ['status' => 'OK', 'errors' => []];

    if (array_key_exists($formName, $GLOBALS['forms'])) {
        $data = $GLOBALS['forms'][$formName];
        
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

    return $response;
}

function rememberUser($userData)
{
    $_SESSION['userName'] = $userData['firstName']['value'] . ' ' . $userData['lastName']['value'];
}