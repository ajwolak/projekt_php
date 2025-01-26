<link rel="stylesheet" href="/src/css/pages/events/event-list.css">
<div class="event-list">
    <div class="new-event" onclick="window.location.href='/events/?list=add'">
        <p>Utwórz nowe wydarzenie</p>
    </div>
    <?php
    $body = '';
    foreach (eventCollect($_SESSION['userId']) as $key => $value) {
        $body .= '<div class="event-container">
                    <div class="event-name"><p><b>Nazwa</b></p><p>' . eventDownload($value)['name'] . '</p></div>
                    <div class="event-desc"><p><b>Opis dla gości</b></p><p>' . eventDownload($value)['guest_description'] . '</p></div>
                    <div class="event-desc"><p><b>Uwagi dodatkowe</b></p><p>' . eventDownload($value)['user_description'] . '</p></div>
                    <div class="event-date"><p><b>Można zaakcpetowac do</b></p><p>' . eventDownload($value)['max_accept_date'] . '</p></div>
                    <div class="event-buttons">
                        <div>Edytuj</div>
                        <div onclick="window.location.href=\'/events/?list=info&eventId=' . $value . '\'">Więcej</div>
                    </div>
                </div>';
    }
    echo $body;
    ?>
</div>
</div>