<?php

require_once(__DIR__ . '/../../api/config.php');
require_once(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../api/functions/db-connect.php');
require(__DIR__ . '/../../api/functions/invations/function-invations-collect.php');
require(__DIR__ . '/../../api/functions/guest/function-guest-collect.php');
require(__DIR__ . '/../../api/functions/guest/function-guest-download.php');
require(__DIR__ . '/../../api/functions/event/function-event-download.php');
require(__DIR__ . '/../../api/functions/invations/function-invation-download.php');

$event_id = $_GET['eventId'] ?? '';

if (empty($event_id)) {
    header('Location: /');
}

$event_info = eventDownload($event_id);
$invations = invationsCollect($event_id, "DESC");


class MYPDF extends TCPDF
{
    public function Header()
    {
        $this->Image(__DIR__ . "/../../src/images/logo-transparent.png", 6, 6, 35, 0);
        $this->SetFont('DejaVuSansCondensed', 'B', 20);
        $this->Cell(190, 0, $GLOBALS['event_info']['name'], 0, 1, "C");
        $this->Ln(3);
        $this->SetFont('DejaVuSansCondensed', 'B', 16);
        $this->Cell(190, 0, "Lista potwierdzonych osób", 0, 1, "C");
    }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($GLOBALS['config_company_name']);
$pdf->SetTitle($GLOBALS['config_company_name'] . ' - lista gości potwierdzonych');
$pdf->SetSubject($GLOBALS['config_company_name'] . ' - lista gości potwierdzonych');
$pdf->SetKeywords($GLOBALS['config_company_name'] . ' - lista gości potwierdzonych');
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$pdf->AddPage();

$qr_style = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false
);

$i = 1;
foreach ($invations as $invation) {
    $pdf->Ln(10);
    $guest = guestCollect($event_id, $invation);
    $y_position = $pdf->GetY();
    $pdf->SetFont('DejaVuSansCondensed', 'B', 18);
    $pdf->Ln(3);
    foreach ($guest as $guest_id) {
        $guest_info = guestDownload($guest_id);
        if ($guest_info['is_accepted'] == 0) continue;
        $pre = $guest_info['sex'] == 0 ? "Pan" : "Pani";
        $pdf->SetFont('DejaVuSansCondensed', 'B', 13);
        $pdf->Cell(138, 0, $pre . ' ' . $guest_info['name'] . " " . $guest_info['surname'], 0, 1, "L");
        $pdf->Ln(1);
    }
    $pdf->Ln(8);
}

ob_end_clean();
$pdf->Output('lista_gości_potwierdzonych.pdf', 'I');
