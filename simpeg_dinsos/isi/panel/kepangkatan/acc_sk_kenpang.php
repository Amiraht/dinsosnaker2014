<?php
	// proses dan notifikasi dalam satu file yang sama
	include "php/kpk/tolak_sk_kenpang.php";
?>
<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $daftar = array();
    $sql_daftar = "SELECT 
				a.*, b.nama_pegawai, b.nip, c.skpd, d.pangkat, d.gol_ruang, e.jabatan  
			FROM
				tbl_sk_kenpang_detail a
				LEFT JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai 
				LEFT JOIN ref_skpd c ON b.id_satuan_organisasi = c.id_skpd
				LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
				LEFT JOIN ref_jabatan e ON b.id_jabatan = e.id_jabatan
			WHERE
				a.id_sk = '". $_GET['id_sk'] ."' 
			ORDER BY
			    b.nama_pegawai ASC
		   ";
	
    $res_daftar = mysql_query($sql_daftar);
    while($ds_daftar = mysql_fetch_array($res_daftar)){
        $row_daftar["id_detail"] = $ds_daftar["id_detail"];
		$row_daftar["id_sk"] = $ds_daftar["id_sk"];
        $row_daftar["nama_pegawai"] = $ds_daftar["nama_pegawai"];
        $row_daftar["nip"] = $ds_daftar["nip"];
        $row_daftar["pangkat"] = $ds_daftar["pangkat"];
        $row_daftar["gol_ruang"] = $ds_daftar["gol_ruang"];
        $row_daftar["jabatan"] = $ds_daftar["jabatan"];
        $row_daftar["skpd"] = $ds_daftar["skpd"];
		$row_daftar["status"] = $ds_daftar["status"];
        array_push($daftar, $row_daftar);
    }
    echo("var daftar = " . json_encode($daftar) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
       // ambil_tanggal("tgl_usulan");
		$("#alert_add_sukses").click(function(){
			$(this).fadeOut('slow');
		});
    });

    function kembali(){
        document.location.href="?mod=kenpang_daftar_sk_diusulkan";
    }
	
	function terima_surat(id_sk){
		jConfirm("Terima data SK Kepangkatan ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/kpk/terima_sk_kenpang.php?id_sk=" + id_sk;
            }
        });	
	}
	
	function tolak_surat(id_sk){
		jConfirm("Tolak data SK Kepangkatan ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "?mod=acc_sk_kenpang&id_sk=" + id_sk + "&act=yes";
            }
        });	
	}
	
	function hapus(id_detail, id_sk){
		document.location.href="php/kpk/pop_pegawai_sk_kenpang.php?id_detail=" + id_detail + "&id_sk="+id_sk;
	}
	
	
</script>
<!-- END OF JAVASCRIPT PAGE -->

	<?php
		$id_sk = mysql_real_escape_string($_GET['id_sk']); // prevent sql injection
		$qs = "SELECT * FROM tbl_sk_kenpang WHERE id_data = '". $id_sk ."'";
		$exec = mysql_query($qs) or die(mysql_error());
		$row = mysql_fetch_array($exec);

	?>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">ACC SURAT SK KEPANGKATAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>ACC SURAT SK KEPANGKATAN</span></td>
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
						
			<div class="panelcontainer panelform" style="width: 100%;">

				<h3 style="text-align: left;">SUPERVISI SURAT SK KENAIKAN PANGKAT (NO SK : <?=$row['no_sk'];?>)</h3>
				
				<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
				<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<label>NO. Surat Keputusan :</label>
								<input type="hidden" name="id_sk" id="id_sk" value="<?=$row['id_data'];?>"/>
								<input type="text" style='width:90%;' name="no_sk" id="no_sk" class="form-control" value="<?=$row['no_sk'];?>" readonly="readonly"/>
							</td>
							<td>
								<label>Tgl. Surat Keputusan :</label>
								<input type="text"  style='width:90%;' name="tgl_sk" id="tgl_sk" class="form-control" value="<?=$row['tgl_sk'];?>" readonly="readonly"/>
							</td>
						</tr>
					</table>
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td align='left'>
								<button type="button" class="btn btn-success" onclick="terima_surat('<?=$_GET['id_sk'];?>');">Terima Surat</button>
								<button type="button" class="btn btn-warning" onclick="tolak_surat('<?=$_GET['id_sk'];?>');">Tolak Surat</button>
							</td>
						</tr>
					</table><br/>
				</div>
			</div>
			<div class="kelang"></div>

			<div class="panelcontainer" style="width: 100%;">
				<h3 style="text-align: left;">DAFTAR PEGAWAI DALAM LAMPIRAN SK	</h3>
				<div class="bodypanel">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
					<thead>
						<tr class="headertable">
							<th width='40px'>No.</th>
							<th width='200px'>Nama Pegawai</th>
							<th width='150px'>NIP</th>
							<th width='150px'>Pangkat</th>
							<th width='200px'>Jabatan</th>
							<th width='200px'>Unit Kerja / SKPD</th>
							<th width='50px'>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<script type="text/javascript">
						$.each(daftar, function(i, item){
							var text = "";
							text += "<tr>";
								text += "<td style='text-align: center;'>" + (i+1) + "</td>";
								text += "<td style='text-align: center;'>" + item.nama_pegawai + "</td>";
								text += "<td style='text-align: center;'>" + item.nip + "</td>";
								text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
								text += "<td style='text-align: center;'>" + item.jabatan + "</td>";
								text += "<td style='text-align: center;'>" + item.skpd + "</td>";
								text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_detail + ", "+ item.id_sk +");'><span class='glyphicon glyphicon-trash'></span></button></td>";
							text += "</tr>";
							document.write(text);
						});
					</script>
					</tbody>
					</table>
				</div>
			</div>

	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 
	
