<?php
session_start();
if (!isset($_SESSION['isLogged']) || !$_SESSION['isLogged']) {
    header("Location: /login/");
}

$page_title = "Twoje wydarzenia";
$header_heading = "Twoje wydarzenia";
$header_under_heading = "Lista";

require(__DIR__ . '/../api/config.php');
require(__DIR__ . '/../api/functions/db-connect.php');
require(__DIR__ . '/../src/modules/head/head.php');
require(__DIR__ . '/../src/modules/header/header.php');
require(__DIR__ . '/../src/modules/navigation/navigation.php');
require(__DIR__ . '/../api/functions/user/user-check-events.php');

?>

<body>
    <section class="content bg-color-white-little-dark">
        <?php
        if (userCheckEvent()) require(__DIR__ . '/event-add.php');
        else require(__DIR__ . '/event-list.php');
        ?>
    </section>

</body>

</html>