<?php
session_start();
// print("<pre>" . print_r($_POST, true) . "</pre>");
if (isset($_POST['action'])) {
    require(__DIR__ . '/../functions/db-connect.php');

    if ($_POST['action'] == 'loginToDashboard') {

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

                if ($row['accountIsActive'] != 1) {
                    $_SESSION['loginError'] = "Twoje konto czeka na aktywację. Sprawdź maila.";
                    header('Location: /login/');
                } else {
                    $_SESSION['isLogged']           = true;
                    $_SESSION['userId']             = $row['id'];
                    $_SESSION['name']               = $row['name'];
                    $_SESSION['surname']            = $row['surname'];
                    $_SESSION['email']              = $row['email'];
                    $_SESSION['accountIsActive']    = $row['accountIsActive'];

                    $sql = "UPDATE users SET lastLoggin = NOW() WHERE id = " . $row['id'] . ";";
                    $GLOBALS['link']->query($sql);
                    header('Location: /home/');
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

    if ($_POST['action'] == 'activeAccountInDashboard') {
        try {
            $sql = "SELECT accountIsActive FROM users WHERE id = ?";
            $scr = $GLOBALS['link']->prepare($sql);
            $scr->bind_param("i", $_POST['userId']);
            $scr->execute();
            $result = $scr->get_result();
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                if ($row['accountIsActive'] === $_POST['token']) {
                    $sql = "UPDATE users SET accountIsActive = 1 WHERE id = ?;";
                    $scr = $GLOBALS['link']->prepare($sql);
                    $scr->bind_param("i", $_POST['userId']);
                    $scr->execute();
                    echo json_encode(['status' => 200, 'message' => 'Pomyślnie aktywowano konto.']);
                    exit();
                }
            }
            echo json_encode(['status' => 200, 'message' => 'Błędny link']);
            exit();
        } catch (\Throwable $th) {
            returnError($th, "Wystąpił błąd podczas aktywacji konta.");
        }
    }
}


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'logginOff') {
        session_destroy();
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        echo json_encode(["status" => 200]);
    }
}
