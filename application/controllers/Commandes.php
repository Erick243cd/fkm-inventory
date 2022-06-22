<?php
class Commandes extends CI_Controller
{

	public function index($offset = 0)
	{

		$config['base_url'] = base_url() . 'commandes/index/';
		$config['total_rows'] = $this->db->count_all('lq_factures');
		$config['per_page'] = 200;
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

		//var_dump($this->cart->contents()); die();

		if (!empty($this->cart->contents())) {
			foreach ($this->cart->contents() as $items) {

				$data = [
					'id_article' => $items["id"],
					'prix_achat' => $items["buy_price"],
					'prix_unitaire' => $items["unitprice"],
					'prix_vente' => $items["price"],
					'qte_achetee' => $items["qty"],
					'remise' => $items["remise"],
					'product_tva' => $items["tva"],
					'subtotal' => $items["subtotal"],
					'fact_token' => $fact_token,
					'client_token' => $client_token,
					'date_facture' => date('Y-m-d')
				];

				$this->commande_model->create_commande($data); //Create command

				$data['solde'] = $this->commande_model->getSolde();

				$qty = $data['solde']['montant_entree'];

				$data_solde = ['montant_entree' => $items['subtotal'] + $qty];


				$this->commande_model->update_solde($data_solde); //Solde add data
			}
			redirect('shopping_cart/destroy_cart');
		} else {
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

		$data = [
			'factures' => $this->commande_model->factureDetails($fact_token),
			'facture' => $this->commande_model->factureDetail($fact_token)
		];

		$this->load->view('factures/fact_details', $data);
	}

	function soldes()
	{
		$request = $this->input->post('date_facture') ?? null;

		$data = [
			'solde' => $this->commande_model->getSoldeStory($request),
			'current' => $this->commande_model->getSolde()
		];

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
		$data = ['current' => $this->commande_model->getSolde()];

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

		$data = [
			'preview_amount' => $current_amount,
			'retrieve_amount' => $amount_to_retrieve,
			'current_amount' => $current_amount - $amount_to_retrieve,
			'retrieve_date' => $this->input->post('date_retrait'),
			'motif' => $this->input->post('motif_retrait')
		];

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
}
