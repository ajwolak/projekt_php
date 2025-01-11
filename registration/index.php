<?php
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
                <button type="submit">Zarejestruj się</button>
            </div>
        </form>
    </div>

</body>

</html>