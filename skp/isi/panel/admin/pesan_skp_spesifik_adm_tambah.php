<!-- CONTROLLER SCRIPT -->
<script type="text/javascript">
<?php
    /* 1. NAMA-NAMA YANG AKAN DIKIRIMI PESAN */
    $temp_penerima = array();
    $sql_temp_penerima = "SELECT
                            	a.id_pegawai, a.nama_pegawai, a.nip,
                            	b.pangkat, b.gol_ruang,
                            	c.jabatan, d.skpd
                            FROM
                            	tbl_pegawai a
                            	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                            	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                            	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                            	INNER JOIN tbl_pesan_skp_spesifik_temp_penerima e ON a.id_pegawai = e.id_pegawai
                            ORDER BY
                            		a.nama_pegawai ASC";
    $res_temp_penerima = mysql_query($sql_temp_penerima);
    while($ds_temp_penerima = mysql_fetch_array($res_temp_penerima)){
        $row_temp_penerima["id_pegawai"] = $ds_temp_penerima["id_pegawai"];
        $row_temp_penerima["nama_pegawai"] = $ds_temp_penerima["nama_pegawai"];
        $row_temp_penerima["nip"] = $ds_temp_penerima["nip"];
        $row_temp_penerima["pangkat"] = $ds_temp_penerima["pangkat"];
        $row_temp_penerima["gol_ruang"] = $ds_temp_penerima["gol_ruang"];
        $row_temp_penerima["jabatan"] = $ds_temp_penerima["jabatan"];
        $row_temp_penerima["skpd"] = $ds_temp_penerima["skpd"];
        array_push($temp_penerima, $row_temp_penerima);
    }
    echo("var temp_penerima = " . json_encode($temp_penerima) . ";");
    /* END OF 1. *****************************/
?>
</script>
<!-- END OF CONTROLLER SCRIPT -->

<!-- PAGE SCRIPT -->
<script type="text/javascript">
function push_penerima(){
    var nip = $("#nip").val();
    if(nip == ""){
        jAlert("Isikan NIP", "PERHATIAN");
    }else{
        $("#frm_temp_penerima").submit();
    }
}
function pop_penerima(id_pegawai){
    document.location.href="php/admin/pesan_skp_spesifik_adm_delete_temp_penerima.php?id_pegawai=" + id_pegawai;
}
function proses(){
    var judul = $("#judul").val();
    var pesan = $("#pesan").val();
    var jlh_penerima = 0;
    
    $.each(temp_penerima, function(i, item){
        jlh_penerima++;
    });
    if(judul == "" || pesan == "")
        jAlert("Isikan judul dan isi pesan", "PERHATIAN");
    else if(jlh_penerima == 0)
        jAlert("Tidak ada penerima yang ditentukan", "PERHATIAN");
    else
        $("#frm").submit();
}
</script>
<!-- END OF PAGE SCRIPT -->

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">PESAN AKAN DIKIRIM KE</h3>
    <div class="bodypanel">
        <form name="frm_temp_penerima" id="frm_temp_penerima" action="php/admin/pesan_skp_spesifik_adm_temp_penerima.php" method="post">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td>
                        <label>
                            NIP Penerima :
                            <a href="javascript:show_auto_search_pegawai('nip');" class="link_auto_panel input_widget">Search</a>
                        </label>
                        <input type="text" name="nip" id="nip" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-success" onclick="push_penerima();">Tambah</button>
                    </td>
                </tr>
            </table>
        </form>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
            <thead>
                <tr class="headertable">
                    <th width='40px'>No.</th>
                    <th width='200px'>NAMA PEGAWAI</th>
                    <th width='200px'>NIP</th>
                    <th>SKPD</th>
                    <th width='200px'>PANGKAT</th>
                    <th width='200px'>JABATAN</th>
                    <th width='20px'>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <script type="text/javascript">
            var listing_temp_penerima = "";
            var ctr_temp_penerima = 0;
            $.each(temp_penerima, function(i, item){
                ctr_temp_penerima++;
                listing_temp_penerima += "<tr>";
                    listing_temp_penerima += "<td align='center'>" + ctr_temp_penerima + "</td>";
                    listing_temp_penerima += "<td>" + item.nama_pegawai + "</td>";
                    listing_temp_penerima += "<td align='center'>" + item.nip + "</td>";
                    listing_temp_penerima += "<td>" + item.skpd + "</td>";
                    listing_temp_penerima += "<td align='center'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
                    listing_temp_penerima += "<td>" + item.jabatan + "</td>";
                    listing_temp_penerima += "<td><button type='button' class='btn btn-sm btn-info' onclick='pop_penerima(" + item.id_pegawai + ");'>Hapus</button></td>";
                listing_temp_penerima += "</tr>";
            });
            document.write(listing_temp_penerima);
            </script>
            </tbody>
        </table>
    </div>
</div>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">BUAT PESAN BARU</h3>
    <div class="bodypanel">
        <form name="frm" id="frm" action="php/admin/pesan_skp_spesifik_adm.php" method="post">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td>
                        <input type="text" name="judul" id="judul" placeholder=":::: JUDUL PESAN ::::" /><br />
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea name="pesan" id="pesan" placeholder=":::: ISI PESAN ::::"></textarea>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td>
                    <button type="button" class="btn btn-lg btn-success" onclick="proses();">Kirim Pesan</button>
                </td>
            </tr>
        </table>
    </div>
</div>