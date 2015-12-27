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

function get_no_usulan_pangkat($id_usul){
	$sql = mysql_query("SELECT no_usulan FROM tbl_usulan_pangkat WHERE id_usulan = '$id_usul'") or die(mysql_error());
	$tag = mysql_fetch_array($sql);
	
	return $tag["no_usulan"];
}

function get_no_usulan_pmk($id_usul){
	$sql = mysql_query("SELECT no_usulan FROM tbl_usulan_pmk WHERE id_usulan = '$id_usul'") or die(mysql_error());
	$tag = mysql_fetch_array($sql);
	
	return $tag["no_usulan"];
}

function getNoUsulSkKenpang($id_data){
	$sql = "SELECT no_usulan_naik_pangkat as 'no_usul' FROM tbl_sk_kenpang WHERE id_data = '".$id_data."'";
	$query = mysql_query($sql) or die(mysql_error());
	$tag = mysql_fetch_array($query);
	
	return $tag['no_usul'];
}

function getNoUsulanSkPMK($id_surat){
	$sql = "SELECT no_usul_pmk as 'no_usul' FROM tbl_sk_pmk WHERE id_surat = '".$id_surat."'";
	$query = mysql_query($sql) or die(mysql_error());
	$tag = mysql_fetch_array($query);
	
	return $tag['no_usul'];
}


function getFileNameFromScanSKKenpang($id_file){
	$sql = "SELECT filename FROM tbl_scan_sk_kenpang WHERE id_files = '".$id_file."'";
	$query = mysql_query($sql) or die(mysql_error());
	$tag = mysql_fetch_array($query);
	
	return $tag['filename'];
}

function getNoUsulFromUsulanCuti($id_usulan){
	$sql = "SELECT no_usulan FROM tbl_usulan_cuti WHERE id_usulan = '".$id_usulan."'";
	$query = mysql_query($sql) or die(mysql_error());
	$tag = mysql_fetch_array($query);
	
	return $tag['no_usulan'];
}

function get_nip_riwayat_pendidikan($id){
	$sql = mysql_query("SELECT nip FROM tbl_riwayat_pendidikan WHERE id_data_rp = '$id'") or die(mysql_error());
	$tag = mysql_fetch_array($sql);
	
	return $tag["nip"];
}

