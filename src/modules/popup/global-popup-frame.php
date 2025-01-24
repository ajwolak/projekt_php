<link rel="stylesheet" href="/src/css/global/popup.css?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/css/global/popup.css') ?>">
<div class="global-popup-frame" style="display: none;">
    <div id="global_popup_container" class="global-popup-container">
        <div class="global-popup-heading">
            <h3 id="global_popup_heading_title" style="width: fit-content; float:left;"></h3>
            <div class="action " onclick="this.closest('.global-popup-frame').style.display = 'none';">&#10005;</div>
        </div>
        <div id="global_popup_main_content" class="global-popup-main-content"></div>
    </div>
</div>