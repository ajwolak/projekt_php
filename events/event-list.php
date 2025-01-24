<link rel="stylesheet" href="/src/css/pages/events/event-list.css">
<div class="event-list">
    <?php
    $body = '';
    $userEvents = eventCollect($_SESSION['userId']);
    foreach ($userEvents as $key) {
        $body .= '<div class="event-container">
                    <div class="event-name"><p>Nazwa</p><p>' . $key['name'] . '</p></div>
                    <div class="event-name"><p>Opis dla gości</p><p>' . $key['guestDescription'] . '</p></div>
                    <div class="event-name"><p>Uwagi dodatkowe</p><p>' . $key['userDescription'] . '</p></div>
                    <div class="event-name"><p>Mozna zaakcpetowac do</p><p>' . $key['maxAcceptDate'] . '</p></div>
                </div>';
    }
    echo $body;
    ?>
</div>
</div>