function tgl_lahir_me($id_peg){
	$sql = mysql_query("SELECT tanggal_lahir FROM tbl_pegawai WHERE id_pegawai = '$id_peg'") or die(mysql_error());
	$tag = mysql_fetch_array($sql);
	
	return $tag["tanggal_lahir"];
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
function tglpjgindonesia($tgl){
    $pecahtgl = explode("-", $tgl);
    $thn = $pecahtgl[0];
    $bln = intval($pecahtgl[1]);
    $tgl = $pecahtgl[2];
    
    $arrbulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
                        "November", "Desember");
    
    return $tgl . " " . $arrbulan[$bln] . " " . $thn;
}
function idr($nilai){
    $rupiah = number_format($nilai, 0, ".", ",");
    return "Rp. " . $rupiah;
}
function status_supervisi($status_supervisi){
    $lampu = "";
	$stats = "";
	if($status_supervisi == 1){
		$stats = "Belum Di Proses di Admin BKD";
	}else if($status_supervisi == 2){
		$stats = "Masih Di Proses di Admin BKD";
	}else if($status_supervisi == 3){
		$stats = "Sudah Di ACC";
	}
    $lampu = "<div class='lampu_" . $status_supervisi . "' title='". $stats ."'>&nbsp;</div>";
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

function whoami($id_peg){
	$qr = mysql_query("SELECT nama_pegawai as 'nama' FROM tbl_pegawai WHERE id_pegawai = '$id_peg'") or die(mysql_error());
	$row = mysql_fetch_array($qr);
	
	return $row['nama'];
}

// fungsi ini untuk mengecek apakah si pegawai sudah masuk kedalam daftar lampiran
// pegawai yang ada dalam SK Kepangkatan 
function is_tersedia_in_lampiran_sk_kenpang($id_pegawai){
	$qr = mysql_query("SELECT * FROM tbl_sk_kenpang_detail WHERE id_pegawai = '".$id_pegawai."'") or die(mysql_error());
	$row = mysql_num_rows($qr);
	
	if($row > 0){
		return true;
	}else{
		return false;
	}
}


function all_detail_pegawai($id_pegawai){
    $sql = "SELECT
            	a.id_pegawai, a.nama_pegawai, a.nip,
            	CASE
            		WHEN a.gelar_depan <> '' THEN CONCAT(a.gelar_depan, '. ')
            		ELSE ''
            	END AS gelar_depan,
            	CASE
            		WHEN a.gelar_belakang <> '' THEN CONCAT(', ', a.gelar_belakang)
            		ELSE ''
            	END AS gelar_belakang,
            	e.jenis_kelamin, a.alamat, a.tanggal_lahir, f.skpd, g.pangkat, g.gol_ruang, h.jabatan, i.agama
            FROM
            	tbl_pegawai a
            	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
            	LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian
            	LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian
            	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
            	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
            	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
            	LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                LEFT JOIN ref_agama i ON a.id_agama = i.id_agama
            WHERE
            	a.id_pegawai = '" . $id_pegawai . "'";
    $res = mysql_query($sql);
    $ds = mysql_fetch_array($res);
    return $ds;
}
function detail_pegawai_by_nip($nip, $field){
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pegawai WHERE nip = '" . $nip . "'"));
    return $ds[$field];
}
function detail_pegawai_by_id($id, $field){
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pegawai WHERE id_pegawai = '" . $id . "'"));
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
function apa_pangkat($id_pangkat){
    $sql = "SELECT * FROM ref_pangkat WHERE id_pangkat = '" . $id_pangkat . "'";
    $res = mysql_query($sql);
    $ds = mysql_fetch_array($res);
    return $ds["pangkat"] . " (" . $ds["gol_ruang"] . ")";
}
function konversi_nilai_ke_huruf($nilai){
    if($nilai >= 91)
        return "sangat baik";
    else if($nilai >= 76 && $nilai <= 90)
        return "baik";
    else if($nilai >= 61 && $nilai <= 75)
        return "cukup";
    else if($nilai >= 51 && $nilai <= 60)
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
                                	(SELECT AVG(kualitas) FROM tbl_uraian_realisasi_skp WHERE id_skp='1' AND id_uraian_skp=b.id_uraian_skp AND kualitas > 0) AS rel_kualitas,
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
                                WHERE
                                	a.id_skp = '" . $id_skp . "'
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

function get_existing_filename($id_rp){
	$sql = "SELECT scan_ijazah FROM tbl_riwayat_pendidikan WHERE id_data_rp = '$id_rp'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch['scan_ijazah'];
}

function get_maks_id_data_riwayat_pendidikan(){
	$sql = "SELECT MAX(id_data_rp) as 'max' FROM tbl_riwayat_pendidikan";
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

function get_maks_id_pmk(){
	$sql = "SELECT MAX(id_usulan) as 'max' FROM tbl_usulan_pmk";
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

function get_maks_id_pangkat(){
	$sql = "SELECT MAX(id_usulan) as 'max' FROM tbl_usulan_pangkat";
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

function get_maks_id_sk_pangkat(){
	$sql = "SELECT MAX(id_data) as 'max' FROM tbl_sk_kenpang";
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
function get_id_data_pmk(){
	$sql = "SELECT MAX(nomor) as 'max' FROM tbl_detail_usul_pmk";
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

function get_id_sk_pmk(){
	$sql = "SELECT MAX(id_surat) as 'max' FROM tbl_sk_pmk";
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

function getNoUsulSkPmk($id_surat){
	$sql = "SELECT id_usulan FROM tbl_sk_pmk WHERE id_surat = '$id_surat'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch['no_usul'];
}

function jumlahUcapanKenpangMasuk($nip){
	$sql = "SELECT * FROM tbl_ucapan_naik_pangkat WHERE tujuan = '".$nip."' AND lihat = '1'";
	$query = mysql_query($sql) or die(mysql_error());
	$num = mysql_num_rows($query);
	return $num;
}

function jumlahUcapanJabatanMasuk($nip){
	$sql = "SELECT * FROM tbl_ucapan_naik_jabatan WHERE tujuan = '".$nip."' AND lihat = '1'";
	$query = mysql_query($sql) or die(mysql_error());
	$num = mysql_num_rows($query);
	return $num;
}

function bulan_ke_skp($bulan_ke, $id_skp){
    $bulan = $bulan_ke - 1;
    $ds = mysql_fetch_array(mysql_query("SELECT id_pegawai, dari, DATE_ADD(dari,INTERVAL " . $bulan . " MONTH) AS bulan_ke FROM tbl_skp WHERE id_skp = '" . $id_skp . "'"));
    $saatnya = $ds["bulan_ke"];
    $pecah = explode("-", $saatnya);
    $nama_bulan = "";
    switch($pecah[1]){
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

// get Num Data of table
function getNumData($sql){
	$query = mysql_query($sql) or die(mysql_error());
	$num = mysql_num_rows($query);
	
	return $num;
}

// get ID pegawai pada tabel kenaikan pangkat
function get_id_pegawai_on_kpk($nip){
	$sql = "SELECT id_pegawai as 'id' FROM tbl_pegawai WHERE nip = '$nip'";
	$query = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($query);
	
	return $row['id'];
}

// untuk pengecekan pegawai di data surat usulan kenaikan pangkat
function cek_pegawai_kpk($id_pegawai){
	$status = "";
	$sql = "SELECT * FROM tbl_usulan_pangkat WHERE id_pegawai = '$id_pegawai'";
	$ex = mysql_query($sql) or die(mysql_error());
	$num = mysql_num_rows($ex);
	if($num > 0 ){
		$status = "unvalid";
	}else{
		$status = "valid";
	}
	
	return $status;
}

// get nomor usulan dari semua tabel surat usulan
function getNoUsul($table_name, $id_usulan){
	$sql = "SELECT  no_usulan FROM ". $table_name ." WHERE id_usulan = '$id_usulan'";
	$ex = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($ex);
	
	return $row['no_usulan'];
}

// cek_pegawai kenaikan pangkat untuk edit
function cek_pegawai_kpk_for_edit($id_pegawai, $no_usulan){
	$status = "";
	$sql = "SELECT * FROM tbl_usulan_pangkat WHERE id_pegawai = '$id_pegawai' AND no_usulan = '$no_usulan'";
	$ex = mysql_query($sql) or die(mysql_error());
	$num = mysql_num_rows($ex);
	if($num > 0 ){
		$status = "unvalid";
	}else{
		$status = "valid";
	}
	
	return $status;
}

// nama file scan SK kepangkatan
function getfile_sk_kenpang($id_data){
	$sql = "SELECT scan_sk FROM tbl_sk_kenpang WHERE id_data = '$id_data'";
	$q = mysql_query($sql) or die(mysql_error());
	$data = mysql_fetch_array($q);
	
	return $data['scan_sk'];
}

function get_id_pangkat_baru($no_usul){
	$sql = "SELECT id_pangkat_baru FROM tbl_usulan_pangkat WHERE no_usulan = '$no_usul'";
	$id_pang_bar = array();
	$query = mysql_query($sql) or die(mysql_error());
	$i = 0;
	while($row = mysql_fetch_array($query)){
		$id_pang_bar[$i] = $row["id_pangkat_baru"];
		$i++;
	}
	
	return $id_pang_bar;
}

function get_id_pegawai_baru($no_usul){
	$sql = "SELECT id_pegawai FROM tbl_usulan_pangkat WHERE no_usulan = '$no_usul'";
	$id_peg = array();
	$query = mysql_query($sql) or die(mysql_error());
	$i = 0;
	while($row = mysql_fetch_array($query)){
		$id_peg[$i] = $row["id_pegawai"];
		$i++;
	}
	
	return $id_peg;
}

// jumlah pesan ultah yang masuk
function get_pesan_ultah_masuk($id_pegawai){
	$s = "SELECT * FROM tbl_ucapan_ultah_pegawai WHERE tujuan = '".$id_pegawai."' AND lihat = '1'";
    $q = mysql_query($s) or die(mysql_error());
	$pesan_ultah_masuk = mysql_num_rows($q);
	
	return $pesan_ultah_masuk;
}

// untuk detail usulan pencantuman gelar
function getIDPegawaiDetailPg($id_detail){
	$sql = "SELECT id_pegawai FROM tbl_usulan_pg_detail WHERE id_usulan_pg_detail = '$id_detail'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch['id_pegawai'];
}

// untuk detail usulan penyesuaian ijazah
function getIDPegawaiDetailPi($id_detail){
	$sql = "SELECT id_pegawai FROM tbl_usulan_pi_detail WHERE id_pi_detali = '$id_detail'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch['id_pegawai'];
}

function getMaksIDPangkatDetail(){
	$sql = "SELECT MAX(id_detail) as 'max' FROM tbl_detail_usulan_pangkat";
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

function getIDPegawaiDetailKenpang($id_detail){
	$sql = "SELECT id_pegawai FROM tbl_detail_usulan_pangkat WHERE id_detail = '$id_detail'";
	$query = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_array($query);
	
	return $fetch['id_pegawai'];
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

// untuk menentukan id unik tiap pegawai
function set_id_pegawai(){
	$sql = "SELECT MAX(id_pegawai) as 'max' FROM tbl_pegawai";
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

// untuk menentukan id unik tiap pengguna
function set_id_pengguna(){
	$sql = "SELECT MAX(id_pengguna) as 'max' FROM tbl_pengguna";
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

?>