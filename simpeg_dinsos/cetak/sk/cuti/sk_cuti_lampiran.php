<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../../php/dompdf_config.inc.php"); ?>
<?php require_once("../../../php/koneksi.php"); ?>
<?php require_once("../../../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
    /* CONTROLLER */
    
    // data surat
    $ds_surat = mysql_fetch_array(mysql_query("SELECT a.*, b.pangkat FROM tbl_sk_cuti a LEFT JOIN ref_pangkat b ON a.pangkat_surat = b.id_pangkat WHERE id_surat='" . $_GET["id_surat"] . "'"));
    $no_surat = ($ds_surat["no_surat"] == "") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : $ds_surat["no_surat"];
    $tgl_surat = ($ds_surat["tgl_surat"] == "0000-00-00") ? "&nbsp;&nbsp;&nbsp;&nbsp;" : tglpjgindonesia($ds_surat["tgl_surat"]);
    $pecah_tgl_surat = explode("-", $ds_surat["tgl_surat"]);
    $tahun_surat = ($ds_surat["tgl_surat"] == "0000-00-00") ? "&nbsp;&nbsp;&nbsp;&nbsp;" : $pecah_tgl_surat[0];
    $jabatan_peneken = $ds_surat["pejabat_surat"];
    $nama_peneken = $ds_surat["nama_surat"];
    $pangkat_peneken = $ds_surat["pangkat"];
    $nip_peneken = $ds_surat["nip_surat"];
    
    // data pegawai yang diusulkan
    $list_pegawai = array();
    $sql_list_pegawai = "SELECT
                            	e.id_riwayat_cuti, f.jenis_cuti, e.lama, e.dari, e.sampai, a.id_pegawai, a.nama_pegawai, a.nip,
                            	b.pangkat, b.gol_ruang,
                            	c.jabatan, d.skpd, e.keterangan
                            FROM
                            	tbl_pegawai a
                            	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                            	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                            	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                            	INNER JOIN tbl_riwayat_cuti e ON (a.id_pegawai = e.id_pegawai AND e.id_surat = '" . $_GET["id_surat"] . "')
                            	LEFT JOIN ref_jenis_cuti f ON e.id_jenis_cuti = f.id_jenis_cuti
                            ORDER BY
                            		a.nama_pegawai ASC";
    $res_list_pegawai = mysql_query($sql_list_pegawai);
    $norut_list_pegawai = 0;
    while($ds_list_pegawai = mysql_fetch_array($res_list_pegawai)){
        $norut_list_pegawai++;
        $row_list_pegawai["no"] = $norut_list_pegawai;
        $row_list_pegawai["id_riwayat_cuti"] = $ds_list_pegawai["id_riwayat_cuti"];
        $row_list_pegawai["jenis_cuti"] = $ds_list_pegawai["jenis_cuti"];
        $row_list_pegawai["lama"] = $ds_list_pegawai["lama"];
        $row_list_pegawai["dari"] = tglpjgindonesia($ds_list_pegawai["dari"]);
        $row_list_pegawai["sampai"] = tglpjgindonesia($ds_list_pegawai["sampai"]);
        $row_list_pegawai["id_pegawai"] = $ds_list_pegawai["id_pegawai"];
        $row_list_pegawai["nama_pegawai"] = $ds_list_pegawai["nama_pegawai"];
        $row_list_pegawai["nip"] = $ds_list_pegawai["nip"];
        $row_list_pegawai["pangkat"] = $ds_list_pegawai["pangkat"];
        $row_list_pegawai["gol_ruang"] = $ds_list_pegawai["gol_ruang"];
        $row_list_pegawai["jabatan"] = $ds_list_pegawai["jabatan"];
        $row_list_pegawai["skpd"] = $ds_list_pegawai["skpd"];
        $row_list_pegawai["keterangan"] = "";
        if($ds_list_pegawai["keterangan"] != "")
            $row_list_pegawai["keterangan"] = "(" . $ds_list_pegawai["keterangan"] . ")";
        array_push($list_pegawai, $row_list_pegawai);
    }
?>
<?php
    $html = "";
    
    $html .= "<div style='text-align: left; font-family: serif; font-size: 11pt; margin-left: 700px;'>";
        $html .= "<b>DAFTAR LAMPIRAN : SURAT WALIKOTA MEDAN TENTANG</b><br />";
        $html .= "<b>CUTI PEGAWAI NEGERI SIPIL</b><br />";
        $html .= "<b>NOMOR : " . $no_surat . "</b><br />";
        $html .= "<b>TANGGAL : " . $tgl_surat . "</b><br />";
    $html .= "</div>";
    
    $html .= "<div style='height: 20px;'>&nbsp;</div>";
    
    $html .= "<table width='100%' border='0' style='font-family: serif; border-collapse: collapse;' cellspacing='0' cellpadding='0'>";
        $html .= "<thead style='font-weight: bold; background-color: #CCC; font-size: 11pt;'>";
            $html .= "<tr>";
                $html .= "<td width='3%' style='text-align: center; border: solid 1px black; padding: 3px;'>NO.</td>";
                $html .= "<td width='15%' style='text-align: center; border: solid 1px black; padding: 3px;'>NAMA / NIP</td>";
                $html .= "<td width='15%' style='text-align: center; border: solid 1px black; padding: 3px;'>PANGKAT<br />GOL. RUANG</td>";
                $html .= "<td width='15%' style='text-align: center; border: solid 1px black; padding: 3px;'>JABATAN</td>";
                $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>UNIT KERJA</td>";
                $html .= "<td width='15%' style='text-align: center; border: solid 1px black; padding: 3px;'>JENIS CUTI</td>";
                $html .= "<td width='20%' style='text-align: center; border: solid 1px black; padding: 3px;'>TMT</td>";
            $html .= "</tr>";
            $html .= "<tr>";
                $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>1</td>";
                $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>2</td>";
                $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>3</td>";
                $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>4</td>";
                $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>5</td>";
                $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>6</td>";
                $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>7</td>";
            $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody style='font-size: 10pt;'>";
            foreach($list_pegawai as $list){
                $html .= "<tr>";
                    $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>" . $list["no"] . "</td>";
                    $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>" . $list["nama_pegawai"] . "<br />" . $list["nip"] . "</td>";
                    $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>" . $list["pangkat"] . "<br />" . $list["gol_ruang"] . "</td>";
                    $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>" . $list["jabatan"] . "</td>";
                    $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>" . $list["skpd"] . "</td>";
                    $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>" . $list["jenis_cuti"] . "</td>";
                    $selama = "";
                    if(strtolower($list["jenis_cuti"]) == "cuti tahunan")
                        $selama = "<br />Selama " . $list["lama"] . " hari kerja";
                    $html .= "<td style='text-align: center; border: solid 1px black; padding: 3px;'>" . $list["dari"] . " S/D " . $list["sampai"] . $selama . "<br />" . $list["keterangan"] . "</td>";
                $html .= "</tr>";
            }
        $html .= "</tbody>";
    $html .= "</table>";
    
    $html .= "<div style='height: 30px;'>&nbsp;</div>";
    
    $html .= "<div style='font-family: serif; font-size: 11pt; text-transform: uppercase;'>";
        $html .= "<table width='100%' border='0'>";
            // ROW 1
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='13%' align='left'>";
                    $html .= "Dikeluarkan Di :";
                $html .= "</td>";
                $html .= "<td width='15%' align='left'>";
                    $html .= "Medan";
                $html .= "</td>";
            $html .= "</tr>";
            
            // ROW 2
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='13%' align='left'>";
                    $html .= "Pada Tanggal :";
                $html .= "</td>";
                $html .= "<td width='15%' align='left'>";
                    $html .= $tgl_surat;
                $html .= "</td>";
            $html .= "</tr>";
        $html .= "</table>";
        
        $html .= "<div style='height: 10px;'>&nbsp;</div>";
        
        $html .= "<table width='100%' border='0' style='font-weight: bold;'>";
            // ROW 3
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='30%' align='center' colspan='2'>";
                    $html .= "an. WALIKOTA MEDAN";
                $html .= "</td>";
            $html .= "</tr>";
            
            // ROW 4
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='30%' align='center' colspan='2'>";
                    $html .= $jabatan_peneken;
                $html .= "</td>";
            $html .= "</tr>";
        $html .= "</table>";
        
        $html .= "<div style='height: 70px;'>&nbsp;</div>";
        
        $html .= "<table width='100%' border='0' style='font-weight: bold;'>";
            // ROW 5
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='20%' align='left' colspan='2'>";
                    $html .= $nama_peneken;
                $html .= "</td>";
            $html .= "</tr>";
            
            // ROW 6
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='20%' align='left' colspan='2'>";
                    $html .= $pangkat_peneken;
                $html .= "</td>";
            $html .= "</tr>";
            
            // ROW 7
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='20%' align='left' colspan='2'>";
                    $html .= "NIP. " . $nip_peneken;
                $html .= "</td>";
            $html .= "</tr>";
        $html .= "</table>";
    $html .= "</div>";
?>
<?php
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("folio", "landscape");
    $dompdf->render();

    $dompdf->stream("target_skp.pdf", array("Attachment" => false));
    //echo($html);

  exit(0);
?>