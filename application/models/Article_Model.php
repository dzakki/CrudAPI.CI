<?php

class Article_Model extends CI_Model
{
    public $table = 'news';
    public function get($key = null, $value = null)
    {
    	if (!empty($key) && !empty($value)) {
    		$this->db->where($key, $value);
    		$query = $this->db->get('news');
    		return $query->row();
    	}
        $query = $this->db->get($this->table);
        return $query->result();
    }
    public function create()
    {
        $data = [
            'title' => $this->input->post('title'),
            'slug' => $this->input->post('slug'),
            'text' => $this->input->post('text')
        ];
        if ($this->db->insert($this->table, $data)) {
            return [
                'id'        => $this->db->insert_id(),
                'success'   => true,
                'message'   => 'data berhasi di masukkan'
            ];
        }
    }
    public function update($key, $value)
    {
        if (empty($this->get($key, $value))) {
            return [
                    'success'   => false,
                    'message'   => 'data gagal di update'
                ];
        }else{
            $data = array(
                'title'    => $this->input->post('title'),
                'slug'     => $this->input->post('slug'),
                'text'     => $this->input->post('text')
            );
            $this->db->where($key, $value);
            $this->db->update($this->table, $data);
            return  [
                    'id'        => $value,
                    'success'   => true,
                    'message'   => 'data berhasi di update'
                ];
        }
    }
    public function delete($key, $value)
    {
        if (empty($this->get($key, $value))) {
            return [
                    'success'   => false,
                    'message'   => 'data gagal di hapus'
                ];
        }else{
            $this->db->where($key, $value)->delete($this->table);
            return [
                    'id'        => $value,
                    'success'   => true,
                    'message'   => 'data berhasi di hapus'
                ];
        }
    }

}