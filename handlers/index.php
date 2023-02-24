<?php
session_start();

if (array_key_exists('userName', $_SESSION)) {
    header('Location: ' . '../views/index.php');
} else {
    header('Location: ' . '../views/login.php');
}