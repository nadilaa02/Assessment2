<?php 

class Action{

	var $servername = "localhost";
	var $username = "root";
	var $password = "";
	var $database = "nilai";

	function __construct(){
		$this->conn = mysqli_connect($this->servername, $this->username, $this->password);
		mysqli_select_db($this->conn, $this->database);
	}

	public function Login (){
		if (!strcmp($_POST['nim'], "6701194009")) {
			if (!strcmp($_POST['pass'], "nadila")) {
				echo "<script> alert ('Selamat Datang')</script>;";
				session_start();
				$_SESSION['user']=$_POST['nim'];
			}
			else{
				echo "<script> alert ('Gagal')</script>;";
			echo "<script> location='Login.php'; </script>";
			}
		}
		else{
			echo "<script> alert ('Gagal')</script>;";
			echo "<script> location='Login.php'; </script>";
		}
		echo "<script> location='Dashboard.php'; </script>";
	}

	public function View (){ 
		$sql = "SELECT * FROM ip";
		return $this->conn->query($sql);
	}

	public function Add(){
		$sql = "INSERT INTO ip (Semester, IndeksPrestasi) VALUES ('$_POST[semester]', '$_POST[ip]')";
		$result = $this->conn->query($sql);
		if ($result) {
			echo "<script>alert ('Berhasil menambahkan Indeks Prestasi'); </script>";
		}
		else{
			echo "<script>alert ('Gagal'); </script>";
		}
		echo "<script> location='Dashboard.php' </script>";
	}

	public function Edit (){
		$sql = "UPDATE ip SET IndeksPrestasi = '$_POST[ip]' WHERE Semester = '$_POST[semester]' ";
		$result = $this->conn->query($sql);
		if($result){
			echo "<script> alert ('Berhasil diubah')</script>;";			
		}
		else{
			echo "<script> alert ('Gagal')</script>;";
		}
		echo "<script> location='Dashboard.php'; </script>";
	}

}

$action = new Action();

if (isset($_POST['login'])) {
	$action->Login();
}

if (isset($_POST['Tambah'])) {
	$action->Add();
}

if (isset($_POST['Ubah'])) {
	$action->Edit();
}
?>