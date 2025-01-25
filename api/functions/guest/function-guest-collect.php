<?php

function guestCollect(int $event_id, int $invation_id): array
{
    $arr = [];
    $sql = "SELECT id FROM invited_guests WHERE eventId = ? AND invationId = ?;";
    $scr = $GLOBALS['link']->prepare($sql);
    $scr->bind_param("ii", $event_id, $invation_id);
    $scr->execute();
    $result = $scr->get_result();
    while ($row = $result->fetch_assoc()) {
        array_push($arr, $row['id']);
    }
    return $arr;
}
