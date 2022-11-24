<?php

/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 21/10/2020
 * Time: 20:55
 */
class Sortie_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	function fetch()
	{
		$this->db->order_by('id_sortie', 'DESC');
		$this->db->join('lq_articles', 'lq_articles.id_article=lq_sorties.id_article');
		$this->db->join('lq_unities', 'lq_articles.unityId=lq_unities.unityId');
		$this->db->join('lq_quantites_sortie', 'lq_quantites_sortie.key_sortie=lq_sorties.key_sortie');

		$query = $this->db->get("lq_sorties");
		return $query->result();
	}

	function save($data_sortie, $data_article, $data_quantite_sortie)
	{

		$this->db->insert('lq_sorties', $data_sortie);

		$this->db->insert('lq_quantites_sortie', $data_quantite_sortie); //Maintient de la quantité actuel par sortie

		$this->db->where('id_article', $this->input->post('id_article'));
		$this->db->update('lq_articles', $data_article);


		return true;
	}
}
