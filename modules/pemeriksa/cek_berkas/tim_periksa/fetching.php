<?php
/*=============================================*/
		 $conn = mysqli_connect("localhost", "root", "", "db_disnakersos");
			include "../../../../libraries/dinsos.php";
		
				if(isset($_GET['action']) && $_GET['action'] == "getUser")
				{
					$id_user = $_GET['id_user'];
					$jabatanget = "SELECT a.id_user, a.nip, a.nama, d.jabatan FROM user a LEFT JOIN t_jabatan d on a.jabatan = d.id_jabatan Where id_user=$id_user";
					$jabatandata= mysqli_query($conn,$jabatanget);
					$rows = array();
					while($row = mysqli_fetch_assoc($jabatandata))
					{
						//array_push($rows,$row);
						$rows[] = $row;
					}
					echo json_encode($rows);
					exit;
				}
?>
		
		