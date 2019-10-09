<!DOCTYPE html>
<html>
	<head>
		<title>DATOS CENTRO</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">ADMINISTRADOR DATOS CENTRO</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>NOMBRE</th>
							<th>DESCRIPCION</th>
							<th>DIRECCION</th>
							<th>TELEFONO</th>
							<th>CELULAR</th>
							<th>EMAIL</th>
							<th>WEB</th>
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

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Datos Centro</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>Nombre</label>
			        	<input type="text" name="nombre" id="nombre" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>Descripcion</label>
			        	<input type="text" name="descripcion" id="descripcion" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>Direccion</label>
			        	<input type="text" name="direccion" id="direccion" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>Telefono</label>
			        	<input type="text" name="telefono" id="telefono" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>Celular</label>
			        	<input type="text" name="celular" id="celular" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>Email</label>
			        	<input type="text" name="email" id="email" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>Web</label>
			        	<input type="text" name="web" id="web" class="form-control" />
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
	function fetch_data()
	{
		$.ajax({
			url:"fetch_datos_centro.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('DATOS CENTRO');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#nombre').val() == '')
		{
			alert("Ingresar nombre");
		}
		else if($('#descripcion').val() == '')
		{
			alert("Ingrese descripcion");
		}
		else if($('#direccion').val() == '')
		{
			alert("Ingrese direccion");
		}
		else if($('#telefono').val() == '')
		{
			alert("Ingrese telefono");
		}
		else if($('#celular').val() == '')
		{
			alert("Ingrese celular");
		}
		else if($('#email').val() == '')
		{
			alert("Ingrese email");
		}
		else if($('#web').val() == '')
		{
			alert("Ingrese web");
		}
		else
		{
			console.info("antes de formulario");
			var form_data = $(this).serialize();
			console.info(form_data);
			console.info("Despues de formulario");
			$.ajax({
				url:"action_datos_centro.php",
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
			url:"action_datos_centro.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_centro);
				$('#nombre').val(data.nombre);
				$('#descripcion').val(data.descripcion);
				$('#direccion').val(data.direccion);
				$('#telefono').val(data.telefono);
				$('#celular').val(data.celular);
				$('#email').val(data.email);
				$('#web').val(data.web);
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Modificar Datos Centro');
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
				url:"action_datos_centro.php",
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