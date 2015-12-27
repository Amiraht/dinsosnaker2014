<script type="text/javascript">
$(document).ready(function(){
	$("#expand").click(function(){
            $("#bodyfilter").slideToggle(800);
        });	

	$("#cadis").dialog({
			autoOpen: false,
			height: 450,
			width: 650,
			modal: true,
			show: "fade",
			hide: "fade"
	});		
});
</script>
<script type="text/javascript">
function hapus(id_riwayat_pend, status_supervisi){
    <?php
		if(isset($_SESSION["simpeg_id_level"])){
			$simpeg_id_level = $_SESSION["simpeg_id_level"];
		}
		
        if($simpeg_id_level == 5 && $simpeg_id_level == 12){
    ?>
            jConfirm("Hapus data riwayat pendidikan dengan ID "+ id_riwayat_pend + " ?", "KONFIRMASI", function(r){
                if(r){
                    document.location.href="php/riwayat_pendidikan/riwayat_pendidikan_hapus.php?id=" + id_riwayat_pend;
                }
            });
    <?php
        }else{
    ?>
            if(status_supervisi == 3){
                jAlert("Data ini telah di terima (ACC) oleh admin SKPD. Data tidak bisa dihapus kembali", "PERHATIAN");
            }else{
                jConfirm("Hapus data riwayat pendidikan dengan ID "+ id_riwayat_pend +" ?", "KONFIRMASI", function(r){
                    if(r){
                        document.location.href="php/riwayat_pendidikan/riwayat_pendidikan_hapus.php?id=" + id_riwayat_pend;
                    }
                });
            }
    <?php
        }
    ?>
}
function edit(id_riwayat_pend, status_supervisi){
    <?php
         if($simpeg_id_level == 5 && $simpeg_id_level == 12){
    ?>
            document.location.href="?mod=riwayat_pendidikan_edit&id=" + id_riwayat_pend;
    <?php
        }else{
    ?>
            if(status_supervisi == 3){
                jAlert("Data ini telah di terima (ACC) oleh admin SKPD. Data tidak bisa diedit kembali", "PERHATIAN");
            }else{
                document.location.href="?mod=riwayat_pendidikan_edit&id=" + id_riwayat_pend;
            }
    <?php
        }
    ?>
}

  function tolak(id_data){
	$("#id_data").val(id_data);
	$("#cadis").dialog("open");
  }	
  
  function acc(id_data){
	  jConfirm("Proses (ACC) data riwayat pendidikan dengan ID "+ id_data + " ini ?", "KONFIRMASI", function(r){
                if(r){
                    document.location.href="php/riwayat_pendidikan/acc_riwayat_pendidikan.php?id=" + id_data;
                }
      });
  }
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">SUPERVISI DATA RIWAYAT PENDIDIKAN </h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th width='90px'>NIP</th>
                <th width='200px'>Nama Pegawai</th>
				<th width='100px'>Tingkat Pendidikan</th>
				<th width='100px'>Tempat Pendidikan</th>
				<th width='150px'>Nama Kepala / Pimpinan Tempat Pendidikan </th>
                <th width='20px'>&nbsp;</th>
				<th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
				<th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
			//$where = " b.nama_pegawai LIKE '%" . $nama_pegawai . "%' AND a.nip LIKE '%" . $nip . "%' ";
            $res = mysql_query("SELECT
                                	a.id_data_rp as 'id_data', a.nip, a.tempat_pendidikan, a.k_a_tempat_pendidikan as 'kepala' ,b.nama_pegawai, 
									c.tingkat_pendidikan ,
                                	a.no_ijazah, a.tgl_ijazah, a.supervisi 
                                FROM
                                	tbl_riwayat_pendidikan a
                                	LEFT JOIN tbl_pegawai b ON a.nip = b.nip
									LEFT JOIN ref_tingkat_pendidikan c ON a.id_tingkat_pendidikan = c.id_tingkat_pendidikan
								WHERE 
									a.supervisi = 2 
                                ORDER BY
                                	a.id_data_rp ASC") or die(mysql_error());
									
            $no = 0;
            while($ds = mysql_fetch_array($res)){
                $no++;
                echo "<tr>";
                    echo "<td align='center'>" . $no . "</td>";
                    echo "<td align='center'>" . $ds["nip"] . "</td>";
                    echo "<td align='center'>" . $ds["nama_pegawai"] . "</td>";
                    echo "<td align='center'>" . $ds["tingkat_pendidikan"] . "</td>";
					echo "<td align='center'>" . ($ds["tempat_pendidikan"] == "" ? "---------" : $ds["tempat_pendidikan"]) . "</td>";
					echo "<td align='center'>" . ($ds["kepala"] == "" ? "---------" : $ds["kepala"]) . "</td>";
                    echo "<td>
                            <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='edit(\"" . $ds["id_data"] . "\", " . $ds["supervisi"] . ");' />
                        </td>";
					echo "<td>
                       <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Data' onclick='hapus(\"" . $ds["id_data"] . "\", " . $ds["supervisi"] . ");' />
                   </td>";
                   
				   echo "<td style='text-align: center;'><button type='button' title='ACC' class='btn btn-sm btn-success' style='width: 100%;' onclick='acc(".$ds["id_data"].");'>Proses (ACC)&nbsp;<span class='glyphicon glyphicon-cog'></span></button></td>";
				   
				   echo "<td style='text-align: center;'><button type='button' title='ACC' class='btn btn-sm btn-warning' style='width: 100%;' onclick='tolak(".$ds["id_data"].");'>Tolak&nbsp;<span class='glyphicon glyphicon-cog'></span></button></td>";
				   
                echo "</tr>";
            }
        ?>
        </tbody>
        </table>
    </div>
</div>

<!-- DIALOG JQUERY -->
<div id="cadis" title="CATATAN SUPERVISI RIWAYAT PENDIDIKAN PEGAWAI " style="display: none;">
<form name="frm_supervisi_rp" id="frm_supervisi_rp" action="php/riwayat_pendidikan/catatan_supervisi_rp.php" method="POST">
<input type="hidden" id="id_textbox" />
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
				<input type="hidden" name="id_data" id="id_data" />
                <label>Input Catatan Supervisi ( *opsional )</label>
				<textarea name="catatan" id="catatan" placeholder=":: Masukan Catatan Supervisi, jika ada(opsional) ::"></textarea>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value="Submit Catatan" style="height: 30px; width: 140px;" class="btn btn-sm btn-success" /></td>
            </tr>
        </table>
    </div>
</div>
</form>
</div>