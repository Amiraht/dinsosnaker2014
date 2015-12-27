<!-- CONTROLLER SCRIPT -->
<script type="text/javascript">
<?php
    /* 1. DAFTAR PESAN-PESAN YANG PERNAH DIKIRIM*/
    $pesan = array();
    $sql_pesan = "SELECT
                    	*, COUNT(tujuan) AS jlh_penerima
                    FROM
                    	tbl_pesan_skp_spesifik
                    GROUP BY
                    	judul
                    ORDER BY
                    	tgl_pesan DESC";
    $res_pesan = mysql_query($sql_pesan);
    while($ds_pesan = mysql_fetch_array($res_pesan)){
        $row_pesan["id_pesan"] = $ds_pesan["id_pesan"];
        $row_pesan["judul"] = $ds_pesan["judul"];
        $row_pesan["pesan"] = $ds_pesan["pesan"];
        $row_pesan["tgl_pesan"] = $ds_pesan["tgl_pesan"];
        $row_pesan["jlh_penerima"] = $ds_pesan["jlh_penerima"];
        array_push($pesan, $row_pesan);
    }
    echo("var json_pesan = " . json_encode($pesan) . ";");
    /* END OF 1. ********************************/
?>
</script>
<!-- END OF CONTROLLER SCRIPT -->

<!-- PAGE SCRIPT -->
<script type="text/javascript">
function pesan_baru(){
    document.location.href="?mod=pesan_skp_spesifik_adm_tambah";
}
function hapus_pesan(isi_pesan){
    jConfirm("Anda yakin akan menghapus pesan ini?", "PERHATIAN", function(r){
       if(r){
            document.location.href="php/admin/pesan_skp_spesifik_adm_hapus.php?isi_pesan=" + isi_pesan;
       } 
    });
}
</script>
<!-- END OF PAGE SCRIPT -->

<button class="btn btn-success" onclick="pesan_baru();">Buat Pesan Baru</button>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR PESAN YANG PERNAH DIKIRIM</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
            <thead>
                <tr class="headertable">
                    <th width='40px'>No.</th>
                    <th width='300px'>JUDUL</th>
                    <th>ISI</th>
                    <th width='150px'>TGL. POSTING</th>
                    <th width='150px'>DIKIRIM KE</th>
                    <th width='20px'>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <script type="text/javascript">
            var ctr_listing_pesan = 0;
            var listing_pesan = "";
            $.each(json_pesan, function(i, item){
                ctr_listing_pesan++;
                listing_pesan += "<tr>";
                    listing_pesan += "<td align='center'>" + ctr_listing_pesan + "</td>";
                    listing_pesan += "<td>" + item.judul + "</td>";
                    listing_pesan += "<td>" + item.pesan + "</td>";
                    listing_pesan += "<td align='center'>" + item.tgl_pesan + "</td>";
                    listing_pesan += "<td align='center'>" + item.jlh_penerima + " Pegawai</td>";
                    listing_pesan += "<td><button type='button' class='btn btn-sm btn-info' onclick='hapus_pesan(\"" + item.pesan + "\");'>Hapus</button></td>";
                listing_pesan += "</tr>";
            });
            document.write(listing_pesan);
            </script>
            </tbody>
        </table>
    </div>
</div>