<?php 

/**
 * 
 */
class database
{
	static function connect(){
		$host = "localhost";
		$dbname = "database_kas";
		$username = "fecore";
		$passwd = "awesome123";

			try {
					$koneksi = new PDO("mysql:host={$host};dbname={$dbname}", $username, $passwd);
					$koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
				
			} catch (PDOException $e) {
				echo "Connetion Failed" . $e->getMessage();
			}

			return $koneksi;
	}
}





 ?>