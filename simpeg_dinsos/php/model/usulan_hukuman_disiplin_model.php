<?php

    class UsulanHukumanDisiplin{
        public $id_usulan;
        public $id_pegawai;
        public $tmt;
        public $id_jenis_disiplin;
        public $id_sub_jenis_disiplin;
        public $keterangan;
        public $jabatan_pejabat_sk;
        public $nama_pejabat_sk;
        public $nip_pejabat_sk;
        public $pangkat_pejabat_sk;
        public $tgl_sk;
        public $no_sk;
        public $membaca;
        public $menimbang;
        public $mengingat;
        public $menetapkan;
        public $tembusan;
        public $status;
        public $pemisah_hukuman;
        public $scan_sk;
        
        public function __construct(){
            $this->id_usulan = 0;
            $this->id_pegawai = 0;
            $this->tmt = "";
            $this->id_jenis_disiplin = 0;
            $this->id_sub_jenis_disiplin = 0;
            $this->keterangan = "";
            $this->jabatan_pejabat_sk = "";
            $this->nama_pejabat_sk = "";
            $this->nip_pejabat_sk = "";
            $thi->pangkat_pejabat_sk = 0;
            $this->tgl_sk = "";
            $this->no_sk = "";
            $this->membaca = "";
            $this->menimbang = "";
            $this->mengingat = "";
            $this->menetapkan = "";
            $this->tembusan = "";
            $this->status = 0;
            $this->pemisah_hukuman = 0;
            $this->scan_sk = "";
        }
        
        public function Record($id_usulan){
            $sql_record = "SELECT * FROM tbl_usulan_hukuman_disiplin WHERE id_usulan='" . $id_usulan . "'";
            $res_record = mysql_query($sql_record);
            while($ds_record = mysql_fetch_array($res_record)){
                $this->id_usulan = $ds_record["id_usulan"];
                $this->id_pegawai = $ds_record["id_pegawai"];
                $this->tmt = $ds_record["tmt"];
                $this->id_jenis_disiplin = $ds_record["id_jenis_disiplin"];
                $this->id_sub_jenis_disiplin = $ds_record["id_sub_jenis_disiplin"];
                $this->keterangan = $ds_record["keterangan"];
                $this->jabatan_pejabat_sk = $ds_record["jabatan_pejabat_sk"];
                $this->nama_pejabat_sk = $ds_record["nama_pejabat_sk"];
                $this->nip_pejabat_sk = $ds_record["nip_pejabat_sk"];
                $this->pangkat_pejabat_sk = $ds_record["pangkat_pejabat_sk"];
                $this->tgl_sk = $ds_record["tgl_sk"];
                $this->no_sk = $ds_record["no_sk"];
                $this->membaca = $ds_record["membaca"];
                $this->menimbang = $ds_record["menimbang"];
                $this->mengingat = $ds_record["mengingat"];
                $this->menetapkan = $ds_record["menetapkan"];
                $this->tembusan = $ds_record["tembusan"];
                $this->status = $ds_record["status"];
                $this->pemisah_hukuman = $ds_record["pemisah_hukuman"];
                $this->scan_sk = $ds_record["scan_sk"];
            }
        }
        
        public function Insert(){
            $sql_insert = "INSERT INTO tbl_usulan_hukuman_disiplin(
                                id_pegawai, tmt, id_jenis_disiplin, id_sub_jenis_disiplin, keterangan,
                                jabatan_pejabat_sk, nama_pejabat_sk, nip_pejabat_sk, pangkat_pejabat_sk, tgl_sk, no_sk,
                                membaca, menimbang, mengingat, menetapkan, tembusan,
                                status, pemisah_hukuman, scan_sk
                            ) VALUES(
                                '" . $this->id_pegawai . "', '" . $this->tmt . "', '" . $this->id_jenis_disiplin . "', '" . $this->id_sub_jenis_disiplin . "', '" . $this->keterangan . "',
                                '" . $this->jabatan_pejabat_sk . "', '" . $this->nama_pejabat_sk . "', '" . $this->nip_pejabat_sk . "', '" . $this->pangkat_pejabat_sk . "', '" . $this->tgl_sk . "', '" . $this->no_sk . "',
                                '" . $this->membaca . "', '" . $this->menimbang . "', '" . $this->mengingat . "', '" . $this->menetapkan . "', '" . $this->tembusan . "',
                                '" . $this->status . "', '" . $this->pemisah_hukuman . "', '" . $this->scan_sk . "'
                            )";
            mysql_query($sql_insert);
        }
        
        public function Update(){
            $sql_update = "UPDATE tbl_usulan_hukuman_disiplin SET
                                id_pegawai='" . $this->id_pegawai . "', tmt='" . $this->tmt . "', id_jenis_disiplin='" . $this->id_jenis_disiplin . "', id_sub_jenis_disiplin='" . $this->id_sub_jenis_disiplin . "', keterangan='" . $this->keterangan . "',
                                jabatan_pejabat_sk='" . $this->jabatan_pejabat_sk . "', nama_pejabat_sk='" . $this->nama_pejabat_sk . "', nip_pejabat_sk='" . $this->nip_pejabat_sk . "', pangkat_pejabat_sk='" . $this->pangkat_pejabat_sk . "', tgl_sk='" . $this->tgl_sk . "', no_sk='" . $this->no_sk . "',
                                membaca='" . $this->membaca . "', menimbang='" . $this->menimbang . "', mengingat='" . $this->mengingat . "', menetapkan='" . $this->menetapkan . "', tembusan='" . $this->tembusan . "',
                                status='" . $this->status . "', pemisah_hukuman='" . $this->pemisah_hukuman . "', scan_sk='" . $this->scan_sk . "'
                            WHERE
                                id_usulan='" . $this->id_usulan . "'";
            mysql_query($sql_update);
        }
        
        public function Delete($id_usulan){
            $sql_delete = "DELETE FROM tbl_usulan_hukuman_disiplin WHERE id_usulan='" . $id_usulan . "'";
            mysql_query($sql_delete);
        }
    }

?>