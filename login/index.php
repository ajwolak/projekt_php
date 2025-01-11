<?php
session_start();
if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
    header("Location: /home/");
}
$page_title = 'Logowanie do panelu';
require(__DIR__ . '/../src/modules/head/head.php');
?>
<link rel="stylesheet" href="/src/css/pages/login/style.css?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/css/pages/login/style.css') ?>">
<div class="form-box">
    <form action="/api/login/" method="POST">
        <h3>Zaloguj sie do systemu</h3>
        <div class="input-box">
            <input type="text" name="login" id="login" placeholder="Login:" autocomplete="off">
            <label for="login">Login:</label>
        </div>
        <div class="input-box">
            <input type="password" name="password" id="password" placeholder="Hasło:" autocomplete="off">
            <label for="password">Hasło:</label>
        </div>

        <?php
        if (isset($_SESSION['loginError'])) {
            echo '<div class="error" >' . $_SESSION['loginError'] . '</div>';
            unset($_SESSION['loginError']);
        }
        ?>
        <div>
            <input type="hidden" name="action" value="loginToDashboard">
            <button type="submit">Zaloguj</button>
        </div>
        <div class="link">
            <p>Nie masz konta? <a href="/registration/">Zarejestruj się!</a></p>
        </div>
    </form>
</div>

</body>

<script>
    if (paramDownload("action") && paramDownload("id") && paramDownload("token")) {
        activeAccount(paramDownload("id"), paramDownload("token"));
        paramDelete("id");
        paramDelete("token");
        paramDelete("action");
    }

    async function activeAccount(id, token) {
        fetchApi("/api/login/", {
                action: 'activeAccountInDashboard',
                userId: id,
                token: token
            }, "POST")
            .then(res => {
                return res.json();
            })
            .then(res => {
                alert(res.message);
                if (res.error)
                    console.log(res.error);
            })
    }
</script>

</html>