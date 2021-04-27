<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class KelolaProvider extends CI_Model{
		public function get_all()
		{
			return $this->db->get('tblkelola');
		}

		public function get_where($where)
		{
			return $this->db->get_where('tblkelola',$where);
		}

		public function delete($id_kelola)
		{
			return $this->db->delete('tblkelola',['id_kelola'=>$id_kelola]);
		}

		public function update($data,$where)
		{
			$this->db->where($where);
			return $this->db->update('tblkelola',$data);
		}

		public function insert($data)
		{
			return $this->db->insert('tblkelola',$data);
		}
	}