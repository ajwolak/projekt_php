<!DOCTYPE html>
<html lang="pl">

<head>
    <!-- Meta tags & title & icon -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $GLOBALS['page_title'] ?? '' ?></title>
    <!-- <link rel="icon" href="" /> -->
    <!-- Meta tags & title & icon -->


    <!-- Global css styles -->
    <link rel="stylesheet" href="/src/css/global/global.css?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/css/global/global.css') ?>">
    <!-- Global css styles -->

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    <!-- Google fonts -->

    <!-- Global scripts -->
    <script src="/src/js/function-fetch-api.js?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/js/function-fetch-api.js') ?>"></script>
    <script src="/src/js/function-params.js?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/js/function-params.js') ?>"></script>
    <!-- Global scripts -->
</head>

<body>
    <?php
    require(__DIR__ . '/../popup/global-popup-frame.php');
    ?>