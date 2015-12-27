
 <!-- DIALOG -->
<div id="dialog_form_disp" title="Kirim Surat">
<form name="frm" id="frm_kirim_surat" action="php/finalisasi_surat_keluar.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <div class="bodypanel">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_keluar" value="" id="id_surat_keluar" />
                <input type="hidden" name="id_disposisi" value="" id="id_disposisi" />
                <tr style="display: none;">
                    <td width='20%'>Nomor Nota Dinas</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_nodin" id="no_nodin" /></td>
                </tr>
                <tr style="display: none;">
                    <td width='20%'>Tanggal Nota Dinas</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_nodin" id="tgl_nodin" /></td>
                </tr>
                <tr>
                    <td colspan="3">
                        Anda yakin bahwa surat keluar ini telah selesai diupload file finalnya?
                    </td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'>
                        <input type="button" name="terima" value='Ya' id="cmdKirim" style="width: 100%;" />
                    </td>
                    <td width='50%'>
                        <input type="button" name="ya" value='Tidak' id="cmdJangan" style="width: 100%;" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
</div>

<div id="dialog_nosur" title="Penomoran Surat Keluar">
    <form name="frm" action="php/penomoran_surat_keluar.php" method="post">
        <div class="panelcontainer" style="width: 100%;">
            <div class="bodypanel">
                <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_keluar" value="" id="id_surat_keluar_nosur" />
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td width='50px' align='right'><span id="kode_surat">989.00</span>/</td>
                    <input type="hidden" name="kode_surat" id="kodsur" />
                    <td><input type="text" name="no_surat" id="no_surat" /></td>
                </tr>
                <tr>
                    <td colspan="4"><b>Nomor surat harus sesuai dengan nomor fisik pada keadaan surat keluar yang sebenarnya</b></td>
                </tr>  
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td>
                        <input type="submit" value='Simpan Nomor Surat' style="width: 100%;" />
                    </td>
                </tr>
            </table>
            </div>
        </div>
    </form>
</div>

<div id="dialog_parkor" title="Paraf Koordinasi">
</div>
<!-- END OF DIALOG -->


