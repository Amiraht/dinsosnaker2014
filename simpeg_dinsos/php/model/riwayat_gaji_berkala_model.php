<?php
    
    class RiwayatGajiBerkala_Model{
        public $id_riwayat;
        public $id_pegawai;
        public $tmt;
        public $no_sk;
        public $tgl_sk;
        public $nama_pejabat_ttd_sk;
        public $nip_pejabat_ttd_sk;
        public $jabatan_pejabat_ttd_sk;
        public $id_pangkat_pejabat_ttd_sk;
        public $id_peraturan_gaji;
        public $id_jenis_gaji;
        public $scan_sk;
        
        public function __construct(){
            $this->id_riwayat = 0;
            $this->id_pegawai = 0;
            $this->tmt = "";
            $this->no_sk = "";
            $this->tgl_sk = "";
            $this->nama_pejabat_ttd_sk = "";
            $this->nip_pejabat_ttd_sk = "";
            $this->jabatan_pejabat_ttd_sk = "";
            $this->id_pangkat_pejabat_ttd_sk = 0;
            $this->id_peraturan_gaji = 0;
            $this->id_jenis_gaji = 0;
            $this->scan_sk = "";
        }
        
        public function Record($id_riwayat){
            $sql = "SELECT * FROM tbl_riwayat_gaji_berkala WHERE id_riwayat = '" . $id_riwayat . "'";
            $res = mysql_query($sql);
            while($ds = mysql_fetch_array($res)){
                $this->id_riwayat = $ds["id_riwayat"];
                $this->id_pegawai = $ds["id_pegawai"];
                $this->tmt = $ds["tmt"];
                $this->no_sk = $ds["no_sk"];
                $this->tgl_sk = $ds["tgl_sk"];
                $this->nama_pejabat_ttd_sk = $ds["nama_pejabat_ttd_sk"];
                $this->nip_pejabat_ttd_sk = $ds["nip_pejabat_ttd_sk"];
                $this->jabatan_pejabat_ttd_sk = $ds["jabatan_pejabat_ttd_sk"];
                $this->id_pangkat_pejabat_ttd_sk = $ds["id_pangkat_pejabat_ttd_sk"];
                $this->id_peraturan_gaji = $ds["id_peraturan_gaji"];
                $this->id_jenis_gaji = $ds["id_jenis_gaji"];
                $this->scan_sk = $ds["scan_sk"];
            }
        }
        
        public function Insert(){
            $sql = "INSERT INTO tbl_riwayat_gaji_berkala(
                    	id_pegawai,
                    	tmt,
                    	no_sk,
                    	tgl_sk,
                    	nama_pejabat_ttd_sk,
                    	nip_pejabat_ttd_sk,
                    	jabatan_pejabat_ttd_sk,
                    	id_pangkat_pejabat_ttd_sk,
                    	id_peraturan_gaji,
                    	id_jenis_gaji,
                    	scan_sk
                    )VALUES(
                    	'$this->id_pegawai',
                    	'$this->tmt',
                    	'$this->no_sk',
                    	'$this->tgl_sk',
                    	'$this->nama_pejabat_ttd_sk',
                    	'$this->nip_pejabat_ttd_sk',
                    	'$this->jabatan_pejabat_ttd_sk',
                    	'$this->id_pangkat_pejabat_ttd_sk',
                    	'$this->id_peraturan_gaji',
                    	'$this->id_jenis_gaji',
                    	'$this->scan_sk'
                    )";
            $res = mysql_query($sql);
        }
        
        public function Update(){
            $sql = "UPDATE tbl_riwayat_gaji_berkala SET
                    	id_pegawai='$this->id_pegawai',
                    	tmt='$this->tmt',
                    	no_sk='$this->no_sk',
                    	tgl_sk='$this->tgl_sk',
                    	nama_pejabat_ttd_sk='$this->nama_pejabat_ttd_sk',
                    	nip_pejabat_ttd_sk='$this->nip_pejabat_ttd_sk',
                    	jabatan_pejabat_ttd_sk='$this->jabatan_pejabat_ttd_sk',
                    	id_pangkat_pejabat_ttd_sk='$this->id_pangkat_pejabat_ttd_sk',
                    	id_peraturan_gaji='$this->id_peraturan_gaji',
                    	id_jenis_gaji='$this->id_jenis_gaji',
                    	scan_sk='$this->scan_sk'
                    WHERE
                    	id_riwayat = '$this->id_riwayat'";
            $res = mysql_query($sql);
        }
        
        public function Delete(){
            $sql = "DELETE FROM tbl_riwayat_gaji_berkala
                    WHERE
                    	id_riwayat = '$this->id_riwayat'";
            $res = mysql_query($sql);
        }
        
        public function Validation(){
            $validation_result = "";
            if($this->tmt == "" || $this->id_peraturan_gaji == 0 || $this->id_jenis_gaji == 0){
                //$validation_result = "Maaf, input anda belum lengkap TMT : " . $this->tmt . " peraturan : " . $this->id_peraturan_gaji . " jenis : " . $this->id_jenis_gaji;
                $validation_result = "Maaf, input anda belum lengkap";
            }else if($this->id_pegawai == 0){
                $validation_result = "Maaf, pegawai belum ditentukan";
            }
            
            return $validation_result;
        }
    }
    
?>