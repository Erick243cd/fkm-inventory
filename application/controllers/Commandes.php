<?php

class Commandes extends CI_Controller
{

	public function index($offset = 0)
	{

		$config['base_url'] = base_url() . 'commandes/index/';
		$config['total_rows'] = $this->db->count_all('lq_factures');
		$config['per_page'] = 300;
		$config['uri_segment'] = 3;
		$config['attributes'] = array('class' => 'pagination-links');

		//Init Pagination
		$this->pagination->initialize($config);

		$data['title'] = 'Factures enregistrées';
		$data['factures'] = $this->commande_model->get_commandes(FALSE, $config['per_page'], $offset);

		$this->load->view('dashboards/header');
		$this->load->view('factures/index', $data);
		$this->load->view('dashboards/footer');
	}

	public function create()
	{
		$this->load->library("cart");

		$client_token = substr(str_shuffle(str_repeat('123456789', mt_rand(5, 20))), 0, 5);
		$fact_token = substr(str_shuffle(str_repeat('987654321', mt_rand(5, 20))), 0, 5);

		$reduction = htmlentities($this->input->post('amount_reduction'));
		$usb_amount = htmlentities($this->input->post('usd_amount'));
		$cdf_amount = htmlentities($this->input->post('cdf_amount'));
		$client_name = htmlentities($this->input->post('client_name'));
		$is_cash = $this->input->post('is_cash');

		//var_dump($this->cart->contents()); die();
		if (!empty($this->cart->contents())) {
			foreach ($this->cart->contents() as $items) {
				$data = array(
					'id_article' => $items["id"],
					'prix_achat' => $items["buy_price"],
					'prix_unitaire' => $items["unit_price"],
					'prix_vente' => $items["price"],
					'qte_achetee' => $items["qty"],
					'remise' => $reduction,
					'usd_amount' => $usb_amount,
					'cdf_amount' => $cdf_amount,
					'product_tva' => $items["tva"],
					'subtotal' => $items["subtotal"],
					'fact_token' => $fact_token,
					'client_token' => $client_token,
					'client_name' => $client_name,
					'date_facture' => date('Y-m-d'),
					'is_cash' => isset($is_cash) ? $is_cash : 0,
				);


				//Mise jour de la quantité
				$product = $this->article_model->getQuantity($items['id']);

				if ($items['qty'] > $product->qte_actuelle) {
					$this->session->set_flashdata('error', "<b>Erreur</b>, 
														La quantité en stock de l'article <b>{$product->designation}</b>
														 est inférieure à celle qui est saisie,
													 Veuillez réapprovisionner puis compléter l'article sur la facture !");
					redirect(base_url('shopping_cart/index'));

				} else {
					$reste = $product->qte_actuelle - $items['qty'];
					$DataQty = array(
						'qte_actuelle' => $reste
					);
					$this->article_model->updateProductQuantity($items['id'], $DataQty);
				}

				$this->commande_model->create_commande($data); //Create command
			}

			$data['solde'] = $this->commande_model->getSolde();

			if (!empty($data['solde'])) {
				$general_solde = $data['solde']['montant_entree'];
				$usd_solde = $data['solde']['usd_amount'];
				$cdf_solde = $data['solde']['cdf_amount'];

				$data_solde = array(
					'usd_amount' => $usd_solde + $usb_amount,
					'cdf_amount' => $cdf_solde + $cdf_amount,
					'montant_entree' => $general_solde + $usb_amount
				);
				$this->commande_model->update_solde($data_solde);
			} else {
				//Solde add data
				$data_solde = array(
					'montant_entree' => $usb_amount,
					'usd_amount' => $usb_amount,
					'cdf_amount' => $cdf_amount);
				$this->commande_model->insert_solde($data_solde);
			}
			redirect('commandes/factureDetail/'.$fact_token);
			//redirect('shopping_cart/destroy_cart');

		} else {
			$this->session->set_flashdata('error', '<b>Erreur</b>, La facture ne contient aucune élément, Veuillez ajouter des articles à la facture.!');
			redirect(base_url('shopping_cart/index'));
		}
	}

	public function delete($id)
	{
		$this->commande_model->delete_commande($id);
		//Set Message
		$this->session->set_flashdata('commande_deleted', 'La commande a été supprimée !');
		redirect('commandes/index');
	}

	function factureDetail($fact_token)
	{
		$this->load->library("cart");
		$data = array(
			'factures' => $this->commande_model->factureDetails($fact_token),
			'facture' => $this->commande_model->factureDetail($fact_token)
		);

		$this->cart->destroy();
		$this->session->set_flashdata('succsess', 'Facture enregitrée!');

		$this->load->view('factures/fact_more', $data);
	}

	function soldes()
	{
		$request = $this->input->post('date_facture');

		$usd_amount = 0;
		$cdf_amount = 0;
		$remise_amount = 0;
		$subtotal = 0;

		$soldes = $this->commande_model->getSoldeStory($request);


		if (!empty($soldes)) {
			foreach ($soldes as $solde) {
				$usd_amount += $solde->usd_amount;
				$cdf_amount += $solde->cdf_amount;
				$remise_amount += $solde->remise;
				$subtotal += $solde->subtotal;
			}
		}
		$data =(object) array(
			'usd_amount' => $usd_amount,
			'cdf_amount' => $cdf_amount,
			'remise' => $remise_amount,
			'subtotal' => $subtotal,
		);

		$this->load->view('dashboards/header');
		$this->load->view('soldes/index', $data);
		$this->load->view('dashboards/footer');
	}

	function facturesByarticle()
	{

		$request = $this->input->post('date_facture') ?? date('Y-m-d');

		$data['factures'] = $this->commande_model->facturesByarticle($request);

		$this->load->view('dashboards/header');
		$this->load->view('factures/list', $data);
		$this->load->view('dashboards/footer');
	}

	function retrieve()
	{
		$data = array('current' => $this->commande_model->getSolde());

		$this->load->view('dashboards/header');
		$this->load->view('soldes/retrieve', $data);
		$this->load->view('dashboards/footer');
	}

	function saveRetrieve()
	{

		$data['current'] = $this->commande_model->getSolde();

		$current_amount = $data['current']['montant_entree'];

		$amount_to_retrieve = $this->input->post('amount_retrieve');

		$data_solde = ['montant_entree' => $current_amount - $amount_to_retrieve];

		$this->commande_model->update_solde($data_solde);

		$data = array(
			'preview_amount' => $current_amount,
			'retrieve_amount' => $amount_to_retrieve,
			'current_amount' => $current_amount - $amount_to_retrieve,
			'retrieve_date' => $this->input->post('date_retrait'),
			'motif' => $this->input->post('motif_retrait')
		);

		$this->commande_model->saveRetrieve($data);

		$this->session->set_flashdata('success', 'Le retrait a été enregistré !');
		redirect(base_url('commandes/soldes'));
	}

	function retrieveList()
	{
		$data['retrieves'] = $this->commande_model->getRetrieve();

		$this->load->view('dashboards/header');
		$this->load->view('soldes/retrievelist', $data);
		$this->load->view('dashboards/footer');
	}


	public function cancelFacture($factureToken)
	{

		$factures = $this->commande_model->factureDetails($factureToken);

		if (!empty($factures)) {
			foreach ($factures as $item) {
				$product = $this->article_model->getQuantity($item->id_article);

				$newQuantity = $product->qte_actuelle + $item->qte_achetee;
				$data = array(
					'qte_actuelle' => $newQuantity
				);
				$this->article_model->updateProductQuantity($product->id_article, $data);
			}
			$commandData = array(
				'is_canceled' => "1"
			);

			$this->commande_model->cancelCommand($factureToken, $commandData);
			$this->session->set_flashdata('success', 'La facture a été annulée avec succès !');
			redirect(base_url('commandes/index'));

		} else {
			$this->session->set_flashdata('error', 'La facture n\'a pas été retrouvée !');
			redirect(base_url('commandes/index'));
		}
	}
}
