<script type="text/javascript">
$(document).ready(function(){
    $("#tgl_surat").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#harus_selesai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
function hapusFile(id){
            //alert("hapus");
      document.location.href = "php/hapus_file_surat_masuk.php?id=" + id + "&id_surat_masuk=<?php echo($_GET["id"]); ?>&redir=<?php echo($_GET["redir"]); ?>";
      
}
function goBack(){
	window.history.back();
}
function cetakresi(id){
    var rangkap = $("#rangkap").val();
    /*if(parseInt(rangkap)){
        //jAlert("Rangkap harus angka", "PERHATIAN");
        alert(rangkap);
    }else{
        //window.open("php/cetak_resi.php?id=" + id + "&rangkap=" + rangkap);
        alert("bukan angka");
    }*/
    //alert(rangkap);
    window.open("php/cetak_resi.php?id=" + id + "&rangkap=" + rangkap);
}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
        <td >
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'">
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00; href="">FILE SURAT MASUK</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>FILE LAMPIRAN SURAT MASUK</span>
                            <td><img  align="right" width="90" height="29" onclick="goBack();" 
                                onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
                                </td>
                        </tr>
                    </table>            
                    </div>
            <br>
        </td>
  </tr>
  <tr>
  	<td>
    <div id='content' style='padding-top:10px;'>	<br>
		<fieldset>
    <legend><h3>RESI SURAT MASUK</h3></legend>
    <?php
        $res_sm = mysql_query("SELECT 
                                	a.*, b.unit_kerja, CONCAT('(', c.kode_masalah, ') ', c.masalah) AS masalah,
                                	CONCAT('(', d.kode, ') ', d.jenis_surat) AS jenis_surat
                                FROM 
                                	myapp_maintable_suratmasuk a
                                	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                                	LEFT JOIN myapp_reftable_masalah c ON a.id_masalah = c.id_masalah
                                	LEFT JOIN myapp_reftable_jenissurat d ON a.id_jenis_surat = d.id_jenis_surat
                                WHERE 
                                	a.id='" . $_GET["id"] . "'");
        $ds_sm = mysql_fetch_array($res_sm);
    ?>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='20%'>Nomor Register</td>
                <td width='10px'>:</td>
                <td><b><?php echo(no_register($ds_sm["noreg"])); ?></b></td>
            </tr>
            <tr>
                <td width='20%'>Nomor Surat</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_sm["no_surat"]); ?></b></td>
            </tr>
            <tr>
                <td width='20%'>Tanggal Surat</td>
                <td width='10px'>:</td>
                <td><b><?php echo tglindonesia($ds_sm["tgl_surat"]); ?></b></td>
            </tr>
            <tr>
                <td width='20%'>Tanggal Terima</td>
                <td width='10px'>:</td>
                <td><b><?php echo tglindonesia($ds_sm["tgl_terima"]); ?></b></td>
            </tr>
            <tr>
                <td width='20%'>Tanggal Selesai</td>
                <td width='10px'>:</td>
                <td><b><?php echo tglindonesia($ds_sm["harus_selesai"]); ?></b></td>
            </tr>
            <tr>
                <td width='20%'>Perihal</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_sm["perihal_surat"]); ?></td>
            </tr>
            <tr>
                <td width='20%'>Deskripsi</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_sm["deskripsi_surat"]); ?></b></td>
            </tr>
            <tr>
                <td width='20%'>SKPD / Unit Kerja Pengirim</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_sm["unit_kerja"]); ?></b></td>
            </tr>
            <tr>
                <td width='20%'>Masalah</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_sm["masalah"]); ?></b></td>
            </tr>
            <tr>
                <td width='20%'>Sub Masalah</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_sm["jenis_surat"]); ?></b></td>
            </tr>
        </table><br/>
        <table border="0px" cellspacing='0' cellpadding='0' width='80%'>
            <tr>
                <td>
                    Rangkap :
                    <input type="text" value='2' id="rangkap" style="width: 50px;" />
                    <input type="button" value='Cetak' onclick="cetakresi(<?php echo($_GET["id"]); ?>);" />
                </td>
            </tr>
        </table>
   </fieldset><br/><br/> 

	<fieldset>	
        <h3>INPUT FILE BUKTI / PENDUKUNG SURAT MASUK</h3><br/>
		<form name="frm" action="php/file_surat_masuk.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="redir" value="<?php echo($_GET["redir"]); ?>" />
            <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>" />
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Upload File</td>
                    <td width='10px'>:</td>
                    <td><input type="file" name="file" /></td>
                </tr>
                <tr>
                    <td width='20%'>Keterangan File</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="keterangan" /></td>
                </tr>                
            </table>
            <br />
            
            <table border="0px" cellspacing='0' cellpadding='0' width='80%'>
                <tr>
                <?php
                    $redir = "?mod=input_surat_masuk";
                    if(isset($_GET["redir"])){
                        $redir = "?mod=" . $_GET["redir"] . "&id=" . $_GET["id"];
                    }
                ?>
                    <td width='25%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='25%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                    <td width='25%'><input type="button" value='Kembali' style="width: 100%;" onclick="document.location.href='<?php echo($redir); ?>';" /></td>
                    <td width='25%'><input type="button" value='Selesai' style="width: 100%;" onclick="document.location.href='?mod=info&pesan=47&redir=<?php if(isset($_GET["redir"]))echo("manajemen_surat_masuk_1"); else{echo("input_surat_masuk");} ?>';" /></td>
                </tr>
            </table>
      </form>
	</fieldset><br/><br/>  
<fieldset>
<legend><h3>DAFTAR FILE BUKTI / PENDUKUNG SURAT MASUK</h3></legend>

<?php
    $res = mysql_query("SELECT * FROM myapp_filetable_suratmasuk WHERE id_surat_masuk='" . $_GET["id"] . "'");
    while($ds = mysql_fetch_array($res)){
?>
        <div class="judullist"><?php echo($ds["nama_file"]) ?></div>
        <div class="isilist">
            <?php echo($ds["keterangan"]) ?>
            <div style="clear: both;"></div>
            <a class="linktambahan" href="uploaded/sm/<?php echo($ds["nama_file"]) ?>" target="_blank">Download</a>
            <a class="linktambahan" href="php/hapus_file_surat_masuk.php?id=<?=$ds["id"];?>&id_surat_masuk=<?php echo($_GET["id"]); ?>&redir=<?php echo($_GET["redir"]); ?>">Hapus</a>
            <div style="clear: both;"></div>
        </div>
<?php
    }
?>
</fieldset>
	</div>
</td>
</tr>
<tr>
    <td align="center" valign="middle">
    <div id='menu' style='border:0px solid black;'>
                    <nav>
                            <ul>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='<?=$url_main;?>'>BERANDA UTAMA</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=latar_belakang'>LATAR BELAKANG</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=berita_dan_informasi'>BERITA DAN INFORMASI</a></li>
									<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=fdownload'>FILE DOWNLOAD</a></li>
                                </ul>
                    </nav>
    </div>
    </td>
</tr>
<tr>
    <td>
    <div id='footer' style='background:url(./image/coba/footer.png) no-repeat;height:100px;'>
        </div>
     </td>
 </tr>
 </table>
