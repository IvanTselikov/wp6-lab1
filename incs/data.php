<?php

$authorFormData = [
    'login' => [
        'fieldName' => 'Логин',
        'required' => 1,
        'dbField' => 'login'
    ],
    'password' => [
        'fieldName' => 'Пароль',
        'required' => 1,
        'dbField' => 'password'
    ]
];

$registrFormData = [
    'firstName' => [
        'fieldName' => 'Имя',
        'required' => 1,
        'pattern' => '/[a-zA-Zа-яА-ЯЁё\'-]{2,15}/',
        'dbField' => 'firstName'
    ],
    'lastName' => [
        'fieldName' => 'Фамилия',
        'required' => 1,
        'pattern' => '/[a-zA-Zа-яА-ЯЁё\'-]{2,15}/',
        'dbField' => 'lastName'
    ],
    'email' => [
        'fieldName' => 'Email',
        'required' => 1,
        'type' => 'email',
        'dbField' => 'email'
    ],
    'login' => [
        'fieldName' => 'Логин',
        'required' => 1,
        'pattern' => '/[^\s]{6,}/',
        'dbField' => 'login'
    ],
    'password' => [
        'fieldName' => 'Пароль',
        'required' => 1,
        'pattern' => '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_=+]).{8,}/',
        'dbField' => 'password'
    ],
    'passwordCheck' => [
        'fieldName' => 'Повторите пароль',
        'required' => 1
    ],
    'gender' => [
        'fieldName' => 'Пол',
        'dbField' => 'gender'
    ],
    'isAdult' => [
        'fieldName' => 'Возраст',
        'required' => 1,
        'dbField' => 'isAdult'
    ],
    'accept' => [
        'fieldName' => 'Принимаю Пользовательское соглашение',
        'required' => 1
    ]
];