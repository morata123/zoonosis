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
		$query = "SELECT * FROM datos_centro ORDER BY id_centro;";
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
				':nombre'		    =>	$_POST["nombre"],
				':descripcion'		    =>	$_POST["descripcion"],
				':direccion'		    =>	$_POST["direccion"],
				':telefono'		    =>	$_POST["telefono"],
				':celular'		    =>	$_POST["celular"],
				':email'		    =>	$_POST["email"],
				':web'		    =>	$_POST["web"]
			);
			$query = "
			INSERT INTO datos_centro
			(nombre,descripcion,direccion,telefono,celular,email,web) VALUES 
			(:nombre,:descripcion,:direccion,:telefono,:celular,:email,:web);
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
		$query = "SELECT * FROM datos_centro where id_centro='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_centro'] = $row['id_centro'];
				$data['nombre'] = $row['nombre'];
				$data['descripcion'] = $row['descripcion'];
				$data['direccion'] = $row['direccion'];
				$data['telefono'] = $row['telefono'];
				$data['celular'] = $row['celular'];
				$data['email'] = $row['email'];
				$data['web'] = $row['web'];
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
				':descripcion'		    =>	$_POST["descripcion"],
				':direccion'		    =>	$_POST["direccion"],
				':telefono'		    =>	$_POST["telefono"],
				':celular'		    =>	$_POST["celular"],
				':email'		    =>	$_POST["email"],
				':web'		    =>	$_POST["web"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE datos_centro 
			SET nombre = :nombre
			, descripcion = :descripcion
			, direccion = :direccion
			, telefono = :telefono
			, celular = :celular
			, email = :email
			, web = :web
			WHERE id_centro= :id
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
		$query = "DELETE FROM datos_centro WHERE id_centro= '".$id."'";
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