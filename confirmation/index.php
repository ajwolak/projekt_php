<?php

if (!isset($_GET['code']) || empty($_GET['code'])) {
    // header('Location: /');
}

require(__DIR__ . '/../api/config.php');
require(__DIR__ . '/../api/functions/db-connect.php');
require(__DIR__ . '/../api/functions/invations/function-invation-download.php');
require(__DIR__ . '/../api/functions/guest/function-guest-download.php');
require(__DIR__ . '/../api/functions/event/function-event-download.php');
require(__DIR__ . '/../api/functions/guest/function-guest-collect.php');

$page_title = "Potwierdzenie obecności";

require(__DIR__ . '/../src/modules/head/head.php');

$invation_info = invationCodeDownload($_GET['code']);
$event_info = eventDownload($invation_info['event_id']);
$guest_collect = guestCollect($invation_info['event_id'], $invation_info['id']);

?>
<link rel="stylesheet" href="/src/css/pages/confirmation/style.css?lmod=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/css/pages/confirmation/style.css') ?>">
<section>
    <div class="confirmation-box">
        <div class="header">
            <h3 style="margin-bottom: 8px;"><?= $event_info['name'] ?></h3>
            <p>Potwierdzenie online</p>
        </div>
        <div class="guest-box">
            <table>
                <?php
                foreach ($guest_collect as $guest_id) {
                    $guest_info = guestDownload($guest_id);
                    echo '
                    <tr>
                        <td><b>' . $guest_info['name'] . ' ' . $guest_info['surname'] . '</b></td>
                        <td>
                            <div class="global-input-box">
                                <select>
                                    <option value="1">Będę na weselu</option>
                                    <option value="0">Nie będzie mnie na weselu</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="global-input-box">
                                <input type="text" placeholder="Informacja dla organizatorów" autocomplete="off" required/>
                                <label>Informacja dla organizatorów:</label>
                            </div>
                        </td>
                    </tr>';
                }
                ?>
            </table>
        </div>
        <div class="action-box">
            <div class="button">Potwierdzam</div>
        </div>
    </div>
</section>

</body>

</html>