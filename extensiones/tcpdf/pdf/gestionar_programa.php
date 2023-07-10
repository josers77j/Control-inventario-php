<?php
require_once('tcpdf_include.php');

require_once "../../../controladores/gestorprogramas.controlador.php";
require_once "../../../modelos/gestorprogramas.modelo.php";
 
class PDF extends TCPDF {

    public function Header() {
        $image_file = K_PATH_IMAGES.'UNIVO.png';
        $this->Image($image_file, 8, 8, 35, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 17);
        $this->Ln(13);

        $idProgramaProducto = null;
        $idProgramaProducto = $_GET["idProgramaProducto"];

        $valor = null;

        $respuestaGestorPrograma = ModeloGestorProgramas::mdlMostrarGestorProgramas($valor);

        foreach($respuestaGestorPrograma as $key => $value) {
            if($value['id_programa_productos'] == $idProgramaProducto){
                $this->Cell(0, 0, 'Reporte del programa - '.$value['programa'], 0, false, 'C', 0, '', 0, false, 'M', 'M');
            }
        }

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
$pdf->setTitle('Reporte gestion de programas');
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

$valor = null;
$valor = $_GET["idProgramaProducto"];

$respuestaGestorProgramas = ModeloGestorProgramas::mdlMostrarDetalleProducto($valor);

// Set some content to print
$html = '
<table cellspacing="0" cellpadding="1" border="0" style="border-color:gray;">
    <tr style="background-color:#1f4271;color:#FFF; padding: 3px;">
        <td style="width: 250rem">Productos</td>
        <td style="width: 60rem">Cantidad</td>
        <td style="width: 60rem">Precio</td>
        <td style="width: 60rem">Importe</td>
        <td style="width: 60rem">Estado</td>
    </tr>';

   foreach($respuestaGestorProgramas as $key => $value) {

        $html .= '<tr>
                <td border="0.35" >'.$value["producto"].'</td>
                <td border="0.35" >'.$value["cantidad"].'</td>
                <td border="0.35" >$'.$value["precio_unitario"].'</td>
                <td border="0.35" >'.$value["importe"].'</td>
                <td border="0.35" >Activo</td>
        </tr>';
    } //Cierra foreach 
 
    $html .= '</table>';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$pdf->Output('reporte_gestion_programa.pdf', 'I');
