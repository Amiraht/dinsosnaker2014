<?php
    class IjinCerai_Model{
        public $id_cerai;
        public $id_pegawai;
        public $nama_pasangan;
        public $pekerjaan_pasangan;
        public $id_agama_pasangan;
        public $alasan;
        public $no_sp;
        public $tgl_sp;
        public $nama_pejabat_sp;
        public $nip_pejabat_sp;
        public $jabatan_pejabat_sp;
        public $id_pangkat_pejabat_sp;
        public $nip_kesdip;
        public $nama_kesdip;
        public $id_pangkat_kesdip;
        public $no_smp;
        public $tgl_smp;
        public $no_spgl;
        public $tgl_spgl;
        public $nama_pejabat_spgl;
        public $nip_pejabat_spgl;
        public $jabatan_pejabat_spgl;
        public $id_pangkat_pejabat_spgl;
        public $hari_h_spgl;
        public $tgl_h_spgl;
        public $jam_h_spgl;
        public $tempat_h_spgl;
        public $membaca_sk;
        public $menimbang_sk;
        public $mengingat_sk;
        public $memperhatikan_sk;
        public $tembusan_sk;
        public $no_sk;
        public $tgl_sk;
        public $nama_pejabat_sk;
        public $nip_pejabat_sk;
        public $jabatan_pejabat_sk;
        public $id_pangkat_pejabat_sk;
        public $status;
        
        public function __construct(){
            $this->id_cerai = 0;
            $this->id_pegawai = 0;
            $this->nama_pasangan = "";
            $this->pekerjaan_pasangan = "";
            $this->id_agama_pasangan = 0;
            $this->alasan = "";
            $this->no_sp = "";
            $this->tgl_sp = "";
            $this->nama_pejabat_sp = "";
            $this->nip_pejabat_sp = "";
            $this->jabatan_pejabat_sp = "";
            $this->id_pangkat_pejabat_sp = 0;
            $this->nip_kesdip = "";
            $this->nama_kesdip = "";
            $this->id_pangkat_kesdip = 0;
            $this->no_smp = "";
            $this->tgl_smp = "";
            $this->no_spgl = "";
            $this->tgl_spgl = "";
            $this->nama_pejabat_spgl = "";
            $this->nip_pejabat_spgl = "";
            $this->jabatan_pejabat_spgl = "";
            $this->id_pangkat_pejabat_spgl = 0;
            $this->hari_h_spgl = "";
            $this->tgl_h_spgl = "";
            $this->jam_h_spgl = "";
            $this->tempat_h_spgl = "";
            $this->membaca_sk = "";
            $this->menimbang_sk = "";
            $this->mengingat_sk = "";
            $this->memperhatikan_sk = "";
            $this->tembusan_sk = "";
            $this->no_sk = "";
            $this->tgl_sk = "";
            $this->nama_pejabat_sk = "";
            $this->nip_pejabat_sk = "";
            $this->jabatan_pejabat_sk = "";
            $this->id_pangkat_pejabat_sk = 0;
            $this->status = 0;
        }
        
        public function Record($id_cerai){
            $sql_record = "SELECT * FROM tbl_ijin_cerai WHERE id_cerai='" . $id_cerai . "'";
            $res_record = mysql_query($sql_record);
            while($ds_record = mysql_fetch_array($res_record)){
                $this->id_cerai = $ds_record["id_cerai"];
                $this->id_pegawai = $ds_record["id_pegawai"];
                $this->nama_pasangan = $ds_record["nama_pasangan"];
                $this->pekerjaan_pasangan = $ds_record["pekerjaan_pasangan"];
                $this->id_agama_pasangan = $ds_record["id_agama_pasangan"];
                $this->alasan = $ds_record["alasan"];
                $this->no_sp = $ds_record["no_sp"];
                $this->tgl_sp = $ds_record["tgl_sp"];
                $this->nama_pejabat_sp = $ds_record["nama_pejabat_sp"];
                $this->nip_pejabat_sp = $ds_record["nip_pejabat_sp"];
                $this->jabatan_pejabat_sp = $ds_record["jabatan_pejabat_sp"];
                $this->id_pangkat_pejabat_sp = $ds_record["id_pangkat_pejabat_sp"];
                $this->nip_kesdip = $ds_record["nip_kesdip"];
                $this->nama_kesdip = $ds_record["nama_kesdip"];
                $this->id_pangkat_kesdip = $ds_record["id_pangkat_kesdip"];
                $this->no_smp = $ds_record["no_smp"];
                $this->tgl_smp = $ds_record["tgl_smp"];
                $this->no_spgl = $ds_record["no_spgl"];
                $this->tgl_spgl = $ds_record["tgl_spgl"];
                $this->nama_pejabat_spgl = $ds_record["nama_pejabat_spgl"];
                $this->nip_pejabat_spgl = $ds_record["nip_pejabat_spgl"];
                $this->jabatan_pejabat_spgl = $ds_record["jabatan_pejabat_spgl"];
                $this->id_pangkat_pejabat_spgl = $ds_record["id_pangkat_pejabat_spgl"];
                $this->hari_h_spgl = $ds_record["hari_h_spgl"];
                $this->tgl_h_spgl = $ds_record["tgl_h_spgl"];
                $this->jam_h_spgl = $ds_record["jam_h_spgl"];
                $this->tempat_h_spgl = $ds_record["tempat_h_spgl"];
                $this->membaca_sk = $ds_record["membaca_sk"];
                $this->menimbang_sk = $ds_record["menimbang_sk"];
                $this->mengingat_sk = $ds_record["mengingat_sk"];
                $this->memperhatikan_sk = $ds_record["memperhatikan_sk"];
                $this->tembusan_sk = $ds_record["tembusan_sk"];
                $this->no_sk = $ds_record["no_sk"];
                $this->tgl_sk = $ds_record["tgl_sk"];
                $this->nama_pejabat_sk = $ds_record["nama_pejabat_sk"];
                $this->nip_pejabat_sk = $ds_record["nip_pejabat_sk"];
                $this->jabatan_pejabat_sk = $ds_record["jabatan_pejabat_sk"];
                $this->id_pangkat_pejabat_sk = $ds_record["id_pangkat_pejabat_sk"];
                $this->status = $ds_record["status"];
            }
        }
        
        public function Insert(){
            $sql_insert = "INSERT INTO tbl_ijin_cerai(
                            	id_pegawai,
                                nama_pasangan,
                                pekerjaan_pasangan,
                                id_agama_pasangan,
                            	alasan,
                            	no_sp,
                            	tgl_sp,
                            	nama_pejabat_sp,
                            	nip_pejabat_sp,
                            	jabatan_pejabat_sp,
                            	id_pangkat_pejabat_sp,
                                nip_kesdip,
                                nama_kesdip,
                                id_pangkat_kesdip,
                                no_smp,
                                tgl_smp,
                                no_spgl,
                                tgl_spgl,
                                nama_pejabat_spgl,
                                nip_pejabat_spgl,
                                jabatan_pejabat_spgl,
                                id_pangkat_pejabat_spgl,
                                hari_h_spgl,
                                tgl_h_spgl,
                                jam_h_spgl,
                                tempat_h_spgl,
                                membaca_sk,
                                menimbang_sk,
                                mengingat_sk,
                                memperhatikan_sk,
                                tembusan_sk,
                                no_sk,
                                tgl_sk,
                                nama_pejabat_sk,
                                nip_pejabat_sk,
                                jabatan_pejabat_sk,
                                id_pangkat_pejabat_sk,
                                status
                            ) VALUES(
                            	'$this->id_pegawai',
                                '$this->nama_pasangan',
                                '$this->pekerjaan_pasangan',
                                '$this->id_agama_pasangan',
                            	'$this->alasan',
                            	'$this->no_sp',
                            	'$this->tgl_sp',
                            	'$this->nama_pejabat_sp',
                            	'$this->nip_pejabat_sp',
                            	'$this->jabatan_pejabat_sp',
                            	'$this->id_pangkat_pejabat_sp',
                                '$this->nip_kesdip',
                                '$this->nama_kesdip',
                                '$this->id_pangkat_kesdip',
                                '$this->no_smp',
                                '$this->tgl_smp',
                                '$this->no_spgl',
                                '$this->tgl_spgl',
                                '$this->nama_pejabat_spgl',
                                '$this->nip_pejabat_spgl',
                                '$this->jabatan_pejabat_spgl',
                                '$this->id_pangkat_pejabat_spgl',
                                '$this->hari_h_spgl',
                                '$this->tgl_h_spgl',
                                '$this->jam_h_spgl',
                                '$this->tempat_h_spgl',
                                '$this->membaca_sk',
                                '$this->menimbang_sk',
                                '$this->mengingat_sk',
                                '$this->memperhatikan_sk',
                                '$this->tembusan_sk',
                                '$this->no_sk',
                                '$this->tgl_sk',
                                '$this->nama_pejabat_sk',
                                '$this->nip_pejabat_sk',
                                '$this->jabatan_pejabat_sk',
                                '$this->id_pangkat_pejabat_sk',
                                '$this->status'
                            )";
            mysql_query($sql_insert);
        }
        
        public function Update(){
            $sql_update = "UPDATE 
                            	tbl_ijin_cerai
                            SET
                            	id_pegawai='$this->id_pegawai',
                                nama_pasangan='$this->nama_pasangan',
                                pekerjaan_pasangan='$this->pekerjaan_pasangan',
                                id_agama_pasangan='$this->id_agama_pasangan',
                            	alasan='$this->alasan',
                            	no_sp='$this->no_sp',
                            	tgl_sp='$this->tgl_sp',
                            	nama_pejabat_sp='$this->nama_pejabat_sp',
                            	nip_pejabat_sp='$this->nip_pejabat_sp',
                            	jabatan_pejabat_sp='$this->jabatan_pejabat_sp',
                            	id_pangkat_pejabat_sp='$this->id_pangkat_pejabat_sp',
                                nip_kesdip='$this->nip_kesdip',
                                nama_kesdip='$this->nama_kesdip',
                                id_pangkat_kesdip='$this->id_pangkat_kesdip',
                                no_smp='$this->no_smp',
                                tgl_smp='$this->tgl_smp',
                                no_spgl='$this->no_spgl',
                                tgl_spgl='$this->tgl_spgl',
                                nama_pejabat_spgl='$this->nama_pejabat_spgl',
                                nip_pejabat_spgl='$this->nip_pejabat_spgl',
                                jabatan_pejabat_spgl='$this->jabatan_pejabat_spgl',
                                id_pangkat_pejabat_spgl='$this->id_pangkat_pejabat_spgl',
                                hari_h_spgl='$this->hari_h_spgl',
                                tgl_h_spgl='$this->tgl_h_spgl',
                                jam_h_spgl='$this->jam_h_spgl',
                                tempat_h_spgl='$this->tempat_h_spgl',
                                membaca_sk='$this->membaca_sk',
                                menimbang_sk='$this->menimbang_sk',
                                mengingat_sk='$this->mengingat_sk',
                                memperhatikan_sk='$this->memperhatikan_sk',
                                tembusan_sk='$this->tembusan_sk',
                                no_sk='$this->no_sk',
                                tgl_sk='$this->tgl_sk',
                                nama_pejabat_sk='$this->nama_pejabat_sk',
                                nip_pejabat_sk='$this->nip_pejabat_sk',
                                jabatan_pejabat_sk='$this->jabatan_pejabat_sk',
                                id_pangkat_pejabat_sk='$this->id_pangkat_pejabat_sk',
                                status='$this->status'
                            WHERE
                            	id_cerai = '" . $this->id_cerai . "'";
            mysql_query($sql_update);
        }
        
        public function Delete(){
            $sql_delete = "DELETE FROM tbl_ijin_cerai WHERE id_cerai = '" . $this->id_cerai . "'";
            mysql_query($sql_delete);
        }
        
        public function Validation(){
            $validation_result = "";
            if($this->id_pegawai == 0)
                $validation_result = "Maaf, Data pegawai yang diusulkan tidak ditemukan";
            else if($this->alasan == "" || $this->no_sp == "" || $this->tgl_sp == "" || $this->nama_pejabat_sp == "" ||
                    $this->nip_pejabat_sp == "" || $this->jabatan_pejabat_sp == "" || $this->id_pangkat_pejabat_sp == "0")
                        $validation_result = "Maaf, input anda belum lengkap";
            return $validation_result;
        }
    }
?>