<?php 
include 'config_db/database_web.php';

/**
 * 
 */
class Code_random
{
	
	public function generate_code()
	{
		$code = bin2hex(random_bytes(16));
		return $code;
	}
}

/**
 * 
 */
class Show_anggota
	{
		public function view_anggota()
		{
			$db = database::connect();
			$query = $db->prepare("SELECT * FROM cash_anggota ORDER BY id_anggota DESC");
			$query->execute();
			$data = $query->fetchAll();
			return $data;
		}
	}


/**
 * 
 */
class Config_anggota
	{		
		public function tambah_anggota($data)
		{
			$db = database::connect();
			$code_ran = new Code_random();
			$code = $code_ran->generate_code();
			$nama_anggota = htmlspecialchars($data['nama_anggota']);
			$tgl_anggota = htmlspecialchars($data['tgl_lahir']);
			$ponsel_anggota = htmlspecialchars($data['ponsel_anggota']);
			$email_anggota = htmlspecialchars($data['email_anggota']);
			$alamat_anggota = htmlspecialchars($data['alamat_anggota']);

				$query = $db->prepare("INSERT INTO cash_anggota (nama_anggota, tgl_lahir, ponsel_anggota, email_anggota, alamat_anggota,code_uniq) VALUES (:nama_anggota, :tgl_lahir, :ponsel_anggota, :email_anggota, :alamat_anggota, :code)");
				$query->bindParam(":nama_anggota", $nama_anggota);
				$query->bindParam(":tgl_lahir", $tgl_anggota);
				$query->bindParam(":ponsel_anggota", $ponsel_anggota);
				$query->bindParam(":email_anggota", $email_anggota);
				$query->bindParam(":alamat_anggota", $alamat_anggota);
				$query->bindParam(":code", $code);
				$query->execute();
				return $query->rowCount();
		}

		public function edit_anggota($data){
			$db = database::connect();
			$id_anggota = $data['id_data'];
			$nama_anggota = htmlspecialchars($data['nama_anggota']);
			$tgl_lahir = htmlspecialchars($data['tgl_lahir']);
			$ponsel_anggota = htmlspecialchars($data['ponsel_anggota']);
			$email_anggota = htmlspecialchars($data['email_anggota']);
			$alamat_anggota = htmlspecialchars($data['alamat_anggota']);
				$query = $db->prepare("UPDATE cash_anggota SET 
									nama_anggota = :nama_anggota,
									tgl_lahir = :tgl_lahir,
									ponsel_anggota = :ponsel_anggota,
									email_anggota = :email_anggota,
									alamat_anggota = :alamat_anggota
									WHERE code_uniq = :id_data");
				$query->bindParam(":nama_anggota", $nama_anggota);
				$query->bindParam(":tgl_lahir", $tgl_lahir);
				$query->bindParam(":ponsel_anggota", $ponsel_anggota);
				$query->bindParam(":email_anggota", $email_anggota);
				$query->bindParam(":alamat_anggota", $alamat_anggota);
				$query->bindParam(":id_data", $id_anggota);
				$query->execute();
				return $query->rowCount();
		}

		public function hapus_anggota($id_anggota){
			$db = database::connect();
			$query = $db->prepare("DELETE FROM cash_anggota WHERE code_uniq = :id_anggota");
			$query->bindParam(":id_anggota", $id_anggota);
			$query->execute();
			return $query->rowCount();
		}
	}



/**
 * 
 */
class Config_uangkas
	{
		public function view_uangkas(){
			$db = database::connect();
			$query = $db->prepare("SELECT * FROM cash_masuk");
			$query->execute();
			$data = $query->fetchAll();
			return $data;
		}

		public function add_uangkas($data)
		{
			$db = database::connect();
			$code_ran = new Code_random();
			$code = $code_ran->generate_code();
			$bayar_anggota = htmlspecialchars($data['bayar_anggota']);
			$nominal_cash = htmlspecialchars($data['nominal_cash']);
			$via_pembayaran = htmlspecialchars($data['catatan']);
			$tanggal = htmlspecialchars($data['tgl_kas']);
				$query = $db->prepare("INSERT INTO cash_masuk (bayar_anggota, nominal_cash, ket_pembayaran, tgl_masuk, code_uniq) VALUES (:bayar, :nominal_cash, :ket, :tgl, :code)");
				$query->bindParam(":bayar", $bayar_anggota);
				$query->bindParam(":nominal_cash", $nominal_cash);
				$query->bindParam(":ket", $via_pembayaran);
				$query->bindParam(":tgl", $tanggal);
				$query->bindParam(":code", $code);
				$query->execute();
				return $query->rowCount(); 
		}

		public function update_uangkas($data){
			$db = database::connect();
			$id = $data['id'];
			$nama_anggota = htmlspecialchars($data['bayar_anggota']);
			$nominal_cash = htmlspecialchars($data['nominal_cash']);
			$tgl_kas = htmlspecialchars($data['tgl_kas']);
			$catatan = htmlspecialchars($data['catatan']);
				$query = $db->prepare("UPDATE cash_masuk SET 
					bayar_anggota = :nama,
					nominal_cash = :nominal,
					ket_pembayaran = :ket,
					tgl_masuk = :tgl
					WHERE code_uniq = :id");
				$query->bindParam(":nama", $nama_anggota);
				$query->bindParam(":nominal", $nominal_cash);
				$query->bindParam(":ket", $catatan);
				$query->bindParam(":tgl", $tgl_kas);
				$query->bindParam(":id", $id);
				$query->execute();
				return $query->rowCount();
		}


		public function delete_kas($id_data){
			$db = database::connect();
			$query = $db->prepare("DELETE FROM cash_masuk WHERE code_uniq = :id_data");
			$query->bindParam(":id_data", $id_data);
			$query->execute();
			return $query->rowCount();
		}

		///Catatan Pengeluaran

		public function view_catatan(){
			$db = database::connect();
			$query = $db->prepare("SELECT * FROM cash_catatan");
			$query->execute();
			return $query->fetchAll();
		}

		public function add_catatan($data){
			$db = database::connect();
			$code_ran = new Code_random();
			$code = $code_ran->generate_code();
			$catatan = htmlspecialchars($data['catatan']);
			$nominal = htmlspecialchars($data['nominal']);
			$tanggal = $data['tanggal'];
			$query = $db->prepare("INSERT INTO cash_catatan (catatan, nominal_uang, tanggal, code_uniq) VALUES (:catatan, :nominal_uang, :tanggal, :code)");
			$query->bindParam(":catatan", $catatan);
			$query->bindParam(":nominal_uang", $nominal);
			$query->bindParam(":tanggal", $tanggal);
			$query->bindParam(":code", $code);
			$query->execute();
			return $query->rowCount();
		}

		public function update_catatan($data){
			$db = database::connect();
			$id = $data['id'];
			$catatan = htmlspecialchars($data['catatan']);
			$nominal = htmlspecialchars($data['nominal']);
			$tanggal = htmlspecialchars($data['tanggal']);
				$query = $db->prepare("UPDATE cash_catatan
									   SET catatan = :catatan, nominal_uang = :nominal, tanggal = :tanggal
										WHERE code_uniq = :id_data");
				$query->bindParam(":catatan", $catatan);
				$query->bindParam(":nominal", $nominal);
				$query->bindParam(":tanggal", $tanggal);
				$query->bindParam(":id_data", $id);
				$query->execute();
				return $query->rowCount();
		}


		public function delete_catatan($id_data){
			$db = database::connect();
			$query = $db->prepare("DELETE FROM cash_catatan WHERE code_uniq = :id");
			$query->bindParam(":id", $id_data);
			$query->execute();
				return $query->rowCount();
		}
	
	}


/**
 * 
 */
class Config_User
{


	public function show_user(){
		$db = database::connect();
		$query = $db->prepare("SELECT * FROM cash_user");
		$query->execute();
		return $query->fetchAll();
	}




	public function add_user($data){
		$db = database::connect();
		$code = htmlspecialchars($data['code']);
		$nama_awal = htmlspecialchars($data['nama_awal']);
		$nama_akhir = htmlspecialchars($data['nama_akhir']);
		$email = htmlspecialchars($data['email']);
		$level = htmlspecialchars($data['level']);
		$passwd = htmlspecialchars($data['passwd']);
		$passwd_confirm = htmlspecialchars($data['passwd_konfirmasi']);

			//Cek password
			if($passwd != $passwd_confirm){
				echo "<script>alert('Password tidak sama!');
								document.location.href = 'add_user.php';
						 </script>";
				return false;
			}

		//cek email
			$cek_email = $db->prepare("SELECT * FROM cash_user WHERE email = :email");
			$cek_email->bindParam(":email", $email);
			$cek_email->execute();
				if($cek_email->rowCount() == 1){
					echo "<script>alert('Email sudah terdaftar pada database sistem!');
								document.location.href = 'add_user.php';
						 </script>";
				return false;
				}

		//hash password	
	 	$password = password_hash($passwd, PASSWORD_DEFAULT);

	 			//insert data 
	 				$query = $db->prepare("INSERT INTO cash_user (nama_awal, nama_akhir, email, level_user, passwd, code_uniq) VALUES (:awal, :akhir, :email, :level, :password, :code)");
	 				$query->bindParam(":awal", $nama_awal, PDO::PARAM_STR);
	 				$query->bindParam(":akhir", $nama_akhir, PDO::PARAM_STR);
	 				$query->bindParam(":email", $email);
	 				$query->bindParam(":level", $level, PDO::PARAM_STR);
	 				$query->bindParam(":password", $password);
	 				$query->bindParam(":code", $code);
	 				$query->execute();
	 				return $query->rowCount();


	}

	public function update_user($data){
		$db = database::connect();
		$id  = $data['id'];
		$nama_awal = htmlspecialchars($data['nama_awal']);
		$nama_akhir = htmlspecialchars($data['nama_akhir']);
		$email = htmlspecialchars($data['email']);
		$level = htmlspecialchars($data['level']);
			$query = $db->prepare("UPDATE cash_user
									   SET nama_awal = :nama_awal, nama_akhir = :nama_akhir, email = :email, level_user = :level
										WHERE id = :id_data");
			$query->bindParam(":nama_awal", $nama_awal);
			$query->bindParam(":nama_akhir", $nama_akhir);
			$query->bindParam(":email", $email);
			$query->bindParam(":level", $level);
			$query->bindParam(":id_data", $id);
			$query->execute();
			return $query->rowCount();


	}

	public function change_pass($data){
		$db = database::connect();
		$code = htmlspecialchars($data['id']);
		$password_old = htmlspecialchars($data['passwd_old']);
		$password_new = htmlspecialchars($data['passwd_awal']);
		$password_confirm = htmlspecialchars($data['passwd_konfirmasi']);
			
			//query data
				$query = $db->prepare("SELECT * FROM cash_user WHERE code_uniq = :code");
				$query->bindParam(":code", $code);
				$query->execute();
					if($query->rowCount() == 1){
						$data_pass = $query->fetch(PDO::FETCH_ASSOC);
							if(password_verify($password_old, $data_pass['passwd'])){
								//cek password baru dan confirm
								if($password_new != $password_confirm){
									echo "<script>alert('Password tidak sama!'); </script>";
										return false;
										}
									
								}else{
									echo "<script>alert('Password lama anda salah!'); </script>";
									return false;
								}
							}
					$pass_hash = password_hash($password_new, PASSWORD_DEFAULT);

				$query = $db->prepare("UPDATE cash_user SET passwd = :pass");
				$query->bindParam(":pass", $pass_hash);
				$query->execute();
				return $query->rowCount();

				}


	public function delete_user($token){
		$db = database::connect();
		$query = $db->prepare("DELETE FROM cash_user WHERE code_uniq = :code");
		$query->bindParam(":code", $token);
		$query->execute();
		return $query->rowCount();
	}


	
}

 ?>