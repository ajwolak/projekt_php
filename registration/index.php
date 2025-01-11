<?php
session_start();
if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
    header("Location: /home/");
}
$page_title = 'Rejestracja';

require(__DIR__ . '/../src/modules/head/head.php');
?>

<link rel="stylesheet" href="/src/css/pages/login/style.css?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/css/pages/login/style.css') ?>">
<div class="form-box">
    <?php

    if (isset($_GET['reg']) && $_GET['reg'] == 'success')
        echo '
        <div class="success">
            <h1>Dziękujemy za rejestrację!</h1>
            <p>Twoje konto zostało pomyślnie utworzone.</p>
            <p>Wysłaliśmy do Ciebie e-mail z linkiem aktywacyjnym.</p>
            <p><b>Co dalej?</b></p>
            <ul>
                <li>Sprawdź swoją skrzynkę pocztową (w tym folder Spam, jeśli wiadomość nie jest widoczna w folderze głównym).</li>
                <li>Kliknij w link aktywacyjny w wiadomości, aby aktywować swoje konto.</li>
            </ul>
            <p>Jeśli nie otrzymałeś e-maila w ciągu kilku minut, skontaktuj się z nami.</p>
            <a href="/login/">Przejdź do logowania!</a>
        </div>
        ';
    else {

    ?>
        <form action="/api/registration/" method="POST">
            <h3>Uzupełnij poniższe dane</h3>
            <div class="input-box">
                <input type="text" name="login" id="login" required placeholder="Login:" autocomplete="off">
                <label for="login">Login:</label>
            </div>

            <div class="input-box">
                <input type="password" name="password" id="password" required placeholder="Hasło:" autocomplete="off">
                <label for="password">Hasło:</label>
            </div>

            <div class="input-box">
                <input type="email" name="email" id="email" required placeholder="E-mail:" autocomplete="off">
                <label for="email">E-mail:</label>
            </div>

            <div class="input-box">
                <input type="text" name="name" id="name" placeholder="Imię:" autocomplete="off">
                <label for="name">Imię:</label>
            </div>

            <div class="input-box">
                <input type="text" name="surname" id="surname" placeholder="Nazwisko:" autocomplete="off">
                <label for="surname">Nazwisko:</label>
            </div>
            <?php
            if (isset($_SESSION['regError'])) {
                echo '<div class="error">' . $_SESSION['regError'] . '</div>';
                unset($_SESSION['regError']);
            }
            ?>
            <div>
                <input type="hidden" name="action" value="registrationAccount">
                <button type="submit">Zarejestruj się</button>
            </div>

            <div class="link">
                <p>Masz już konto? <a href="/login/">Zaloguj się!</a></p>
            </div>
        </form>
    <?php
    }
    ?>
</div>

</body>

</html>