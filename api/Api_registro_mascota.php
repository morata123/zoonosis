<?php

//Api.php

class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=zoonosis_db", "root", "");
	}

	function fetch_all()
	{
		$query = "SELECT * FROM registro_mascota ORDER BY id_mascota;";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert()
	{
		if(isset($_POST["nombre"]))
		{
			$form_data = array(
				':nombre'		   	 =>	$_POST["nombre"],
				':fecha_nac'	 =>	$_POST["fecha_nac"],
				':especie'	 =>	$_POST["especie"],
				':sexo'	 =>	$_POST["sexo"],
				':color'	 =>	$_POST["color"],
				':senal'	 =>	$_POST["senal"],
				':tipo_pelo'	 =>	$_POST["tipo_pelo"],
				':imagen'	 =>	$_POST["imagen"],
				':fecha_registro'	 =>	$_POST["fecha_registro"],
				':id_raza'	 =>	$_POST["id_raza"],
				':id_centro'	 =>	$_POST["id_centro"],
				':id_senas_particulares'	 =>	$_POST["id_senas_particulares"],
				':id_grado_peligro'	 =>	$_POST["id_grado_peligro"],
				':id_vacuna'	 =>	$_POST["id_vacuna"]
			);
			$query = "
			INSERT INTO registro_mascota
			(nombre,fecha_nac,especie,sexo,color,senal,tipo_pelo,imagen,fecha_registro,id_raza,id_centro,id_senas_particulares,id_grado_peligro,id_vacuna) VALUES 
			(:nombre,:fecha_nac,:especie,:sexo,:color,:senal,:tipo_pelo,:imagen,:fecha_registro,:id_raza,:id_centro,:id_senas_particulares,:id_grado_peligro,:id_vacuna);
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function fetch_single($id)
	{
		$query = "SELECT * FROM registro_mascota where id_mascota='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_mascota'] = $row['id_mascota'];
				$data['nombre'] = $row['nombre'];
				$data['fecha_nac'] = $row['fecha_nac'];
				$data['especie'] = $row['especie'];
				$data['sexo'] = $row['sexo'];
				$data['color'] = $row['color'];
				$data['senal'] = $row['senal'];
				$data['tipo_pelo'] = $row['tipo_pelo'];	
				$data['imagen'] = $row['imagen'];
				$data['fecha_registro'] = $row['fecha_registro'];
				$data['id_raza'] = $row['id_raza'];
				$data['id_centro'] = $row['id_centro'];
				$data['id_senas_particulares'] = $row['id_senas_particulares'];
				$data['id_grado_peligro'] = $row['id_grado_peligro'];
				$data['id_vacuna'] = $row['id_vacuna'];	

			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["nombre"]))
		{
			$form_data = array(
				':nombre'		    =>	$_POST["nombre"],
				':fecha_nac'	=>	$_POST["fecha_nac"],
				':especie'	=>	$_POST["especie"],
				':sexo'	=>	$_POST["sexo"],
				':color'	=>	$_POST["color"],
				':senal'	=>	$_POST["senal"],
				':tipo_pelo'	=>	$_POST["tipo_pelo"],
				':imagen'		    =>	$_POST["imagen"],
				':fecha_registro'	=>	$_POST["fecha_registro"],
				':id_raza'	=>	$_POST["id_raza"],
				':id_centro'	=>	$_POST["id_centro"],
				':id_senas_particulares'	=>	$_POST["id_senas_particulares"],
				':id_grado_peligro'	=>	$_POST["id_grado_peligro"],
				':id_vacuna'	=>	$_POST["id_vacuna"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE registro_mascota 
			SET nombre = :nombre 
				, fecha_nac = :fecha_nac
				, especie = :especie
				, sexo = :sexo
				, color = :color
				, senal = :senal
				, tipo_pelo = :tipo_pelo
				, imagen = :imagen
				, fecha_registro = :fecha_registro
				, id_raza = :id_raza
				, id_centro = :id_centro
				, id_senas_particulares = :id_senas_particulares
				, id_grado_peligro = :id_grado_peligro
				, id_vacuna = :id_vacuna
			WHERE id_mascota = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM registro_mascota WHERE id_mascota = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>