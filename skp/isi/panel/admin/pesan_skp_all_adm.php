<script type="text/javascript">
<?php
    /**
     * PADA BAGIAN INI AKAN DILOAD SEMUA YANG BERHUBUNGAN DENGAN DATA
     */
     /* 1. Load data semua pesan */
     $pesan = array();
     $sql_1 = "SELECT * FROM tbl_pesan_skp_all ORDER BY tgl_pesan DESC";
     $res_1 = mysql_query($sql_1);
     while($ds_1 = mysql_fetch_array($res_1)){
        $isi_pesan["id_pesan"] = $ds_1["id_pesan"];
        $isi_pesan["judul"] = $ds_1["judul"];
        $isi_pesan["pesan"] = $ds_1["pesan"];
        $isi_pesan["tgl_pesan"] = $ds_1["tgl_pesan"];
        array_push($pesan, $isi_pesan);
     }
     echo("var json_pesan = " . json_encode($pesan) . ";");
     /* *********************************************************** */
?>
</script>
<script type="text/javascript">
function proses(){
    var judul = $("#judul").val();
    var pesan = $("#pesan").val();
    if(judul == "" || pesan == "")
        jAlert("Harap isi judul dan isi pesan", "PERHATIAN");
    else
        $("#frm").submit(); 
}
function hapus_pesan(id_pesan){
    jConfirm("Anda yakin akan menghapus pesan ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href = "php/admin/pesan_skp_all_adm_hapus.php?id_pesan=" + id_pesan;
        }
    });
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">BUAT PESAN BARU</h3>
    <div class="bodypanel">
        <form name="frm" id="frm" action="php/admin/pesan_skp_all_adm.php" method="post">
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
            <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
                <tr>
                    <td>
                        <button type="button" class="btn btn-lg btn-success" onclick="proses();">Simpan</button>
                        <button type="reset" class="btn btn-lg btn-default">Reset</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
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
                    <th width='20px'>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <script type="text/javascript">
                var listing_pesan = "";
                var ctr_pesan = 0;
                $.each(json_pesan, function(i, item){
                    ctr_pesan++;
                    listing_pesan += "<tr>";
                        listing_pesan += "<td align='center'>" + ctr_pesan + "</td>";
                        listing_pesan += "<td>" + item.judul + "</td>";
                        listing_pesan += "<td>" + item.pesan + "</td>";
                        listing_pesan += "<td align='center'>" + item.tgl_pesan + "</td>";
                        listing_pesan += "<td><button class='btn btn-success btn-sm' onclick='hapus_pesan(" + item.id_pesan + ");'>Hapus</button></td>";
                    listing_pesan += "</tr>";
                });
                document.write(listing_pesan);
            </script>
            </tbody>
        </table>
    </div>
</div>