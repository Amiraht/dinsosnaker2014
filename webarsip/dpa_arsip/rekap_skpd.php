<script type="text/javascript">
    $(document).ready(function(){
        $("#dari").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
        $("#sampai").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
        $("#tgl_laporan").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    });
    function validasi_submit(){
        var dari = $("#dari").val();
        var sampai = $("#sampai").val();
        var skpd = $("#skpd").val();
        if(dari == "" || sampai == ""){
            alert("Pilih tanggal penginputan");
            return false;
        }
        if(skpd == ""){
            alert("Pilih SKPD penginput");
            return false;
        }
        return true;
    }
</script>
<div class="panel">
    <div class="panel_title">Input Dari SKPD</div>
    <div class="panel_body">
        <form name="frm_skpd" method="get" target="_blank" action="kegiatan_skpd.php">
            <table width="40%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                <tr>
                    <td width="50%">
                        <input type="text" name="dari" id="dari" placeholder="Dari" />
                    </td>
                    <td>
                        <input type="text" name="sampai" id="sampai" placeholder="Sampai" />
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                <tr>
                    <td>
                        <select name="skpd" id="skpd">
                            <option value="">----- Semua SKPD -----</option>
                            <?php
                                $sql_unit_kerja = "SELECT * FROM ref_unit_kerja ORDER BY unit_kerja";
                                $res_unit_kerja = mysql_query($sql_unit_kerja, $link_identifier);
                                while($ds_unit_kerja = mysql_fetch_array($res_unit_kerja)){
                                    echo "<option value='" . $ds_unit_kerja["id_unit_kerja"] . "'>" . $ds_unit_kerja["unit_kerja"] . "</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                <tr>
                    <td>
                        <input type="text" name="judul" placeholder="Judul Laporan" />
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="tgl_laporan" id="tgl_laporan" placeholder="Tanggal Laporan" style="width: 100px;" />
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Penginput Arsip</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="nama_penginput" placeholder="Nama" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="nip_penginput" placeholder="NIP" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="pangkat_penginput" placeholder="Pangkat" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="jabatan_penginput" placeholder="Jabatan" />
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Disetujui Oleh</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="nama_setuju" placeholder="Nama" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="nip_setuju" placeholder="NIP" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="pangkat_setuju" placeholder="Pangkat" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="jabatan_setuju" placeholder="Jabatan" />
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                <tr>
                    <td>
                        <input type="submit" name="proses_skpd" value="Proses Laporan" onclick="return validasi_submit();" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>