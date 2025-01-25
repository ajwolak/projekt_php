<?php
session_start();
if (!isset($_SESSION['isLogged']) || !$_SESSION['isLogged']) {
    header("Location: /login/");
}

if ($_GET['list'] == 'info') {
    $page_title = "Informacje";
    $header_heading = "Szczegóły wydarzenia";
    $header_under_heading = "Zobacz najważniejsze informacje";
} else {
    $page_title = "Twoje wydarzenia";
    $header_heading = "Twoje wydarzenia";
    $header_under_heading = "Lista";
}

require(__DIR__ . '/../api/config.php');
require(__DIR__ . '/../api/functions/db-connect.php');
require(__DIR__ . '/../src/modules/head/head.php');
require(__DIR__ . '/../src/modules/header/header.php');
require(__DIR__ . '/../src/modules/navigation/navigation.php');
require(__DIR__ . '/../api/functions/user/user-check-events.php');
require(__DIR__ . '/../api/functions/event/function-event-download.php');
require(__DIR__ . '/../api/functions/event/function-event-collect.php');

?>

<body>
    <section class="content bg-color-white-little-dark">
        <?php
        if (userCheckEvent() || $_GET['list'] == 'add' || $_GET['list'] == 'edit') {
            require(__DIR__ . '/event-add.php');
        } else {
            if ($_GET['list'] == 'info') {
                require(__DIR__ . '/event-info.php');
            } else {
                require(__DIR__ . '/event-list.php');
            }
        }
        ?>
    </section>
</body>

</html>