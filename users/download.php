<?php
// --- Load FPDF ---
require('../fpdf186/fpdf.php'); // Adjust path as needed
include '../dbconnect.php';
session_start();

if (!isset($_SESSION['user_email'])) {
    exit("Access denied");
}

$id = $_GET['id'];
$email = $_SESSION['user_email'];

// --- Fetch Approved Checkbook from Database ---
$stmt = $conn->prepare("SELECT * FROM checkbook WHERE request_id=? AND status='Approved'");
$stmt->bind_param("s", $id);
$stmt->execute();
$checkbook = $stmt->get_result()->fetch_assoc();

if (!$checkbook) {
    exit("Checkbook not available or not approved yet.");
}

/*---------------------------------------------------------
 |   FPDF Extension: Transparency (Alpha Channel Support)
 *--------------------------------------------------------*/
class AlphaPDF extends FPDF {
    protected $extgstates = [];

    function SetAlpha($alpha, $bm = 'Normal') {
        if ($alpha < 0) $alpha = 0;
        if ($alpha > 1) $alpha = 1;
        $gs = $this->AddExtGState(['ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm]);
        $this->SetExtGState($gs);
    }

    function AddExtGState($parms) {
        $n = count($this->extgstates) + 1;
        $this->extgstates[$n]['parms'] = $parms;
        return $n;
    }

    function SetExtGState($gs) {
        $this->_out(sprintf('/GS%d gs', $gs));
    }

    function _enddoc() {
        if (!empty($this->extgstates) && $this->PDFVersion<'1.4')
            $this->PDFVersion='1.4';
        parent::_enddoc();
    }

    function _putextgstates() {
        foreach ($this->extgstates as $k=>$v) {
            $this->_newobj();
            $this->extgstates[$k]['n']=$this->n;
            $this->_put('<<');
            foreach ($v['parms'] as $key=>$val)
                $this->_put('/'.$key.' '.$val);
            $this->_put('>>');
            $this->_put('endobj');
        }
    }

    function _putresourcedict() {
        parent::_putresourcedict();
        $this->_put('/ExtGState <<');
        foreach ($this->extgstates as $k=>$v)
            $this->_put('/GS'.$k.' '.$v['n'].' 0 R');
        $this->_put('>>');
    }

    function _putresources() {
        $this->_putextgstates();
        parent::_putresources();
    }
}

/*---------------------------------------------------------
 |   Main PDF Class
 *--------------------------------------------------------*/
class PDF extends AlphaPDF {
    public $logo = '../logo.png';       // Bank logo
    public $signature = '../signature.png'; // Authorized signature

    function Header() {
        $this->SetFillColor(54, 79, 199); // Bank blue
        $this->Rect(0, 0, 210, 20, 'F');  // Header bar
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 10, 'AmarJesh Bank Ltd. - Secure Digital Checkbook', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(0, 10, 'AmarJesh Bank - Secure Banking © ' . date('Y'), 0, 0, 'C');
    }

    function DrawCheque($num, $acc, $holder) {
        // --- Outer Border ---
        $this->SetDrawColor(54, 79, 199);
        $this->Rect(10, 40, 190, 90, 'D');

        // --- Header Bar ---
        $this->SetFillColor(54, 79, 199);
        $this->Rect(10, 40, 190, 15, 'F');
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 13);
        $this->SetXY(15, 44);
        $this->Cell(0, 8, "AmarJesh Bank Ltd. - Cheque #" . $num, 0, 1, 'L');

        // --- Transparent Watermark Logo ---
        if (file_exists($this->logo)) {
            $this->SetAlpha(0.12);
            $this->Image($this->logo, 65, 70, 80);
            $this->SetAlpha(1);
        }

        // --- Cheque Info ---
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->SetXY(20, 60);
        $this->Cell(100, 8, "Account No: $acc", 0, 1);
        $this->Cell(100, 8, "Issued To: $holder", 0, 1);

        // --- Payee Area (Soft Blue Background) ---
        $this->SetFillColor(240, 248, 255);
        $this->Rect(20, 90, 170, 25, 'F');
        $this->SetXY(22, 92);
        $this->Cell(150, 8, "Pay: ____________________________________", 0, 1);
        $this->Cell(150, 8, "Amount: ________________________________", 0, 1);

        // --- Date Box (Yellow Highlight) ---
        $this->SetDrawColor(200, 200, 200);
        $this->SetFillColor(255, 255, 204);
        $this->Rect(145, 60, 50, 12, 'DF');
        $this->SetXY(148, 63);
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(80, 80, 80);
        $this->Cell(0, 0, "Date", 0, 1, 'L');

        // --- Signature Section ---
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->SetXY(20, 120);
        $this->Cell(150, 8, "Authorized Signature:", 0, 1);

        if (file_exists($this->signature)) {
            $this->Image($this->signature, 130, 115, 40);
        } else {
            $this->SetFont('Arial', 'I', 10);
            $this->SetTextColor(150, 150, 150);
            $this->Text(130, 125, '[Signature not available]');
        }

        // --- Footer Line ---
        $this->SetDrawColor(54, 79, 199);
        $this->Line(10, 135, 200, 135);
    }
}

/*---------------------------------------------------------
 |   Generate PDF
 *--------------------------------------------------------*/
$pdf = new PDF();
$pdf->SetTitle('Checkbook_' . $checkbook['account_number']);
$pdf->AddPage();

// --- Checkbook Info Page ---
$pdf->SetFillColor(240, 240, 255);
$pdf->Rect(10, 25, 190, 60, 'F');
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(54, 79, 199);
$pdf->Cell(0, 10, "Checkbook Details", 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(5);
$pdf->Cell(0, 8, "Account Number: " . $checkbook['account_number'], 0, 1);
$pdf->Cell(0, 8, "Issued To: " . $email, 0, 1);
$pdf->Cell(0, 8, "Request ID: " . $checkbook['request_id'], 0, 1);
$pdf->Cell(0, 8, "Issued Date: " . $checkbook['request_time'], 0, 1);
$pdf->Ln(5);
$pdf->Cell(0, 8, "Total Pages: " . $checkbook['pages'], 0, 1);
$pdf->Ln(10);
$pdf->SetTextColor(120, 120, 120);
$pdf->Cell(0, 10, "--------------------------------------------", 0, 1, 'C');

// --- Generate Each Cheque ---
for ($i = 1; $i <= $checkbook['pages']; $i++) {
    $pdf->AddPage();
    $pdf->DrawCheque($i, $checkbook['account_number'], $email);
}

// --- Output PDF (Download) ---
$pdf->Output('D', 'Checkbook_' . $checkbook['account_number'] . '.pdf');
?>
