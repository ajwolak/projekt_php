<?php
session_start();
if (isset($_POST['action'])) {
    require(__DIR__ . '/../functions/db-connect.php');
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';

    $sql = "SELECT 1 FROM users WHERE login = ?;";
    $stmt = $GLOBALS['link']->prepare($sql);
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $_SESSION['regError'] = 'Podany login już istnieje!';
        header("Location: /registration/");
    }

    $sql = "SELECT 1 FROM users WHERE email = ?;";
    $stmt = $GLOBALS['link']->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $_SESSION['regError'] = 'Podany e-mail już istnieje!';
        header("Location: /registration/");
    }

    $verifyCode = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(20 / strlen($x)))), 1, 20);

    $sql = "INSERT INTO users (id, name, surname, login, password, email, accountIsActive, lastLoggin, editDate) VALUES (NULL,?,?,?,?,?,'$verifyCode','0000-00-00 00:00:00','0000-00-00 00:00:00');";
    $stmt = $GLOBALS['link']->prepare($sql);
    $stmt->bind_param('sssss', $name, $surname, $login, $password, $email);
    $stmt->execute();

    if ($stmt->execute()) {
        header('Location: /registration/?reg=success');
    } else {
        $_SESSION['regError'] = 'Wystąpił błąd podczas rejestracji. Spróbuj ponownie.';
        header('Location: /registration/');
    }
}
