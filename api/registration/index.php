<?php
session_start();
function generateToken(int $length = 20): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}


if (isset($_POST['action'])) {
    require(__DIR__ . '/../functions/db-connect.php');
    require(__DIR__ . '/../functions/function-send-mail.php');

    if ($_POST['action'] == 'registrationAccount') {
        print("<pre>" . print_r($_POST, true) . "</pre>");
        $login = $_POST['login'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $name = $_POST['name'] ?? '';
        $surname = $_POST['surname'] ?? '';

        $sql = "SELECT id FROM users WHERE login = ?;";
        $stmt = $GLOBALS['link']->prepare($sql);
        $stmt->bind_param('s', $login);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['regError'] = 'Konto z takim loginem już istnieje. <br/> Zaloguj się lub wpisz inny login.';
            header('Location: /registration/');
            exit();
        }

        $sql2 = "SELECT id FROM users WHERE email = ?;";
        $stmt2 = $GLOBALS['link']->prepare($sql2);
        $stmt2->bind_param('s', $email);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows > 0) {
            $_SESSION['regError'] = 'Konto z takim mailem już istnieje. <br /> Zaloguj się lub wpisz inny adres email.';
            header('Location: /registration/');
            exit();
        }

        $verifyCode = generateToken(20);

        $sql3 = "INSERT INTO users (id, name, surname, login, password, email, accountIsActive, lastLoggin, editDate) VALUES (NULL,?,?,?,?,?,'$verifyCode','0000-00-00 00:00:00','0000-00-00 00:00:00');";
        $stmt3 = $GLOBALS['link']->prepare($sql3);
        $stmt3->bind_param('sssss', $name, $surname, $login, $password, $email);

        if ($stmt3->execute()) {
            $last_id = $GLOBALS['link']->insert_id;
            mailRegistration($last_id, $verifyCode, $name, $email);
            header('Location: /registration/?reg=success');
            exit();
        } else {
            $_SESSION['regError'] = 'Wystąpił błąd podczas rejestracji. Spróbuj ponownie.';
            header('Location: /registration/');
            exit();
        }
    }
}
