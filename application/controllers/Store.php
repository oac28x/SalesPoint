<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Aplicación desarrollada por Ing. Oscar Aguilar Cruz
// Contacto: oscar_agrl@outlook.com
// Sitio:  www.oscaraguilar.info  >Aún trabajando en el.

// Applicación punto de venta para pequeños negocios.
// Si montas en pequeña intranet, puedes acceder desde diferentes equipos.
// Puedes hacer uso de ella, modificarla o agregar mejoras; para esto último contactame para que puedas hacer tu pull-request.

// Framework CodeIgniter, Js, JQuery, SQLite Database, 
// Esta es la clase controlador principal 'Store', el modelo en carpeta models 'PostModel' y vistas en Views, basado con MVC.
// Originalmente imprime tikets en POS Printer por DB9 conectada al servidor donde corre la aplicacion.
// Tiene la opcion de dar reportes de productos con condición, puedes revisar todos los productos con cantidad menor a la que indiques.
// Tiene la opcion de dar reportes de ventas, por usuario y todos, con rango de fechas.
// Puedes dar de alta artículos y modificarlos.
// Puedes dar de alta usuarios y modificarlos, hay dos roles de usuarios, Vendedor y Administrador.

// Cambia en index.php root development a production si montas la aplicación.

// Si te ayudó en algo y deseas donar para un café, dejo mis direcciones d:
// XRP: rLSn6Z3T8uCxbcd1oxwfGQN1Fdn5CyGujK DT: 31930983
// ETH: 0xdb06ea3ca720e7c94ecf4fcf7a13f8e136c14cc3
// BTC: 36KCiY7YSNGXiB1wjNdQXNaZXTQLStt34C


class Store extends CI_Controller {	

	function __Construct(){
		parent::__Construct();
		$this->load->database();
		$this->load->model('PostModel');
		$this->session->sess_expiration = '28800'; //Expira en 30 minutos
		if(!isset($_SESSION['logeado'])){
			$this->session->set_userdata(array("logeado"=>0));
		}
	}

	public function index()
	{		
		//$this->session->sess_destroy();
		$this->load->view('Header');	
		if($this->session->userdata("logeado") == 1){
			if($this->session->userdata("permiso") == 0){
				$this->load->view('loginSuccessVenta', $this->session->userdata("trabajador"));
			}else{
				$vendedores = $this->PostModel->cehcaUsrsVentas();	
				$trabajador = $this->session->userdata("trabajador");
				$dEnviados = array(
					'trabajador'=> $trabajador['trabajador'],
					'vendedores'=> $vendedores);
				$this->load->view('loginSuccessAdmin', $dEnviados);
			}
		}else{
			$this->load->view('login');
		}			
		$this->load->view('Footer');		
	}

	public function checa(){
		$user = $this->input->post("usuario");
		$pass = $this->input->post("contra"); 
        $datos = $this->PostModel->ChecaUsr($user);

        if(empty($datos)){
        	echo "1";
        }else{

        	$vData=array('trabajador'=>$datos->NCompleto);
        	if($datos->contra == $pass){
				echo 'success';
        		$this->session->set_userdata(array("logeado"=>1, "permiso"=>$datos->permiso, "trabajador"=>$vData));
        	}
        	else{
        		echo "1";
        	}
        }
	}
	public function salir(){
		$this->session->sess_destroy();
		header('Location: '.site_url());
	}

	public function sugiere(){
		$como = $this->input->post("buscapor");
		$like = $this->input->post("Nbuscar");
		$a = 0;
		switch ($como) {
			case 'Codigo':
				$a = 1;
				break;	
			case 'Nombre':
				$a = 2;
				break;
			case 'Formula':
				$a = 3;
				break;
		}

		$data = $this->PostModel->sugerencia($like, $a);
		$html = "";
		foreach ($data as $nombre) {
			$html.='<li value="'.$nombre['clave'].'"><a href="#">'.$nombre['nombre'].' | $'.$nombre['precio'].' | | '.$nombre['presentacion'].' |</a></li>';
		}

		echo $html;
	}


	public function editarArt(){
		$id = $this->input->post("id");

		$art = $this->PostModel->buscaArt($id);
		echo json_encode($art);
	}

	public function eliminarArt(){
		$id = $this->input->post("id");
		$estado = $this->PostModel->eliminaArt($id);
		echo $estado;
	}

