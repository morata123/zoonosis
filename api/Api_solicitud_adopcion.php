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
		$query = "SELECT * FROM solicitud_adopcion ORDER BY id_adopcion;";
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
		if(isset($_POST["tipo_vivienda"]))
		{
			$form_data = array(
				':tipo_vivienda'		   	 =>	$_POST["tipo_vivienda"],
				':descripcion'	 =>	$_POST["descripcion"],
				':fecha_solicitud'	 =>	$_POST["fecha_solicitud"],
				':nombre_solicitante'	 =>	$_POST["nombre_solicitante"],
				':ci_solicitante'	 =>	$_POST["ci_solicitante"],
				':id_mascota'	 =>	$_POST["id_mascota"],
				':id_centro'	 =>	$_POST["id_centro"],
		
			);
			$query = "
			INSERT INTO solicitud_adopcion
			(tipo_vivienda,descripcion,fecha_solicitud,nombre_solicitante,ci_solicitante,id_mascota,id_centro) VALUES 
			(:tipo_vivienda,:descripcion,:fecha_solicitud,:nombre_solicitante,:ci_solicitante,:id_mascota,:id_centro);
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
		$query = "SELECT * FROM solicitud_adopcion where id_adopcion='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_adopcion'] = $row['id_adopcion'];
				$data['tipo_vivienda'] = $row['tipo_vivienda'];
				$data['descripcion'] = $row['descripcion'];
				$data['fecha_solicitud'] = $row['fecha_solicitud'];
				$data['nombre_solicitante'] = $row['nombre_solicitante'];
				$data['ci_solicitante'] = $row['ci_solicitante'];
				$data['id_mascota'] = $row['id_mascota'];
				$data['id_centro'] = $row['id_centro'];	
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["tipo_vivienda"]))
		{
			$form_data = array(
				':tipo_vivienda'		    =>	$_POST["tipo_vivienda"],
				':descripcion'	=>	$_POST["descripcion"],
				':fecha_solicitud'	=>	$_POST["fecha_solicitud"],
				':nombre_solicitante'	=>	$_POST["nombre_solicitante"],
				':ci_solicitante'	=>	$_POST["ci_solicitante"],
				':id_mascota'	=>	$_POST["id_mascota"],
				':id_centro'	=>	$_POST["id_centro"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE solicitud_adopcion 
			SET tipo_vivienda = :tipo_vivienda 
				, descripcion = :descripcion
				, fecha_solicitud = :fecha_solicitud
				, nombre_solicitante = :nombre_solicitante
				, ci_solicitante = :ci_solicitante
				, id_mascota = :id_mascota
				, id_centro = :id_centro
			WHERE id_adopcion = :id
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
		$query = "DELETE FROM solicitud_adopcion WHERE id_adopcion = '".$id."'";
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