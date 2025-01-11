<?php
session_start();
if (isset($_POST['action'])) {
    require(__DIR__ . '/../functions/db-connect.php');
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE login = ?;";
    $stmt = $GLOBALS['link']->prepare($sql);
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {

            if ($row['accountIsActive'] == 0) {
                $_SESSION['loginError'] = "Twoje konto czeka na aktywację. Sprawdź maila i dokończ aktywację.";
                header('Location: /login/');
            } else {

                $_SESSION['isLogged']           = true;
                $_SESSION['userId']             = $row['id'];
                $_SESSION['name']               = $row['name'];
                $_SESSION['surname']            = $row['surname'];
                $_SESSION['email']              = $row['email'];
                $_SESSION['accountIsActive']    = $row['accountIsActive'];

                $sql = "UPDATE users SET lastLogin = NOW();";
                $GLOBALS['link']->query($sql);
                header('Location: /');
            }
        } else {
            $_SESSION['loginError'] = 'Nieprawidłowe hasło';
            header('Location: /login/');
        }
    } else {
        $_SESSION['loginError'] = 'Nieprawidłowy login';
        header('Location: /login/');
    }
}
