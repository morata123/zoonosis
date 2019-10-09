<?php

//fetch.php

$api_url = "http://localhost/rest1/api/test_api_registro_mascota.php?action=fetch_all";

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
			<td>'.$row->nombre.'</td>
			<td>'.$row->fecha_nac.'</td>
			<td>'.$row->especie.'</td>
			<td>'.$row->sexo.'</td>
			<td>'.$row->color.'</td>
			<td>'.$row->senal.'</td>
			<td>'.$row->tipo_pelo.'</td>
			<td>'.$row->imagen.'</td>
			<td>'.$row->fecha_registro.'</td>
			<td>'.$row->id_raza.'</td>
			<td>'.$row->id_centro.'</td>
			<td>'.$row->id_senas_particulares.'</td>
			<td>'.$row->id_grado_peligro.'</td>
			<td>'.$row->id_vacuna.'</td>
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_mascota.'">Edit</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_mascota.'">Delete</button></td>
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