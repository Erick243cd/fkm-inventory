<?php
class Articles extends CI_Controller
{
	public function index($offset = 0)
	{
		$data['title'] = 'Articles';

		$data['articles'] = $this->article_model->get_articles();

		$this->load->view('dashboards/header');
		$this->load->view('articles/index', $data);
		$this->load->view('dashboards/footer');
	}
	public function create()
	{
		$data['title'] = 'Nouvel article';
		$data['categories'] = $this->categorie_model->fetch();

		//Validation de formulaire
		$this->form_validation->set_rules('designation', 'Nom de l\'article', 'required');
		$this->form_validation->set_rules('prix_unitaire', 'Prix unitaire', 'required|numeric');
		$this->form_validation->set_rules('qte_initial', 'Quantité initiale', 'required|numeric');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('dashboards/header');
			$this->load->view('articles/create', $data);
			$this->load->view('dashboards/footer');
		} else {
			if (isset($_FILES["articlefile"]["name"])) {

				$config['upload_path'] = './assets/img/articles';
				$config['allowed_types'] = 'jpg|png|gif';

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('articlefile')) {
					$file = 'no_file';
				} else {
					$string = $_FILES["articlefile"]["name"];
					$pattern = '# #';
					$replacement = "_";
					$data = $this->upload->data();
					$file = preg_replace($pattern, $replacement, $string);
				}
			}
			$this->article_model->create_article($file);
			//Set_messages
			$this->session->set_flashdata('article_created', 'L\'article a bien été créé avec succès!');
			redirect('articles');
		}
	}
	public function edit($id)
	{
		$data['categories'] = $this->categorie_model->fetch();
		$data['article'] = $this->article_model->get_article_id($id);

		$data['title'] = 'Editer l\'article';

		$this->load->view('dashboards/header');
		$this->load->view('articles/edit', $data);
		$this->load->view('dashboards/footer');
	}
	public function update()
	{
		$data = array(
			'designation' => $this->input->post('designation'),
			'prix_unitaire' => $this->input->post('prix_unitaire'),
			'devise' => $this->input->post('devise'),
			'qte_initial' => $this->input->post('qte_initial'),
			'qte_actuelle' => $this->input->post('qte_initial'),
			'id_categorie' => $this->input->post('id_categorie'),
		);
		$this->article_model->update_article($data);
		//Set Message
		$this->session->set_flashdata('article_updated', 'Le produit a été modifié !');
		redirect('articles');
	}
	public function delete($id)
	{
		$this->article_model->delete_article($id);
		//Set Message
		$this->session->set_flashdata('article_deleted', 'L\'article a été supprimé avec succès !');
		redirect('articles');
	}

	function entree($id)
	{
		$data['categories'] = $this->categorie_model->fetch();
		$data['article'] = $this->article_model->get_article_id($id);
		$data['title'] = 'Reapprovisonner l\'article';

		$this->load->view('dashboards/header');
		$this->load->view('entrees/entree', $data);
		$this->load->view('dashboards/footer');
	}
	function reapprovisionner()
	{

		/*
                Quantité Sortie
            */
		$key_entree_qte = rand(78452, 8569211);

		$quantite_actuel = $this->input->post('qte_actuelle') + $this->input->post('qte_reappro');

		$data_entree = array(
			'id_article' => $this->input->post('id_article'),
			'qte_reappro' => $this->input->post('qte_reappro'),
			'date_reappro' => $this->input->post('date_reappro'),
			'nom_fournisseur' => $this->input->post('nom_fournisseur'),
			'key_entree' => $key_entree_qte
		);
		$data_article = array(
			'qte_actuelle' => $quantite_actuel
		);

		$data_qte_entree = array(
			'key_entree' => $key_entree_qte,
			'qte_restante' => $quantite_actuel
		);

		$this->article_model->save_reappro($data_entree, $data_article, $data_qte_entree);
		//Set Message
		$this->session->set_flashdata('reapro_save', 'Le reapprovisonnement de l\'article a été bien enregistré !');
		redirect('articles/entreelist');
	}
	function entreelist()
	{
		$data['title'] = "Reapprovisionnements";
		$data['sorties'] = $this->article_model->fetch_reappro();

		$this->load->view('dashboards/header');
		$this->load->view('entrees/index', $data);
		$this->load->view('dashboards/footer');
	}

	function inventaire()
	{

		$mois = null; //Initialize month and motif value
		$motif = null;

		if ($this->input->post('month') !== NULL) {
			$mois = $this->input->post('month');
			$title = $mois . ' - ' . date('Y');

			$motif = $this->input->post('motif');
		}

		$data = array(
			'title' => $title ?? "",
			'products' => $this->inventaire_model->productData(),
			'outputs' => $this->inventaire_model->outputData($mois, $motif),
			'inputs' => $this->inventaire_model->inputData($mois),
			'motifs' => $this->inventaire_model->getMotifs()
		);
		/*echo '<pre>';
            print_r($data); die();*/


		$this->load->view('dashboards/header');
		$this->load->view('inventaire/index', $data);
		$this->load->view('dashboards/footer');
	}
}