<fieldset>
    <legend><h3>REKAPITULASI SURAT MASUK</h3></legend>
    
    <table border="1" width="1000" align="left" cellpadding="5" cellspacing="1" class='tblisi'>
    
        <tr>
            <th width='40px' rowspan="2">No.</th>
            <th width='250px' rowspan="2">No. Surat</th>
            <th width='150px' rowspan="2">Tgl. Surat</th>
            <th width='150px' rowspan="2">Tgl. Terima</th>
            <th width='250px' rowspan="2">Unit Pengirim</th>
            <th rowspan="2">Perihal</th>
            <th colspan="2">Surat Turun</th>
            <th colspan="2">Surat Naik</th>
            <th rowspan="2">Status Surat</th>
            <th rowspan="2">&nbsp;</th>
            <th rowspan="2">&nbsp;</th>
            <th rowspan="2">&nbsp;</th>
            <!--<td width='20px'>&nbsp;</th>-->
        </tr>
        <tr>
            <th>Posisi</th>
            <th>Tanggal</th>
            <th>Posisi</th>
            <th>Tanggal</th>
        </tr>
      
    <?php
        $whr = "";
        $sql = "";
        
            if($_POST["no_surat"] <> "")
                $whr .= " AND a.no_surat LIKE '%" . $_POST["no_surat"] . "%'";
            if($_POST["tgl_surat_dari"] <> "" && $_POST["tgl_surat_sampai"] <> "")
                $whr .= " AND a.tgl_surat BETWEEN '" . $_POST["tgl_surat_dari"] . "' AND '" . $_POST["tgl_surat_sampai"] . "'";
            if($_POST["tgl_terima_dari"] <> "" && $_POST["tgl_terima_sampai"] <> "")
                $whr .= " AND a.tgl_terima BETWEEN '" . $_POST["tgl_terima_dari"] . "' AND '" . $_POST["tgl_terima_sampai"] . "'";
            if($_POST["perihal_surat"] <> "")
                $whr .= " AND a.perihal_surat LIKE '%" . $_POST["perihal_surat"] . "%'";
            if($_POST["deskripsi_surat"] <> "")
                $whr .= " AND a.deskripsi_surat LIKE '%" . $_POST["deskripsi_surat"] . "%'";
            if($_POST["id_skpd_pengirim"] <> 0)
                $whr .= " AND a.id_skpd_pengirim = '" . $_POST["id_skpd_pengirim"] . "'";
            
            
            $sql = "SELECT
                    	a.id, a.no_surat AS no_surat_masuk, a.tgl_surat AS tgl_surat_masuk, a.tgl_terima, a.perihal_surat, h.unit_kerja,
                    	f.level AS disposisi_surat_masuk, b.tgl_disposisi AS tgl_disposisi_surat_masuk, b.status AS status_disposisi_surat_masuk,
                    	d.no_surat AS no_surat_keluar, d.tgl_surat AS tgl_surat_keluar,
                    	g.level AS disposisi_surat_keluar, e.tgl_disposisi AS tgl_disposisi_surat_keluar, e.status AS status_disposisi_surat_keluar,
                    	d.status AS status_surat_keluar
                    FROM
                    	myapp_maintable_suratmasuk a
                    	LEFT JOIN(
                    		SELECT a.* FROM myapp_disptable_suratmasuk a
                    		WHERE a.id = (SELECT MAX(id) FROM myapp_disptable_suratmasuk WHERE id_surat_masuk = a.id_surat_masuk)
                    		ORDER BY a.id_surat_masuk
                    	) b ON a.id = b.id_surat_masuk
                    	LEFT JOIN myapp_maintable_balasan c ON a.id = c.id_surat_masuk
                    	LEFT JOIN myapp_maintable_suratkeluar d ON c.id_surat_keluar = d.id
                    	LEFT JOIN (
                    		SELECT a.* FROM myapp_disptable_suratkeluar a
                    		WHERE a.id = (SELECT MAX(id) FROM myapp_disptable_suratkeluar WHERE id_surat_keluar = a.id_surat_keluar)
                    		ORDER BY a.id_surat_keluar
                    	) e ON d.id = e.id_surat_keluar
                    	LEFT JOIN myapp_reftable_levelpengguna f ON b.id_level_tujuan = f.id
                    	LEFT JOIN myapp_reftable_levelpengguna g ON e.id_level_tujuan = g.id
                    	LEFT JOIN myapp_reftable_unitkerja h ON a.id_skpd_pengirim = h.id_unit_kerja
                    WHERE
                    	1 " . $whr . "
                    ORDER BY
                    	a.id
                    ";
        
        //echo($sql);
        $res = mysql_query($sql);
        $ctr = 0;
        $rec = mysql_num_rows($res);
        if($rec < 5000){
            while($ds = mysql_fetch_array($res)){
                $ctr++;
                $status_surat = "";
                echo("<tr>");
                    echo("<td align='center'>" . $ctr . "</td>");
                    echo("<td>" . $ds["no_surat_masuk"] . "</td>");
                    echo("<td>" . tglindonesia($ds["tgl_surat_masuk"]) . "</td>");
                    echo("<td>" . tglindonesia($ds["tgl_terima"]) . "</td>");
                    echo("<td>" . $ds["unit_kerja"] . "</td>");
                    echo("<td>" . $ds["perihal_surat"] . "</td>");
                    if($ds["disposisi_surat_keluar"] == ""){
                        echo("<td>" . $ds["disposisi_surat_masuk"] . "</td>");
                        echo("<td>" . $ds["tgl_disposisi_surat_masuk"] . "</td>");
                        echo("<td align='center'>---</td>");
                        echo("<td align='center'>---</td>");
                        echo("<td align='center'>Proses Turun</td>");
                    }else{
                        echo("<td align='center'>---</td>");
                        echo("<td align='center'>---</td>");
                        echo("<td>" . $ds["disposisi_surat_keluar"] . "</td>");
                        echo("<td>" . $ds["tgl_disposisi_surat_keluar"] . "</td>");
                        //echo("<td>Proses Naik</th>");
                        if($ds["status_surat_keluar"] == 3)
                            echo("<td align='center'>Selesai</td>");
                        else if($ds["status_surat_keluar"] == 2)
                            echo("<td align='center'>Menunggu Pengiriman</td>");
                        else if($ds["status_surat_keluar"] == 1)
                            echo("<td align='center'>Proses Naik</td>");
                    }
                    
                    echo("<td align='center'>");
                        echo("<img src='image/Info-32.png' width='18px' class='linkimage' title='Detail Surat Masuk' onclick='lihat_detail_sm(" . $ds["id"] . ", 0);'>");
                    echo("</td>");
                    echo("<td align='center'>");
                        echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sm(" . $ds["id"] . ", 0);'>");
                    echo("</td>");
                    echo("<td align='center'>");
                        echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sm(" . $ds["id"] . ", 0);'>");
                    echo("</td>");
                  
                echo("</tr>");
				echo "
					<tr id='div_if'>
						<span style='display:none;' id='load_text'></span>
						<td colspan='14'> <div id='div_cek_".$ds["id"]."'></div></td>
					</tr>
					";
            }
        }else{
            echo("<h3>Data yang di load lebih dari 5000 record. Harap lakukan filter</h3>");
        }
        
    ?>
    
    </table>
 </fieldset> 