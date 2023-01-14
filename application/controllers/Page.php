<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Model_page');
		
		if($this->session->userdata('status')!= "login"){
			redirect(base_url('auth'));
		}
	}

	public function transaksi()
	{
    $data['title'] = 'Transaksi';
		$q = $this->db->select('*')->from('tbl_barang')->join('tbl_lokasi', 'tbl_lokasi.id_lokasi=tbl_barang.lokasi', 'left')->get();
    $data ['hasil'] = $q->result();
    $this->load->view('include/header', $data);
		$this->load->view('transaksi');
    $this->load->view('include/footer');
	}

	public function lokasi()
	{
    $data['title'] = 'Lokasi';
    $data['hasil']= $this->Model_page->tampil('tbl_lokasi')->result();
    $this->load->view('include/header', $data);
		$this->load->view('lokasi');
    $this->load->view('include/footer');
	}

	public function tambah_lokasi(){
		$nama = $_POST['lokasi'];
			$data = array(
				'nama_lokasi'=>$nama,
				);
		$this->Model_page->tambah('tbl_lokasi',$data);
		$this->session->set_flashdata('msg',
		'<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Berhasil!</strong> Menambahkan data Lokasi!!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>'
		);
		redirect(base_url('page/lokasi'));
	}

	public function update_lokasi()
	{
		$where = $_POST['id'];
		$nama = $_POST['nama'];
		$data = array(
			'nama_lokasi'=>$nama,
		);
		$this->db->where('id_lokasi',$where);
		$this->db->update('tbl_lokasi',$data);
		$this->session->set_flashdata('msg',
		'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> Merubah data barang!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>'
		);
		redirect(base_url('page/lokasi'));
	}

  public function checkout(){
		$id_barang = $_POST['id'];
		$stok = $_POST['stok'];
    $waktu = $_POST['waktu'];
		$data = array(
			'id_barang'=>$id_barang,
			'stok'=>$stok,
      'waktu_transaksi'=>$waktu
			);
		$this->Model_page->tambah('tbl_transaksi',$data);
		$this->session->set_flashdata('msg',
		'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> Melakukan Transaksi!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>'
		);
		redirect(base_url('page/transaksi'));
	}

	public function habis_pakai()
	{
    $data['title'] = 'Barang Habis Pakai';
		$data['lokasi']= $this->db->get('tbl_lokasi')->result();
		$q = $this->db->select('*')->from('tbl_barang')->join('tbl_lokasi', 'tbl_lokasi.id_lokasi=tbl_barang.lokasi', 'left')->where('jenis', 1)->get();
    $data ['hasil'] = $q->result();
    $this->load->view('include/header', $data);
		$this->load->view('habis_pakai');
    $this->load->view('include/footer');
	}

	public function tidak_habis_pakai()
	{
    $data['title'] = 'Barang Tidak Habis Pakai';
		$data['lokasi']= $this->db->get('tbl_lokasi')->result();
		$q = $this->db->select('*')->from('tbl_barang')->join('tbl_lokasi', 'tbl_lokasi.id_lokasi=tbl_barang.lokasi', 'left')->where('jenis', 2)->get();
    $data ['hasil'] = $q->result();
    $this->load->view('include/header', $data);
		$this->load->view('tidak_habis_pakai');
    $this->load->view('include/footer');
	}


  public function tambah_barang(){
		$url = $_POST['url'];
		$kode = $_POST['kode'];
		$nama = $_POST['nama'];
		$merk = $_POST['merk'];
		$jenis = $_POST['jenis'];
		$lokasi = $_POST['lokasi'];
		if($jenis ==2){
			$data = array(
				'id_barang'=>$kode,
				'nama_barang'=>$nama,
				'lokasi'=>$lokasi,
				'jenis'=>$jenis,
				'merk'=>$merk,
				'stok_barang'=>0
				);
		}else{
			$data = array(
				'id_barang'=>$kode,
				'nama_barang'=>$nama,
				'lokasi'=>$lokasi,
				'jenis'=>$jenis,
				'stok_barang'=>0
				);
		}
		$this->Model_page->tambah('tbl_barang',$data);
		$this->session->set_flashdata('msg',
		'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> Menambahkan data barang!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>'
		);
		redirect(base_url('page/'.$url.''));
	}

  public function tambah_stok(){
		$url = $_POST['url'];
		$id_barang = $_POST['id'];
		$stok = $_POST['stok'];
    $waktu = date("Y-m-d");
		$data = array(
			'id_barang'=>$id_barang,
			'stok'=>$stok,
      'waktu_suply'=>$waktu
			);
		$this->Model_page->tambah('tbl_suply',$data);
		$this->session->set_flashdata('msg',
		'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> Menambahkan stok barang!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>'
		);
		redirect(base_url('page/'.$url.''));
	}

	public function update_barang()
	{
		$id = $_POST['id'];
		$where = array('id_barang' => $id);
		$nama = $_POST['nama'];
		$harga = $_POST['harga'];
		$data = array(
			'nama_barang'=>$nama,
			'harga_barang'=>$harga,
		);
		$this->db->update('tbl_barang',$data,$where);
		$this->session->set_flashdata('msg',
		'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> Merubah data barang!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>'
		);
		redirect(base_url('page/barang'));
	}
	
	function hapus($id, $url)
	{
		$where = array('id_barang'=>$id);
		$this->Model_page->hapus('tbl_barang',$where);
		$this->session->set_flashdata('msg',
		'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> Menghapus data barang!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>'
		);
		redirect(base_url('page/'.$url.''));
	}

  public function laporan_suply()
	{
    $data['title'] = 'Laporan Suply';
		$data['hasil']= $this->Model_page->data_suply()->result();
    $this->load->view('include/header', $data);
		$this->load->view('laporan_suply');
    $this->load->view('include/footer');
	}

  public function laporan_transaksi()
	{
    $data['title'] = 'Laporan Transaksi';
		$data['hasil']= $this->Model_page->data_transaksi()->result();
    $this->load->view('include/header', $data);
		$this->load->view('laporan_transaksi');
    $this->load->view('include/footer');
	}

  public function user()
	{
    $data['title'] = 'Manajemen User';
    $data['hasil']= $this->Model_page->tampil('tbl_users')->result();
    $this->load->view('include/header', $data);
		$this->load->view('user');
    $this->load->view('include/footer');
	}

	public function tambah_user()
	{
		$nama = $_POST['nama'];
		$jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
		$username = $_POST['username'];
    $password = $_POST['password'];
		$level = $_POST['level'];
		$data = array(
			'nama'=>$nama,
			'jenis_kelamin'=>$jk,
			'alamat'=>$alamat,
			'username'=>$username,
      'password'=>md5($password),
			'level'=>$level
			);
		$this->Model_page->tambah('tbl_users',$data);
		$this->session->set_flashdata('msg',
		'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> Menambahkan user!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>'
		);
		redirect(base_url('page/user'));
	}

	function hapus_user($id)
	{
		$where = array('id'=>$id);
		$this->Model_page->hapus('tbl_users',$where);
		$this->session->set_flashdata('msg',
		'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> Menghapus data user!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>'
		);
		redirect(base_url('page/user'));
	}
}
