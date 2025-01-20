<?php
session_start();
if (!isset($_SESSION['isLogged']) || !$_SESSION['isLogged']) {
    header("Location: /login/");
}

$page_title = "Strona główna";
$header_heading = "Witaj w PartyPlanner!";


require(__DIR__ . '/../api/config.php');
require(__DIR__ . '/../api/functions/db-connect.php');
require(__DIR__ . '/../src/modules/head/head.php');
require(__DIR__ . '/../src/modules/header/header.php');
require(__DIR__ . '/../src/modules/navigation/navigation.php');
?>

<body>
    <link rel="stylesheet" href="/src/css/pages/home/style.css">
    <section class="content bg-color-white-little-dark">
        <div class="event-add">
            <div class="event-add-title">
                <h2>Nie masz jeszcze eventu? Utwórz event!</h2>
            </div>
            <div class="event-add-action">
                <div>
                    <img src="/src/images/add.png">
                </div>
            </div>
        </div>
        <div class="current-events"></div>
    </section>

</body>

</html>