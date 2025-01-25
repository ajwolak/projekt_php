<?php
session_start();

if (isset($_POST['action'])) {
    require(__DIR__ . '/../functions/db-connect.php');
    require(__DIR__ . '/../functions/function-send-mail.php');

    if ($_POST['action'] == 'addNewEvent') {
        // print("<pre>" . print_r($_POST, true) . "</pre>");
        $userId = $_SESSION['userId'];
        $name = $_POST['name'];
        $dateMax = $_POST['dateMax'];
        $descriptionGuest = $_POST['descriptionGuest'] ?? '';
        $descriptionOwn = $_POST['descriptionOwn'] ?? '';

        $sql3 = "INSERT INTO events_list (id, eventType, userId, name, 	guestDescription, userDescription, creationDate, maxAcceptDate) VALUES (NULL,1,$userId,?,?,?,NOW(),'$dateMax');";
        $stmt3 = $GLOBALS['link']->prepare($sql3);
        $stmt3->bind_param('sss', $name, $descriptionGuest, $descriptionOwn);

        if ($stmt3->execute()) {
            $eventId = $stmt3->insert_id;
            header('Location: /event/?list=info&eventId=' . $eventId);
            exit();
        } else {
            $_SESSION['addError'] = 'Wystąpił błąd podczas dodawania. Spróbuj ponownie.';
            header('Location: /events/?list=add');
            exit();
        }
    }
}
