<?php

function invationDownload(int $invation_id): array
{
    $sql = "SELECT * FROM invation WHERE id = ?;";
    $scr = $GLOBALS['link']->prepare($sql);
    $scr->bind_param('i', $invation_id);
    $scr->execute();
    $row = $scr->get_result()->fetch_assoc();
    return [
        'id'            => $row['id'],
        "invation_code" => $row['invationCode'],
        "event_id"      => $row['eventId'],
    ];
}

function invationCodeDownload(string $code): array
{
    $sql = "SELECT * FROM invation WHERE invationCode = ?;";
    $scr = $GLOBALS['link']->prepare($sql);
    $scr->bind_param('s', $code);
    $scr->execute();
    $row = $scr->get_result()->fetch_assoc();
    return [
        'id'            => $row['id'],
        "invation_code" => $row['invationCode'],
        "event_id"      => $row['eventId'],
    ];
}
