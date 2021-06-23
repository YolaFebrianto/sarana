<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class LokasiProvider extends CI_Model{
		public function get_all()
		{
			return $this->db->get('tbllokasi');
		}

		public function get_where($where)
		{
			return $this->db->get_where('tbllokasi',$where);
		}

		public function delete($id_lokasi)
		{
			return $this->db->delete('tbllokasi',['id_lokasi'=>$id_lokasi]);
		}

		public function update($data,$where)
		{
			$this->db->where($where);
			return $this->db->update('tbllokasi',$data);
		}

		public function insert($data)
		{
			return $this->db->insert('tbllokasi',$data);
		}
	}