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
    <script src="/src/js/home/apex-chart-library.js?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/js/home/apex-chart-library.js')  ?>"></script>
    <link rel="stylesheet" href="/src/css/pages/home/style.css?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/css/pages/home/style.css') ?>">
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
                <select id="eventId" onchange="generateStats(this.value);">
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
                <div class="card card_one">
                    <img src="/src/images/icon-qrcode-black.png?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/icon-qrcode-black.png') ?>">
                    <h2>Wygeneruj kody QR</h2>
                </div>
                <div class="card card_two">
                    <img src="/src/images/icon-list-black.png?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/icon-list-black.png') ?>">
                    <h2>Wygeneruj listę gości</h2>
                </div>
                <div class="card card_three">
                    <img src="/src/images/icon-details-black.png?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/icon-details-black.png') ?>">
                    <h2>Zobacz szczegóły</h2>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="/src/js/home/script.js?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/js/home/script.js') ?>"></script>
<script>
    generateStats(document.querySelector("#eventId").value);
</script>

</html>