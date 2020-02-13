<?php

class Web extends CI_Model{

		public function get_blog()
		{
			$this->db->limit(3);
			$this->db->order_by("RAND ()");
			$query = $this->db->get("tbl_blog");
			return $query->result();
		}
	}