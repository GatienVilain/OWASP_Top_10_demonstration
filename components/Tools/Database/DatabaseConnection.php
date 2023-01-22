<?php

namespace Application\Tools\Database;

require_once("components/Tools/Database/DatabaseUser.php");

use Application\Tools\Database\DatabaseUser;

class DatabaseConnection
{
	protected const host = "localhost";
	protected const user = "root";
	protected const password = "";
	protected const db = "drive";


	use DatabaseUser;

	function console_log($output, $with_script_tags = true)
	{
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
			');';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}

		//décommenter la ligne ci-dessous pour aider à débugger
		//echo $js_code;
		return -1;
	}


	//renvoie true si l'utilisateur est dans la BDD, false sinon
	function check_user(string $email): bool
	{
		//point de connexion à la base de donnée
		$conn = new \mysqli(DatabaseConnection::host, DatabaseConnection::user, DatabaseConnection::password, DatabaseConnection::db);
		if (!$conn) {
			return $this->console_log("Echec de connexion à la base de donnée.");
		}

		$query = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
		$query->bind_param("s", $email);
		$query->execute();
		$result = $query->get_result();

		return $result->num_rows > 0;
	}
}
