<?php

class Article_Model extends CI_Model
{
    public function get($key = null, $value = null)
    {
    	if (!empty($key) && !empty($value)) {
    		$this->db->where($key, $value);
    		$query = $this->db->get('news');
    		return $query->row();
    	}
        $query = $this->db->get('news');
        return $query->result();
    }
}