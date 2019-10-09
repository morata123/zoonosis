<?php

//fetch.php

$api_url = "http://localhost/rest1/api/test_api_solicitud_adopcion.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$rapellidosonse = curl_exec($client);

$result = json_decode($rapellidosonse);

$output = '';

if(count($result) > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row->tipo_vivienda.'</td>
			<td>'.$row->descripcion.'</td>
			<td>'.$row->fecha_solicitud.'</td>
			<td>'.$row->nombre_solicitante.'</td>
			<td>'.$row->ci_solicitante.'</td>
			<td>'.$row->id_mascota.'</td>
			}<td>'.$row->id_centro.'</td>
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_adopcion.'">Edit</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_adopcion.'">Delete</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="7" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;

?>