	public function updateArt(){
		$idr = $this->input->post("idr");
		$nombre = $this->input->post("nombre");
		$clave = $this->input->post("clave");
		$sustancia = $this->input->post("sustancia");
		$present = $this->input->post("present");
		$cantidad = $this->input->post("canti");
		$precio = $this->input->post("precio");

		$estado = $this->PostModel->actualizaArt($idr, $nombre, $clave, $sustancia, $present, $cantidad, $precio);
		echo $estado;
	}

	public function updateUsr(){
		$idUsr = $this->input->post("usrBuscar");
		$nombre = $this->input->post("usrNombre1");
		$usr = $this->input->post("usr1");
		$usrContra = $this->input->post("usrContra1");
		$permiso = $this->input->post("permiso1");

		$estado = $this->PostModel->actualizaUsr($idUsr, $nombre, $usr, $usrContra, $permiso);
		echo $estado;
	}

	public function eliminarUsr(){
		$idUsr = $this->input->post("usrBuscar");
		$usr = $this->input->post("usr1");

		$estado = $this->PostModel->eliminaUsr($idUsr, $usr);
		echo $estado;
	}

	public function addNewArt(){
		$nombre = $this->input->post("nombre1");
		$clave = $this->input->post("clave1");
		$sustancia = $this->input->post("sustancia1");
		$present = $this->input->post("present1");
		$cantidad = $this->input->post("canti1");
		$precio = $this->input->post("precio1");

		$data = $this->PostModel->buscaId($clave);
		
		if($data) echo "Clave existente";
		else{
			$this->PostModel->insertNewArt($clave, $nombre, $sustancia, $present, $cantidad, $precio);
			echo "ok";
		}
	}

	public function addNewUsr(){
		$nombre = $this->input->post("usrNombre");
		$usr = $this->input->post("usr");
		$clave = $this->input->post("usrContra");
		$permiso = $this->input->post("permiso");

		$this->PostModel->insertNewUsr($nombre, $usr, $clave, $permiso);
	}

	public function buscaUsr(){
		$nombre = $this->input->post("usrBuscar");


		$data = $this->PostModel->sugerenciaUsr($nombre);
		$html = "";
		foreach ($data as $nombre) {
			$html.='<li value="'.$nombre['usuario'].'"><a href="#">'.$nombre['NCompleto'].'</a></li>';
		}

		echo $html;
	}

	public function editarUsr(){
		$nombre = $this->input->post("nombre");
		$usr = $this->input->post("usr");


		$usrData = $this->PostModel->buscaUsr($usr, $nombre);
		echo json_encode($usrData);
	}

	public function agregar(){
		$cantidad = $this->input->post("cuantos");
		$id = $this->input->post("id");
		$data = $this->PostModel->buscaId($id);
		$total = $cantidad*$data->precio;
		$idUnico = $timestamp = strtotime(date("Y-m-d H:i:s"));

		$html = '<tr id="'.$idUnico.'" value="'.$total.'">';
		$html .= '<td><button onclick="deletiar('.$idUnico.');" class="btn-danger btn">Eliminar</button></td>';
		$html .= '<td>'.$data->clave.'</td>';
		$html .= '<td>'.$data->nombre.'</td>';
		$html .= '<td>'.$cantidad.'</td>';
		$html .= '<td>'.$data->precio.'</td>';
		$html .= '<td>'.$total.'</td></tr>';
		
		$datos=array(
			'info'=>$html,
			'total'=>$total
		);

		echo json_encode($datos);
	}

