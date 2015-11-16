<?php
	if(isset($_GET['c_num']) && isset($_GET['res'])){
		$str = "";
		$url = "";
		$gt = mysql_real_escape_string($_GET['res']);
		$n_resi = base64_decode(base64_decode($gt)); // pecah decoding
		
		if($_GET['c_num'] == 1){
			$str = "DELETE FROM tbl_berkas_iplk WHERE no_resi = '".$n_resi."'";
			$url = "./index.php?mod=loket&opt=proses_permohonan&opts=baru";
		}
		
		mysql_query($str);
	}
?>
<script type="text/javascript">

function Kirim_Cari1()
{
	var cari ='<?php echo $_GET["cari"]; ?>';

	var s;
	s='./index.php?mod=loket&opt=proses_permohonan&opts=perbaikan';
	//s='agenda_masuk.php?opts=view';
	if(cari != '')
		s=s+'&cari='+cari;
	s=s+'&halaman='+document.f2.halaman.value;
	document.location.href=s;
}

function kirim_edit(no_resi)
{
	var s;
	s='./index.php?mod=loket&opt=proses_permohonan&opts=perbaikan_berkas';
	if(no_resi != '')
	s=s+'&no_resi='+no_resi;
	document.location.href=s;
} 
function edit_data(c,uid)
{
		var t=document.getElementById("div_edit_"+c);
		if(t.innerHTML != ''){
			t.innerHTML = '';
		}
		else
			t.innerHTML='<iframe src="./modules/loket/lembar_kendali/edit.php?link='+c+'&id_user='+uid+'" width="100%" style="height:300px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
		
}

function lihat_data(k,uid)
{
		var t=document.getElementById("div_edit_"+k);
		if(t.innerHTML != ''){
			t.innerHTML = '';
		}
		else
			t.innerHTML='<iframe src="./modules/loket/lembar_kendali/lihat.php?link='+k+'&id_user='+uid+'" width="100%" style="height:300px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
	
}
 function tambah(){
	 var url = '<?=$url;?>';
	 document.location.href = url;
 }
</script>

<table width="1024" border="0" cellspacing="0" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#"><b>DATA UNTUK PROSES PERBAIKAN	</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				 <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
				 <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a> 
				 <img src="./image/panah.gif"  /><span id="linkutama">DATA UNTUK PROSES PERBAIKAN	</span>
                 </td>
                
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr><td style="float:right; padding-right:10px;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=proses_permohonan'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
	<tr>
		<td>
         <div id='content' style='margin-left:2%;margin-bottom:20px;width:97%;'>
            <fieldset>
            <legend id="linkutama1">KONFIRMASI PEMBATALAN  DATA BERKAS </legend>
				<span style='color:green;font-family:verdana;font-size:14px;'>
					*) PROSES PEMBATALAN DATA BERKAS TELAH ANDA LAKUKAN. DATA YANG TELAH ANDA INPUTKAN SEBELUMNYA TELAH TERHAPUS.
					 SILAHKAN TEKAN TOMBOL <b>TAMBAH</b> BERIKUT UNTUK MENAMBAHKAN BERKAS SEBELUMNYA KEMBALI. <br/><br/>
					<button style='width:120px;height:35px;background' onclick='tambah();' >TAMBAH</button>
				</span>
            </fieldset>
		 </td>
 <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>	