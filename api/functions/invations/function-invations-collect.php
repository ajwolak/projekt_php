<?php

function invationsCollect(int $event_id,  string $sort = "ASC"): array
{
    $arr = [];
    $sql = "SELECT id FROM invation WHERE eventId = ? ORDER BY id $sort;";
    $scr = $GLOBALS['link']->prepare($sql);
    $scr->bind_param('i', $event_id);
    $scr->execute();
    $result = $scr->get_result();
    while ($row = $result->fetch_assoc()) {
        array_push($arr, $row['id']);
    }
    return $arr;
}
