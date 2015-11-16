 <?php 
	
	$user = $_SESSION["id_user"];
	$q = "select a.*, b.keterangan, c.nama_skpd, d.jabatan from user a 
			LEFT join user_level b on a.level = b.level 
			LEFT JOIN t_skpd c on a.skpd = c.id_skpd
			LEFT JOIN t_jabatan d on a.jabatan = d.id_jabatan
			where a.id_user='$user'";
		$ax = mysql_query($q);
		$set=mysql_fetch_array($ax);
	$conn = mysqli_connect("localhost", "root", "", "db_disnakersos");
		
	#ambil data skpd
	$skpdget = "select * from t_skpd ORDER by nama_skpd";
	$skpddata = mysqli_query($conn, $skpdget);
	$skpdarray = array();
	while ($row = mysqli_fetch_assoc($skpddata)) {
		$skpdarray [ $row['id_skpd'] ] = $row['nama_skpd'];
	}	
	
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
?>

	<script type='text/javascript'>
	function toggleTextbox()
		{
				document.getElementById('mytext').disabled = false;
				document.getElementById('mytext2').disabled = false;
				document.getElementById('mytext3').disabled = false;
				document.getElementById('mytext4').disabled = false;
				document.getElementById('mytext5').disabled = false;
				document.getElementById('mytext6').disabled = false;
				document.getElementById('mytext7').disabled = false;
				document.getElementById('mytext9').disabled = false;
				document.getElementById('btnsimpan').disabled = false;
		}
				$(document).ready(function(){
				  $("#editbtn").click(function(){
					$("#detail").show();
					$("#mypass").hide();
				  });
				 
				});
	</script>
	<script type='text/javascript'>
		$(document).ready(function(){
			 $('#mytext6').change(function(){
					$.getJSON('fetching.php',{action:'getSKPD',id_skpd:$(this).val()},function(json){
						$('#mytext5').html('');
						$.each(json, function(index,row){
						$('#mytext5').append('<option value='+row.id_jabatan+'>'+row.jabatan+'</option>');
							});
						});
					});
				});
	</script>
    
<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr>
     <td height="124" colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
       <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>PROFIL USER</b></a></td>
            </tr>
                    <tr>
                  	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
                     <img src="./image/panah.gif"  /><a href="./index.php?mod=arsip&opt=main" id="linkutama">BERANDA LOGIN ARSIP</a>
					 <img src="./image/panah.gif" /><a href="#" id="linkutama">PROFIL USER</a>
                     </td>
                     
            </tr>
        </table>
     </div></td>
  </tr>
  	<tr>
    <td style="float:right;">
                		<img width="90" height="29" 
				onclick="document.location.href='./index.php?mod=arsip&opt=main'" 
				onmouseout="this.src='./image/button/KEMBALI.gif'" 
				onmouseover="this.src='./image/button/KEMBALI2.gif'" 
				src="./image/button/KEMBALI.gif"></img>
                </td>    
    </tr>
    <tr><td>&nbsp;</td></tr>
  <tr>
    <td colspan="2">
    <div id='content' style='margin-left:2%;margin-bottom:20px;width:98%;'> 
	<fieldset>
		<legend >PROFIL USER	</legend>
		<br />
		<form action='index.php?mod=arsip&opt=usersimpan' method='post' name='edituser'>
						
    <table width='100%' border='0' cellspacing='2' cellpadding='5'>
      
      <tr>
 <?php
		echo"
		<td colspan='3'><input id='mytext0' type='hidden' name='id' placeholder='' value='$set[0]' readOnly='true'>
		</td>
	  </tr>
	  <tr height='26px'>
        <td width='170px' >NIP</td>
        <td width='6px'>:</td>
        <td ><input id='mytext' name='nip' placeholder='' value='$set[1]' disabled='disable' size='29'></td>
       </tr>
      <tr height='26px'>
        <td>NAMA</td>
        <td>:</td>
        <td><input id='mytext3' name='nama' placeholder='' value='$set[2]' disabled='disable' size='29'></td>
       </tr>
	  <tr height='26px'>
	  <td >NO. TELEPON</td>
        <td >:</td>
        <td ><input id='mytext2' name='telp' placeholder='' value='$set[6]' disabled='disable' size='29'></td>
	  </tr>
	  <tr height='26px'>
	  <td>EMAIL</td>
        <td>:</td>
        <td><input id='mytext4' name='email' placeholder='' value='$set[7]' disabled='disable' size='29'></td>
	  </tr>
	  <tr height='26px'>
        <td>SKPD</td>
        <td>:</td>
        <td><select id='mytext6' name='skpd' placeholder='' disabled='disable'>
			<option value='$set[4]'>$set[nama_skpd]</option>
			";
				foreach($skpdarray as $id_skpd=>$nama_skpd){
					echo "<option value='$id_skpd'>$nama_skpd</option>";
				}
	echo"
		</select>
		</td>
        
      </tr>
      <tr height='26px'>
        <td>JABATAN</td>
        <td>:</td>
        <td><select id='mytext5' name='jabatan' placeholder='' value='$set[3]' disabled='disable'>
			<option value='$set[3]'>$set[jabatan]</option>
		</select></td>
      </tr>
      <tr height='26px'>
        <td>ALAMAT</td>
        <td>:</td>
        <td><input id='mytext7' name='alamat' placeholder='' value='$set[5]' disabled='disable' size='29'></td>
        
      </tr>
      <tr height='26px'>
        <td>LEVEL USER</td>
        <td>:</td>
        <td><input id='mytext8' name='level' placeholder='' value='$set[11]' readOnly='true' disabled='disable' size='29'> &nbsp;&nbsp; *Data ini tidak dapat diubah</td>
        
      </tr>
      <tr height='26px'>
        <td>USERNAME</td>
        <td>:</td>
        <td><input id='mytext9' name='username' placeholder='' value='$set[9]' disabled='disable' size='29'></td>
       
      </tr>
      <tr height='26px' id='mypass'>
        <td>PASSWORD</td>
        <td>:</td>
        <td><input  name='id' placeholder='' readOnly='true' size='29'>
       
       </tr>
	  <tr >
		<td colspan='9'>
			<table id='detail' border=0 style='display:none;'>
					<tr height='26px'>
						<td>PASSWORD LAMA</td>
						<td>:</td>
						<td><input type='password' id='mytext13' name='pass_old' placeholder='' value='' > &nbsp;&nbsp; *Field ini wajib diisi </td>
						
					</tr>
					<tr height='26px'>
						<td width='170px'>PASSWORD BARU</td>
						<td>:</td>
						<td><input type='password' id='mytext11' name='pass_new1' placeholder='' value=''></td>
						
					</tr>
					<tr height='26px'>
						<td>ULANGI PASSWORD BARU</td>
						<td>:</td>
						<td><input type='password' id='mytext12' name='pass_new2' placeholder='' value='' ></td>
						
					</tr>
					
					
			</table>		
		</td>
	  </tr>
	  <tr>
        
		<td colspan='3'  align='center'><br/><br/><input type='button' id='editbtn' onclick='toggleTextbox()' value='EDIT'> <input type='submit' disabled id='btnsimpan' value='SIMPAN'></td>
	  	
	  </tr>
    </table>
	</form>";
	?>
    </div>
    </td>
				
  </tr>  
  <tr>
    <td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; '>
</div></td>
  </tr>
</table>
			

