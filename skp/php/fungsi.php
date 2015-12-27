<?php

function digitformat($angka, $digit){
    $strangka = $angka . "";
    $pjgkar = strlen($strangka);
    $kembali = $strangka;
    if($pjgkar < $digit){
        $kembali = "";
        $selisih = $digit - $pjgkar;
        for($i=0; $i<$selisih; $i++){
            $kembali .= "0";
        }
        $kembali .= $strangka;
    }
    return $kembali;
}
function no_register($id){
    return digitformat($id, 5);
}
function tglindonesia($tgl){
    $pecahtgl = explode("-", $tgl);
    $thn = $pecahtgl[0];
    $bln = $pecahtgl[1];
    $tgl = $pecahtgl[2];
    
    $arrbulan = array("", "januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober",
                        "november", "desember");
    
    return $tgl . "-" . $bln . "-" . $thn;
}
function status_supervisi($status_supervisi){
    $lampu = "";
    $lampu = "<div class='lampu_" . $status_supervisi . "'>&nbsp;</div>";
    return $lampu;
}
function nama_skpd($id_skpd){
    $ds = mysql_fetch_array(mysql_query("SELECT skpd FROM ref_skpd WHERE id_skpd = '" . $id_skpd . "'"));
    return $ds["skpd"];
}
function detail_pegawai($id_pegawai, $field){
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pegawai WHERE id_pegawai = '" . $id_pegawai . "'"));
    return $ds[$field];
}
function detail_pegawai_by_nip($nip, $field){
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pegawai WHERE nip = '" . $nip . "'"));
    return $ds[$field];
}
function update_pangkat_pegawai($id_pegawai){
    $ds_pangkat_terakhir = mysql_fetch_array(mysql_query("SELECT * FROM tbl_riwayat_pangkat WHERE id_pegawai='" . $id_pegawai . "' ORDER BY tmt DESC LIMIT 0, 1"));
    mysql_query("UPDATE tbl_pegawai SET
                    id_pangkat='" . $ds_pangkat_terakhir["id_pangkat"] . "'
                 WHERE id_pegawai='" . $id_pegawai . "'");
}
function update_jabatan_pegawai($id_pegawai){
    $ds_jabatan_terakhir = mysql_fetch_array(mysql_query("SELECT * FROM tbl_riwayat_jabatan WHERE id_pegawai='" . $id_pegawai . "' ORDER BY tmt DESC LIMIT 0, 1"));
    mysql_query("UPDATE tbl_pegawai SET
                    id_satuan_organisasi='" . $ds_jabatan_terakhir["id_skpd"] . "',
                    id_tipe_jabatan='" . $ds_jabatan_terakhir["id_tipe_jabatan"] . "',
                    id_jabatan='" . $ds_jabatan_terakhir["id_jabatan"] . "'
                 WHERE id_pegawai='" . $id_pegawai . "'");
}
function konversi_nilai_ke_huruf($nilai){
    if($nilai > 90)
        return "sangat baik";
    else if($nilai > 75 && $nilai <= 90)
        return "baik";
    else if($nilai > 60 && $nilai <= 75)
        return "cukup";
    else if($nilai > 50 && $nilai <= 60)
        return "kurang";
    else if($nilai <= 50)
        return "buruk";
}
function total_nilai_skp($id_skp){
    $res_data = mysql_query("SELECT
                                    a.*, c.satuan_waktu, 
                                	CASE
                                		WHEN SUM(b.kuantitas) IS NULL THEN 0
                                		ELSE SUM(b.kuantitas)
                                	END AS rel_kuantitas,
                                	CASE
                                		WHEN (SELECT AVG(kualitas) FROM tbl_uraian_realisasi_skp WHERE id_uraian_skp=b.id_uraian_skp AND kualitas > 0) IS NULL THEN 0
                                		ELSE (SELECT AVG(kualitas) FROM tbl_uraian_realisasi_skp WHERE id_uraian_skp=b.id_uraian_skp AND kualitas > 0)
                                	END AS rel_kualitas,
                                	CASE 
                                		WHEN SUM(b.waktu) IS NULL THEN 0
                                		ELSE SUM(b.waktu)
                                	END AS rel_waktu, 
                                	CASE
                                		WHEN SUM(b.biaya) IS NULL THEN 0
                                		ELSE SUM(b.biaya)
                                	END AS rel_biaya
                                FROM
                                	tbl_uraian_skp a
                                	LEFT JOIN tbl_uraian_realisasi_skp b ON a.id_uraian_skp = b.id_uraian_skp
                                	LEFT JOIN ref_satuan_waktu c ON a.id_satuan_waktu = c.id_satuan_waktu
                                    LEFT JOIN tbl_skp_perilaku_disatukan d ON a.id_skp = d.id_skp
                                WHERE
                                	d.id_skp_perilaku = '" . $id_skp . "'
                                GROUP BY
                                	a.id_uraian_skp
                                ORDER BY
                                		a.kegiatan ASC");
        $no = 0;
        $total_seluruh = 0;
        while($ds_data = mysql_fetch_array($res_data)){
            $no++;
            $bobot_ak = $ds_data["ak"];
            $target_ak = $bobot_ak * $ds_data["kuantitas"];
            $nilai_ak = $bobot_ak * $ds_data["rel_kuantitas"];
            $tulis_target_ak = "-";
            
            if($target_ak > 0)
                $tulis_target_ak = $target_ak;
            $tulis_nilai_ak = "-";
            if($nilai_ak > 0)
                $tulis_nilai_ak = $nilai_ak;
             
            $pembagi = 0;
            
            $nilai_kuantitas = 0;
            if($ds_data["rel_kuantitas"] > 0){
                $nilai_kuantitas = ($ds_data["rel_kuantitas"] * 100) / $ds_data["kuantitas"];
                $pembagi++;
            }
            
            $nilai_kualitas = 0;
            if($ds_data["rel_kualitas"] > 0){
                $nilai_kualitas = ($ds_data["rel_kualitas"] * 100) / $ds_data["kualitas"];
                $pembagi++;
            }
                
            $nilai_waktu = 0;
            if($ds_data["rel_waktu"] > 0){
                $nilai_waktu = (((1.76 * $ds_data["waktu"]) - $ds_data["rel_waktu"]) * 100) / $ds_data["waktu"];
                $pembagi++;
            }
            
            $nilai_biaya = 0;
            if($ds_data["biaya"] > 0 && $ds_data["rel_biaya"] > 0){
                $nilai_biaya = (((1.76 * $ds_data["biaya"]) - $ds_data["rel_biaya"]) * 100) / $ds_data["biaya"];
                $pembagi++;
            }
            
            $total_penghitungan = $nilai_kuantitas + $nilai_kualitas + $nilai_waktu + $nilai_biaya;
            $total_capaian = 0;
            if($pembagi > 0)
                $total_capaian = $total_penghitungan / $pembagi;
            $total_seluruh += $total_capaian;
        }
        $nilai_skp = $total_seluruh / $no;
        return $nilai_skp;
}

function ekstensi($nama_file){
    $pecah = explode(".", $nama_file);
    $ekstensi = $pecah[count($pecah) - 1];
    return $ekstensi;
}

function bulan_ke_skp($bulan_ke, $id_skp){
    $bulan = $bulan_ke - 1;
    $ds = mysql_fetch_array(mysql_query("SELECT id_pegawai, dari, DATE_ADD(dari,INTERVAL " . $bulan . " MONTH) AS bulan_ke FROM tbl_skp WHERE id_skp = '" . $id_skp . "'"));
    $saatnya = $ds["bulan_ke"];
    $pecah = explode("-", $saatnya);
    $nama_bulan = "";
    switch($bulan_ke){ // sebelumnya : $pecah[1]
        case 01 :
            $nama_bulan = "Januari";
            break;
        case 02 :
            $nama_bulan = "Februari";
            break;
        case 03 :
            $nama_bulan = "Maret";
            break;
        case 04 :
            $nama_bulan = "April";
            break;
        case 05 :
            $nama_bulan = "Mei";
            break;
        case 06 :
            $nama_bulan = "Juni";
            break;
        case 07 :
            $nama_bulan = "Juli";
            break;
        case 08 :
            $nama_bulan = "Agustus";
            break;
        case 09 :
            $nama_bulan = "September";
            break;
        case 10 :
            $nama_bulan = "Oktober";
            break;
        case 11 :
            $nama_bulan = "November";
            break;
        case 12 :
            $nama_bulan = "Desember";
            break;
    }
    $kembali = $nama_bulan . " " . $pecah[0];
    return $kembali;
}

function penilaian_tugas_tambahan($total){
    $nilai = 0;
    if($total > 0 && $total <= 3){
        $nilai = 1;
    }else if($total > 3 && $total <= 6){
        $nilai = 2;
    }else if($total > 6){
        $nilai = 3;
    }
    return $nilai;
}

function getIDUsulanDetailKenpang($id_detail){
	$sql = "SELECT id_usulan FROM tbl_detail_usulan_pangkat WHERE id_detail = '$id_detail'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch['id_usulan'];
}

function get_id_usulan_from_no_usulan_kenpang($no_usul){
	$sql = "SELECT id_usulan FROM tbl_usulan_pangkat WHERE no_usulan = '$no_usul'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch['id_usulan'];
}

function list_no_usulan_kenpang(){
	$usul = array();
	$sql = "SELECT id_usulan, no_usulan FROM tbl_usulan_pangkat WHERE status_proses = 3 ORDER BY id_usulan ASC";
	$query = mysql_query($sql) or die(mysql_error());
	$i = 0;
	while($row = mysql_fetch_array($query)){
		$usul[$i]['id_usulan'] = $row['id_usulan'];
		$usul[$i]['no_usulan'] = $row['no_usulan'];
		$i++;
	}
	
	return $usul;
}

function list_no_usulan_pmk(){
	$usul = array();
	$sql = "SELECT id_usulan, no_usulan FROM tbl_usulan_pmk WHERE status_supervisi = 3 ORDER BY id_usulan ASC";
	$query = mysql_query($sql) or die(mysql_error());
	$i = 0;
	while($row = mysql_fetch_array($query)){
		$usul[$i]['id_usulan'] = $row['id_usulan'];
		$usul[$i]['no_usulan'] = $row['no_usulan'];
		$i++;
	}
	
	return $usul;
}

function get_id_detail_sk_kenpang(){
	$sql = "SELECT MAX(id_detail) as 'max' FROM tbl_sk_kenpang_detail";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	$id = "";
	if($fetch['max'] <= 0){
		$id = 1;
	}else{
		$id = ($fetch['max'] + 1);
	}
	return $id;
}

// untuk id detail sk pmk
function get_id_detail_sk_pmk(){
	$sql = "SELECT MAX(id_detail) as 'max' FROM tbl_sk_pmk_detail";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	$id = "";
	if($fetch['max'] <= 0){
		$id = 1;
	}else{
		$id = ($fetch['max'] + 1);
	}
	return $id;
}

function get_field_usulan_kenpang_detail_by_id_pegawai($id_pegawai, $field){
	$sql = "SELECT * FROM tbl_detail_usulan_pangkat WHERE id_pegawai = '".$id_pegawai."'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch[$field];
}

function get_field_usulan_pmk_detail_by_nip($nip, $field){
	$sql = "SELECT * FROM tbl_detail_usul_pmk WHERE nip = '".$nip."'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch[$field];
}

function get_field_in_table_sk_kenpang($id_sk, $field){
	$sql = "SELECT * FROM tbl_sk_kenpang WHERE id_data = '".$id_sk."'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch[$field];
}

function getFileSkKenpangPegawai($id){
	$sql = "SELECT * FROM tbl_riwayat_pangkat WHERE id_riwayat_pangkat = '".$id."'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch["img_sk"];
}

// fungsi untuk mendapatkan kode_skpd pada tabel ref skpd
function getKodeSKPD($id_skpd){
	$sql = "SELECT kode_skpd as KODE FROM ref_skpd WHERE id_skpd = '".$id_skpd."'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch["KODE"];
}

?>