<?php

    class SKKenpang_Model{
        public $id_data;
        public $no_sk;
        public $tgl_sk;
        public $jabatan_ttd_sk;
        public $nama_ttd_sk;
        public $nip_ttd_sk;
        public $id_pangkat_ttd_sk;
		public $no_usul;
		public $scan_sk;
        public $status;
        
        public function __construct(){
            $this->id_data = 0;
            $this->no_sk = "";
            $this->tgl_sk = "0000-00-00";
            $this->jabatan_ttd_sk = "";
            $this->nama_ttd_sk = "";
            $this->nip_ttd_sk = "";
            $this->id_pangkat_ttd_sk = 0;
			$this->no_usul = "";
			$this->scan_sk = "-";
            $this->status = 0;
        }
        
        public function Record($id_data){
            $sql = "SELECT * FROM tbl_sk_kenpang WHERE id_data='" . mysql_real_escape_string($id_data) . "'";
            $res = mysql_query($sql);
            while($ds = mysql_fetch_array($res)){
                $this->id_data = $ds["id_data"];
                $this->no_sk = $ds["no_sk"];
                $this->tgl_sk = $ds["tgl_sk"];
                $this->jabatan_ttd_sk = $ds["jabatan_ttd_sk"];
                $this->nama_ttd_sk = $ds["nama_ttd_sk"];
                $this->nip_ttd_sk = $ds["nip_ttd_sk"];
                $this->id_pangkat_ttd_sk = $ds["id_pangkat_ttd_sk"];
				$this->no_usul= $ds["no_usulan_naik_pangkat"];
				$this->scan_sk = $ds["scan_sk"];
                $this->status = $ds["status_supervisi"];
            }
        }
        
        public function Insert(){
            $sql = "INSERT INTO tbl_sk_kenpang(
                    	id_data,
						no_sk,
                    	tgl_sk,
                    	jabatan_ttd_sk,
                    	nama_ttd_sk,
                    	nip_ttd_sk,
                    	id_pangkat_ttd_sk,
						no_usulan_naik_pangkat,
						scan_sk,
                    	status_supervisi
                    )VALUES(
						'$this->id_data'
                    	'$this->no_sk',
                    	'$this->tgl_sk',
                    	'$this->jabatan_ttd_sk',
                    	'$this->nama_ttd_sk',
                    	'$this->nip_ttd_sk',
                    	'$this->id_pangkat_ttd_sk',
						'$this->no_usul',
						'$this->scan_sk',
                    	'$this->status'
                    )";
            $res = mysql_query($sql);
        }
        
        public function Update(){
            $sql = "UPDATE tbl_sk_kenpang SET
                    	no_sk='$this->no_sk',
                    	tgl_sk='$this->tgl_sk',
                    	jabatan_ttd_sk='$this->jabatan_ttd_sk',
                    	nama_ttd_sk='$this->nama_ttd_sk',
                    	nip_ttd_sk='$this->nip_ttd_sk',
                    	id_pangkat_ttd_sk='$this->id_pangkat_ttd_sk',
						no_usulan_naik_pangkat='$this->no_usul',
						scan_sk='$this->scan_sk',
                    	status_supervisi='$this->status'
                    WHERE
                    	id_data = '$this->id_data'";
						
            $res = mysql_query($sql);
        }
        
        public function Delete(){
            $sql = "DELETE FROM tbl_sk_kenpang 
                    WHERE id_data = '$this->id_data'";
            $res = mysql_query($sql);
        }
        
        public function Validation(){
            $validation_result = "";
            if($this->no_sk == "" || $this->tgl_sk == "0000-00-00" || $this->nama_ttd_sk == "" ||
                $this->nip_ttd_sk == "" || $this->jabatan_ttd_sk == "" || $this->id_pangkat_ttd_sk == 0)
                $validation_result = "Maaf, input anda masih belum lengkap";
                
            return $validation_result;
        }
		
	   public function getNoUsul(){
			$sql = "SELECT no_usulan_naik_pangkat as 'no_usul' FROM tbl_sk_kenpang WHERE id_data = '$this->id_data'";
			$qr = mysql_query($sql) or die(mysql_error());
			$data = mysql_fetch_array($qr);
			
			return $data['no_usul'];
		}
    }

?>