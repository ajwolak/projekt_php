<link rel="stylesheet" type="text/css" href="/src/css/modules/navigation/navigation.css?lmod=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/css/modules/navigation/navigation.css'); ?>" />
<?php
session_start();
$file_name = explode("/", $_SERVER['PHP_SELF']);
$hash = $_SERVER["REQUEST_URI"];


echo '
<nav>
    <div onclick="showToogledNav()" class="toggle-arrow">
        <img src="/src/images/icon-minimize-menu-arrow-black.svg?lmod=' . filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/icon-minimize-menu-arrow-black.svg') . '" />
    </div>
    <div class="group">
';


// echo '
//     <div>
//         <a href="' . $nav_data['nav_path'] . '">                    
//             <div class="image-box">
//                 <img src="/includes/images/nav/' . strtolower($nav_data['nav_name']) . '.svg?lmod=' . filemtime($_SERVER['DOCUMENT_ROOT'] . '/includes/images/dashboard/logout-white.png') . '" />
//             </div>
//             <div class="' . $active . ' heading-box">
//                 <p class="font-weight-500 font-color-white">' . strtoupper($nav_data['nav_name']) . '</p>
//             </div>
//             <div class="' . $activeMark . '"></div>
//         </a>
//     </div>
// ';


echo '';
echo '
    </div>
    <div class="footer">
        <div>
            <p class="font-color-white font-weight-500">' . $_SESSION['name'] . ' ' . $_SESSION['surname'] . '</p>
        </div>
        <div onClick="logginOff();" class="cursor-pointer">
            <img src="/src/images/logout-white.png?lmod=' . filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/logout-white.png') . '" />
        </div>
    </div>
</nav>
';

?>
<script src="/src/js/function-login.js?lmod=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/js/function-login.js'); ?>"></script>
<script src="/src/js/navigation/function-show-toggled-nav.js?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/js/navigation/function-show-toggled-nav.js'); ?>"></script>
<script src="/src/js/navigation/function-adjust-popup-height.js?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/js/navigation/function-adjust-popup-height.js'); ?>"></script>