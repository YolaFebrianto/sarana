<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class FotoProvider extends CI_Model{
		public function get_all()
		{
			return $this->db->get('tblfoto');
		}

		public function get_where($where)
		{
			return $this->db->get_where('tblfoto',$where);
		}

		public function delete($id_foto)
		{
			return $this->db->delete('tblfoto',['id_foto'=>$id_foto]);
		}

		public function update($data,$where)
		{
			$this->db->where($where);
			return $this->db->update('tblfoto',$data);
		}

		public function insert($data)
		{
			return $this->db->insert('tblfoto',$data);
		}
	}