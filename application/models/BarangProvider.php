<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class BarangProvider extends CI_Model{
		public function get_all()
		{
			return $this->db->get('tblbarang');
		}

		public function get_where($where)
		{
			return $this->db->get_where('tblbarang',$where);
		}

		public function delete($id_barang)
		{
			return $this->db->delete('tblbarang',['id_barang'=>$id_barang]);
		}

		public function update($data,$where)
		{
			$this->db->where($where);
			return $this->db->update('tblbarang',$data);
		}

		public function insert($data)
		{
			return $this->db->insert('tblbarang',$data);
		}
	}