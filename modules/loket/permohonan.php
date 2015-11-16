<?php
	if($_GET["opts"] == '')
	{
?>
<table width="1024" height='100%'border="0" cellspacing="2" cellpadding="5" style="background:#FFF; border-collapse:collapse;">

              	      <tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>PROSES PERMOHONAN DAN PRINT RESI</b></a></td>
            </tr>
  <tr>
	<td> <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
	<img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a>
    
	</td>
  </tr>        
        </table>
        </div>
     </td>
  <tr>
   <td>
   <div id='content' style='margin-left:5%;width:90%;min-height:50px;'>
	<table width="90%" border='0px' style='margin-left: 48px;height:250px;'>
	<tr>
		<td width='40%' ></td>
		<td style="text-align:left; "id='menudepan'>        	
        	 <div style="line-height:25px;">
             <span id="vertical"></span><a href="./index.php?mod=loket&opt=proses_permohonan&opts=baru" class="menu">PROSES PERMOHONAN BARU</a><br />
             <span id="vertical"></span><a href="./index.php?mod=loket&opt=proses_permohonan&opts=perbaikan" class="menu">DATA UNTUK PROSES PERBAIKAN	</a><BR /><span id="vertical"></span><a href="./index.php?mod=loket&opt=main" class="menu">KEMBALI	</a><br />
            </div>
		</td>
	</tr>
	</table>
	</div>
    </td>
  </tr>

  <tr>
    <td><br><div id='footer'></div></td>
  </tr>
</table>
<?php
	}
	else
	{
		
		if($_GET["opts"] == 'baru') 
			include('./modules/loket/permohonan_baru/baru.php');//sudah
		else if($_GET["opts"] == 'perbaikan')
			//include('./modules/loket/permohonan_baru/perbaikan.php');
			include('./modules/loket/permohonan_baru/main_perbaikan.php');
		else if($_GET["opts"] == "cancel_validate"){
			include('./modules/loket/permohonan_baru/revalidate.php');
		}	
		else if($_GET["opts"] == 'perbaikan_berkas')
		{
			$no_resi = $_GET["no_resi"];
			$data=explode("-",$no_resi);
			$kode = $data[0];
			if($kode == "01")
			{
				include('./modules/loket/permohonan_baru/wl/edit_wl.php');//sudah
			}
			elseif($kode=='02')
			{
				include('./modules/loket/permohonan_baru/imta/edit_imta.php');//sudah
			}

			elseif($kode=='03')
			{
				include('./modules/loket/permohonan_baru/pengaduan/edit_pengaduan.php');//sudah
			}
			elseif($kode=='04')
			{
				include('./modules/loket/permohonan_baru/janji/edit_janji.php');//sudah
			}		
			elseif($kode=='05')
			{
				include('./modules/loket/permohonan_baru/sah/edit_sah.php');//sudah
			}	
			elseif($kode=='06')
			{
				include('./modules/loket/permohonan_baru/iplk/edit_iplk.php');//sudah
			}							
			//include('./modules/loket/permohonan_baru/perbaikan.php');
			//include('./modules/loket/permohonan_baru/perbaikan.php');
		}	
		else if($_GET["opts"] == 'baru_wl')
			include('./modules/loket/permohonan_baru/wl/baru_wl.php');
		else if($_GET["opts"] == 'validate_wl')
			include('./modules/loket/permohonan_baru/wl/validasi.php');//sudah
		else if($_GET["opts"] == 'main_wl')
			include('./modules/loket/permohonan_baru/wl/main_wl.php');//sudah
		else if($_GET["opts"] == 'edit_wl')
			include('./modules/loket/permohonan_baru/wl/edit_wl.php');//sudah
		else if($_GET["opts"] == 'baru_imta')
			include('./modules/loket/permohonan_baru/imta/baru_imta.php');//sudah
		else if($_GET["opts"] == 'validate_imta')
			include('./modules/loket/permohonan_baru/imta/validasi.php');//sudah
		else if($_GET["opts"] == 'main_imta')
			include('./modules/loket/permohonan_baru/imta/main_imta.php');//sudah
		else if($_GET["opts"] == 'edit_imta')
			include('./modules/loket/permohonan_baru/imta/edit_imta.php');//sudah
		else if($_GET["opts"] == 'resi')
			include('./modules/loket/permohonan_baru/imta/resi.php');//sudah
		else if($_GET["opts"] == 'cetak_resi')
			include('./modules/loket/permohonan_baru/cetak_resi.php');//sudah			
		else if($_GET["opts"] == 'baru_pengaduan')
			include('./modules/loket/permohonan_baru/pengaduan/baru_pengaduan.php');//sudah
		else if($_GET["opts"] == 'validate_pengaduan')
			include('./modules/loket/permohonan_baru/pengaduan/validasi.php');//sudah
		else if($_GET["opts"] == 'main_pengaduan')
			include('./modules/loket/permohonan_baru/pengaduan/main_pengaduan.php');//sudah
		else if($_GET["opts"] == 'edit_pengaduan')
			include('./modules/loket/permohonan_baru/pengaduan/edit_pengaduan.php');//sudah
//perjanjian
		else if($_GET["opts"] == 'baru_janji')
			include('./modules/loket/permohonan_baru/janji/baru_janji.php');//sudah
		else if($_GET["opts"] == 'validate_janji')
			include('./modules/loket/permohonan_baru/janji/validasi.php');//sudah
		else if($_GET["opts"] == 'main_janji')
			include('./modules/loket/permohonan_baru/janji/main_janji.php');//sudah
		else if($_GET["opts"] == 'edit_janji')
			include('./modules/loket/permohonan_baru/janji/edit_janji.php');//sudah			
//pengesahan pp
		else if($_GET["opts"] == 'baru_sah')
			include('./modules/loket/permohonan_baru/sah/baru_sah.php');//sudah
		else if($_GET["opts"] == 'validate_sah')
			include('./modules/loket/permohonan_baru/sah/validasi.php');//sudah
		else if($_GET["opts"] == 'main_sah')
			include('./modules/loket/permohonan_baru/sah/main_sah.php');//sudah
		else if($_GET["opts"] == 'edit_sah')
			include('./modules/loket/permohonan_baru/sah/edit_sah.php');//sudah		
//pengesahan iplk
		else if($_GET["opts"] == 'baru_iplk')
			include('./modules/loket/permohonan_baru/iplk/baru_iplk.php');//sudah
		else if($_GET["opts"] == 'validate_iplk')
			include('./modules/loket/permohonan_baru/iplk/validasi.php');//sudah
		else if($_GET["opts"] == 'main_iplk')
			include('./modules/loket/permohonan_baru/iplk/main_iplk.php');//sudah
		else if($_GET["opts"] == 'edit_iplk')
			include('./modules/loket/permohonan_baru/iplk/edit_iplk.php');//sudah						
		else
			die ("restricted access");
	}
?>