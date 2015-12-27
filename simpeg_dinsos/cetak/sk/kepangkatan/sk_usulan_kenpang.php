<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../../php/dompdf_config.inc.php"); ?>
<?php require_once("../../../php/koneksi.php"); ?>
<?php require_once("../../../php/fungsi.php"); ?>
<?php require_once("../../../php/model/sk_kenpang_model.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
    /* CONTROLLER */
	$id_sk = mysql_real_escape_string($_GET['id_sk']);
    $sk = new SKKenpang_Model();
    $sk->Record($id_sk);
    $no_sk = ($sk->no_sk == "") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : $sk->no_sk;
    $tgl_sk = ($sk->tgl_sk == "0000-00-00") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : tglpjgindonesia($sk->tgl_sk);
  
    $daftar = array();
    $sql_daftar = "SELECT
                    	b.id_pegawai, b.nama_pegawai, b.nip,
                    	CASE
                    		WHEN b.gelar_depan <> '' THEN CONCAT(b.gelar_depan, '. ')
                    		ELSE ''
                    	END AS gelar_depan,
                    	CASE
                    		WHEN b.gelar_belakang <> '' THEN CONCAT(', ', b.gelar_belakang)
                    		ELSE ''
                    	END AS gelar_belakang,
                    	c.skpd, d.pangkat, d.gol_ruang ,
						e.pangkat as 'PANGKAT_BARU', e.gol_ruang as 'GOLBAR'
                    FROM
                    	tbl_sk_kenpang_detail a
						LEFT JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai
						LEFT JOIN ref_skpd c ON b.id_satuan_organisasi = c.id_skpd
						LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
						LEFT JOIN ref_pangkat e ON a.id_pangkat_baru = e.id_pangkat
					WHERE
						a.id_sk = '". $id_sk ."' 
					ORDER BY
						b.nama_pegawai ASC";
						
    $res_daftar = mysql_query($sql_daftar) or die(mysql_error());
	
    while($ds_daftar = mysql_fetch_array($res_daftar)){
        $row_daftar["nama_pegawai"] = $ds_daftar["nama_pegawai"];
        $row_daftar["gelar_depan"] = $ds_daftar["gelar_depan"];
        $row_daftar["gelar_belakang"] = $ds_daftar["gelar_belakang"];
        $row_daftar["nip"] = $ds_daftar["nip"];
        $row_daftar["pangkat"] = $ds_daftar["pangkat"];
        $row_daftar["gol_ruang"] = $ds_daftar["gol_ruang"];
		$row_daftar["PANGBARU"] = $ds_daftar["PANGKAT_BARU"];
        $row_daftar["GOLBAR"] = $ds_daftar["GOLBAR"];
        //$row_daftar["jabatan"] = $ds_daftar["jabatan"];
        array_push($daftar, $row_daftar);
    }
    /* END OF CONTROLLER */
?>
<?php
	$html = '
			<table width="100%" style="border-bottom: 3px solid black; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
			<td><span style="float:left"><img src="../../../image/logo.png" width="85" height="95"/></span></td>
			<td style="font-family:verdana; color:black;">
				<span style="font-size:18px;"><center><b>PEMERINTAH KOTA MEDAN</b></center></span>
				<span style="font-size:19px;"><center><b>BADAN KEPEGAWAIAN DAERAH</b></center></span>
				<span style="font-size:14px;"><center>Jalan Kapten Maulana Lubis No. 2 Telepon : 061-4512412 - Faks. 061-4553780</center>
				<center>Website : bkd.pemkomedan.go.id</center>
				<center>Medan - 20112</center></span>
			</td>
			</tr></table>
		';

    $html .= "<div style='font-family: sans-serif; font-size: 9pt;'>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<div style='margin-left: 250px; line-height: 17px;'>";
        $html .= "<div style='text-align: left; text-transform: uppercase;'>DAFTAR LAMPIRAN : SURAT KEPALA BKD KOTA MEDAN TENTANG UNTUK</div>";
        $html .= "<div style='margin-left: 30px; text-align: left; text-transform: uppercase;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USULAN KENAIKAN PANGKAT PEGAWAI</div>";
        $html .= "<div style='margin-left: 25px; margin-top:10px; text-align: left; text-transform: uppercase;'>NOMOR : <b>" . $no_sk . "</b></div>";
        $html .= "<div style='margin-left: 25px; text-align: left; text-transform: uppercase;'>TANGGAL : " . $tgl_sk . "</div>";
    $html .= "</div>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<table style='width: 100%;' border='1px' cellspacing='0' cellpadding='5'>";
        $html .= "<thead>";
            $html .= "<tr>";
                $html .= "<th style='width: 3%; text-align: center;'>NO.</th>";
                $html .= "<th style='width: 25%; text-align: center;'>NAMA / NIP</th>";
                $html .= "<th style='text-align: center;'>DARI PANGKAT / JABATAN</th>";
				$html .= "<th text-align: center;'>NAIK KE PANGKAT / JABATAN </th>";
            $html .= "</tr>";
            $html .= "<tr>";
                $html .= "<th style='text-align: center;'>1</th>";
                $html .= "<th style='text-align: center;'>2</th>";
                $html .= "<th style='text-align: center;'>3</th>";
                $html .= "<th style='text-align: center;'>4</th>";
            $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
            $ctr = 0;
            foreach($daftar as $list){
                $ctr++;
                $html .= "<tr>";
                    $html .= "<td style='text-align: center; text-transform: capitalize;'>" . $ctr . "</td>";
                    $html .= "<td style='text-align: left; text-transform: capitalize;'>" . $list["gelar_depan"] . $list["nama_pegawai"] . $list["gelar_belakang"] . "<br />NIP. " . $list["nip"] . "</td>";
                    $html .= "<td style='text-align: center; text-transform: capitalize;'>" . $list["pangkat"] . " (" . $list["gol_ruang"] . ")" . "<br /></td>";
                   $html .= "<td style='text-align: center; text-transform: capitalize;'>" . $list['PANGBARU'] . " (" . $list["GOLBAR"] . ")" . "<br /></td>";
                $html .= "</tr>";
            }
        $html .= "</tbody>";
    $html .= "</table>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<div style='margin-left: 300px; line-height: 15px;'>";
        $html .= "<div style='text-align: center; text-transform: uppercase;'>" . $sk->jabatan_ttd_sk . "</div>";
        
        $html .= "<div style='height: 2cm;'>&nbsp;</div>";
        
        $html .= "<div style='text-align: center; text-transform: uppercase;'>" . $sk->nama_ttd_sk . "</div>";
        $html .= "<div style='text-align: center; text-transform: uppercase;'>" . apa_pangkat($sk->id_pangkat_ttd_sk) . "</div>";
        $html .= "<div style='text-align: center; text-transform: uppercase;'>NIP : " . $sk->nip_ttd_sk . "</div>";
    $html .= "</div>";
    
    
    $html .= "</div>";
?>
<?php
	
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("folio", "landscape");
    $dompdf->render();

    $dompdf->stream("surat_panggilan_kenpang.pdf", array("Attachment" => false));
	
    //echo($html);

  exit(0);
?>