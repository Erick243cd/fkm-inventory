<?php
/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 21/10/2020
 * Time: 19:38
 */
class Categorie_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    function fetch(){
        $this->db->order_by('id_categorie', 'DESC');
        $query= $this->db->get_where('lq_categories', array('deleted'=>'not'));
        return $query->result();
    }
}