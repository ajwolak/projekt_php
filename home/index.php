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
require(__DIR__ . '/../api/functions/user/user-check-events.php');
require(__DIR__ . '/../api/functions/event/function-event-collect.php');
require(__DIR__ . '/../api/functions/event/function-event-download.php');
?>

<body>
    <link rel="stylesheet" href="/src/css/pages/home/style.css">
    <section class="content bg-color-white-little-dark">
        <?php
        if (userCheckEvent()) {
        ?>
            <div class="event-add">
                <div class="event-add-title">
                    <h2>Nie masz jeszcze eventu? Utwórz event!</h2>
                </div>
                <div class="event-add-action" onclick="window.location.href='/events/?list=add'">
                    <div>
                        <img src="/src/images/add.png">
                    </div>
                </div>
            </div>
        <?php exit();
        } ?>
        <div class="filtr">
            <div class="global-input-box">
                <select id="eventId">
                    <?php
                    foreach (eventCollect($_SESSION['userId']) as $key => $id) {
                        echo '<option ' . ($key == 0 ? 'selected' : '') . ' value="' . $id . '">' . eventDownload($id)['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="section">
            <div class="chart-box"></div>
            <div class="card-box">
                <div class="cart">
                    <img src="/src/">
                </div>
            </div>
        </div>
    </section>

</body>

</html>