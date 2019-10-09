	<?php

//action.php

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'insert')
	{
		echo "insert"; 
		$form_data = array(
			'nombre'		    =>	$_POST['nombre'],
			'fecha_nac'		    =>	$_POST['fecha_nac'],
			'especie'	    =>	$_POST['especie'],
			'sexo'	=>	$_POST['sexo'],
			'color'		=>	$_POST['color'],
			'senal'		    =>	$_POST['senal'],
			'tipo_pelo'				=>	$_POST['tipo_pelo'],
			'imagen'		    =>	$_POST['imagen'],
			'fecha_registro'		    =>	$_POST['fecha_registro'],
			'id_raza'	    =>	$_POST['id_raza'],
			'id_centro'	=>	$_POST['id_centro'],
			'id_senas_particulares'		=>	$_POST['id_senas_particulares'],
			'id_grado_peligro'		    =>	$_POST['id_grado_peligro'],
			'id_vacuna'				=>	$_POST['id_vacuna']

		
		);
		$api_url = "http://localhost/rest1/api/test_api_registro_mascota.php?action=insert";  //change this url as per your folder path for api folder
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
		$api_url = "http://localhost/rest1/api/test_api_registro_mascota.php?action=fetch_single&id=".$id."";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
	if($_POST["action"] == 'update')
	{
		$form_data = array(
			'nombre'				=>	$_POST['nombre'],
			'fecha_nac'				=>	$_POST['fecha_nac'],
			'especie'			=>	$_POST['especie'],
			'sexo'		=>	$_POST['sexo'],
			'color'			=>	$_POST['color'],
			'senal'				=>	$_POST['senal'],
			'tipo_pelo'					=>	$_POST['tipo_pelo'],
			'imagen'				=>	$_POST['imagen'],
			'fecha_registro'				=>	$_POST['fecha_registro'],
			'id_raza'			=>	$_POST['id_raza'],
			'id_centro'		=>	$_POST['id_centro'],
			'id_senas_particulares'			=>	$_POST['id_senas_particulares'],
			'id_grado_peligro'				=>	$_POST['id_grado_peligro'],
			'id_vacuna'					=>	$_POST['id_vacuna'],	
			'hidden_id'					=>	$_POST['hidden_id']

		);
		$api_url = "http://localhost/rest1/api/test_api_registro_mascota.php?action=update";  //change this url as per your folder path for api folder
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
		$api_url = "http://localhost/rest1/api/test_api_registro_mascota.php?action=delete&id=".$id.""; //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
}


?>