	public function regVentas(){
		$cantidad = $this->input->post("infoTabla");
		$nombre = $this->input->post("nombre");
		$pago = $this->input->post("pago");
		$aPagar = $this->input->post("total");
		$cambio = $this->input->post("cambio");

		date_default_timezone_set('America/Mexico_City');
		$fecha = strtotime(date('d-m-Y').' 00:00:01');

		foreach ($cantidad as $data) {
			$this->PostModel->insertCompra($data[1], $data[2], $data[3], $data[4], $aPagar, $fecha, $nombre, $pago, $cambio);
		}

		//POS Printer Ticket DB9 Port
		//$foliazo = $this->PostModel->checkFolio();
		// $foliazo = str_pad($foliazo->folio + 1, 5, "0", STR_PAD_LEFT);
		
		// $folio = '  Folio: '.$foliazo;
		// $fecha = '  Fecha: '.date("d-m-Y H:i:s");
		// $efectiv = '   Efectivo:';         //12
		// $total = '   Total de su compra:'; //22
		// $sCambio = '   Cambio:';           //10 
		// $nombres = "Cant.Descripcion      P.Unit   Importe";
		// //          1234 123456789012345  $2345678 $2345678
		// $asteris = "****************************************";
		// $pago = '$'.str_pad(number_format($pago, 2, '.', ''),23, " ", STR_PAD_LEFT);
		// $aPagar = '$'.str_pad(number_format($aPagar, 2, '.', ''),13, " ", STR_PAD_LEFT);
		// $cambio = '$'.str_pad(number_format($cambio, 2, '.', ''),25, " ", STR_PAD_LEFT);
		
		// shell_exec('echo '.chr(27). chr(64).' > LPT1');
		// shell_exec('echo '.chr(27). chr(112). chr(48).' > LPT1'); //Abrir cajon
		// shell_exec('echo '.chr(27). chr(97). chr(1).' > LPT1');	 //Alinea centro
		// shell_exec('echo NOMBRE DE NEGOCIO TITULO AQUI > LPT1');
		// shell_exec('echo MAS TITULO DEL NEGOCIO AQUI > LPT1');
		// shell_exec('echo Av. NOMBRE DE AVENIDA #0000-B > LPT1');
		// shell_exec('echo CIUDAD MUNICIPIO, ESTADO. > LPT1');	
		// shell_exec('echo C.P. 00000 > LPT1');	
		// shell_exec('echo Nombre de quien atiende o negocio > LPT1'); 	
		// shell_exec('echo RFC: AAAA111111AA5 > LPT1');
		// shell_exec('echo Exp. en Ciudad, Municipio. > LPT1');
		// shell_exec('echo '.chr(27). chr(64).' > LPT1');	
		// shell_exec('echo '.chr(27). chr(97). chr(0).' > LPT1');  //Alinea izquierda
		// shell_exec('echo '.$folio.' > LPT1');
		// shell_exec('echo '.$fecha.' > LPT1');	
		// shell_exec('echo ======================================= > LPT1');
		// shell_exec('echo '.$nombres.' > LPT1');
		
		// foreach ($cantidad as $dato) {
		// 	$cu = str_pad($dato[2],5);
		// 	$no = str_pad(substr($dato[1], 0, 15),17);
		// 	$pu = str_pad(number_format($dato[3], 2, '.', ''),8);
		// 	$pt = number_format($dato[4], 2, '.', '');
		// 	shell_exec('echo '.$cu.$no.'$'.$pu.'$'.$pt.' > LPT1');
		// }
		
		// shell_exec('echo ======================================= > LPT1');
		// shell_exec('echo '.$efectiv.$pago.' > LPT1');
		// shell_exec('echo '.$total.$aPagar.' > LPT1');
		// shell_exec('echo '.$sCambio.$cambio.' > LPT1');
		// shell_exec('echo '.chr(27). chr(64).' > LPT1');
		// shell_exec('echo '.chr(27). chr(97). chr(1).' > LPT1');	 //Alinea centro
		// shell_exec('echo GRACIAS POR SU COMPRA > LPT1');
		// shell_exec('echo '.$asteris.' > LPT1');

		// shell_exec('echo '.chr(27). chr(100). chr(1).' > LPT1');  //Nueva linea
		// shell_exec('echo '.chr(27). chr(100). chr(1).' > LPT1');  //Nueva linea
		// shell_exec('echo '.chr(27). chr(100). chr(1).' > LPT1');  //Nueva linea

		echo "ok";
	}

	public function Reporte(){
		$usr = $this->input->post("usuario");
		$IFecha = $this->input->post("fechaInicio");
		$FFecha = $this->input->post("fechaFinal");

		$this->load->library('fpdf');
		$Data = $this->PostModel->selectVentas($IFecha, $FFecha, $usr);

		$sData = array(
			'tabla' => $Data,
			'iFecha' => $IFecha,
			'fFecha' => $FFecha,
			'usr' => $usr);
		$this->load->view("reporteVentas",$sData);
	}

	public function ReporteArt(){
		$cant = $this->input->post("cant");
		
		$this->load->library('fpdf');
		$Data = $this->PostModel->selectArtLow($cant);

		$sData = array(
			'tabla' => $Data);
		$this->load->view("reporteArticulos",$sData);
	}

	public function Error(){
		$this->load->view('errors/html/error_404');
	}
}