<?php

$forms = [
    'author-form' => [
        'login' => [
            'fieldName' => 'Логин',
            'required' => 1,
            'dbField' => 'login',
            'dbType' => 's',
        ],
        'password' => [
            'fieldName' => 'Пароль',
            'required' => 1,
            'dbField' => 'password',
            'dbType' => 's',
        ],
    ],
    'registr-form' => [
        'firstName' => [
            'fieldName' => 'Имя',
            'required' => 1,
            'pattern' => '/^[a-zA-Zа-яА-ЯЁё\'-]{2,15}$/u',
            'dbField' => 'firstName',
            'dbType' => 's',
        ],
        'lastName' => [
            'fieldName' => 'Фамилия',
            'required' => 1,
            'pattern' => '/^[a-zA-Zа-яА-ЯЁё\'-]{2,15}$/u',
            'dbField' => 'lastName',
            'dbType' => 's',
        ],
        'email' => [
            'fieldName' => 'Email',
            'required' => 1,
            'type' => 'email',
            'dbField' => 'email',
            'dbType' => 's',
        ],
        'login' => [
            'fieldName' => 'Логин',
            'required' => 1,
            'pattern' => '/^.{6,}$/u',
            'dbField' => 'login',
            'dbType' => 's',
        ],
        'password' => [
            'fieldName' => 'Пароль',
            'required' => 1,
            'pattern' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_=+]).{8,}$/u',
            'dbField' => 'password',
            'dbType' => 's',
        ],
        'passwordCheck' => [
            'fieldName' => 'Повторите пароль',
            'required' => 1,
        ],
        'gender' => [
            'fieldName' => 'Пол',
            'dbField' => 'gender',
            'required' => 1,
            'dbType' => 'i',
        ],
        'isAdult' => [
            'fieldName' => 'Возраст',
            'required' => 1,
            'dbField' => 'isAdult',
            'dbType' => 'i',
        ],
        'accept' => [
            'fieldName' => 'Принимаю Пользовательское соглашение',
            'required' => 1,
        ],
    ],
];