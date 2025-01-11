<link rel="stylesheet" type="text/css" href="/src/css/modules/navigation/navigation.css?lmod=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/css/modules/navigation/navigation.css'); ?>" />
<?php
session_start();
$file_name = explode("/", $_SERVER['PHP_SELF']);
$nav = [
    'home'  => [
        'path'  => '/home/',
        "img"   => '/src/images/home.svg',
        "label" => "Strona główna"
    ],
    'event'  => [
        'path'  => '/events/',
        "img"   => '/src/images/event.png',
        "label" => "Twoje wydarzenia"
    ]
]
?>


<nav>
    <div onclick="showToogledNav()" class="toggle-arrow">
        <img src="/src/images/icon-minimize-menu-arrow-black.svg?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/icon-minimize-menu-arrow-black.svg') ?>" />
    </div>
    <div class="group">

        <?php
        foreach ($nav as $key => $item) {
            $active = ('/' . $file_name[1] . '/' == $item['path']) ? 'active-item' : "";
            $activeMark = ('/' . $file_name[1] . '/' == $item['path']) ? 'active-mark' : "";
            echo '
                <div>
                    <a href="' . $item['path'] . '">                    
                        <div class="image-box">
                            <img src="' . $item['img'] . '?lmod=' . filemtime($_SERVER['DOCUMENT_ROOT'] . $item['img']) . '" />
                        </div>
                        <div class="' . $active . ' heading-box">
                            <p class="font-weight-500 font-color-white">' . strtoupper($item['label']) . '</p>
                        </div>
                        <div class="' . $activeMark . '"></div>
                    </a>
                </div>
            ';
        }
        ?>



    </div>
    <div class="footer">
        <div>
            <p class="font-color-white font-weight-500"><?= $_SESSION['name'] . ' ' . $_SESSION['surname']  ?></p>
        </div>
        <div onClick="logginOff();" class="cursor-pointer">
            <img src="/src/images/logout-white.png?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/logout-white.png') ?>" />
        </div>
    </div>
</nav>



<script src="/src/js/function-login.js?lmod=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/js/function-login.js'); ?>"></script>
<script src="/src/js/navigation/function-show-toggled-nav.js?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/js/navigation/function-show-toggled-nav.js'); ?>"></script>
<script src="/src/js/navigation/function-adjust-popup-height.js?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/js/navigation/function-adjust-popup-height.js'); ?>"></script>