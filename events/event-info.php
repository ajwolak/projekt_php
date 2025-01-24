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
    <div id="invationBox" style="width: 100%;"></div>

    <div class="guest-list">
        <div class="header">
            <h3>Lista gości:</h3>
        </div>
        <div class="absolute-img" onclick="showAddInvationForm(true);">
            <img src="/src/images/add.png?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/add.png') ?>" />
        </div>
    </div>
</div>

<script>
    async function addInvationToDb() {
        const invationBoxes = document.querySelectorAll('.invation-box');
        const invations = [];

        invationBoxes.forEach((invationBox) => {
            const inputs = invationBox.querySelectorAll('input, select');
            const invation = {};
            inputs.forEach((input) => {
                invation[input.name] = input.value;
            });
            invations.push(invation);
        });

        const res = await fetchApi("/api/invations/", {
            action: 'addInvation',
            eventId: paramDownload("eventId"),
            invations: JSON.stringify(invations)
        }, "POST");
        const resJson = await res.json();
        console.log(resJson);
        if (resJson.status == 200) {
            //tu dodać odświeżanie listy zaproszeń
            //tu dodać odświeżanie listy zaproszeń
            showAddInvationForm(false);
        } else {
            alert(resJson.message);
            console.log(resJson.error);
        }
    }

    function addQuestElement() {
        const invationBox = document.querySelector('.invation-box');
        const guestsBox = document.querySelector('#guestsBox');
        const invationBoxClone = invationBox.cloneNode(true);

        const guestNumber = guestsBox.children.length + 1;
        invationBoxClone.querySelector('.header h3').textContent = `Gość nr ${guestNumber}`;

        const inputs = invationBoxClone.querySelectorAll('input, select');
        inputs.forEach((input) => {
            if (input.tagName === 'SELECT') {
                input.selectedIndex = 0;
            } else {
                input.value = '';
            }
        });

        guestsBox.appendChild(invationBoxClone);
    }

    async function showAddInvationForm(bool) {
        var box = document.querySelector('#invationBox');
        if (bool) {
            const res = await fetchApi("/events/event-invation-add.php", {});
            box.innerHTML = await res.text();
        } else {
            box.innerHTML = "";
        }
    }
</script>