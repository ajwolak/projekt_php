<?php

function mailRegistration(int $user_id, string $user_hash, string $user_name, string $user_mail): void
{
    $body = '
    <!DOCTYPE html>
    <html lang="pl">    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $GLOBALS['config_company_name'] . ' - aktywacja konta</title>
        <style>
            body {
                margin: 0 auto;
                padding: 0;
                width: 100%;
                height: 100%;
            }

            .content {
                width: 70%;
                overflow: hidden;
                padding: 40px;
                margin: 100px auto 0 auto;
            }

            .heading {
                width: calc(100% + 80px);
                height: 90px;
                background-color: #3693eb;
            }

            .heading a {
                text-decoration: none;
                text-align: center;
                font-size: 40px;
                width: 100%;
                color: white;
                display: block;
                line-height: 90px;
            }

            p {
                font-size: 19px;
            }

            .button {
                width: fit-content;
                font-size: 25px;
                padding: 8px 13px;
                background-color: #3693eb;
                text-align: center;
                color: white;
                cursor: pointer;
                text-decoration: none;

            }
        </style>
    </head>

    <body>
        <div class="content">
            <div class="heading">
                <a href="https://www.partyplanner.com.pl">' . $GLOBALS['config_company_name'] . '</a>
            </div>
            <div>
                <h1>Cześć ' . $user_name . '</h1>
                <p>Cieszymy się, że do nas dołączyłeś i postanowiłeś skorzystać z naszych usług!</p>
                <p>Aby rozpocząć korzystanie z konta, prosimy o jego aktywację. Wystarczy, że klikniesz w poniższy przycisk:</p>
                <br />
                <a class="button" href="https://www.' . $_SERVER['SERVER_NAME'] . '/login/?action=activeAccount&id=' . $user_id . '&token=' . urlencode($user_hash) . '">Aktywuj konto </a>
                <br />
                <br />

                <p>Dziękujemy za zaufanie! <br />W razie jakichkolwiek pytań, skontaktuj się z naszym zespołem wsparcia.</p>
                <p>Pozdrawiamy,<br>Zespół ' . $GLOBALS['config_company_name'] . '</p>
            </div>
        </div>
    </body>

    </html>
    ';

    sendMail([$user_mail], $GLOBALS['config_company_name'] . " - aktywacja konta", $body, $GLOBALS['config_company_name']);
}
