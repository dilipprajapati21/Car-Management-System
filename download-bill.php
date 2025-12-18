<?php
session_start();
require('fpdf/fpdf186/fpdf.php');
include("db.php");

if (!isset($_SESSION['email'])) {
    echo "<script>alert('Please login first!'); window.location='login.html';</script>";
    exit;
}

$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT * FROM orders WHERE email=? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('No orders found!'); window.location='order.php';</script>";
    exit;
}

$row = $result->fetch_assoc();

// Extend FPDF for Header & Footer
class PDF_Bill extends FPDF {
    function Header() {
        // Logo
        if (file_exists('logo.jpg')) {
            $this->Image('logo.jpg', 10, 8, 25);
        }

        // Title
        $this->SetFont('Arial', 'B', 20);
        $this->SetTextColor(0, 76, 153);
        $this->Cell(0, 10, 'CARZ WORLD BILL', 0, 1, 'C');
        $this->SetFont('Arial', 'I', 12);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(0, 8, 'Drive Your Dream Car', 0, 1, 'C');
        $this->Ln(5);
        $this->SetDrawColor(0, 76, 153);
        $this->SetLineWidth(1);
        $this->Line(10, 30, 200, 30);
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-25);
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(120, 120, 120);
        $this->Cell(0, 8, 'Thank you for booking with Carz World!', 0, 1, 'C');
        $this->Cell(0, 8, 'www.carzworld.in | support@carzworld.in | +91-98765 43210', 0, 0, 'C');
    }
}

// Create PDF
$pdf = new PDF_Bill();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

// Customer Details
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,10,'Customer Details',0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(245,245,245);
$pdf->Cell(50,8,'Customer Name:',0,0);
$pdf->Cell(100,8,$row['fullname'],0,1,'L',true);
$pdf->Cell(50,8,'Email:',0,0);
$pdf->Cell(100,8,$row['email'],0,1,'L',true);
$pdf->Cell(50,8,'Phone:',0,0);
$pdf->Cell(100,8,$row['phone'],0,1,'L',true);
$pdf->Cell(50,8,'Address:',0,0);
$pdf->MultiCell(120,8,$row['address'],0,'L',true);
$pdf->Ln(5);

// Table Heading
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(0,102,204);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(63,10,'Car Model',1,0,'C',true);
$pdf->Cell(63,10,'Payment',1,0,'C',true);
$pdf->Cell(63,10,'Order Date',1,1,'C',true);

// Table Data
$pdf->SetFont('Arial','',12);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(245,245,245);
$pdf->Cell(63,10,$row['car'],1,0,'C',true);
$pdf->Cell(63,10,$row['payment'],1,0,'C',true);
$pdf->Cell(63,10,$row['order_date'],1,1,'C',true);

$pdf->Ln(15);

// Final Note
$pdf->SetFont('Arial','I',11);
$pdf->SetTextColor(80,80,80);
$pdf->MultiCell(0,8,'"Your journey begins with Carz World!"');

// Output PDF
$pdf->Output('D','CarzWorld_Bill.pdf');
?>
