<?php
session_start();

require(__DIR__ . '/../api/functions/db-connect.php');
require(__DIR__ . '/../api/config.php');
require(__DIR__ . '/../src/modules/head/head.php');

?>

<div>
    <h1>Ups... Błędny link</h1>
    <h3>Niestety nic tu nie ma</h3>
    <br />
    <br />
    <a href="/">
        <h3>Powrót na stronę główną</h3>
    </a>
</div>

</body>

</html>