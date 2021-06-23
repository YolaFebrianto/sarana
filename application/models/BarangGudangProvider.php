<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class BarangGudangProvider extends CI_Model{
		public function get($status){
			return $this->db->select('tblbarang_gudang.*,tblbarang.nama_barang')->from('tblbarang_gudang')->join('tblbarang','tblbarang_gudang.id_barang = tblbarang.id_barang')->where('tblbarang_gudang.status',$status)->get();
		}

		public function get_where($where)
		{
			return $this->db->get_where('tblbarang_gudang',$where);
		}

		public function delete($id_barang)
		{
			return $this->db->delete('tblbarang_gudang',['id_barang_gudang'=>$id_barang]);
		}

		public function update($data,$where)
		{
			$this->db->where($where);
			return $this->db->update('tblbarang_gudang',$data);
		}

		public function insert($data)
		{
			return $this->db->insert('tblbarang_gudang',$data);
		}
	}