<?php
    
    class RiwayatSatyaLancana_Model{
        public $id_riwayat;
        public $id_pegawai;
        public $no_sk;
        public $tgl_sk;
        public $nama_pejabat_ttd_sk;
        public $nip_pejabat_ttd_sk;
        public $jabatan_pejabat_ttd_sk;
        public $id_pangkat_pejabat_ttd_sk;
        public $no_piagam;
        public $tgl_piagam;
        public $nama_presiden;
        public $jenis_satya;
        public $scan_sk;
        
        public function __construct(){
            $this->id_riwayat = 0;
            $this->id_pegawai = 0;
            $this->no_sk = "";
            $this->tgl_sk = "";
            $this->nama_pejabat_ttd_sk = "";
            $this->nip_pejabat_ttd_sk = "";
            $this->jabatan_pejabat_ttd_sk = "";
            $this->id_pangkat_pejabat_ttd_sk = 0;
            $this->no_piagam = "";
            $this->tgl_piagam = "";
            $this->nama_presiden = "";
            $this->jenis_satya = "";
            $this->scan_sk = "";
        }
        
        public function Record($id_riwayat){
            $sql = "SELECT * FROM tbl_riwayat_satya_lancana WHERE id_riwayat = '" . $id_riwayat . "'";
            $res = mysql_query($sql);
            while($ds = mysql_fetch_array($res)){
                $this->id_riwayat = $ds["id_riwayat"];
                $this->id_pegawai = $ds["id_pegawai"];
                $this->no_sk = $ds["no_sk"];
                $this->tgl_sk = $ds["tgl_sk"];
                $this->nama_pejabat_ttd_sk = $ds["nama_pejabat_ttd_sk"];
                $this->nip_pejabat_ttd_sk = $ds["nip_pejabat_ttd_sk"];
                $this->jabatan_pejabat_ttd_sk = $ds["jabatan_pejabat_ttd_sk"];
                $this->id_pangkat_pejabat_ttd_sk = $ds["id_pangkat_pejabat_ttd_sk"];
                $this->no_piagam = $ds["no_piagam"];
                $this->tgl_piagam = $ds["tgl_piagam"];
                $this->nama_presiden = $ds["nama_presiden"];
                $this->jenis_satya = $ds["jenis_satya"];
                $this->scan_sk = $ds["scan_sk"];
            }
        }
        
        public function Insert(){
            $sql = "INSERT INTO tbl_riwayat_satya_lancana(
                    	id_pegawai,
                    	no_sk,
                    	tgl_sk,
                    	nama_pejabat_ttd_sk,
                    	nip_pejabat_ttd_sk,
                    	jabatan_pejabat_ttd_sk,
                    	id_pangkat_pejabat_ttd_sk,
                        no_piagam,
                        tgl_piagam,
                        nama_presiden,
                        jenis_satya,
                    	scan_sk
                    )VALUES(
                    	'$this->id_pegawai',
                    	'$this->no_sk',
                    	'$this->tgl_sk',
                    	'$this->nama_pejabat_ttd_sk',
                    	'$this->nip_pejabat_ttd_sk',
                    	'$this->jabatan_pejabat_ttd_sk',
                    	'$this->id_pangkat_pejabat_ttd_sk',
                        '$this->no_piagam',
                        '$this->tgl_piagam',
                        '$this->nama_presiden',
                        '$this->jenis_satya',
                    	'$this->scan_sk'
                    )";
            $res = mysql_query($sql);
        }
        
        public function Update(){
            $sql = "UPDATE tbl_riwayat_satya_lancana SET
                    	id_pegawai='$this->id_pegawai',
                    	no_sk='$this->no_sk',
                    	tgl_sk='$this->tgl_sk',
                    	nama_pejabat_ttd_sk='$this->nama_pejabat_ttd_sk',
                    	nip_pejabat_ttd_sk='$this->nip_pejabat_ttd_sk',
                    	jabatan_pejabat_ttd_sk='$this->jabatan_pejabat_ttd_sk',
                    	id_pangkat_pejabat_ttd_sk='$this->id_pangkat_pejabat_ttd_sk',
                        no_piagam = '$this->no_piagam',
                        tgl_piagam = '$this->tgl_piagam',
                        nama_presiden = '$this->nama_presiden',
                        jenis_satya = '$this->jenis_satya',
                    	scan_sk='$this->scan_sk'
                    WHERE
                    	id_riwayat = '$this->id_riwayat'";
            $res = mysql_query($sql);
        }
        
        public function Delete(){
            $sql = "DELETE FROM tbl_riwayat_satya_lancana
                    WHERE
                    	id_riwayat = '$this->id_riwayat'";
            $res = mysql_query($sql);
        }
        
        public function Validation(){
            $validation_result = "";
            if($this->id_pegawai == 0){
                $validation_result = "Maaf, pegawai belum ditentukan";
            }else if($this->no_piagam == "" || $this->tgl_piagam == "" || $this->nama_presiden == ""){
                $validation_result = "Maaf, input masih belum lengkap";
            }
            
            return $validation_result;
        }
    }
    
?>