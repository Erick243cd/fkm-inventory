<?php
class User_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_users(){
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('lq_users');
        return $query->result_array();
    }
    public function get_users_home($limit=6){
        if($limit){
            $this->db->limit($limit);
        }
        $this->db->order_by('pseudo');
        $query = $this->db->get('lq_users');
        return $query->result_array();
    }
    public function get_user_id($id){
        $query=$this->db->get_where('lq_users', array('id'=>$id));
        return $query->row_array();
    }
    public function update_user($user_image){
        $password = $this->input->post('password');
        if(empty($password)){
            $data = array(
                'user_name'=>$this->input->post('username'),
                'user_image'=>$user_image
            );
        }else{
            $data = array(
                'user_name'=>$this->input->post('name'),
                'password'=>password_hash($password, PASSWORD_BCRYPT),
                'user_image'=>$user_image
            );
        }
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('lq_users', $data);
    }

    public function create_user(){
        $data = array(
            'user_name'=>$this->input->post('username'),
            'role_utilisateur'=>$this->input->post('role_user'),
            'password'=>password_hash('123456789', PASSWORD_BCRYPT),
            'user_image'=>'noimage_user.png'
        );
        return $this->db->insert('lq_users', $data);
    
    }  
    

    public function get_user_by_sessions(){
        $session_data= $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        if(empty($data['id'])){
            return false;
        }else{
            $query=$this->db->get_where('lq_users',array('id'=>$data['id']));
            return $query->row_array();
        }
    }
    public function update_user_compte(){
        $data = array(
            'statut'=>$this->input->post('statut'),
            'role_utilisateur'=>$this->input->post('role_user')
        );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('lq_users', $data);
    }
}

