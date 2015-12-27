<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $data = array();
    $sql_data = "SELECT
                	a.*, b.pangkat, b.gol_ruang
                FROM
                	tbl_usulan_pi a
                	LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd_usulan = b.id_pangkat
                WHERE
                	a.kode_skpd LIKE '" . $_SESSION["simpeg_kode_skpd"] . "%' 
					AND a.status = 2 
                ORDER BY
                	a.id_usulan DESC";
    $res_data = mysql_query($sql_data);
    while($ds_data = mysql_fetch_array($res_data)){
        $row_data["id_usulan"] = $ds_data["id_usulan"];
        $row_data["no_usulan"] = $ds_data["no_usulan"];
        $row_data["tgl_usulan"] = tglindonesia($ds_data["tgl_usulan"]);
        $row_data["jabatan_ttd_usulan"] = $ds_data["jabatan_ttd_usulan"];
        $row_data["nama_ttd_usulan"] = $ds_data["nama_ttd_usulan"];
        $row_data["nip_ttd_usulan"] = $ds_data["nip_ttd_usulan"];
        $row_data["status"] = $ds_data["status"];
        $row_data["pangkat"] = $ds_data["pangkat"];
        $row_data["gol_ruang"] = $ds_data["gol_ruang"];
        array_push($data, $row_data);
    }
    echo("var data = " . json_encode($data) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    function edit(id_usulan){
        document.location.href = "?mod=pi_daftar_usulan_edit&id_usulan=" + id_usulan;
    }
    
    function hapus(id_usulan){
        jConfirm("Anda yakin akan menghapus data usulan ini?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/pi/pi_daftar_usulan_hapus.php?id_usulan=" + id_usulan;
            }
        });
    }
    
    function daftar_diusulkan(id_usulan){
        document.location.href = "?mod=pi_daftar_usulan_diusulkan&id_usulan=" + id_usulan;
    }
	
	function acc(id_usulan){
		 document.location.href = "?mod=supervisi_usulan_pegawai_pi&id_usulan=" + id_usulan;
	}
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR SURAT USULAN PENYESUAIAN IJAZAH</h3>
	<?php 
		if(isset($_GET['code']) && isset($_GET['nomor'])){
			if($_GET['code'] == 1){	
				//echo "sukses";
				echo "<div class='alert alert-success' role='alert' id='alert_add_sukses' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data usulan penyesuaian ijazah dengan No.Usulan : <b>".$_GET['nomor']." </b> diterima.</center>";
				echo "</div>";
			}else if($_GET['code'] == 2){
				echo "<div class='alert alert-warning' role='alert' id='alert_add_sukses'  title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data usulan penyesuaian ijazah dengan No.Usulan : <b>".$_GET['nomor']." </b> ditolak.</center>";
				echo "</div>";
			}
		}
	?>	
    <div class="bodypanel">
    <button type="button" class="btn btn-success" onclick="document.location.href='?mod=pi_daftar_usulan_tambah';"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah Surat Usulan</button>
    <div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>No. Usulan</th>
                <th width='100px'>Tgl. Usulan</th>
                <th width='200px'>Nama Pejabat Penandatangan</th>
                <th width='200px'>NIP Pejabat Penandatangan</th>
                <th width='200px'>Jabatan Pejabat Penandatangan</th>
                <th width='200px'>Pangkat Pejabat Penandatangan</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <script type="text/javascript">
            $.each(data, function(i, item){
                var text = "";
                text += "<tr>";
                    text += "<td style='text-align: center;'>" + (i+1) + "</td>";
                    text += "<td style='text-align: center;'>" + item.no_usulan + "</td>";
                    text += "<td style='text-align: center;'>" + item.tgl_usulan + "</td>";
                    text += "<td style='text-align: center;'>" + item.nama_ttd_usulan + "</td>";
                    text += "<td style='text-align: center;'>" + item.nip_ttd_usulan + "</td>";
                    text += "<td style='text-align: center;'>" + item.jabatan_ttd_usulan + "</td>";
                    text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
                        text += "<td style='text-align: center;'><button type='button' title='Edit Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='edit(" + item.id_usulan + ");'><span class='glyphicon glyphicon-edit'></span></button></td>";
                        text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_usulan + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
                        text += "<td style='text-align: center;'><button type='button' title='Data Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='daftar_diusulkan(" + item.id_usulan + ");'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
                        text += "<td style='text-align: center;'><button type='button' title='Supervisi Data Usulan' class='btn btn-sm btn-success' style='width: 100%;' onclick='acc(" + item.id_usulan + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
                    
                text += "</tr>";
                document.write(text);
            });
        </script>
        </tbody>
    </table>
    </div>
</div>