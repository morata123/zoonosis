<!DOCTYPE html>
<html>
	<head>
		<title>REGISTRO MASCOTAS</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center"> ADMINISTRADOR REGISTRO MASCOTAS</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>NOMBRE MASCOTA</th>
							<th>FECH_NAC</th>
							<th>ESPECIE</th>
							<th>SEXO</th>
							<th>COLOR</th>
							<th>SEÑAL</th>
							<th>TIP_PEL</th>
							<th>IMAGEN</th>
							<th>FECH_REGI</th>
							<th>ID_RAZA</th>
							<th>ID_CENTR</th>
							<th>ID_SEÑAS</th>
							<th>ID_PELIGR</th>
							<th>ID_VACUNA</th>
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
		        	<h4 class="modal-title">Datos Registro mascota</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>nombre</label>
			        	<input type="text" name="nombre" id="nombre" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>fecha_nac</label>
			        	<input type="date" name="fecha_nac" id="fecha_nac" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>especie</label>
			        	<input type="text" name="especie" id="especie" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>sexo</label>
			        	<input type="text" name="sexo" id="sexo" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>color</label>
			        	<input type="text" name="color" id="color" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>senal</label>
			        	<input type="text" name="senal" id="senal" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>tipo_pelo</label>
			        	<input type="text" name="tipo_pelo" id="tipo_pelo" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>imagen</label>
			        	<input type="text" name="imagen" id="imagen" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
			        	<label>fecha_registro</label>
			        	<input type="date" name="fecha_registro" id="fecha_registro" class="form-contfec_nac" />
			        </div>
					<div class="form-group">
            			<label for="id_raza">id_raza</label>
            			<select id="id_raza" name="id_raza" runat="server" class="form-control" required="required"></select>          
         			</div>
					 <div class="form-group">
            			<label for="id_centro">id_centro</label>
            			<select id="id_centro" name="id_centro" runat="server" class="form-control" required="required"></select>          
         			</div>
					 <div class="form-group">
            			<label for="id_senas_particulares">id_senas_particulares</label>
            			<select id="id_senas_particulares" name="id_senas_particulares" runat="server" class="form-control" required="required"></select>          
         			</div>
					 <div class="form-group">
            			<label for="id_grado_peligro">id_grado_peligro</label>
            			<select id="id_grado_peligro" name="id_grado_peligro" runat="server" class="form-control" required="required"></select>          
         			</div>
					 <div class="form-group">
            			<label for="id_vacuna">id_vacuna</label>
            			<select id="id_vacuna" name="id_vacuna" runat="server" class="form-control" required="required"></select>          
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
	var id_raza= $('#id_raza');
	$.ajax({
			 url: '/rest1/api/test_api_raza.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					id_raza.append($('<option/>', { value: item.id_raza, text: item.nombre }));
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
		 var id_senas_particulares= $('#id_senas_particulares');
	$.ajax({
			 url: '/rest1/api/test_api_senas_particulares.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					id_senas_particulares.append($('<option/>', { value: item.id_senas_particulares, text: item.nombre }));
				 });
			 },
			 error: function (err) {
				 console.log(err.responseText);
				 alert(err);
			 }
		 });
		 var id_grado_peligro= $('#id_grado_peligro');
	$.ajax({
			 url: '/rest1/api/test_api_datos_peligro.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					id_grado_peligro.append($('<option/>', { value: item.id_grado_peligro, text: item.nombre }));
				 });
			 },
			 error: function (err) {
				 console.log(err.responseText);
				 alert(err);
			 }
		 });
		 var id_vacuna= $('#id_vacuna');
	$.ajax({
			 url: '/rest1/api/test_api_registro_vacunas.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					id_vacuna.append($('<option/>', { value: item.id_vacuna, text: item.tipo_vacuna }));
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
			url:"fetch_registro_mascota.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('REGISTRO MASCOTA');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#nombre').val() == '')
		{
			alert("Ingresar nombre");
		}
		else if($('#fecha_nac').val() == '')
		{
			alert("Ingrese fecha_nac ");
		}
		else if($('#especie').val() == '')
		{
			alert("Ingrese especie ");
		}
		else if($('#sexo').val() == '')
		{
			alert("Ingrese sexo ");
		}
		else if($('#color').val() == '')
		{
			alert("Ingrese color ");
		}
		else if($('#senal').val() == '')
		{
			alert("Ingrese senal ");
		}
		else if($('#tipo_pelo').val() == '')
		{
			alert("Ingrese tipo_pelo ");
		}
		else if($('#imagen').val() == '')
		{
			alert("Ingrese imagen ");
		}
		else if($('#fecha_registro').val() == '')
		{
			alert("Ingrese fecha_registro ");
		}
		else if($('#id_raza').val() == '')
		{
			alert("Ingrese id_raza ");
		}
		else if($('#id_centro').val() == '')
		{
			alert("Ingrese id_centro ");
		}
		else if($('#id_senas_particulares').val() == '')
		{
			alert("Ingrese id_senas_particulares ");
		}
		else if($('#id_grado_peligro').val() == '')
		{
			alert("Ingrese id_grado_peligro ");
		}
		else if($('#id_vacuna').val() == '')
		{
			alert("Ingrese id_vacuna ");
		}
		
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action_registro_mascota.php",
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
			url:"action_registro_mascota.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_mascota);
				$('#nombre').val(data.nombre);
				$('#fecha_nac').val(data.fecha_nac);
				$('#especie').val(data.especie);
				$('#sexo').val(data.sexo);
				$('#color').val(data.color);
				$('#senal').val(data.senal);
				$('#tipo_pelo').val(data.tipo_pelo);
				$('#imagen').val(data.imagen);
				$('#fecha_registro').val(data.fecha_registro);
				$('#id_raza').val(data.id_raza);
				$('#id_centro').val(data.id_centro);
				$('#id_senas_particulares').val(data.id_senas_particulares);
				$('#id_grado_peligro').val(data.id_grado_peligro);
				$('#id_vacuna').val(data.id_vacuna);
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
				url:"action_registro_mascota.php",
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