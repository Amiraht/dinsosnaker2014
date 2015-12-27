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

function pushDispSM($id_surat_masuk, $id_level_asal, $id_level_tujuan, $catatan, $id_pengguna_asal=0, $id_pengguna_tujuan=0){
    mysql_query("INSERT INTO myapp_disptable_suratmasuk VALUES(null, '" . $id_surat_masuk . "', '" . $id_level_asal . "', '" . $id_level_tujuan . "', '" . $id_pengguna_asal . "', '" . $id_pengguna_tujuan . "', CURRENT_TIMESTAMP(), '" . $catatan . "', '1')");
    //echo("INSERT INTO myapp_disptable_suratmasuk VALUES(null, '" . $id_surat_masuk . "', '" . $id_level_asal . "', '" . $id_level_tujuan . "', '" . $id_pengguna_asal . "', '" . $id_pengguna_tujuan . "', CURRENT_TIMESTAMP(), '" . $catatan . "', '1')");
}
function bacaDisp($id_disposisi){
    mysql_query("UPDATE myapp_disptable_suratmasuk SET status=2 WHERE id='" . $id_disposisi . "' AND status <> 3");
}
function selesaiDisp($id_disposisi){
    mysql_query("UPDATE myapp_disptable_suratmasuk SET status=3 WHERE id='" . $id_disposisi . "'");
}

function pushDispSK($id_surat_keluar, $id_level_asal, $id_level_tujuan, $catatan, $keadaan, $id_pengguna_asal=0, $id_pengguna_tujuan=0){
    mysql_query("INSERT INTO myapp_disptable_suratkeluar VALUES(null, '" . $id_surat_keluar . "', '" . $id_level_asal . "', '" . $id_level_tujuan . "', '" . $id_pengguna_asal . "', '" . $id_pengguna_tujuan . "', CURRENT_TIMESTAMP(), '" . $catatan . "', '1', '" . $keadaan . "')");
    //echo("INSERT INTO myapp_disptable_suratmasuk VALUES(null, '" . $id_surat_masuk . "', '" . $id_level_asal . "', '" . $id_level_tujuan . "', '" . $id_pengguna_asal . "', '" . $id_pengguna_tujuan . "', CURRENT_TIMESTAMP(), '" . $catatan . "', '1')");
}
function bacaDispSK($id_disposisi){
    mysql_query("UPDATE myapp_disptable_suratkeluar SET status=2 WHERE id='" . $id_disposisi . "' AND status < 3");
}
function selesaiDispSK($id_disposisi, $status=3){
    mysql_query("UPDATE myapp_disptable_suratkeluar SET status=" . $status . " WHERE id='" . $id_disposisi . "'");
}
function konversiKeadaanSK($keadaan){
    $hasil = "";
    if($keadaan == 1)
        $hasil = "Disposisi Hasil";
    else if($keadaan == 2)
        $hasil = "Penolakan Hasil";
    return $hasil;
}
function konversiJenisFileSK($status){
    $hasil = "";
    if($status == 1)
        $hasil = "Konsep Surat";
    else if($status == 2)
        $hasil = "Konsep Nota Dinas";
    else if($status == 3)
        $hasil = "File Pendukung Surat Keluar";
    else if($status == 4)
        $hasil = "Berkas Final (Sudah Ditandatangani)";
    return $hasil;
}
function levelBawahan($id_surat_keluar, $urutan, $tipe=0){
    $res = mysql_query("SELECT
                        	a.id_level_asal, b.urutan, a.id_pengguna_asal
                        FROM
                        	myapp_disptable_suratkeluar a
                        	LEFT JOIN myapp_reftable_levelpengguna b ON a.id_level_asal = b.id
                        WHERE
                        	a.id_level_asal <> 2 AND a.id_surat_keluar = '" . $id_surat_keluar . "' AND b.urutan = '" . $urutan . "'
                        GROUP BY
                        	a.id_level_asal");
    $ds = mysql_fetch_array($res);
    $kembali = $ds["id_level_asal"];
    if($tipe <> 0)
        $kembali = $ds["id_pengguna_asal"];
        
    return $kembali;
}
function levelAtasan($id_surat_masuk, $urutan, $tipe=0){
    $res = mysql_query("SELECT
                        	a.id_level_asal, b.urutan, a.id_pengguna_asal
                        FROM
                        	myapp_disptable_suratmasuk a
                        	LEFT JOIN myapp_reftable_levelpengguna b ON a.id_level_asal = b.id
                        WHERE
                        	a.id_level_asal <> 2 AND a.id_surat_masuk = '" . $id_surat_masuk . "' AND b.urutan = '" . $urutan . "'
                        GROUP BY
                        	a.id_level_asal");
    $ds = mysql_fetch_array($res);
    $kembali = $ds["id_level_asal"];
    if($tipe <> 0)
        $kembali = $ds["id_pengguna_asal"];
        
    return $kembali;
}
function nomor_nodin($id_level, $tahun){
    $res_l = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE id='" . $id_level . "'");
    $ds_l = mysql_fetch_array($res_l);
    
    $res_a = mysql_query("SELECT * FROM myapp_constable_notadinas WHERE id_level='" . $id_level . "' AND tahun='" . $tahun . "'");
    if(mysql_num_rows($res_a) == 0){
        mysql_query("INSERT INTO myapp_constable_notadinas VALUES(null, '" . $id_level . "', '" . $tahun . "', 0)");
    }
    
    $res_b = mysql_query("SELECT * FROM myapp_constable_notadinas WHERE id_level='" . $id_level . "' AND tahun='" . $tahun . "'");
    $ds_b = mysql_fetch_array($res_b);
    
    $norut = $ds_b["nomor"] + 1;
    $nodin = digitformat($norut, 4) . "/" . $ds_l["kode_nota"] . "/" . $tahun;
    
    mysql_query("UPDATE myapp_constable_notadinas SET nomor = nomor + 1 WHERE id_level='" . $id_level . "' AND tahun='" . $tahun . "'");
    
    return $nodin; 
}

function anti_injection($str){
	return mysql_real_escape_string(strip_tags(trim($str)));
}
?>