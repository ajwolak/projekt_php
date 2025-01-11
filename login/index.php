<?php
session_start();
if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
    header("Location: /home/");
}
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie do panelu</title>
</head>

<body>
    <div>
        <form action="/api/login/" method="POST">
            <div>
                <div class="input-box">
                    <label for="login">Login:</label>
                    <input type="text" name="login" id="login">
                </div>
            </div>
            <div>
                <div class="input-box">
                    <label for="password">Hasło:</label>
                    <input type="password" name="password" id="password">
                </div>
            </div>
            <div>
                <?php
                if (isset($_SESSION['loginError'])) {
                    echo "<p>" . $_SESSION['loginError'] . "</p>";
                    unset($_SESSION['loginError']);
                }
                ?>
            </div>
            <div>
                <input type="hidden" name="action" value="loginToDashboard">
                <button type="submit">Zaloguj</button>
            </div>
        </form>
    </div>

</body>

</html>