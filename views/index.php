<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="icon" href="img/icon.svg">
    <title>PHP Авторизация/Регистрация</title>
</head>

<body>
    <header class="d-flex justify-content-end">
        <button class="btn btn-primary m-3" id="theme-switcher">
            <i class="fa fa-sun-o me-1" aria-hidden="true"></i>
            <span>Светлая тема</span>
        </button>
    </header>
    <main class="w-50 mx-auto mb-5 px-5 py-4 border">
        <h3 class="text-center mb-5 mt-4">Добро пожаловать,
            <?= $_SESSION['userName']; ?>!
        </h3>
        <img src="img/welcome.svg" alt="welcome" class="w-50 d-block mx-auto">
        <div class="d-grid gap-2 mt-5 mb-3 mx-5">
            <a class="btn btn-primary btn-block" href="out.php">
                <i class="fa fa-sign-out me-1" aria-hidden="true"></i>
                Выйти
            </a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>