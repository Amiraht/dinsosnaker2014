<?php
/*=============================================*/
$conn = mysqli_connect("localhost", "root", "", "db_disnakersos");
include "./libraries/dinsos.php";
/*=============================================*/
		
		 	#ambil data jabatan
				if(isset($_GET['action']) && $_GET['action'] == "getSKPD")
				{
					$id_skpd = $_GET['id_skpd'];
					$jabatanget = "select id_jabatan,jabatan from t_jabatan Where id_skpd=$id_skpd order by jabatan";
					$jabatandata= mysqli_query($conn,$jabatanget);
					$jabatanarray = array();
					while($row = mysqli_fetch_assoc($jabatandata))
					{
						array_push($jabatanarray,$row);
					}
					
					echo json_encode($jabatanarray);
					exit;
				}
				
		if(isset($_GET['action']) && $_GET['action'] == "getNegara")
				{
					$jabatangetA = "select * from t_negara";
					$ad = mysqli_query($conn,$jabatangetA);
					$Arr = array();
					
					while($row1 = mysqli_fetch_assoc($ad))
					{
						array_push($Arr,$row1);
					}
					
					 echo json_encode($Arr);
					 exit;
				}

//Kenegaraaan
if(isset($_POST['nama']))
{
	$name = $_POST['nama'];
	$query = "INSERT INTO t_negara (nama_negara) VALUES ('$name')";
	$result = mysql_query("$query") or die ("5");
	
}				
				
?>
		
		