<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

//logowanie błędów do pliku
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../../errors.log');
//logowanie błędów do pliku

require_once(__DIR__ . '/../../vendor/autoload.php');


//funkcja do obsługi błędów
function returnError(\Throwable $th, string $message): void
{
    echo json_encode([
        'status' => 500,
        'error' => "File: " . $th->getFile() . ' \n Line: ' . $th->getLine() . ' \n Trace: ' . $th->getTraceAsString() . ' \n Message: ' . $th->getMessage(),
        'message' => $message
    ]);
    exit();
}

//funkcja rejestruje fatal error i zwraca json
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && ($error['type'] === E_ERROR || $error['type'] === E_PARSE || $error['type'] === E_CORE_ERROR || $error['type'] === E_COMPILE_ERROR)) {
        echo json_encode([
            'status' => 500,
            'error' => "File: " .  $error['file'] . ' \n Line: ' . $error['line'],
            'message' => "Wystąpił błąd."
        ]);
        exit();
    }
});


try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../', ".env.development");
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']); //wymagane zmienne, które muszą być w pliku

    $link = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
} catch (\Throwable $th) {
    returnError($th, "Błąd połączenia z serwerem i bazą.");
}
