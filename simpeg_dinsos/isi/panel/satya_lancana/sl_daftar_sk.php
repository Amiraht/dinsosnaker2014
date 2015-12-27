<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $data = array();
    $sql_data = "SELECT
                	a.*, b.pangkat, b.gol_ruang
                FROM
                	tbl_sk_satya_lancana a
                	LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd_usulan = b.id_pangkat
                ORDER BY
                	a.id_usulan DESC";
    $res_data = mysql_query($sql_data);
    while($ds_data = mysql_fetch_array($res_data)){
        $row_data["id_usulan"] = $ds_data["id_usulan"];
        $row_data["no_usulan"] = $ds_data["no_usulan"];
        $row_data["tgl_usulan"] = $ds_data["tgl_usulan"];
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
        document.location.href = "?mod=sl_daftar_sk_edit&id_usulan=" + id_usulan;
    }
    
    function hapus(id_usulan){
        jConfirm("Anda yakin akan menghapus data usulan ini?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/satya_lancana/sl_daftar_sk_hapus.php?id_usulan=" + id_usulan;
            }
        });
    }
    
    function cetak_daftar_usulan(id_usulan){
        window.open("cetak/sk/satya_lancana/sk_sl.php?id_usulan=" + id_usulan);
    }
    
    function proses(id_usulan){
        document.location.href = "?mod=sl_daftar_sk_diproses&id_usulan=" + id_usulan;
    }
    
    function daftar_diusulkan(id_usulan){
        document.location.href = "?mod=sl_daftar_sk_diusulkan&id_usulan=" + id_usulan;
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR SK PENGUSULAN SATYA LANCANA</h3>
    <div class="bodypanel">
    <button type="button" class="btn btn-success" onclick="document.location.href='?mod=sl_daftar_sk_tambah';"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah SK</button>
    <div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>No. SK</th>
                <th width='100px'>Tgl. SK</th>
                <th width='200px'>Nama Pejabat<br />Penandatangan</th>
                <th width='200px'>NIP Pejabat<br />Penandatangan</th>
                <th width='200px'>Jabatan Pejabat<br />Penandatangan</th>
                <th width='200px'>Pangkat Pejabat<br />Penandatangan</th>
                <th width='50px'>&nbsp;</th>
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
                    if(item.status == 1){
                        text += "<td style='text-align: center;'><button type='button' title='Edit Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='edit(" + item.id_usulan + ");'><span class='glyphicon glyphicon-edit'></span></button></td>";
                        text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_usulan + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
                        text += "<td style='text-align: center;'><button type='button' title='Data Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='daftar_diusulkan(" + item.id_usulan + ");'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
                        text += "<td style='text-align: center;'><button type='button' title='Cetak Daftar Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='cetak_daftar_usulan(" + item.id_usulan + ");'><span class='glyphicon glyphicon-print'></span></button></td>";
                        
						text += "<td style='text-align: center;'><button type='button' title='Proses Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='proses(" + item.id_usulan + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
                    }else{
                        text += "<td style='text-align: center;'>&nbsp;</td>";
                        text += "<td style='text-align: center;'>&nbsp;</td>";
                        text += "<td style='text-align: center;'>&nbsp;</td>";
                        text += "<td style='text-align: center;'>&nbsp;</td>";
                        text += "<td style='text-align: center;'>&nbsp;</td>";
                    }
                    
                text += "</tr>";
                document.write(text);
            });
        </script>
        </tbody>
    </table>
    </div>
</div>