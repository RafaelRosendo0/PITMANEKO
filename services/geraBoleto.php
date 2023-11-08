<?php
require("../fpdf/fpdf.php");
class PDF extends FPDF
{
  function Header()
  {
    $this->SetFont("Arial", "B", 12);
    $this->Cell(0, 10, "Boleto de Teste", 0, 1, 'C');
  }

  function Footer()
  {
    $this->SetY(-15);
    $this->SetFont("Arial", "I", 8);
    $this->Cell(0, 10, 'Página ', $this->PageNo(), 0, 0, 'C');
  }

  function Boleto()
  {
    $valor = "R$5,00";
    $dataAtual = new DateTime();

    $dataCerta = $dataAtual->modify("+1 month");

    $vencimento = $dataCerta->format('Y-m-d');

    $numeroAleatorio = mt_rand(100000000000, 999999999999);
    $code = strval($numeroAleatorio);

    $boleto = array(
      "beneficiario" => "EatEasy",
      "valor" => $valor,
      "vencimento" => $vencimento,
      "codigoBarras" => $code
    );

    $this->SetFont('Arial', '', 12);
    $this->Cell(0, 10, 'Beneficiário: ' . $boleto['beneficiario'], 0, 1);
    $this->Cell(0, 10, 'Valor: ' . $boleto["valor"], 0, 1);
    $this->Cell(0, 10, 'Vencimento: ' . $boleto['vencimento'], 0, 1);
    $this->Cell(0, 10, 'Código de Barras: ' . $boleto['codigoBarras'], 0, 1);
  }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->Boleto();

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="doc.pdf"');

$pdf->Output();
