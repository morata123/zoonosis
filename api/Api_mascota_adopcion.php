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
		$query = "SELECT * FROM mascota_adopcion ORDER BY id_mascota_adopcion;";
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
		if(isset($_POST["id_mascota"]))
		{
			$form_data = array(
				':id_mascota'		    =>	$_POST["id_mascota"],
				':id_adopcion'		    =>	$_POST["id_adopcion"]
			);
			$query = "
			INSERT INTO datos_centro
			(id_mascota,id_adopcion) VALUES 
			(:id_mascota,:id_adopcion);
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
		$query = "SELECT * FROM mascota_adopcion where id_mascota_adopcion='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_mascota_adopcion'] = $row['id_mascota_adopcion'];
				$data['id_mascota'] = $row['id_mascota'];
				$data['id_adopcion'] = $row['id_adopcion'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["id_mascota"]))
		{
			$form_data = array(
				':id_mascota'		    =>	$_POST["id_mascota"],
				':id_adopcion'		    =>	$_POST["id_adopcion"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE mascota_adopcion 
			SET id_mascota = :id_mascota
			, id_adopcion = :id_adopcion
			WHERE id_mascota_adopcion= :id
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
		$query = "DELETE FROM mascota_adopcion WHERE id_mascota_adopcion= '".$id."'";
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