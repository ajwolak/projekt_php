<?php
session_start();
header('Content-Type: application/json');

if (isset($_GET['action'])) {
    require(__DIR__ . '/../functions/db-connect.php');

    if ($_GET['action'] == "getStats") {
        try {
            $sql = "SELECT COUNT(id) as summ FROM invited_guests WHERE isAccepted = 2 AND eventId = ?;";
            $scr = $GLOBALS['link']->prepare($sql);
            $scr->bind_param('i', $_GET['eventId']);
            $scr->execute();
            $row = $scr->get_result()->fetch_assoc();
            $no_info = $row['summ'] ?? 0;

            $sql2 = "SELECT COUNT(id) as summ FROM invited_guests WHERE isAccepted = 1 AND eventId = ?;";
            $scr2 = $GLOBALS['link']->prepare($sql2);
            $scr2->bind_param('i', $_GET['eventId']);
            $scr2->execute();
            $row2 = $scr2->get_result()->fetch_assoc();
            $accepted = $row2['summ'] ?? 0;

            $sql3 = "SELECT COUNT(id) as summ FROM invited_guests WHERE isAccepted = 0 AND eventId = ?;";
            $scr3 = $GLOBALS['link']->prepare($sql3);
            $scr3->bind_param('i', $_GET['eventId']);
            $scr3->execute();
            $row3 = $scr3->get_result()->fetch_assoc();
            $not_accepted = $row3['summ'] ?? 0;

            echo json_encode(
                [
                    "status" => 200,
                    "body" => [
                        'noInfo' => $no_info,
                        "accepted" => $accepted,
                        "notAccepted" => $not_accepted,
                    ]
                ]
            );
        } catch (\Throwable $th) {
            returnError($th, "Błąd przy pobieraniu statystyk");
        }
    }
}
