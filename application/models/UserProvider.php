<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class UserProvider extends CI_Model{
		public function get_all()
		{
			return $this->db->get('tbluser');
		}

		public function get_where($where)
		{
			return $this->db->get_where('tbluser',$where);
		}

		public function delete($id)
		{
			return $this->db->delete('tbluser',['id'=>$id]);
		}

		public function update($data,$where)
		{
			$this->db->where($where);
			return $this->db->update('tbluser',$data);
		}

		public function insert($data)
		{
			return $this->db->insert('tbluser',$data);
		}
	}