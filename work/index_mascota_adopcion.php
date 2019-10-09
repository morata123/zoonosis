<!DOCTYPE html>
<html>
	<head>
		<title>MASCOTA ADOPCION</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">ADMINISTRADOR MASCOTA ADOPCION</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID_MASCOTA</th>
							<th>ID_ADOPCION</th>
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
		        	<h4 class="modal-title">mascota adopcion</h4>
		      	</div>
		      	<div class="modal-body">
				  <div class="form-group">
            			<label for="id_mascota">Id_mascota</label>
            			<select id="id_mascota" name="id_mascota" runat="server" class="form-control" required="required"></select>          
         			</div>
					 <div class="form-group">
            			<label for="id_adopcion">id_adopcion</label>
            			<select id="id_adopcion" name="id_adopcion" runat="server" class="form-control" required="required"></select>          
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
		 var id_adopcion= $('#id_adopcion');
	$.ajax({
			 url: '/rest1/api/test_api_solicitud_adopcion.php?action=fetch_all',
			 method: 'post',
			 dataType: 'json',
			 success: function (data) {
				 $(data).each(function (index, item) {
					id_adopcion.append($('<option/>', { value: item.id_adopcion, text: item.tipo_vivienda }));
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
			url:"fetch_mascota_adopcion.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('MASCOTA ADOPCION');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#id_mascota').val() == '')
		{
			alert("Ingresar id_mascota");
		}
		else if($('#id_adopcion').val() == '')
		{
			alert("Ingresar id_adopcion");
		}
		else
		{
			console.info("antes de formulario");
			var form_data = $(this).serialize();
			console.info(form_data);
			console.info("Despues de formulario");
			$.ajax({
				url:"action_mascota_adopcion.php",
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
			url:"action_mascota_adopcion.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(data.id_mascota_adopcion);
				$('#id_mascota').val(data.id_mascota);
				$('#id_adopcion').val(data.id_adopcion);
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Modificar mascota adopcion');
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
				url:"action_mascota adopcion.php",
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