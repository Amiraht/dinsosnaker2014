<?php

    class SKGajiBerkala_Model{
        public $id_sk;
        public $no_sk;
        public $tgl_sk;
        public $jabatan_ttd_sk;
        public $nama_ttd_sk;
        public $nip_ttd_sk;
        public $id_pangkat_ttd_sk;
        public $status;
        
        public function __construct(){
            $this->id_sk = 0;
            $this->no_sk = "";
            $this->tgl_sk = "0000-00-00";
            $this->jabatan_ttd_sk = "";
            $this->nama_ttd_sk = "";
            $this->nip_ttd_sk = "";
            $this->id_pangkat_ttd_sk = 0;
            $this->status = 0;
        }
        
        public function Record($id_sk){
            $sql = "SELECT * FROM tbl_sk_gaji_berkala WHERE id_sk='" . $id_sk . "'";
            $res = mysql_query($sql);
            while($ds = mysql_fetch_array($res)){
                $this->id_sk = $ds["id_sk"];
                $this->no_sk = $ds["no_sk"];
                $this->tgl_sk = $ds["tgl_sk"];
                $this->jabatan_ttd_sk = $ds["jabatan_ttd_sk"];
                $this->nama_ttd_sk = $ds["nama_ttd_sk"];
                $this->nip_ttd_sk = $ds["nip_ttd_sk"];
                $this->id_pangkat_ttd_sk = $ds["id_pangkat_ttd_sk"];
                $this->status = $ds["status"];
            }
        }
        
        public function Insert(){
            $sql = "INSERT INTO tbl_sk_gaji_berkala(
                    	no_sk,
                    	tgl_sk,
                    	jabatan_ttd_sk,
                    	nama_ttd_sk,
                    	nip_ttd_sk,
                    	id_pangkat_ttd_sk,
                    	status
                    )VALUES(
                    	'$this->no_sk',
                    	'$this->tgl_sk',
                    	'$this->jabatan_ttd_sk',
                    	'$this->nama_ttd_sk',
                    	'$this->nip_ttd_sk',
                    	'$this->id_pangkat_ttd_sk',
                    	'$this->status'
                    )";
            $res = mysql_query($sql);
        }
        
        public function Update(){
            $sql = "UPDATE tbl_sk_gaji_berkala SET
                    	no_sk='$this->no_sk',
                    	tgl_sk='$this->tgl_sk',
                    	jabatan_ttd_sk='$this->jabatan_ttd_sk',
                    	nama_ttd_sk='$this->nama_ttd_sk',
                    	nip_ttd_sk='$this->nip_ttd_sk',
                    	id_pangkat_ttd_sk='$this->id_pangkat_ttd_sk',
                    	status='$this->status'
                    WHERE
                    	id_sk = '$this->id_sk'";
            $res = mysql_query($sql);
        }
        
        public function Delete(){
            $sql = "DELETE FROM tbl_sk_gaji_berkala
                    WHERE id_sk = '$this->id_sk'";
            $res = mysql_query($sql);
        }
        
        public function Validation(){
            $validation_result = "";
            if($this->no_sk == "" || $this->tgl_sk == "0000-00-00" || $this->nama_ttd_sk == "" ||
                $this->nip_ttd_sk == "" || $this->jabatan_ttd_sk == "" || $this->id_pangkat_ttd_sk == 0)
                $validation_result = "Maaf, input anda masih belum lengkap";
                
            return $validation_result;
        }
    }

?>