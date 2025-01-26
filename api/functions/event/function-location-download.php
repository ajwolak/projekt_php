<?php

function locationDownload(int $event_id): array
{
    $sql = "SELECT * FROM events_locations WHERE eventId = ?";
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
        "event_id"          => $row['eventId'],
        "street"            => $row['street'],
        "zip_code"          => $row['zipCode'],
        "town"              => $row['town'],
        "country"           => $row['country'],
        "name"              => $row['name'],
        "date"              => $row['date'],
    ];
}
