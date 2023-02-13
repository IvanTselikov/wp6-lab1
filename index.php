<?php

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
    <title>PHP Авторизация/Регистрация</title>
</head>

<body>
    <header class="d-flex justify-content-end">
        <button id="theme-switcher" class="btn btn-primary m-3" data-theme="light">
            <i class="fa fa-sun-o me-1" aria-hidden="true"></i>
            <span>Светлая тема</span>
        </button>
    </header>
    <main class="w-50 mx-auto mb-5 px-5 py-4 border"
        style="border-radius: 0.75rem; background-color: rgb(245, 245, 245);">
        <h3 class="text-center mb-5 mt-4">Добро пожаловать, Иван Иванов!</h3>
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 0 512 512" xml:space="preserve" class="w-50 d-block mx-auto">
            <circle style="fill:#386895;" cx="256" cy="256" r="256" />
            <path style="fill:#273B7A;" d="M499.066,336.517L244.702,82.153l-83.699,48.759l-3.591-3.591l-46.68,32.878l-1.239,0.722
    l0.088,0.088l-18.006,12.683L265.94,348.058l15.345-15.344l77.646,77.646l-245.153,20.185l71.575,71.575
    c22.44,6.43,46.14,9.88,70.647,9.88C369.254,512,465.317,438.451,499.066,336.517z" />
            <path style="fill:#FFC61B;" d="M154.29,426.451H357.71v-82.12c0-19.151-15.524-34.675-34.675-34.675H188.964
    c-19.151,0-34.675,15.524-34.675,34.675V426.451z" />
            <path style="fill:#EAA22F;"
                d="M357.71,344.331c0-19.149-15.524-34.675-34.675-34.675h-67.61v116.795H357.71V344.331z" />
            <circle style="fill:#FFEDB5;" cx="256" cy="264.62" r="62.061" />
            <path style="fill:#FEE187;" d="M256,202.559c-0.193,0-0.383,0.012-0.574,0.014v124.092c0.191,0.002,0.381,0.014,0.574,0.014
    c34.275,0,62.061-27.786,62.061-62.061S290.275,202.559,256,202.559z" />
            <path style="fill:#E09112;" d="M83.609,93.365v66.198c0,9.14,7.409,16.549,16.549,16.549h82.747l19.487,19.487
    c5.023,5.023,13.612,1.465,13.612-5.639v-13.85h16.549c9.14,0,16.55-7.409,16.55-16.549V93.363c0-9.14-7.409-16.549-16.55-16.549
    H100.159C91.019,76.816,83.609,84.225,83.609,93.365z" />
            <rect x="113.778" y="402.101" style="fill:#FF5419;" width="284.444" height="28.444" />
            <rect x="255.431" y="402.101" style="fill:#C92F00;" width="142.791" height="28.444" />
        </svg>
        <br>
        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-block mt-3 mb-2 mx-5">
                <i class="fa fa-sign-out me-1" aria-hidden="true"></i>
                Выйти
            </button>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>