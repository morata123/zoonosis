<!DOCTYPE html>
<html>
	<head>
		<title>DATOS ADOPCION</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">ADMINISTRADOR ADOPCION</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>TIPO VIVIENDA</th>
							<th>DESCRIPCION</th>
							<th>FECHA SOLICITUD</th>
							<th>NOMBRE SOLICITANTE</th>
							<th>CI SOLICITANTE</th>
							<th>ID MASCOTA</th>
							<th>ID CENTRO</th>
							<th>MODIFICAR</th>
							<th>ELIMINAR</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<div id="apicrudModal" class="modal fade" fec_nace="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Datos Solicitud Adopcion</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>Tipo_vivienda</label>
			        	<input type="text" name="tipo_vivienda" id="tipo_vivienda" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>Descripcion</label>
			        	<input type="text" name="descripcion" id="descripcion" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>Fecha_solicitud</label>
			        	<input type="text" name="fecha_solicitud" id="fecha_solicitud" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>Nombre_solicitante</label>
			        	<input type="text" name="nombre_solicitante" id="nombre_solicitante" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>Ci_solicitante</label>
			        	<input type="text" name="ci_solicitante" id="ci_solicitante" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
            			<label for="id_mascota">Id_mascota</label>
            			<select id="id_mascota" name="id_mascota" runat="server" class="form-control" required="required"></select>          
         			</div>
					 <div class="form-group">
            			<label for="id_centro">Id_centro</label>
            			<select id="id_centro" name="id_centro" runat="server" class="form-control" required="required"></select>          
         			</div>
					
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="action" id="action" value="insert" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

	fetch_data();
	var id_mascota= $('#id_mascota');
	$.ajax({
			 url: '/rest1/api/test_api_registro_mascota.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					id_mascota.append($('<option/>', { value: item.id_mascota, text: item.nombre }));
				 });
			 },
			 error: function (err) {
				 console.log(err.responseText);
				 alert(err);
			 }
		 });
		 var id_centro= $('#id_centro');
	$.ajax({
			 url: '/rest1/api/test_api_datos_centro.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					id_centro.append($('<option/>', { value: item.id_centro, text: item.nombre }));
				 });
			 },
			 error: function (err) {
				 console.log(err.responseText);
				 alert(err);
			 }
		 });
	function fetch_data()
	{
		$.ajax({
			url:"fetch_solicitud_adopcion.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('DATOS SOLICITUD ADOPCION');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#tipo_vivienda').val() == '')
		{
			alert("Ingresar tipo_vivienda");
		}
		else if($('#descripcion').val() == '')
		{
			alert("Ingrese descripcion ");
		}
		else if($('#fecha_solicitud').val() == '')
		{
			alert("Ingrese fecha_solicitud ");
		}
		else if($('#nombre_solicitante').val() == '')
		{
			alert("Ingrese nombre_solicitante ");
		}
		else if($('#ci_solicitante').val() == '')
		{
			alert("Ingrese ci_solicitante ");
		}
		else if($('#id_mascota').val() == '')
		{
			alert("Ingrese id_mascota ");
		}
		else if($('#id_centro').val() == '')
		{
			alert("Ingrese id_centro ");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action_solicitud_adopcion.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					fetch_data();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if(data == 'insert')
					{
						alert("Data Inserted using PHP API");
					}
					if(data == 'update')
					{
						alert("Data Updated using PHP API");
					}
				}
			});
			console.info("luego de ajax")
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action_solicitud_adopcion.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_adopcion);
				$('#tipo_vivienda').val(data.tipo_vivienda);
				$('#descripcion').val(data.descripcion);
				$('#fecha_solicitud').val(data.fecha_solicitud);
				$('#nombre_solicitante').val(data.nombre_solicitante);
				$('#ci_solicitante').val(data.ci_solicitante);
				$('#id_mascota').val(data.id_mascota);
				$('#id_centro').val(data.id_centro);
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Modificar Datos');
				$('#apicrudModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Esta seguro de eliminar el Dato"))
		{
			$.ajax({
				url:"action_solicitud_adopcion.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Data Deleted using PHP API");
				}
			});
		}
	});

});
</script>