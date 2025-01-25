<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['action'])) {
    require(__DIR__ . '/../functions/db-connect.php');


    if ($_POST['action'] == 'addInvation') {
        try {
            $event_id = $_POST['eventId'];
            $invations = json_decode($_POST['invations'], true);

            $sql = "INSERT INTO invation (id, eventId) VALUES (NULL, ?);";
            $scr = $GLOBALS['link']->prepare($sql);
            $scr->bind_param("i", $event_id);
            $scr->execute();
            $invationId = $scr->insert_id;

            foreach ($invations as $invation) {
                $sql = "INSERT INTO invited_guests(id, eventId, invationId, name, surname, isKid, email, phone, sex, description, isAccepted, notes) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '');";
                $scr = $GLOBALS['link']->prepare($sql);
                $scr->bind_param("iississisi", $event_id, $invationId, $invation['name'], $invation['surname'], $invation['isKid'], $invation['email'], $invation['phone'], $invation['sex'], $invation['description'], $invation['isAccepted']);
                $scr->execute();
            }

            echo json_encode(['status' => 200]);
        } catch (\Throwable $th) {
            returnError($th, "Błąd dodawania zaproszenia.");
        }
    }
}
