<?php

function userCheckEvent(): bool
{
    $sql = "SELECT * FROM events_list WHERE userId = ?;";
    $stmt = $GLOBALS['link']->prepare($sql);
    $stmt->bind_param('i', $_SESSION['userId']);
    $stmt->execute();
    $result = $stmt->get_result();
    return ($result->num_rows === 0);
}
