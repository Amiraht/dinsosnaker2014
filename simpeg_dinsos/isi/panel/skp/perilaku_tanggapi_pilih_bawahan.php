<script type="text/javascript">
    $(document).ready(function(){
        $("#expand").click(function(){
            $("#bodyfilter").slideToggle(800);
        });
    });
    function lanjut(id){
        document.location.href="?mod=perilaku_tanggapi_pilih_periode&id_pegawai=" + id;
    }
</script>
<form name="frm" action="?mod=<?php echo($_GET["mod"]); ?>" method="post">
<div class="panelcontainer" style="width: 100%;">
    <h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA PENCARIAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <input type="text" name="nama_pegawai" placeholder="Cari Nama Pegawai" title="Nama Pegawai" value="<?php echo($_POST["nama_pegawai"]); ?>" />
                </td>
                <td>
                    <input type="text" name="nip" placeholder="Cari NIP Pegawai" title="NIP Pegawai" value="<?php echo($_POST["nip"]); ?>" />
                </td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='Filter' style="width: 100%;" /></td>
                <td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR PEGAWAI BAWAHAN</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='4px'>&nbsp;</th>
                <th width='40px'>No.</th>
                <th width='150px'>Nama Pegawai</th>
                <th width='150px'>NIP</th>
                <th width='100px'>Status Kepegawaian</th>
                <th width='170px'>Jenis Kepegawaian</th>
                <th width='120px'>Kedudukan Pegawai</th>
                <th width='100px'>Jenis Kelamin</th>
                <th width='70px'>Tgl. Lahir</th>
                <th>Alamat</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $whr = " AND a.nama_pegawai LIKE '%" . $_POST["nama_pegawai"] . "%' AND a.nip LIKE '%" . $_POST["nip"] . "%' ";
            $res = mysql_query("SELECT
                                	a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
                                	b.status_kepegawaian, c.jenis_kepegawaian, d.kedudukan_kepegawaian,
                                	e.jenis_kelamin, a.alamat, a.tanggal_lahir
                                FROM
                                	tbl_pegawai a
                                	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                                	LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian
                                	LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian
                                	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                                    LEFT JOIN tbl_skp f ON a.id_pegawai = f.id_pegawai
                                WHERE
                                	f.id_pegawai_penilai = '" . $_SESSION["simpeg_id_pegawai"] . "'
                                GROUP BY
	                                a.id_pegawai
                                ORDER BY
                                	a.nama_pegawai");
            $no = 0;
            while($ds = mysql_fetch_array($res)){
                $no++;
                $status_supervisi = 0;
                if($ds["spv_kreat"] == 1 || $ds["tugtam_kreat"] == 1)
                    $status_supervisi = 1;
                else if($ds["spv_kreat"] == 2 || $ds["tugtam_kreat"] == 2)
                    $status_supervisi = 2;
                else if($ds["spv_kreat"] == 3 || $ds["tugtam_kreat"] == 3)
                    $status_supervisi = 3;
        ?>
            <tr>
                <td align='center'><?php echo(status_supervisi($status_supervisi)); ?></td>
                <td align='center'><?php echo($no); ?></td>
                <td><?php echo($ds["nama_pegawai"]); ?></td>
                <td align='center'><?php echo($ds["nip"]); ?></td>
                <td align='center'><?php echo($ds["status_kepegawaian"]); ?></td>
                <td><?php echo($ds["jenis_kepegawaian"]); ?></td>
                <td align='center'><?php echo($ds["kedudukan_kepegawaian"]); ?></td>
                <td align='center'><?php echo($ds["jenis_kelamin"]); ?></td>
                <td align='center'><?php echo($ds["tanggal_lahir"]); ?></td>
                <td><?php echo($ds["alamat"]); ?></td>
                <td>
                    <img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Lanjut Untuk Memanajemen Data Penilaian Perilaku Pegawai' onclick='lanjut(<?php echo($ds["id_pegawai"]); ?>);' />
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    </div>
</div>