<?php

//fetch.php

$api_url = "http://localhost/rest1/api/test_api_datos_centro.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if(count($result) > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row->nombre.'</td>
			<td>'.$row->descripcion.'</td>
			<td>'.$row->direccion.'</td>
			<td>'.$row->telefono.'</td>
			<td>'.$row->celular.'</td>
			<td>'.$row->email.'</td>
			<td>'.$row->web.'</td>
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_centro.'">Edit</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_centro.'">Delete</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;

?>