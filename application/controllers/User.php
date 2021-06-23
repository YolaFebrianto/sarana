<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		parent::__construct();
		$this->load->model('UserProvider');
		$this->load->model('BarangProvider');
		$this->load->model('KelolaProvider');
		$this->load->model('LokasiProvider');
		$this->load->model('BarangGudangProvider');
		if (empty($this->session->userdata('username')) && ($this->uri->segment(2)!='index') && ($this->uri->segment(2)!='prosesLogin')) {
			redirect('user/index');
		}
	}
	public function index()
	{
		// JIKA SESSION USERNAME ADA/ SDH LOGIN
		// HLM AWAL
		if ($this->session->userdata('username') != '') {
			$query = $this->BarangProvider->get_where2([]);
			#$data['jumlahData'] = $query->num_rows();
			$data['barang']		= $query->result();
			$data['jumlahTunggu'] = $this->BarangProvider->get_where(['status'=>0])->num_rows();
			$data['jumlahValidasi'] = $this->BarangProvider->get_where(['status'=>1])->num_rows();
			$data['jumlahTolak'] = $this->BarangProvider->get_where(['status'=>2])->num_rows();
			$data['jumlahSetujui'] = $this->BarangProvider->get_where(['status'=>3])->num_rows();
			$this->load->view('user/header');
			$this->load->view('user/home',$data);
			$this->load->view('user/footer');
		} else {
			// JIKA SESSION USERNAME BLM ADA/ BLM LOGIN
			// HLM LOGIN
			$this->load->view('user/login');
		}
	}
	public function prosesLogin()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$where = [
			'username' => $username,
			'password' => $password,
			'status'   => 1
		];
		$cek = $this->UserProvider->get_where($where)->row_array();
		// Cek data pada tabel, JIKA ada maka BUAT SESSION utk Login
		if ($cek != null) {
			$this->session->set_userdata('username',$username);
			redirect();
		} else {
		// JIKA data tdk ditemukan BUAT SESSION utk mengambalikan error
			$this->session->set_flashdata('error','User ID atau Password Salah!');
			$this->session->set_flashdata('user_login',$username);
			redirect('user/index');
		}
	}
	public function barang_disetujui(){
		// BARANG DISETUJUI KEPALA SEKOLAH
		$query = $this->BarangProvider->get_where2(['status'=>3]);
		#$data['jumlahData'] = $query->num_rows();
		$data['barang']		= $query->result();
		$queryLokasi = $this->LokasiProvider->get_all();
		$data['lokasi_barang'] = $queryLokasi->result();
		$this->load->view('user/header');
		$this->load->view('user/barang_disetujui',$data);
		$this->load->view('user/footer');
	}
	public function barang_masuk(){
		// BARANG MASUK (HASIL INPUT STAFF)
		$query = $this->BarangProvider->get_where2(['status'=>0]);
		#$data['jumlahData'] = $query->num_rows();
		$data['barang']		= $query->result();
		$this->load->view('user/header');
		$this->load->view('user/barang_masuk',$data);
		$this->load->view('user/footer');
	}
	public function barang_divalidasi(){
		// BARANG DIVALIDASI WAKA
		$query = $this->BarangProvider->get_where2(['status'=>1]);
		#$data['jumlahData'] = $query->num_rows();
		$data['barang']		= $query->result();
		$this->load->view('user/header');
		$this->load->view('user/barang_validasi',$data);
		$this->load->view('user/footer');
	}
	public function barang_ditolak(){
		// BARANG DITOLAK WAKA
		$query = $this->BarangProvider->get_where2(['status'=>2]);
		#$data['jumlahData'] = $query->num_rows();
		$data['barang']		= $query->result();
		$this->load->view('user/header');
		$this->load->view('user/barang_ditolak',$data);
		$this->load->view('user/footer');
	}
	public function printPDF(){
		$tahun=0;
		$lokasi="";
		if (!empty($this->input->post('tahun'))) {
			$tahun = $this->input->post('tahun');
		}
		$data['tahun'] = $tahun;
		if (!empty($this->input->post('lokasi_barang'))) {
			$lokasi = $this->input->post('lokasi_barang');
		    $data['barang'] = $this->BarangProvider->get_where2(['status'=>3,'YEAR(tanggal_masuk)'=>$tahun,'tblbarang.id_lokasi'=>$lokasi])->result();
		} else {
		    $data['barang'] = $this->BarangProvider->get_where2(['status'=>3,'YEAR(tanggal_masuk)'=>$tahun])->result();
		}
		$this->load->view('user/cetak-pdf',$data);
		$html = $this->output->get_output();
		// $this->load->library('dompdf_gen');

		// $this->dompdf->load_html($html);
		// $this->dompdf->render();
		// $this->dompdf->stream("Data Sarana Prasarana SMK Muhammadiyah 1 Malang.pdf",array('Attachment'=>0));
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
        $dompdf = new DOMPDF();
        $filename = "Data Sarana Prasarana SMK Muhammadiyah 1 Malang.pdf";
        $dompdf->load_html($html);
        $dompdf->set_paper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename,array("Attachment"=>false));
	}
	public function form_add(){
		#$footerData['jumlahData'] = $this->BarangProvider->get_all()->num_rows();
		$queryLokasi = $this->LokasiProvider->get_all();
		$data['lokasi'] = $queryLokasi->result();
		$this->load->view('user/header');
		$this->load->view('user/form-add',$data);	
		$this->load->view('user/footer');
	}
	public function add(){
        try {
        	$uploads_name = $this->upload();
        } catch (Exception $e) {
        	$this->session->set_flashdata('error','Gambar Gagal Diupload! Pastikan format filenya jpg, jpeg, png, atau gif. Dan pastikan ukuran file < 8Mb');
        	redirect('user/form_add');
        }
        $lokasi = $this->LokasiProvider->get_where(['id_lokasi'=>$this->input->post('id_lokasi')])->row_array();
		$data = [
			'tanggal_masuk' => $this->input->post('tanggal_masuk'),
			'kode_barang'	=> $this->input->post('kode_barang'),
			'nama_barang'	=> $this->input->post('nama_barang'),
			'foto_barang'	=> $uploads_name,
			'lokasi_barang'	=> $lokasi['lokasi_barang'],
			'id_lokasi'		=> $this->input->post('id_lokasi'),
			'jumlah_barang'	=> $this->input->post('jumlah_barang'),
			'kondisi_barang'=> $this->input->post('kondisi_barang'),
			'jenis_barang'	=> $this->input->post('jenis_barang'),
			'sumber_dana'	=> $this->input->post('sumber_dana'),
			'keterangan'	=> $this->input->post('keterangan'),
		];
		try {
			$cek = $this->BarangProvider->insert($data);
			// INSERT KE TABEL KELOLA
			$user = $this->session->get_userdata('username');
			$userData = $this->UserProvider->get_where(['username'=>$user['username']])->row_array();
			$barangData = $this->BarangProvider->get_where2(['kode_barang'=>$this->input->post('kode_barang')])->row_array();
			$kelola = [
				'id_pengguna' => $userData['id_pengguna'],
				'id_barang' => $barangData['id_barang'],
				'tanggal' => date('Y-m-d H:i:s'),
				'status' => 'Masuk',
			];
			$cek2 = $this->KelolaProvider->insert($kelola);
			if ($cek) {
				$this->session->set_flashdata('info','Data Berhasil Ditambahkan!');
			} else {
				$this->session->set_flashdata('error','Data Gagal Ditambahkan!');
			}	
		} catch (Exception $e) {
			$this->session->set_flashdata('error','Data Gagal Ditambahkan!');
		}
		redirect('user/barang_masuk');
	}
	public function form_edit($no){
		#$footerData['jumlahData'] = $this->BarangProvider->get_all()->num_rows();
		$data['edit'] = $this->BarangProvider->get_where2(['id_barang'=>$no])->row_array();
		$queryLokasi = $this->LokasiProvider->get_all();
		$data['lokasi'] = $queryLokasi->result();
		$this->load->view('user/header');
		$this->load->view('user/form-edit',$data);	
		$this->load->view('user/footer');
	}
	public function edit(){
        $lokasi = $this->LokasiProvider->get_where(['id_lokasi'=>$this->input->post('id_lokasi')])->row_array();
		$data = [
			'tanggal_masuk' => $this->input->post('tanggal_masuk'),
			'kode_barang'	=> $this->input->post('kode_barang'),
			'nama_barang'	=> $this->input->post('nama_barang'),
			'lokasi_barang'	=> $lokasi['lokasi_barang'],
			'id_lokasi'		=> $this->input->post('id_lokasi'),
			'jumlah_barang'	=> $this->input->post('jumlah_barang'),
			'kondisi_barang'=> $this->input->post('kondisi_barang'),
			'jenis_barang'	=> $this->input->post('jenis_barang'),
			'sumber_dana'	=> $this->input->post('sumber_dana'),
			'keterangan'	=> $this->input->post('keterangan'),
			'status'		=> 0,
		];
		// $this->db->where('no',$this->input->post('no'));
		$where = [
			'id_barang' => $this->input->post('id_barang'),
		];
		try {
			$cek = $this->BarangProvider->update($data,$where);
			if ($this->input->post('status')>0) {
				// INSERT KE TABEL KELOLA
				$user = $this->session->get_userdata('username');
				$userData = $this->UserProvider->get_where(['username'=>$user['username']])->row_array();
				$kelola = [
					'id_pengguna' => $userData['id_pengguna'],
					'id_barang' => $this->input->post('id_barang'),
					'tanggal' => date('Y-m-d H:i:s'),
					'status' => 'Masuk',
				];
				$cek2 = $this->KelolaProvider->insert($kelola);
			}
			if ($cek) {
				$this->session->set_flashdata('info','Data Berhasil Diubah!');
			} else {
				$this->session->set_flashdata('error','Data Gagal Diubah!');
			}
		} catch (Exception $e) {
			$this->session->set_flashdata('error','Data Gagal Diubah!');
		}
		redirect('user/barang_masuk');
	}
	public function edit_status($id_barang,$status=0){
		$data = [
			'status' => $status,
		];
		// $this->db->where('no',$no);
		$where = [
			'id_barang' => $id_barang,
		];
		try {
			$cek = $this->BarangProvider->update($data,$where);
			// INSERT KE TABEL KELOLA
			$user = $this->session->get_userdata('username');
			$userData = $this->UserProvider->get_where(['username'=>$user['username']])->row_array();
			if ($status==3) {
				$statusText = "Disetujui";
			} else if ($status==2) {
				$statusText = "Ditolak";
			} else if ($status==1) {
				$statusText = "Divalidasi";
			} else {
				$statusText = "Masuk";
			} 
			$kelola = [
				'id_pengguna' => $userData['id_pengguna'],
				'id_barang' => $id_barang,
				'tanggal' => date('Y-m-d H:i:s'),
				'status' => $statusText,
			];
			$cek2 = $this->KelolaProvider->insert($kelola);
			if ($cek) {
				$this->session->set_flashdata('info','Data Berhasil Diubah!');
			} else {
				$this->session->set_flashdata('error','Data Gagal Diubah!');
			}
		} catch (Exception $e) {
			$this->session->set_flashdata('error','Data Gagal Diubah!');
		}
		$url='user/barang_disetujui';
		if ($status==1) {
			$url='user/barang_divalidasi';
		} else if ($status==2) {
			$url='user/barang_ditolak';
		}
		redirect($url);
	}
	public function delete($id_barang){
		$cek = $this->BarangProvider->delete($id_barang);
		if ($cek) {
			$this->session->set_flashdata('info', 'Data Berhasil Dihapus!');
		}
		redirect('user/barang_masuk');
	}
	public function logout(){
		// HAPUS SEMUA SESSION DAN REDIRECT KE INDEX
		$this->session->sess_destroy();
		redirect();
	}
	// [2021/06/09] DATA BARANG GUDANG DAN BARANG RUSAK
	public function barang_gudang(){
		// $query = $this->db->get_where('tblbarang_gudang',['status'=>0]);
		$query 			= $this->BarangGudangProvider->get(0);
		$data['barang']	= $query->result();
		$this->load->view('user/header');
		$this->load->view('user/barang_gudang',$data);
		$this->load->view('user/footer');
	}
	public function barang_rusak(){
		// $query = $this->db->get_where('tblbarang_gudang',['status'=>1]);
		$query 			= $this->BarangGudangProvider->get(1);
		$data['barang']	= $query->result();
		$this->load->view('user/header');
		$this->load->view('user/barang_rusak',$data);
		$this->load->view('user/footer');
	}
	public function masukkan_gudang(){
		$id_barang = $this->input->post('id_barang'); 
		$dataMaster = $this->BarangProvider->get_where2(['id_barang'=>$id_barang])->row_array();
		if ($dataMaster['jumlah_barang'] > $this->input->post('stok_gudang')) {
			$data = [
				'id_barang' 			=> $id_barang,
				'kode_barang' 			=> $this->input->post('kode_barang'),
				'tanggal_masuk_gudang' 	=> date('Y-m-d'),
				'jumlah_barang' 		=> $this->input->post('stok_gudang'),
				'kondisi_barang' 		=> $this->input->post('kondisi_barang'),
				'status'				=> 0,
			];
			$insert = $this->BarangGudangProvider->insert($data);
			$stok_baru = $dataMaster['jumlah_barang'] - $this->input->post('stok_gudang');
			$update = $this->BarangProvider->update(['jumlah_barang'=>$stok_baru],['id_barang'=>$id_barang]);
		} else {
			$this->session->set_flashdata('error','Jumlah Barang Tidak Mencukupi!');
		}
		redirect('user/barang_gudang');
	}
	public function edit_status_gudang($id_barang_gudang){
		$data = [
			'kondisi_barang' => 'Barang Rusak',
			'status' => 1,
		];
		// $this->db->where('no',$no);
		$where = [
			'id_barang_gudang' => $id_barang_gudang,
		];
		try {
			$cek = $this->BarangGudangProvider->update($data,$where);
			$this->session->set_flashdata('info','Data Berhasil Diubah!');
		} catch (Exception $e) {
			$this->session->set_flashdata('error','Data Gagal Diubah!');
		}
		$url='user/barang_rusak';
		redirect($url);
	}
	public function pengembalian_gudang($id_barang_gudang){
		$dataGudang = $this->BarangGudangProvider->get_where(['id_barang_gudang'=>$id_barang_gudang])->row_array();
		//idbarang master
		$id_barang = @$dataGudang['id_barang'];
		$dataMaster = $this->BarangProvider->get_where2(['id_barang'=>$id_barang])->row_array();
		if ($dataGudang['jumlah_barang'] > 0) {
			try {
				$data = [
					'id_barang' 			=> $id_barang_gudang,
					'kode_barang' 			=> $this->input->post('kode_barang'),
					'tanggal_masuk_gudang' 	=> date('Y-m-d'),
					'jumlah_barang' 		=> $this->input->post('stok_gudang'),
					'kondisi_barang' 		=> "Barang Gudang",
					'status'				=> 0,
				];
				$stok_baru = $dataGudang['jumlah_barang']+$dataMaster['jumlah_barang'];
				$update = $this->BarangProvider->update(['jumlah_barang'=>$stok_baru],['id_barang'=>$id_barang]);
				$delete = $this->BarangGudangProvider->delete($id_barang_gudang);
				redirect('user/barang_disetujui');
			} catch (Exception $e) {
				$this->session->set_flashdata('error','Batal Barang Gagal!');
			}
		} else {
			$this->session->set_flashdata('error','Jumlah Barang Tidak Mencukupi!');
		}
		redirect('user/barang_gudang');
	}
	public function delete_gudang($id_barang_gudang){
		$cek = $this->BarangGudangProvider->delete($id_barang_gudang);
		if ($cek) {
			$this->session->set_flashdata('info', 'Data Berhasil Dihapus dari Gudang!');
		}
		redirect('user/barang_rusak');
	}
	public function printGudangPDF(){
		$tahun=0;
		if (!empty($this->input->post('tahun'))) {
			$tahun = $this->input->post('tahun');
		}
		$data['tahun'] = $tahun;
		$data['barang'] = $this->BarangGudangProvider->get(0)->result();
		$this->load->view('user/cetak-gudang-pdf',$data);
		$html = $this->output->get_output();
		// $this->load->library('dompdf_gen');

		// $this->dompdf->load_html($html);
		// $this->dompdf->render();
		// $this->dompdf->stream("Data Sarana Prasarana SMK Muhammadiyah 1 Malang.pdf",array('Attachment'=>0));
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
        $dompdf = new DOMPDF();
        $filename = "Data Barang Gudang SMK Muhammadiyah 1 Malang.pdf";
        $dompdf->load_html($html);
        $dompdf->set_paper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename,array("Attachment"=>false));
	}
	public function printBrgRusakPDF(){
		$tahun=0;
		if (!empty($this->input->post('tahun'))) {
			$tahun = $this->input->post('tahun');
		}
		$data['tahun'] = $tahun;
		$data['barang'] = $this->BarangGudangProvider->get(1)->result();
		$this->load->view('user/cetak-brg-rusak-pdf',$data);
		$html = $this->output->get_output();
		// $this->load->library('dompdf_gen');

		// $this->dompdf->load_html($html);
		// $this->dompdf->render();
		// $this->dompdf->stream("Data Sarana Prasarana SMK Muhammadiyah 1 Malang.pdf",array('Attachment'=>0));
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
        $dompdf = new DOMPDF();
        $filename = "Data Barang Rusak SMK Muhammadiyah 1 Malang.pdf";
        $dompdf->load_html($html);
        $dompdf->set_paper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename,array("Attachment"=>false));
	}
    function upload() {
        $config['upload_path'] = './template/uploads/';
        $config['allowed_types'] = 'jpeg|jpg|png|gif';
        $config['max_size'] = 8000;
        $this->load->library('upload', $config);
        $this->upload->do_upload('foto_barang');
        $uploads = $this->upload->data();
        return $uploads['file_name'];
    }
}
