<?php

function guestDownload(int $id): array
{
    $sql = "SELECT * FROM invited_guests WHERE id = ?;";
    $scr = $GLOBALS['link']->prepare($sql);
    $scr->bind_param("i", $id);
    $scr->execute();
    $row = $scr->get_result()->fetch_assoc();

    return [
        "id"            => $row['id'],
        "event_id"      => $row['eventId'],
        "invationId"    => $row['invationId'],
        "name"          => $row['name'],
        "surname"       => $row['surname'],
        "is_kid"        => $row['isKid'],
        "email"         => $row['email'],
        "phone"         => $row['phone'],
        "sex"           => $row['sex'],
        "description"   => $row['description'],
        "is_accepted"   => $row['isAccepted'],
        "notes"         => $row['notes']
    ];
}
