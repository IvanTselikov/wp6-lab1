<?php

$authorFormData = [
    'login' => [
        'fieldName' => 'Логин',
        'required' => 1
    ],
    'password' => [
        'fieldName' => 'Пароль',
        'required' => 1
    ]
];

$registrFormData = [
    'firstName' => [
        'fieldName' => 'Имя',
        'required' => 1,
        'pattern' => '/[a-zA-Zа-яА-ЯЁё\s\'-]{2,15}/'
    ],
    'lastName' => [
        'fieldName' => 'Фамилия',
        'required' => 1,
        'pattern' => '/[a-zA-Zа-яА-ЯЁё\s\'-]{2,15}/'
    ],
    'email' => [
        'fieldName' => 'Email',
        'required' => 1
    ],
    'login' => [
        'fieldName' => 'Логин',
        'required' => 1,
        'pattern' => '/[^\s]{6,}/'
    ],
    'password' => [
        'fieldName' => 'Пароль',
        'required' => 1,
        'pattern' => '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_=+]).{8,}/'
    ],
    'passwordCheck' => [
        'fieldName' => 'Повторите пароль',
        'required' => 1
    ],
    'gender' => [
        'fieldName' => 'Пол'
    ],
    'is_adult' => [
        'fieldName' => 'Возраст',
        'required' => 1
    ],
    'accept' => [
        'fieldName' => 'Принимаю Пользовательское соглашение',
        'required' => 1
    ]
];