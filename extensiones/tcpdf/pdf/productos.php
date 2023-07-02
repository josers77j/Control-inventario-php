<?php
require_once('tcpdf_include.php');

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class PDF extends TCPDF {

    public function Header() {
        $image_file = K_PATH_IMAGES.'UNIVO.png';
        $this->Image($image_file, 8, 8, 35, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 17);
        $this->Ln(13);
        $this->Cell(0, 0, 'Reporte de productos', 0, false, 'C', 0, '', 0, false, 'M', 'M');

    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('INSAFORP-UNIVO');
$pdf->setTitle('Reporte de productos');
$pdf->setSubject('Reportes');
$pdf->setKeywords('Reportes, PDF, INSAFORP, UNIVO');

$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+13, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

$pdf->setFontSubsetting(true);
$pdf->setFont('dejavusans', '', 10, '', true);
$pdf->AddPage();

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$item = null;
$valor = '';
$orden = "codigo_producto";

$respuestaProductos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

// Set some content to print
$html = '
<table cellspacing="0" cellpadding="1" border="0" style="border-color:gray;">
    <tr style="background-color:#1f4271;color:#FFF; padding: 3px;">
        <td style="width: 40rem">Codigo</td>
        <td style="width: 150rem">Nombre</td>
        <td style="width: 50rem">Precio</td>
		<td style="width: 40rem">Cant</td>
        <td>Categoria</td>
        <td>No. Contrato</td>
        <td>Estado</td>
    </tr>';

    foreach($respuestaProductos as $key => $value) {

        $html .= '<tr>
                <td border="0.35" style="text-align: center;">'.$value["codigo_producto"].'</td>
                <td border="0.35">'.$value["nombre"].'</td>
                <td border="0.35" style="text-align: center;">$'.$value["precio_unitario"].'</td>
                <td border="0.35" style="text-align: center;">'.$value["cantidad"].'</td>
                <td border="0.35">'.$value["categoria"].'</td>
                <td border="0.35" style="text-align: center;">'.$value["numero_contrato"].'</td>
                <td border="0.35" style="text-align: center;">'.$value["estado"].'</td>
                

        </tr>';
    } //Cierra foreach 

    $html .= '</table>';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$pdf->Output('reporte_productos.pdf', 'I');
