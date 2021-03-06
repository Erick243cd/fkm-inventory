<?php
    class Commande_model extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }
        public function create_commande($data){

            return $this->db->insert('lq_factures', $data);
        }

        function update_solde($data){
            return $this->db->update('lq_soldes', $data);
        }

        function getSolde(){
            $this->db->limit(1);
            return $this->db->get('lq_soldes')->row_array();
        }


        public function get_commandes($limit=FALSE, $offset=FALSE){

                if($limit){
                    $this->db->limit($limit, $offset);
                }
                $this->db->group_by('fact_token');
                $this->db->order_by('id_facture','DESC');
                return $this->db->get("lq_factures")->result();;
                
        }
        public function delete_commande($id){

            $this->db->where('id',$id);
            return $this->db->delete('commandes');
            
        }
        function factureDetails($fact_token){
            $this->db->join('lq_articles', 'lq_articles.id_article=lq_factures.id_article');
            return $this->db->get_where("lq_factures", array('fact_token'=>$fact_token))->result();
           
        }

        function factureDetail($fact_token){
            $this->db->limit(1);
           return $this->db->get_where("lq_factures", array('fact_token'=>$fact_token))->row_array();  
        }

        function facturesByarticle($request){
            if (isset($request)) {
                $this->db->where('date_facture',$request);
            }
            $this->db->select('*');
            $this->db->select_sum('qte_achetee');
            $this->db->group_by('lq_factures.id_article, lq_factures.date_facture');
            $this->db->join('lq_articles', 'lq_articles.id_article=lq_factures.id_article');

            return $this->db->get("lq_factures")->result();
        }

        function getSoldeStory($request){
            if (isset($request)) {
                $this->db->where('date_facture', $request);
            }else{
                $this->db->where('date_facture', date('Y-m-d')); 
            }
            $this->db->select_sum('subtotal');
            $this->db->group_by('date_facture');
            return $this->db->get("lq_factures")->row_array();
        }

        //Retrieve
        function saveRetrieve($data){
            return $this->db->insert('lq_retrieves', $data);
        }

        function getRetrieve(){
            $this->db->order_by('id_retrieve', 'DESC');
            return $this->db->get('lq_retrieves')->result();
        }


    }