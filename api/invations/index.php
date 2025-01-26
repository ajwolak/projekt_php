<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['action'])) {
    require(__DIR__ . '/../functions/db-connect.php');

    function generateRandomCode(int $length = 7): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomCode = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomCode;
    }

    function isCodeUnique(string $code): bool
    {
        global $link;
        $sql = "SELECT COUNT(*) as count FROM invation WHERE invationCode = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $row = ($stmt->get_result())->fetch_assoc();
        return $row['count'] == 0;
    }

    function generateUniqueCode(): string
    {
        do {
            $randomCode = generateRandomCode();
        } while (!isCodeUnique($randomCode));
        return $randomCode;
    }

    if ($_POST['action'] == 'addInvation') {
        try {
            $event_id = $_POST['eventId'];
            $invations = json_decode($_POST['invations'], true);

            $random_code = generateUniqueCode();

            $sql = "INSERT INTO invation (id, eventId, invationCode) VALUES (NULL, ?, ?);";
            $scr = $GLOBALS['link']->prepare($sql);
            $scr->bind_param("is", $event_id, $random_code);
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
