<?php 

/**
 * summary
 */
class User_Model extends CI_Model
{
    /**
     * summary
     */
    public $table  = 'users';

    public function __construct()
    {
        parent::__construct();
    }
    public function get($key = null, $value = null)
    {
    	if ( !empty($key) && !empty($value)) {
    		$this->db->where($key, $value);
    		$query = $this->db->get($this->table);
    		return $query->row();
    	}
    	$query = $this->db->get($this->table);
    	return $query->result();
    }
    public function create()
    {
    	$data = [
    		'username' 	=> $this->input->post('username'),
    		'password'	=> password_hash($this->input->post('password'), PASSWORD_DEFAULT)
    	];
    	if ( empty($this->get('username',  $this->input->post('username')))) {
            if ($this->db->insert($this->table, $data)) {
            return [
                'id'        => $this->db->insert_id(),
                'success'   => true,
                'message'   => 'data berhasil ditambahkan'
                ];
            }   
        }else{
            return [
                'id'        => null,
                'success'   => false,
                'message'   => 'username sudah ada'
            ];
        }
    	return [
            'id'        => null,
    		'success'	=> false,
    		'message'	=> 'error'
    	];
    }
    public function update($key, $value)
    {
        if (empty($key) && empty($value)) {
            return [
                'id'        => null,
                'success'   => false,
                'message'   => 'data gagal di update'
            ];
        }else{
            $data = [
                'username'  => $this->input->post('username'),
                'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];
            if ($this->db->where($key, $value)->update($this->table, $data)) {
                return [
                    'id'        => $value,
                    'success'   => true,
                    'message'   => 'data berhasil di update'
                ];
            }
        }
    }
}