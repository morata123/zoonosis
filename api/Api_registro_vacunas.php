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
		$query = "SELECT * FROM registro_vacunas ORDER BY id_vacuna;";
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
		if(isset($_POST["tipo_vacuna"]))
		{
			$form_data = array(
				':tipo_vacuna'		    =>	$_POST["tipo_vacuna"],
				':fecha'		    =>	$_POST["fecha"]
			);
			$query = "
			INSERT INTO registro_vacunas
			(tipo_vacuna,fecha) VALUES 
			(:tipo_vacuna,:fecha);
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
		$query = "SELECT * FROM registro_vacunas where id_vacuna='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_vacuna'] = $row['id_vacuna'];
				$data['tipo_vacuna'] = $row['tipo_vacuna'];
				$data['fecha'] = $row['fecha'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["tipo_vacuna"]))
		{
			$form_data = array(
				':tipo_vacuna'		    =>	$_POST["tipo_vacuna"],
				':fecha'		    =>	$_POST["fecha"],
				':id'	            =>	$_POST["hidden_id"]
			);
			$query = "
			UPDATE registro_vacunas 
			SET tipo_vacuna = :tipo_vacuna 
			,fecha = :fecha 
			WHERE id_vacuna = :id
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
		$query = "DELETE FROM registro_vacunas WHERE id_vacuna= '".$id."'";
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