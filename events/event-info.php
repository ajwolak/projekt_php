<?php
if (!isset($_GET['eventId']) || empty($_GET['eventId'])) {
?>
    <script>
        window.location.href = "/";
    </script>
<?php
}

$event_data = eventDownload($_GET['eventId']);
$max_date = new DateTime($event_data['max_accept_date']);
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
        <div class="absolute-img" onclick="window.location.href='/events/?list=edit&eventId=<?= $_GET['eventId'] ?>'">
            <img src="/src/images/icon-edit-pen-black.png?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/icon-edit-pen-black.png') ?>" alt="Edytuj" />
        </div>
    </div>
    <div id="invationBox" style="width: 100%;">
        <?php
        require(__DIR__ . '/event-invation-add.php');
        ?>
    </div>

    <div class="guest-list">
        <div class="header">
            <h3>Lista gości:</h3>
        </div>
        <div class="absolute-img">
            <img src="/src/images/add.png?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/add.png') ?>" />
        </div>
    </div>
</div>

<script>
    async function loadGuestPopup() {

        const res = await fetchApi('/api/functions/invation/add-invation-form.php', {
            action: 'showInvationForm'
        });

        const resJson = await res.json();
        console.log(resJson);
    }
</script>