<?php

function eventDownload(int $event_id): array
{
    $sql = "SELECT * FROM events_list WHERE id = ?";
    $scr = $GLOBALS['link']->prepare($sql);
    $scr->bind_param("i", $event_id);
    $scr->execute();
    $result = $scr->get_result();
    if ($result->num_rows == 0) {
        return [];
    }
    $row = $result->fetch_assoc();
    return [
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
