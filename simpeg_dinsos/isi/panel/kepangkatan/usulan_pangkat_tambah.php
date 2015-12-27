<!-- CONTROLLER -->
<script type="text/javascript">
<?php
	// JSON data untuk daftar pangkat
    $pangkat = array();
    $sql_pangkat = "SELECT * FROM ref_pangkat";
    $res_pangkat = mysql_query($sql_pangkat);
    while($ds_pangkat = mysql_fetch_array($res_pangkat)){
        $row_pangkat["id_pangkat"] = $ds_pangkat["id_pangkat"];
        $row_pangkat["gol_ruang"] = $ds_pangkat["gol_ruang"];
        $row_pangkat["pangkat"] = $ds_pangkat["pangkat"];
        array_push($pangkat, $row_pangkat);
    }
    echo("var pangkat = " . json_encode($pangkat) . ";\n");
	
	// JSON data daftar pegawai yang satu unit/SKPD
	$pegawai = array();
	$s = "SELECT 
				a.id_pegawai, a.nip, a.nama_pegawai
			FROM
				tbl_pegawai a
				LEFT JOIN ref_skpd b ON a.id_satuan_organisasi = b.id_skpd
			WHERE 
				b.kode_skpd = '". $_SESSION["simpeg_kode_skpd"] ."'
			ORDER BY
				a.nama_pegawai ASC
				";
	$rs = mysql_query($s);
	while($dt = mysql_fetch_array($rs)){
		$obj["id_pegawai"] = $dt["id_pegawai"];
		$obj["nama"] = $dt["nama_pegawai"];
		$obj["nip"] = $dt["nip"];
		array_push($pegawai, $obj);
	}
	 echo("var pegawai = " . json_encode($pegawai) . ";\n");
	
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tgl_usulan");
    });
    
    function simpan(){
        $("#frm").submit();
    }
    
    function kembali(){
		var id_level = "<?=$_SESSION['simpeg_id_level'];?>";
		if(id_level == 5){
			 document.location.href="?mod=daftar_usulan_kpk_sedang_diproses";
		}else{
			 document.location.href="?mod=daftar_kpk";
		}
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Data surat usulan kenaikan pangkat telah disimpan", "PEMBERITAHUAN", function(r){
            document.location.href="?mod=daftar_kpk";
        });
    }

</script>
<!-- END OF JAVASCRIPT FROM CHILD -->


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">TAMBAH USULAN KEPANGKATAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH USULAN KEPANGKATAN</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./'" 
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
		
			<form name="frm" id="frm" action="php/kpk/usulan_pangkat_tambah.php" method="POST">
			<div class="panelcontainer panelform" style="width: 100%;">
				<?php
					$qs = "SELECT skpd FROM ref_skpd WHERE kode_skpd = '".$_SESSION["simpeg_kode_skpd"]."'";
					$exec = mysql_query($qs) or die(mysql_error());
					$fetch = mysql_fetch_array($exec);
					$unit_skpd = ($fetch['skpd'] == '') ? '&nbsp;' : "( Unit Kerja/ SKPD : ". $fetch['skpd'] ." ).";
					
				?>
				<h3 style="text-align: left;">TAMBAH SURAT USULAN KENAIKAN PANGKAT <? echo $unit_skpd; ?></h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<label>NO. Surat Usulan :</label>
								<input type="text" style='width:90%;' name="no_usulan" id="no_usulan" class="form-control" placeholder=":: INPUT NO SURAT USULAN ::"/>
							</td>
							<td>
								<label>Tgl. Surat Usulan :</label>
								<input type="text" style='width:90%;' name="tgl_usulan" id="tgl_usulan" class="form-control" placeholder=":: INPUT TANGGAL SURAT USUL ::"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Nama Pejabat Penandatangan :</label>
								<input type="text" style='width:90%;' name="nama_pejabat_ttd" id="nama_pejabat_ttd" class="form-control" placeholder=":: INPUT NAMA PEJABAT PENANDATANGAN ::" />
							</td>
							<td>
								<label>NIP Pejabat Penandatangan :</label>
								<input type="text" style='width:90%;' name="nip_pejabat_ttd" id="nip_pejabat_ttd" class="form-control" placeholder=":: INPUT NIP PEJABAT PENANDATANGAN ::" />
							</td>
						</tr>
						<tr>
							<td>
								<label>Jabatan Pejabat Penandatangan :</label>
								<input type="text" style='width:90%;' name="jabatan_ttd" id="jabatan_ttd" class="form-control" placeholder=":: INPUT JABATAN PEJABAT PENANDATANGAN USULAN ::"/>
							</td>
							<td>
								<label>Pangkat Pejabat Penandatangan :</label>
								<select name="id_pangkat_ttd" id="id_pangkat_ttd" class="form-control">
									<option value="0">----- Pilih Pangkat -----</option>
									<script type="text/javascript">
									$.each(pangkat, function(i, item){
										document.write("<option value='" + item.id_pangkat + "'>" + item.pangkat + " (" + item.gol_ruang + ")</option>");
									});
									</script>
								</select>
							</td>
						</tr>
					</table>
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td align='left'>
								<button type="button" class="btn btn-success" onclick="simpan();"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Tambah</button>
								<button type="button" class="btn btn-warning" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
							</td>
						</tr>
					</table>
				</div>
			</div>
			</form>
			<div class="kelang"></div>

	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 

