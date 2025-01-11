<?php
session_start();
if (isset($_POST['action'])) {
    require(__DIR__ . '/../functions/db-connect.php');
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    isset($_POST['name']) ? $name =  $_POST['name'] : $name = '';
    isset($_POST['surname']) ? $surname =  $_POST['surname'] : $surname = '';

    $sql = "INSERT INTO users (`id`, `name`, `surname`, `login`, `password`, `email`, `accountIsActive`, `lastLoggin`, `editDate`) VALUES (`NULL`,`?`,`?`,`?`,`?`,`?`,`0`,`0000-00-00 00:00:00`,`0000-00-00 00:00:00`);";
    $stmt = $GLOBALS['link']->prepare($sql);
    $stmt->bind_param('si', $login, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // $_SESSION['ma']

            header('Location: /login/');
        } else {
            $_SESSION['loginError'] = 'Nieprawidłowe hasło';
            header('Location: /login/');
        }
    } else {
        $_SESSION['loginError'] = 'Nieprawidłowy login';
        header('Location: /login/');
    }
}
