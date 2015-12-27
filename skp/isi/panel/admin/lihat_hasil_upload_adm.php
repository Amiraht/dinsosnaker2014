<script type="text/javascript">
function proses(){
    var tahun = $("#tahun").val();
    
    if(tahun == "")
        jAlert("Maaf, tahun SKP harus ditentukan", "PERHATIAN");
    else
        $("#frm").submit();
}
function lihat_upload(id_skp, jenis){
    window.open("isi/panel/skp/lihat_upload_dp3.php?id_skp=" + id_skp + "&jenis=" + jenis);
    //alert(id_skp + "\n" + jenis);
}
function diklik(id_skp){
    jConfirm("Anda yakin telah memverifikasi data upload ini?", "PERHATIAN", function(r){
        if(r){
            $("#td_" + id_skp).html("<i>Loading...</i>");
            $.ajax({
                type    : "post",
                url     : "ajax/verifikasi_upload.php",
                data    : "id_skp=" + id_skp,
                success : function(r){
                    $("#td_" + id_skp).html("<b>OK</b>");
                }
            });
        }
    });
}
</script>
<form name="frm" id="frm" action="?mod=<?php echo($_GET["mod"]); ?>" method="post">
<div class="panelcontainer" style="width: 100%;">
    <h3>FILTER DATA REKAP UNTUK MELIHAT HASIL UPLOAD</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>Nama Pegawai :</label>
                    <input type="text" name="nama" id="nama" placeholder=":::: NAMA PEGAWAI ::::" />
                </td>
                <td width='50%'>
                    <label>NIP :</label>
                    <input type="text" name="nip" id="nip" placeholder=":::: NIP PEGAWAI ::::" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='70%'>
                    <label>Pilih SKPD :</label>
                    <select name="kode_skpd" id="kode_skpd">
                        <option value="all">:::: SEMUA SKPD ::::</option>
                    <?php
                        $res_skpd = mysql_query("SELECT * FROM ref_skpd ORDER BY skpd ASC");
                        while($ds_skpd = mysql_fetch_array($res_skpd)){
                            echo("<option value='" . $ds_skpd["kode_skpd"] . "'>" . $ds_skpd["skpd"] . "</option>");
                        }
                    ?>
                    </select>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="40%">
                    <label>Tahun SKP Dan Penilaian Prestasi Kerja Yang Diupload :</label>
                    <input type="text" name="tahun" id="tahun" placeholder=":: Tahun SKP Dan Penilaian Prestasi Kerja ::" value="<?=isset($_POST["tahun"]) ? $_POST["tahun"] : ""; ?>" />
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <input type="checkbox" class="pilih" name="skp" checked="checked" /> SKP<br />
                    <input type="checkbox" class="pilih" name="penilaian" checked="checked" /> Penilaian SKP Bulanan<br />
                    <input type="checkbox" class="pilih" name="dp3" checked="checked" /> Penilaian Prestasi Kerja
                </td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td>
                    <button type="button" class="btn btn-lg btn-success" onclick="proses();">Proses</button>
                    <button type="reset" class="btn btn-lg btn-default">Reset</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR PEGAWAI YANG TELAH MENGUPLOAD</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
            <thead>
                <tr class="headertable">
                    <th width='40px'>No.</th>
                    <th width='200px'>NAMA PEGAWAI</th>
                    <th width='200px'>NIP</th>
                    <th width='150px'>JENIS KELAMIN</th>
                    <th>SKPD / Unit Kerja</th>
                    <th width='200px'>JABATAN</th>
                    <th width='150px'>PANGKAT</th>
                    <th width='20px'>&nbsp;</th>
                    <th width='20px'>&nbsp;</th>
                    <th width='20px'>&nbsp;</th>
                    <th width='70px'>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(isset($_POST["tahun"]) && $_POST["tahun"] != ""){
                    $pilih = "";
                    if(isset($_POST["skp"]))
                        $pilih .= " AND j.skp = 1 ";
                    if(isset($_POST["penilaian"]))
                        $pilih .= " AND j.penilaian = 1 ";
                    if(isset($_POST["dp3"]))
                        $pilih .= " AND j.dp3 = 1 ";
                    $whr = "";
                     if($_POST["kode_skpd"] != "all")
                        $whr .= " AND f.kode_skpd LIKE '" . $_POST["kode_skpd"] . "%' ";
                     $sql = "SELECT
                                	j.id_skp, a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
                                	b.status_kepegawaian,
                                	e.jenis_kelamin, a.alamat, a.tanggal_lahir, f.skpd, g.pangkat, g.gol_ruang, h.jabatan,
                                    CASE
                                		WHEN k.id_skp IS NULL THEN 0
                                		ELSE 1
                                	END AS udah
                                FROM
                                	tbl_pegawai a
                                	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                                	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                                	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
                                	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
                                    LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                                    LEFT JOIN tbl_skp i ON (a.id_pegawai = i.id_pegawai AND YEAR(i.dari) = " . $_POST["tahun"] . ")
                                    LEFT JOIN tbl_skp_dp3_upload_arange j ON (i.id_skp = j.id_skp " . $pilih . " )
                                    LEFT JOIN tbl_skp_dp3_upload_pemeriksaan k ON j.id_skp = k.id_skp
                                WHERE
                                	(a.id_status_kepegawaian = 1 OR a.id_status_kepegawaian = 4 OR a.id_status_kepegawaian = 3)
                                    AND j.id_skp IS NOT NULL AND a.nama_pegawai LIKE '%" . $_POST["nama"] . "%' AND a.nip LIKE '%" . $_POST["nip"] . "%'
                                    " . $whr . "
                                GROUP BY
                	                a.id_pegawai
                                ORDER BY
                                	a.id_satuan_organisasi, a.nama_pegawai";
                     $res = mysql_query($sql) or die(mysql_error());
                     $no = 0;
                        while($ds = mysql_fetch_array($res)){
                            $no++;
                            $html = "";
                            $html .= "<tr>";
                                $html .= "<td align='center'>" . $no . "</td>";
                                $html .= "<td align='center'>" . strtoupper($ds["nama_pegawai"]) . "</td>";
                                $html .= "<td align='center'>" . $ds["nip"] . "</td>";
                                $html .= "<td align='center'>" . $ds["jenis_kelamin"] . "</td>";
                                $html .= "<td align='center'>" . $ds["skpd"] . "</td>";
                                $html .= "<td align='center'>" . $ds["jabatan"] . "</td>";
                                $html .= "<td align='center'>" . $ds["pangkat"] . " (" . $ds["gol_ruang"] . ")</td>";
                                $html .= "<td><img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Lihat SKP yang diupload' onclick='lihat_upload(" . $ds["id_skp"] . ", \"skp\");' /></td>";
                                $html .= "<td><img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Lihat penilaian SKP bulanan yang diupload' onclick='lihat_upload(" . $ds["id_skp"] . ", \"penilaian\");' /></td>";
                                $html .= "<td><img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Lihat penilaian prestasi kerja yang diupload' onclick='lihat_upload(" . $ds["id_skp"] . ", \"dp3\");' /></td>";
                                $html .= "<td align='center' style='padding: 5px;' id='td_" . $ds["id_skp"] . "'>";
                                if($ds["udah"] == 0){
                                    $html .= "<button class='btn btn-success' style='width: 100%;' onclick=diklik(" . $ds["id_skp"] . ");>CEK</button>";
                                }else{
                                    $html .= "<b>OK</b>";
                                }
                                $html .= "</td>";
                            $html .= "</tr>";
                            echo($html);
                        }
                }
            ?>
            </tbody>
        </table>
    </div>
</div>