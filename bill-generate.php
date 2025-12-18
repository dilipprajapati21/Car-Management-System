<?php
require('fpdf/fpdf186/fpdf.php');
include 'db.php';

if(!isset($_GET['id'])) die("Invalid request");

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM orders WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows==0) die("Order not found");

$row = $result->fetch_assoc();

class PDF_Invoice extends FPDF {
    function Header() {
        // Logo
        if(file_exists('logo.jpg')){
            $this->Image('logo.jpg', 10, 8, 30);
        }

        // Title
        $this->SetFont('Arial', 'B', 18);
        $this->SetTextColor(0, 102, 204);
        $this->Cell(0, 10, 'CARZ WORLD INVOICE', 0, 1, 'C');
        $this->Ln(5);
        $this->SetDrawColor(0, 102, 204);
        $this->SetLineWidth(1);
        $this->Line(10, 25, 200, 25);
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-25);
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(120, 120, 120);
        $this->Cell(0, 10, 'Thank you for choosing Carz World!', 0, 1, 'C');
        $this->Cell(0, 10, 'www.carzworld.in | support@carzworld.in', 0, 0, 'C');
    }
}

$pdf = new PDF_Invoice();
$pdf->AddPage();

// Customer Info Section
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 10, 'Customer Details', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(245, 245, 245);

$pdf->Cell(50, 8, 'Customer Name:', 0, 0);
$pdf->Cell(100, 8, $row['fullname'], 0, 1, 'L', true);

$pdf->Cell(50, 8, 'Email:', 0, 0);
$pdf->Cell(100, 8, $row['email'], 0, 1, 'L', true);

$pdf->Cell(50, 8, 'Phone:', 0, 0);
$pdf->Cell(100, 8, $row['phone'], 0, 1, 'L', true);

$pdf->Cell(50, 8, 'Address:', 0, 0);
$pdf->MultiCell(100, 8, $row['address'], 0, 'L', true);

$pdf->Ln(10);

// Order Info Section
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Order Summary', 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0, 102, 204);
$pdf->SetTextColor(255, 255, 255);

$pdf->Cell(63, 10, 'Car Model', 1, 0, 'C', true);
$pdf->Cell(63, 10, 'Payment', 1, 0, 'C', true);
$pdf->Cell(63, 10, 'Order Date', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(245, 245, 245);

$pdf->Cell(63, 10, $row['car'], 1, 0, 'C', true);
$pdf->Cell(63, 10, $row['payment'], 1, 0, 'C', true);
$pdf->Cell(63, 10, $row['order_date'], 1, 1, 'C', true);

$pdf->Ln(10);

// Optional: Amount Section if needed
if(isset($row['amount'])){
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Payment Details', 0, 1, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 8, 'Total Amount:', 0, 0);
    $pdf->SetTextColor(0, 102, 0);
    $pdf->Cell(100, 8, '₹ ' . number_format($row['amount'], 2), 0, 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln(10);
}

$pdf->SetFont('Arial', 'I', 11);
$pdf->SetTextColor(80, 80, 80);
$pdf->MultiCell(0, 8, "Terms & Conditions:\n1. Please verify your order details.\n2. Payment once made is non-refundable.\n3. Carz World reserves the right to modify orders as per availability.");

// Output PDF
$pdf->Output('D', 'CarzWorld_Order_'.$row['id'].'.pdf');
?>
