<?php
function eventCollect(int $user_id): array
{
    $sql = "SELECT * FROM events_list WHERE userId = ?";
    $scr = $GLOBALS['link']->prepare($sql);
    $scr->bind_param("i", $user_id);
    $scr->execute();
    $result = $scr->get_result();
    $events = [];

    while ($row = $result->fetch_assoc()) {
        $events[] = [
            "id"                => $row['id'],
            "event_type"        => $row['eventType'],
            "user_id"           => $row['userId'],
            "name"              => $row['name'],
            "guest_description" => $row['guestDescription'],
            "user_description"  => $row['userDescription'],
            "creation_date"     => $row['creationDate'],
            "max_accept_date"   => $row['maxAcceptDate'],
        ];
    }

    return $events;
}
