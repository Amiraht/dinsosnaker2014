<?php
	include "./libraries/dinsos.php";
	$user=$_POST["user"];
	$pass=md5($_POST["pass"]);

	$query=mysql_query("SELECT * FROM user WHERE username='$user' AND password='$pass' and izin='Y'");
	$data = mysql_num_rows($query);
	
	if($data>0)
	{
		while($data2=mysql_fetch_array($query))
		{
			$_SESSION["lv"]=$data2[8];
			if($data2[8]=="1")
			{
			$_SESSION["id_user"]=$data2[0];
			
?>
			<script type="text/javascript">
				document.location = "./index.php?mod=loket&opt=main";
				//document.location = "./index.php?mod=dinsos&do=main";
			</script>
<?php
			}
			elseif($data2[8]=="2")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=jamsostek&do=main";
				</script>
<?php
			}
			elseif($data2[8]=="0")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./modules/nonlogin/cp/index.php";
				</script>
<?php
			}
			elseif($data2[8]=="3")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=loket&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="4")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kabidhubsaker&opt=main";
				</script>		
<?php
			}
			elseif($data2[8]=="5")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasi&opt=main";
				</script>	
<?php
			}
			elseif($data2[8]=="6")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=staf&opt=main";
				</script>	
<?php
			}
			elseif($data2[8]=="7")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kabidpentaker&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="8")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasipentaker&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="9")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=pemeriksa&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="10")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=stafkasi&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="11")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kabidwasnaker&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="12")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasiwasnaker&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="13")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=pengawas&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="14")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=stafkasiwasnaker&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="15")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasubag_umum&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="16")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=sekretaris&opt=main";
				</script>	
<?php
			}
			elseif($data2[8]=="17")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kadis&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="18")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=arsip&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="19")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=cp&opt=main";
				</script>
<?php
			}//KASI HUBSAKER
			elseif($data2[8]=="20")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasihubsaker&opt=main";
				</script>
<?php
			}//STAF KASI HUBSAKER
			elseif($data2[8]=="21")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=stafkasihubsaker&opt=main";
				</script>
<?php
			}//KABID LATIH
			elseif($data2[8]=="22")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kabidlatih&opt=main";
				</script>
<?php
			}//KASI LATIH
			elseif($data2[8]=="23")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasilatih&opt=main";
				</script>
<?php
			}//STAF KASI LATIH
			elseif($data2[8]=="24")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=stafkasilatih&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="25")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=peninjau&opt=main";
				</script>
<?php
			}	
			elseif($data2[8]=="26")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=pemantau&opt=main";
				</script>
<?php
			}						
			else
			{
?>
				<script type="text/javascript">
					alert('USERNAME DAN PASSWORD ANDA SALAH');
					document.location = "index.php?mod=umum&do=login";
				</script>
<?php
			}
		};
	}
	else
	{
		?>
			<script type="text/javascript">
				alert('USERNAME DAN PASSWORD ANDA SALAH');
				document.location = "index.php?mod=umum&do=login";
			</script>
<?php
	}
?>