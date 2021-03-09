<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('username')) && ($this->uri->segment(2)!='index') && ($this->uri->segment(2)!='prosesLogin')) {
			redirect('user/index');
		}
	}
	public function index()
	{
		// JIKA SESSION USERNAME ADA/ SDH LOGIN
		// HLM AWAL
		if ($this->session->userdata('username') != '') {
			$query = $this->db->get('tblbarang');
			$data['jumlahData'] = $query->num_rows();
			$data['barang']		= $query->result();
			$data['jumlahTunggu'] = $this->db->get_where('tblbarang',['status'=>0])->num_rows();
			$data['jumlahTolak'] = $this->db->get_where('tblbarang',['status'=>1])->num_rows();
			$data['jumlahValidasi'] = $this->db->get_where('tblbarang',['status'=>2])->num_rows();
			$data['jumlahSetujui'] = $this->db->get_where('tblbarang',['status'=>3])->num_rows();
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
		$cek = $this->db->get_where('tbluser',$where)->row_array();
		// Cek data pada tabel, JIKA ada maka BUAT SESSION utk Login
		if ($cek != null) {
			$this->session->set_userdata('username',$username);
			redirect();
		} else {
		// JIKA data tdk ditemukan BUAT SESSION utk mengambalikan error
			$this->session->set_flashdata('error','User ID atau Password Salah!');
			redirect();
		}
	}
	public function barang_disetujui(){
		// BARANG DISETUJUI KEPALA SEKOLAH
		$query = $this->db->get_where('tblbarang',['status'=>3]);
		$data['jumlahData'] = $query->num_rows();
		$data['barang']		= $query->result();
		$this->load->view('user/header');
		$this->load->view('user/barang_disetujui',$data);
		$this->load->view('user/footer');
	}
	public function barang_masuk(){
		// BARANG MASUK (HASIL INPUT STAFF)
		$query = $this->db->get_where('tblbarang',['status'=>0]);
		$data['jumlahData'] = $query->num_rows();
		$data['barang']		= $query->result();
		$this->load->view('user/header');
		$this->load->view('user/barang_masuk',$data);
		$this->load->view('user/footer');
	}
	public function barang_divalidasi(){
		// BARANG DIVALIDASI WAKA
		$query = $this->db->get_where('tblbarang',['status'=>1]);
		$data['jumlahData'] = $query->num_rows();
		$data['barang']		= $query->result();
		$this->load->view('user/header');
		$this->load->view('user/barang_validasi',$data);
		$this->load->view('user/footer');
	}
	public function barang_ditolak(){
		// BARANG DITOLAK WAKA
		$query = $this->db->get_where('tblbarang',['status'=>2]);
		$data['jumlahData'] = $query->num_rows();
		$data['barang']		= $query->result();
		$this->load->view('user/header');
		$this->load->view('user/barang_ditolak',$data);
		$this->load->view('user/footer');
	}
	public function printPDF(){
		$tahun=0;
		if (!empty($this->input->post('tahun'))) {
			$tahun = $this->input->post('tahun');
		}
		$data['tahun'] = $tahun;
		$data['barang'] = $this->db->get_where('tblbarang',['status'=>3,'YEAR(tanggal_masuk)'=>$tahun])->result();
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
		$footerData['jumlahData'] = $this->db->get('tblbarang')->num_rows();
		$this->load->view('user/header');
		$this->load->view('user/form-add');	
		$this->load->view('user/footer',$footerData);
	}
	public function add(){
		$data = [
			'tanggal_masuk' => date('Y-m-d'),
			'kode_barang'	=> $this->input->post('kode_barang'),
			'nama_barang'	=> $this->input->post('nama_barang'),
			'lokasi_barang'	=> $this->input->post('lokasi_barang'),
			'jumlah_barang'	=> $this->input->post('jumlah_barang'),
			'kondisi_barang'=> $this->input->post('kondisi_barang'),
			'jenis_barang'	=> $this->input->post('jenis_barang'),
			'sumber_dana'	=> $this->input->post('sumber_dana'),
			'keterangan'	=> $this->input->post('keterangan'),
		];
		$cek = $this->db->insert('tblbarang',$data);
		if ($cek) {
			$this->session->set_flashdata('info','Data Berhasil Ditambahkan!');
		} else {
			$this->session->set_flashdata('error','Data Gagal Ditambahkan!');
		}
		redirect('user/barang_masuk');
	}
	public function form_edit($no){
		$footerData['jumlahData'] = $this->db->get('tblbarang')->num_rows();
		$data['edit'] = $this->db->get_where('tblbarang',['no'=>$no])->row_array();
		$this->load->view('user/header');
		$this->load->view('user/form-edit',$data);	
		$this->load->view('user/footer',$footerData);
	}
	public function edit(){
		$data = [
			'tanggal_masuk' => date('Y-m-d'),
			'kode_barang'	=> $this->input->post('kode_barang'),
			'nama_barang'	=> $this->input->post('nama_barang'),
			'lokasi_barang'	=> $this->input->post('lokasi_barang'),
			'jumlah_barang'	=> $this->input->post('jumlah_barang'),
			'kondisi_barang'=> $this->input->post('kondisi_barang'),
			'jenis_barang'	=> $this->input->post('jenis_barang'),
			'sumber_dana'	=> $this->input->post('sumber_dana'),
			'keterangan'	=> $this->input->post('keterangan'),
		];
		$this->db->where('no',$this->input->post('no'));
		$cek = $this->db->update('tblbarang',$data);
		if ($cek) {
			$this->session->set_flashdata('info','Data Berhasil Diubah!');
		} else {
			$this->session->set_flashdata('error','Data Gagal Diubah!');
		}
		redirect('user/barang_masuk');
	}
	public function edit_status($no,$status=0){
		$data = [
			'status' => $status,
		];
		$this->db->where('no',$no);
		$cek = $this->db->update('tblbarang',$data);
		if ($cek) {
			$this->session->set_flashdata('info','Data Berhasil Diubah!');
		} else {
			$this->session->set_flashdata('error','Data Gagal Diubah!');
		}
		$url='user/barang_disetujui';
		if ($status==1) {
			$url='user/barang_validasi';
		} else if ($status==2) {
			$url='user/barang_ditolak';
		}
		redirect($url);
	}
	public function delete($no){
		$cek = $this->db->delete('tblbarang',['no'=>$no]);
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
}
