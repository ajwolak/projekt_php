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

$sql = "SELECT id FROM invited_guests WHERE eventId = $event_id AND isAccepted = 1;";
$scr = $GLOBALS['link']->prepare($sql);
$scr->execute();
$res = $scr->get_result();

while ($row = $res->fetch_assoc()) {
    $guest_info = guestDownload($row['id']);
    $pre = $guest_info['sex'] == 0 ? "Pan" : "Pani";
    $pdf->SetFont('DejaVuSansCondensed', 'B', 13);
    $pdf->Cell(138, 0, $pre . ' ' . $guest_info['name'] . " " . $guest_info['surname'], 0, 1, "L");
    $pdf->Ln(1);
}


ob_end_clean();
$pdf->Output('lista_gości_potwierdzonych.pdf', 'I');
