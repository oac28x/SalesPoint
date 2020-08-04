<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
	<div class="col-sm-12" style="font-size:20px;background-color:#5C866D;color:#FFF;">
		<p class="text-center">Administrador</p>
	</div>
	<div class="alert alert-success text-center" style="margin-top: 30px;padding-top: 20px;">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-8 col-sm-12" style="padding-top: 10px; padding-bottom: 10px; font-size: 16px;">
				    <img class="img-responsive" src=<?php echo base_url("/img/header.png"); ?>>
				</div>
				<div class="col-md-4 col-sm-12" style="padding-top: 10px; padding-bottom: 10px;">
					<div class="col-md-12" style="padding-top: 10px; padding-bottom: 10px;">
						<a type="button" href="<?php echo site_url("/Store/salir"); ?>" class="btn btn-lg btn-danger btn-block">Cerrar Sesión</a>
					</div>
					<!--<div class="col-md-12">
						<b id="nombreTrabajador" style="color: #555;"><?php //echo (isset($trabajador)) ? $trabajador : 'Sin nombre de trabajador.'; ?></b>
					</div> -->
					<div class="col-md-12" style="margin-top: 20px;">
						<button type="button" class="btn btn-warning btn-lg btn-group-justified" onclick="modal1Show();">Reporte Ventas</button>
					</div>
					<div class="col-md-12" style="margin-top: 20px;">
						<form class="form-horizontal" method="post" action="<?php echo site_url("/Store/ReporteArt")?>" target="_blank">
							<div class="input-group">
								<input id="cant" name="cant" type="text" class="form-control" placeholder="Cantidad..." onkeypress="return isNumber(event)">
								<span class="input-group-btn">
									<button class="btn btn-warning" type="submit"><b>Reporte Artículos</b></button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home"><b>Agregar artículos</b></a></li>
				<li><a data-toggle="tab" href="#menu1"><b>Editar articulos</b></a></li>
				<li><a data-toggle="tab" href="#menu2"><b>Agregar usuarios</b></a></li>
				<li><a data-toggle="tab" href="#menu3"><b>Editar usuarios</b></a></li>
			</ul>

  			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
					<div class="col-sm-12 sep10">
						<div class="form-group sep5">
							<label class="col-sm-2 control-label" style="margin-top: 5px;" for="nombre1">Nombre:</label>
							<div class="col-sm-10">
								<input name="nombre1" id="nombre1" class="form-control" type="text" placeholder="Nombre...">
							</div>
						</div>
						<div class="form-group sep5">
							<label class="col-sm-2 control-label" style="margin-top: 5px;" for="sustancia1">Sustancia:</label>
							<div class="col-sm-10">
								<input name="sustancia1" id="sustancia1" class="form-control" type="text" placeholder="Sustancia...">
							</div>
						</div>
						<div class="form-group sep5">
							<label class="col-sm-2 control-label" style="margin-top: 5px;" for="present1">Presentación:</label>
							<div class="col-sm-10">
								<input name="present1" id="present1" class="form-control" type="text" placeholder="Presentación...">
							</div>
						</div>

						<div class="row sep5">
							<div class="form-group col-sm-6">
								<label class="col-sm-4" style="margin-top: 5px;" for="clave1">Clave:</label>
								<div class="col-sm-8">
									<input name="clave1" id="clave1" class="form-control" type="text" placeholder="Clave...">
								</div>
							</div> 
							<div class="form-group col-sm-3"> 
								<label class="col-sm-4" style="margin-top: 5px;" for="canti1">Cantidad:</label>
								<div class="col-sm-8">
									<input name="canti1" id="canti1" class="form-control" type="text" placeholder="Cantidad..." onkeypress="return isNumber(event)">
								</div>
							</div> 
							<div class="form-group col-sm-3">
								<label class="col-sm-4" style="margin-top: 5px;" for="precio1">Precio:</label>
								<div class="col-sm-8">
									<input name="precio1" id="precio1" class="form-control" type="text" placeholder="Precio..." onkeypress="return isNumber(event)">
								</div>
							</div> 
						</div>

						<div class="col-md-4 col-md-offset-8 sep5">
							<button type="button" class="btn btn-success btn-group-justified" id="addArt"><b>Agregar artículo</b></button>
						</div>
					</div>
				</div>
				<div id="menu1" class="tab-pane fade">
					<div class="col-sm-12" style="margin-bottom: 10px; margin-top: 10px;">
						<div class="col-sm-4">
							<div class="form-group selecto">
								<label for="sel1">Buscar por:</label>
								<select class="form-control" id="buscapor" name="buscapor">
									<option>Codigo</option>
									<option>Nombre</option>
									<option>Formula</option>
								</select>
							</div> 
						</div>
						<div class="col-sm-8" >
							<label for="fuas">Buscar artículo:</label>	
							<div class="input-group" id="fuas">							
								<div class="input-group-btn">
									<a class="btn btn-primary" data-toggle="dropdown" href="#">
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu scrollable-menu" id="drops">
									</ul>
								</div>
								<input id="Nbuscar" name="Nbuscar" type="text" class="form-control" placeholder="Buscar artículo...">
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group sep5">
							<label class="col-sm-2 control-label" style="margin-top: 5px;" for="nombre">Nombre:</label>
							<div class="col-sm-10">
								<input name="nombre" id="nombre" class="form-control" type="text" placeholder="Nombre...">
							</div>
						</div>

						<div class="form-group sep5">
							<label class="col-sm-2 control-label" style="margin-top: 5px;" for="sustancia">Sustancia:</label>
							<div class="col-sm-10">
								<input name="sustancia" id="sustancia" class="form-control" type="text" placeholder="Sustancia...">
							</div>
						</div>

						<div class="form-group sep5">
							<label class="col-sm-2 control-label" style="margin-top: 5px;" for="present">Presentación:</label>
							<div class="col-sm-10">
								<input name="present" id="present" class="form-control" type="text" placeholder="Presentación...">
							</div>
						</div>

						<div class="row sep5">
							<div class="form-group col-sm-6">
								<label class="col-sm-4" style="margin-top: 5px;" for="clave">Clave:</label>
								<div class="col-sm-8">
									<input name="clave" id="clave" class="form-control" type="text" placeholder="Clave...">
								</div>
							</div> 

							<div class="form-group col-sm-3">
								<label class="col-sm-4" style="margin-top: 5px;" for="canti">Cantidad:</label>
								<div class="col-sm-8">
									<input name="canti" id="canti" class="form-control" type="text" placeholder="Cantidad..." onkeypress="return isNumber(event)">
								</div>
							</div> 

							<div class="form-group col-sm-3">
								<label class="col-sm-4" style="margin-top: 5px;" for="precio">Precio:</label>
								<div class="col-sm-8">
									<input name="precio" id="precio" class="form-control" type="text" placeholder="Precio..." onkeypress="return isNumber(event)">
								</div>
							</div> 
						</div>
						<div class="col-sm-8 col-sm-offset-4 sep5">
							<button type="button" class="btn btn-danger col-sm-5" onclick="modal2Show();">Eliminar artículo</button>
							<span class="col-sm-1"></span>
							<button type="button" id="edit" class="btn btn-success col-sm-6"><b>Guardar</b></a>
						</div>
					</div>
				</div>
				<div id="menu2" class="tab-pane fade">
					<div class="col-md-12 col-sm-12 sep10">
						<div class="form-group" style="padding-bottom: 10px;">
							<label class="col-sm-2 control-label" style="margin-top: 5px;" for="usrNombre">Nombre completo:</label>
							<div class="col-sm-10">
								<input name="usrNombre" id="usrNombre" class="form-control" type="text" placeholder="Nombre...">
							</div>
						</div>

						<div class="row sep5">
							<div class="form-group col-sm-4">
								<label class="col-sm-4" style="margin-top: 5px;" for="usr">Usuario:</label>
								<div class="col-sm-8">
									<input name="usr" id="usr" class="form-control" type="text" placeholder="Usuario...">
								</div>
							</div>

							<div class="form-group col-sm-4">
								<label class="col-sm-4" style="margin-top: 5px;" for="usrContra">Contraseña:</label>
								<div class="col-sm-8">
									<input name="usrContra" id="usrContra" class="form-control" type="text" placeholder="Contraseña...">
								</div>
							</div> 

							<div class="form-group col-sm-4">
								<label class="col-sm-4" style="margin-top: 5px;" for="precio1">Permiso:</label>
								<div class="col-sm-8">
									<div class="form-group selecto">
										<select class="form-control" id="permiso" name="permiso">
											<option>Vendedor</option>
											<option>Administrador</option>
										</select>
									</div> 
								</div>
							</div> 
						</div>

						<div class="col-md-4 col-md-offset-8 sep5">
							<button type="button" class="btn btn-success btn-group-justified" id="addUsr"><b>Agregar usuario</b></button>
						</div>
					</div>
				</div>
				<div id="menu3" class="tab-pane fade">
					<div class="col-sm-12" style="margin-top: 10px;">
						<label class="col-sm-2 control-label" style="margin-top: 5px;" for="fuas">Buscar usuario:</label>	
						<div class="input-group col-sm-10" style="padding-left: 15px;padding-right:15px;">							
							<div class="input-group-btn">
							    <a class="btn btn-primary" data-toggle="dropdown" href="#">
							        <span class="caret"></span>
							    </a>
							    <ul class="dropdown-menu scrollable-menu" id="usrDrops">
							    </ul>
						    </div>
						    <input id="usrBuscar" name="usrBuscar" type="text" class="form-control" placeholder="Buscar usuario...">
						</div>
					</div>
					<div class="col-sm-12 sep5">
						<div class="form-group" style="padding-bottom: 10px;">
							<label class="col-sm-2 control-label" style="margin-top: 5px;" for="usrNombre1">Nombre completo:</label>
							<div class="col-sm-10">
								<input name="usrNombre1" id="usrNombre1" class="form-control" type="text" placeholder="Nombre...">
							</div>
						</div>

						<div class="sep10 row">
							<div class="form-group col-sm-4">
								<label class="col-sm-4" style="margin-top: 5px;" for="usr1">Usuario:</label>
								<div class="col-sm-8">
									<input name="usr1" id="usr1" class="form-control" type="text" placeholder="Usuario...">
								</div>
							</div>

							<div class="form-group col-sm-4">
								<label class="col-sm-4" style="margin-top: 5px;" for="usrContra1">Contraseña:</label>
								<div class="col-sm-8">
									<input name="usrContra1" id="usrContra1" class="form-control" type="text" placeholder="Contraseña...">
								</div>
							</div> 

							<div class="form-group col-sm-4">
								<label class="col-sm-4" style="margin-top: 5px;" for="precio1">Permiso:</label>
								<div class="col-sm-8">
									<div class="form-group selecto">
										<select class="form-control" id="permiso1" name="permiso1">
											<option value="0">Vendedor</option>
											<option value="1">Administrador</option>
										</select>
									</div> 
								</div>
							</div> 
						</div>
						<div class="col-sm-8 col-md-offset-4">
							<button type="button" class="btn btn-danger col-sm-5" onclick="modal3Show();"><b>Eliminar usuario</b></button>
							<span class="col-sm-1"></span>
							<button type="button" id="editUsr" class="btn btn-success col-sm-6"><b>Guardar</b></button>
						</div>
					</div>

				</div>
			</div>
		</div>
		<?php 
			//date_default_timezone_set('America/Mexico_City');
			//echo strtotime(date('d-m-Y').' 07:00:00');

			//echo '<br>';
			//echo strtotime('07-07-2017 00:00:01');
			//echo '<br>';
			//echo date('d-m-Y H:i:s', 1499403601);
		 ?>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Reporte Ventas PDF</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" action="<?php echo site_url("/Store/Reporte")?>" target="_blank">
					<?php date_default_timezone_set('America/Mexico_City'); ?>
						<div class="form-group">
							<label class="control-label col-sm-4" for="datepicker">Fecha inicio:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="fechaInicio" id="datepicker" placeholder="dd/mm/año">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4" for="datepicker2">Fecha final:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="fechaFinal" id="datepicker2" placeholder="dd/mm/año">
							</div>
						</div>
						<div class="form-group">
						<label class="control-label col-sm-4" for="buscapor">Reporte de:</label>
							<div class="col-sm-6">
								<select class="form-control" name="usuario" id="buscapor" name="buscapor">
									<option>Todos</option>
									<?php 
									foreach ($vendedores as $vendedor) {
										echo '<option>'.$vendedor['NCompleto'].'</option>';
									}
								    ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 sep10">
								<button type="submit" class="btn btn-warning btn-lg btn-group-justified">Generar Reporte</button>
							</div>
						</div>
					</form> 
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Eliminar Artículo!</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12 sep10">
							<button type="submit" id="eliminar" class="btn btn-warning btn-lg btn-group-justified">Eliminar permanentemente</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal3" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Eliminar Usuario!</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12 sep10">
							<button type="submit" id="eliminarUsr" class="btn btn-warning btn-lg btn-group-justified">Eliminar permanentemente</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>