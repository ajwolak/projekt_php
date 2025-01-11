<?php
session_start();
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja do panelu</title>
</head>

<body>
    <div>
        <?php

        if (isset($_GET['reg']) && $_GET['reg'] == 'success')
            echo "
             <h1>Dziękujemy za rejestrację!</h1>
        <p>Twoje konto zostało pomyślnie utworzone.</p>
        <p>Wysłaliśmy do Ciebie e-mail z linkiem aktywacyjnym, który należy kliknąć, aby zakończyć proces rejestracji.</p>
        <p><strong>Co dalej?</strong></p>
        <ul style='text-align: left; margin: 0 auto; padding-left: 20px;'>
            <li>Sprawdź swoją skrzynkę pocztową (w tym folder Spam, jeśli wiadomość nie jest widoczna w folderze głównym).</li>
            <li>Kliknij w link aktywacyjny w wiadomości, aby aktywować swoje konto.</li>
        </ul>
        <p>Jeśli nie otrzymałeś e-maila w ciągu kilku minut, skontaktuj się z nami, abyśmy mogli Ci pomóc.</p>
        <p>Cieszymy się, że dołączyłeś do naszej społeczności!</p>
        <a href='/login/'>Przejdź do logowania!</a>";
        else {
            if (isset($_SESSION['regError'])) {
                echo $_SESSION['regError'];
                unset($_SESSION['regError']);
            }

        ?>
            <form action="/api/registration/" method="POST">
                <div>
                    <div class="input-box">
                        <label for="login">Login:</label>
                        <input type="text" name="login" id="login" required>
                    </div>
                </div>
                <div>
                    <div class="input-box">
                        <label for="password">Hasło:</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                </div>
                <div>
                    <div class="input-box">
                        <label for="name">Imię:</label>
                        <input type="text" name="name" id="name">
                    </div>
                </div>
                <div>
                    <div class="input-box">
                        <label for="surname">Nazwisko:</label>
                        <input type="text" name="surname" id="surname">
                    </div>
                </div>
                <div>
                    <div class="input-box">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                </div>
                <div>
                    <input type="hidden" name="action">
                    <button type="submit">Zarejestruj się</button>
                </div>
            </form>
        <?php
        }
        ?>
    </div>

</body>

</html>