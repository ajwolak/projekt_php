<?php
function eventCollect(int $user_id): array
{
    $arr = array();
    $sql = "SELECT * FROM events_list WHERE userId = ?;";
    $scr = $GLOBALS['link']->prepare($sql);
    $scr->bind_param("i", $user_id);
    $scr->execute();
    $result = $scr->get_result();
    while ($row = $result->fetch_array()) {
        array_push($arr, $row['id']);
    }
    return $arr;
}
