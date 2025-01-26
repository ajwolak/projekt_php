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
        } else {
            $_SESSION['addError'] = 'Wystąpił błąd podczas dodawania. Spróbuj ponownie.';
            header('Location: /events/?list=add');
            exit();
        }
        $locationName = $_POST['locationName'];
        $locationDate = $_POST['locationDate'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $postCode = $_POST['postCode'];
        $street = $_POST['street'];


        $sql4 = "INSERT INTO events_locations (id, eventId, street, zipCode, town, country, name, date) VALUES (NULL,$eventId,?,?,?,?,?,'$locationDate');";
        $stmt4 = $GLOBALS['link']->prepare($sql4);
        $stmt4->bind_param('sssss', $street, $postCode, $city, $country, $locationName);

        if ($stmt4->execute()) {
            header('Location: /events/?list=info&eventId=' . $eventId);
            exit();
        } else {
            $_SESSION['addError'] = 'Wystąpił błąd podczas dodawania. Spróbuj ponownie.';
            header('Location: /events/?list=add');
            exit();
        }
    }
    if ($_POST['action'] == 'updateEvent') {
        // print("<pre>" . print_r($_POST, true) . "</pre>");
        $userId = $_SESSION['userId'];
        $eventId = $_POST['eventIdUpdate'];
        $name = $_POST['name'];
        $dateMax = $_POST['dateMax'];
        $descriptionGuest = $_POST['descriptionGuest'] ?? '';
        $descriptionOwn = $_POST['descriptionOwn'] ?? '';

        $sql3 = "UPDATE events_list 
                 SET name = ?, guestDescription = ?, userDescription = ?, maxAcceptDate = ?
                 WHERE id = ? AND userId = ?;";
        $stmt3 = $GLOBALS['link']->prepare($sql3);
        $stmt3->bind_param('ssssii', $name, $descriptionGuest, $descriptionOwn, $dateMax, $eventId, $userId);

        if (!$stmt3->execute()) {
            $_SESSION['updateError'] = 'Wystąpił błąd podczas aktualizacji wydarzenia. Spróbuj ponownie.';
            header('Location: /events/?list=edit&eventId=' . $eventId);
            exit();
        }

        $locationName = $_POST['locationName'];
        $locationDate = $_POST['locationDate'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $postCode = $_POST['postCode'];
        $street = $_POST['street'];

        $sql4 = "UPDATE events_locations 
                 SET street = ?, zipCode = ?, town = ?, country = ?, name = ?, date = ?
                 WHERE eventId = ?;";
        $stmt4 = $GLOBALS['link']->prepare($sql4);
        $stmt4->bind_param('ssssssi', $street, $postCode, $city, $country, $locationName, $locationDate, $eventId);

        if ($stmt4->execute()) {
            header('Location: /events/?list=info&eventId=' . $eventId);
            exit();
        } else {
            $_SESSION['updateError'] = 'Wystąpił błąd podczas aktualizacji lokalizacji. Spróbuj ponownie.';
            header('Location: /events/?list=edit&eventId=' . $eventId);
            exit();
        }
    }
}
