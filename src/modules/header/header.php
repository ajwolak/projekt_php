<link rel="stylesheet" type="text/css" href="/src/css/modules/header/header.css?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/css/modules/header/header.css'); ?>" />
<link rel="stylesheet" type="text/css" href="/src/css/modules/skeletons/system-global-loader.css?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/css/modules/skeletons/system-global-loader.css'); ?>">
<header>
    <div class="logo">
        <img src="/src/images/logo-transparent.png?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/logo-transparent.png') ?>" alt="">
    </div>
    <div class="headings">
        <div class="title">
            <h1 class="font-weight-700"><?= $GLOBALS['header_heading'] ?? '' ?></h1>
            <p class="font-weight-500"><?= $GLOBALS['header_under_heading'] ?? '' ?></p>
        </div>
    </div>
    <div class="load-action-response-element">
        <?php
        echo '<div class="bg-color-orange border-radius-normal header-alert-message alert-ok ' . (isset($_GET['responseMessageOk']) ? "" : "display-none-important") . '">' . (isset($_GET['responseMessageOk']) ? $_GET['responseMessageOk'] : '') . '</div>';
        echo '<div class="bg-color-red font-color-white border-radius-normal header-alert-message alert-err ' . (isset($_GET['responseMessageErr']) ? "" : "display-none-important")  . '">' . (isset($_GET['responseMessageErr']) ? $_GET['responseMessageErr'] : '') . '</div>';
        ?>
    </div>
</header>

<script>
    if (paramDownload("responseMessageOk") != undefined || paramDownload("responseMessageErr") != undefined) {
        setTimeout(function(e) {
            document.querySelectorAll(".header-alert-message").forEach(element => element.style.display = "none");
        }, 5000);
        paramDelete("responseMessageOk");
        paramDelete("responseMessageErr");
    }
</script>