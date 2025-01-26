<?php
if (!isset($_GET['eventId']) || empty($_GET['eventId'])) {
?>
    <script>
        window.location.href = "/";
    </script>
<?php
}

$event_data = eventDownload($_GET['eventId']);
$location_data = locationDownload($_GET['eventId']);
$max_date = new DateTime($event_data['max_accept_date']);
$event_date = new DateTime($location_data['date']);
$address = $location_data['street'] . ", " . $location_data['zip_code'] . ' ' . $location_data['town'];
?>
<link rel="stylesheet" href="/src/css/pages/event/event-info.css?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/css/pages/event/event-info.css') ?>" />
<div class="event-info">
    <div class="information">
        <div class="header">
            <h3>Szczegóły:</h3>
        </div>
        <div>
            <p>Nazwa</p>
            <p><b><?= $event_data['name'] ?></b></p>
        </div>
        <div>
            <p>Opis dla gości</p>
            <p><b><?= $event_data['guest_description'] ?></b></p>
        </div>
        <div>
            <p>Moje notatki</p>
            <p><b><?= $event_data['user_description'] ?></b></p>
        </div>
        <div>
            <p>Data akceptacji zaproszeń</p>
            <p><b><?= $max_date->format("d-m-Y") ?></b></p>
        </div>
        <div>
            <p>Data wesela</p>
            <p><b><?= $event_date->format("d-m-Y") ?></b></p>
        </div>
        <div>
            <p>Adres</p>
            <p><b><?= $address ?></b></p>
        </div>
        <div>
            <p>Nazwa domu weselnego</p>
            <p><b><?= $location_data['name'] ?></b></p>
        </div>
        <div class="absolute-img-box">
            <div class="absolute-img" onclick="window.location.href='/events/?list=edit&eventId=<?= $_GET['eventId'] ?>'">
                <img src="/src/images/icon-edit-pen-black.png?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/icon-edit-pen-black.png') ?>" alt="Edytuj" />
            </div>
        </div>
    </div>
    <div id="invationBox" style="width: 100%;"></div>

    <div class="guest-list">
        <div class="header">
            <h3>Lista gości:</h3>
        </div>
        <div class="absolute-img-box">
            <div class="absolute-img" onclick="window.location.href='/pdf/all-invations/?eventId=<?= $_GET['eventId'] ?>'">
                <img src="/src/images/icon-qrcode-black.png?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/icon-qrcode-black.png') ?>" />
                <div class="tip">Wygeneruj kody QR</div>
            </div>
            <div class="absolute-img" onclick="showAddInvationForm(true);">
                <img src="/src/images/add.png?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/add.png') ?>" />
                <div class="tip">Dodaj zaproszenie i gości</div>
            </div>
        </div>
        <div id="guestListBox" class="guest-list-box"></div>
    </div>
</div>
<script src="/src/js/event/event-info-scripts.js?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/js/event/event-info-scripts.js') ?>"></script>
<script>
    loadInvations();
</script>