<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class BarangProvider extends CI_Model{
		public function get_all()
		{
			return $this->db->get('tblbarang');
		}

		public function get_where2($where=array())
		{
			if (!empty($where)) {
				$this->db->where($where);
			}
			$query = $this->db->select('tblbarang.*, tbllokasi.id_lokasi as l_id_lokasi, tbllokasi.lokasi_barang as l_lokasi_barang')->from('tblbarang')->join('tbllokasi','tblbarang.id_lokasi = tbllokasi.id_lokasi','LEFT')->get();
			return $query;
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