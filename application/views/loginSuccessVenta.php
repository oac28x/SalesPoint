<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
	<div class="alert alert-success text-center" style="margin-top: 30px;padding-top: 20px;">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-8 col-sm-12" style="padding-top: 10px; padding-bottom: 10px; font-size: 16px;">
				    <img class="img-responsive" src=<?php echo base_url("/img/header.png"); ?>>
				</div>
				<div class="col-md-4 col-sm-12" style="padding-top: 10px; padding-bottom: 10px;">
					<div class="btn-group-justified" style="padding-top: 10px; padding-bottom: 10px;">
						<a type="button" href="<?php echo site_url("/Store/salir"); ?>" class="btn btn-lg btn-danger btn-block">Cerrar Sesión</a>
					</div>
					<div class="col-md-12">
						<b id="nombreTrabajador" style="color: #555;"><?php echo (isset($trabajador)) ? $trabajador : 'Sin nombre de trabajador.'; ?></b>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3" style="margin-bottom: 10px; margin-top: 10px;">
				<div class="form-group">
					<label for="usr">Cantidad:</label>
					<input id="cuantos" name="cuantos" type="text" class="form-control" placeholder="Cantidad Articulos" onkeypress='return validateQty(event);'>
				</div>
			</div>
			<div class="col-md-3 col-sm-3" style="margin-bottom: 10px; margin-top: 10px;">
				<div class="form-group selecto">
					<label for="buscapor">Buscar por:</label>
					<select class="form-control" id="buscapor" name="buscapor">
						<option>Código</option>
						<option>Nombre</option>
						<option>Formula</option>
					</select>
				</div> 
			</div>
			<div class="col-md-6 col-sm-6" style="margin-bottom: 10px; margin-top: 10px;">
				<label for="fuas">Buscar artículo:</label>	
				<div class="input-group" id="fuas">							
					<div class="input-group-btn">
					    <a class="btn btn-success" data-toggle="dropdown" href="#">
					        <span class="caret"></span>
					    </a>
					    <ul class="dropdown-menu scrollable-menu" id="drops">
					    </ul>
				    </div>
				    <input id="Nbuscar" name="Nbuscar" type="text" class="form-control" placeholder="Buscar artículo...">
				</div>
			</div>
			<div class="col-md-12 col-sm-12 " style="padding-top: 10px; padding-bottom: 10px;">
				<a id="addProductBtn" type="button" class="btn btn-lg btn-success btn-group-justified">Agregar</a>
			</div>
			<div class="col-md-12" style="margin-bottom: 10px; margin-top: 10px;">
				<table class="table table-striped text-left bg-warning" style="font-weight: bold;">
					<thead>
						<tr style="color: #444;">
							<th></th>
							<th>ID</th>
							<th>Nombre</th>
							<th>Cantidad</th>
							<th>Precio Unitario ($)</th>
							<th>Total ($)</th>
						</tr>
					</thead>
					<tbody id="tablax">
						<!-- info aqui para venta -->
					</tbody>
				</table>
			</div>
			<div class="col-md-12" style="margin-top:-20px;font-size: 20px;font-weight: bold;">
				<p id="totalPagar" value="0" class="text-right text-danger">Total: $0</p>
			</div>
			<div class="col-md-12">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2" style="margin-top: 8px;font-size: 20px;" for="pago">Pago de:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control input-lg" name="pago" id="pago" placeholder="Cantidad" onkeypress="return isNumber(event)">
						</div>
						<div class="col-sm-3" style="font-size: 20px;">
							<label id="cambio" value="0" class="control-label text-center text-warning">Cambio: NA</label>
						</div>
						<div class="col-sm-4">
							<button id="pagarBtn" type="button" class="btn btn-warning btn-lg btn-group-justified" style="margin-top: 5px;">PAGAR</button>
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div>