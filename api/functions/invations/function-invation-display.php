<?php
session_start();

require(__DIR__ . '/../db-connect.php');
require(__DIR__ . '/function-invations-collect.php');
require(__DIR__ . '/../guest/function-guest-download.php');
require(__DIR__ . '/../guest/function-guest-collect.php');
$body = '';

$i = 1;
foreach (invationsCollect($_GET['eventId'], 'DESC') as $invation_id) {
    $body .= '
        <label class="invation-box">
            <input type="checkbox" name="invation_id_' . $invation_id . '" >
            <div class="header">
                <h3>Zaproszenie nr ' . ($i++) . '</h3>
                <div class="actions">
                    <div class="action-box">
                        <img src="/src/images/icon-edit-pen-black.png?lmod=' . filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/icon-edit-pen-black.png') . '">
                        <div class="tip">Edytuj</div>
                    </div>
                    <div class="action-box" onclick="deleteInvation(' . $invation_id . ')">
                        <img src="/src/images/icon-bin-black.png?lmod=' . filemtime($_SERVER['DOCUMENT_ROOT'] . '/src/images/icon-bin-black.png') . '">
                        <div class="tip">Usuń zaproszenie</div>
                    </div>
                    <div class="arrow"></div>
                </div>
            </div>
            <div class="guest-container">
                <table>
                    <tr>
                        <th>Imię i nazwisko</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Twoja notatka</th>
                        <th>Zaakceptowano zaproszenie</th>
                        <th>Informacja od gościa</th>
                    </tr>
                ';
    foreach (guestCollect($_GET['eventId'], $invation_id) as $guest_id) {
        $guest_info = guestDownload($guest_id);
        $body .= '
            <tr>
                <td>' . $guest_info['name'] . ' ' . $guest_info['surname'] . '</td>
                <td>' . $guest_info['email'] . '</td>
                <td>' . $guest_info['phone'] . '</td>
                <td>' . $guest_info['description'] . '</td>
                <td>' . ($guest_info['is_accepted'] == 0 ? '<span class="font-color-red">Nie</span>' : '<span class="font-color-green">Tak</span>') . '</td>
                <td>' . $guest_info['notes'] . '</td>
            </tr>
        ';
    }
    $body .= '</table>
            </div>
        </label>
    ';
}

echo $body;
