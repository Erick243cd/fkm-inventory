<?php
/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 21/10/2020
 * Time: 20:44
 */
class Sorties extends CI_Controller{

    function index(){
        $data['title']="Sorties enregistrées";
        $data['sorties']=$this->sortie_model->fetch();

        $this->load->view('dashboards/header');
        $this->load->view('sorties/index', $data);
        $this->load->view('dashboards/footer');
    }

    function sortie($id){
        $data['categories']=$this->categorie_model->fetch();
        $data['article']=$this->article_model->get_article_id($id);
        $data['title'] = 'Enregistrer la sortie de l\'article';

        $this->load->view('dashboards/header');
        $this->load->view('sorties/sortie', $data);
        $this->load->view('dashboards/footer');
    }

    function save(){

        $quantite_initiale = $this->input->post('qte_initial');
        $quantite_sortie = $this->input->post('qte_sortie');

        /*
         Quantité Sortie
        */
         $key_sortie_qte = rand(78452, 8569211);

        if ($quantite_sortie>$quantite_initiale) {
            $this->session->set_flashdata('sortie_enable', "Impossible d'enregistrer, La quantité à sortir doit être inférieure ou égale à la quantité en stock!");
            redirect('sorties/sortie/'.$this->input->post('id_article'));
        }
        else{
            $quantite_actuel = $this->input->post('qte_initial') - $this->input->post('qte_sortie');

            $data_sortie = array(
                'id_article'=>$this->input->post('id_article'),
                'qte_sortie'=>$this->input->post('qte_sortie'),
                'date_sortie'=>$this->input->post('date_sortie'),
                'motif_sortie'=>$this->input->post('motif_sortie'),
                'key_sortie'=>$key_sortie_qte
            );

            $data_article = array(
                'qte_actuelle'=>$quantite_actuel
            );

            $data_qte_sortie = array(
                'key_sortie'=>$key_sortie_qte,
                'qte_restante'=>$quantite_actuel
            );

            $this->sortie_model->save($data_sortie, $data_article, $data_qte_sortie);
            //Set Message
            $this->session->set_flashdata('sortie_save', 'La sortie de l\'article a été bien enregistrée !');
            redirect('sorties');
        }

    }

}