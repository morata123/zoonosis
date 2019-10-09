	<?php

//action.php

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'insert')
	{
		echo "insert"; 
		$form_data = array(
			'tipo_vivienda'		    =>	$_POST['tipo_vivienda'],
			'descripcion'		    =>	$_POST['descripcion'],
			'fecha_solicitud'	    =>	$_POST['fecha_solicitud'],
			'nombre_solicitante'	=>	$_POST['nombre_solicitante'],
			'ci_solicitante'		=>	$_POST['ci_solicitante'],
			'id_mascota'		    =>	$_POST['id_mascota'],
			'id_centro'				=>	$_POST['id_centro']
		
		);
		$api_url = "http://localhost/rest1/api/test_api_solicitud_adopcion.php?action=insert";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'insert';
			}
			else
			{
				echo 'error';
			}
		}
	}

	if($_POST["action"] == 'fetch_single')
	{
		$id = $_POST["id"];
		$api_url = "http://localhost/rest1/api/test_api_solicitud_adopcion.php?action=fetch_single&id=".$id."";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
	if($_POST["action"] == 'update')
	{
		$form_data = array(
			'tipo_vivienda'				=>	$_POST['tipo_vivienda'],
			'descripcion'				=>	$_POST['descripcion'],
			'fecha_solicitud'			=>	$_POST['fecha_solicitud'],
			'nombre_solicitante'		=>	$_POST['nombre_solicitante'],
			'ci_solicitante'			=>	$_POST['ci_solicitante'],
			'id_mascota'				=>	$_POST['id_mascota'],
			'id_centro'					=>	$_POST['id_centro'],	
			'hidden_id'					=>	$_POST['hidden_id']
		);
		$api_url = "http://localhost/rest1/api/test_api_solicitud_adopcion.php?action=update";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'update';
			}
			else
			{
				echo 'error';
			}
		}
	}
	if($_POST["action"] == 'delete')
	{
		$id = $_POST['id'];
		$api_url = "http://localhost/rest1/api/test_api_solicitud_adopcion.php?action=delete&id=".$id.""; //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
}


?>