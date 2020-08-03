<?php
class ReporteVentas extends FPDF {
	   
	/*public function Header() {
		$this->SetFont('Arial','B',15);
		$this->Line(10,10,206,10);
    	$this->Line(10,35.5,206,35.5);
    	$this->Cell(171,25,'Reporte de Ventas',0,0,'C', $this->Image('img/logo.png',20,7,40));
    }*/
    
    public function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'FARMACIA COLIMA DE SIMILARES Y GENERICOS INTERCAMBIABLES','T',0,'C');
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
    }
}

	$tCuantos = 0;
	$tTotal = 0;
	
	$pdf = new ReporteVentas();
    $pdf->AddPage('P', 'Letter'); //Vertical, Carta

    $pdf->SetFont('Arial','B',15);
	$pdf->Line(10,10,206,10);
	$pdf->Line(10,35.5,206,35.5);
	$pdf->Cell(171,15,'Reporte de Ventas',0,0,'C', $pdf->Image('img/logo.png',20,7,40));
	$pdf->SetFont('Arial','B',12);
	$pdf->SetX(71);
	$pdf->Cell(0,30,'Fecha: '.$iFecha.' a '.$fFecha,0,1);
    $pdf->SetX(71);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(0,-19,'De: '.utf8_decode($usr),0,1);

    $pdf->SetY(40);
    $w = array(10, 146, 15, 15, 20);

	$pdf->SetFont('Arial','B',9); //Arial, negrita, 12 puntos
    $pdf->Cell($w[1],5,'NOMBRE','LR');
    $pdf->Cell($w[2],5,'CANT.','LR');
    $pdf->Cell($w[3],5,'P. UNIT','LR');
    $pdf->Cell($w[4],5,'P. TOTAL','LR');
    $pdf->Ln();

    $pdf->SetFont('Arial','',9); //Arial, negrita, 12 puntos
    foreach($tabla as $row)
    {
    	$tCuantos += $row['cuantos'];
    	$tTotal += $row['precio_tot'];
        $pdf->Cell($w[1],5,utf8_decode($row['nombre']),'LR');
        $pdf->Cell($w[2],5,number_format($row['cuantos']),'LR',0,'R');
        $pdf->Cell($w[3],5,number_format($row['precio_un']),'LR',0,'R');
        $pdf->Cell($w[4],5,number_format($row['precio_tot']),'LR',0,'R');
        $pdf->Ln();
    }

	$pdf->Ln();
    $pdf->SetFont('Arial','B',10); //Arial, negrita, 12 puntos
    $pdf->Cell($w[1],5,'TOTAL','LR');
    $pdf->Cell($w[2],5,number_format($tCuantos),'LR',0,'R');
    $pdf->Cell($w[3],5,'   ------',0,'R');
    $pdf->Cell($w[4],5,number_format($tTotal),'LR',0,'R');
    $pdf->Ln();

    $pdf->Output(); //Salida al navegador del pdf
?>