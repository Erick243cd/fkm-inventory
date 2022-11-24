<?php

class Shopping_cart extends CI_Controller
{

	public function index()
	{
		$this->load->model("shopping_cart_model");
		$this->load->model("article_model");
		$data["articles"] = $this->article_model->get_articles();

		$this->load->view('dashboards/header');
		$this->load->view('shopping_cards/index', $data);
		$this->load->view('dashboards/footer');
	}

	function add()
	{
		$tva = 0;
		$this->load->library("cart");
		$data = array(
			"id" => $_POST['product_id'],
			"name" => $_POST['product_name'],
			"qty" => $_POST['quantity'],
			"price" => $_POST['product_price'],
			"unit_price" => $_POST['product_unit_price'],
			"buy_price" => $_POST['product_price_buy'],
			"unity" => $_POST['unity'],
			"tva" => $tva,
			"subtotal" => $_POST['product_unit_price'] * $_POST['quantity']
		);

		$this->cart->insert($data); //Return rowid
		echo $this->cardview();
	}

	function load()
	{
		echo $this->cardview();
	}

	function remove()
	{
		$this->load->library("cart");
		$row_id = $_POST["row_id"];
		$data = array(
			'rowid' => $row_id,
			'qty' => 0
		);
		$this->cart->update($data);
		echo $this->cardview();
	}

	function clear()
	{
		$this->load->library("cart");
		$this->cart->destroy();
		echo $this->cardview();
	}

	function destroy_cart()
	{
		$this->load->library("cart");
		$this->cart->destroy();

		$this->session->set_flashdata('success', 'Facture enregitrée!');
		redirect('shopping_cart/index');
	}

	function cardview()
	{
		$this->load->library("cart");
		$tva = 0;
		$output = '';
		$output .= '
          
                <div align="right">
                    <button type="button" id="clear_cart" class="btn btn-outline-danger btn-sm">Vider la facture</button>
                </div>
                <div class="my-3 p-3 bg-white rounded shadow-sm">    
            ';
		$count = 0;
		$total = 0;
		$suffix = '' ;
		foreach ($this->cart->contents() as $items) {

			if($items['qty'] > 1 && $items['unity'] != 'Rouleau'){
				$suffix = 's';
			}elseif ($items['qty'] > 1 && $items['unity'] === 'Rouleau'){
				$suffix = 'x';
			}

			$count++;
			$output .= '
                            <div class="media text-muted pt-3">
                                <img data-src="holder.js/32x32?theme=thumb&bg=6f42c1&fg=6f42c1&size=1" alt="" class="mr-2 rounded">
                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark">Nom </strong>
                                    </div>
                                    <span class="d-block">@' . $items["name"] . '</span>
                                </div>
                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark">Quantité</strong>
                                    </div>
                                    <span class="d-block">' . $items["qty"] . " " . $items["unity"] . $suffix.'</span>
                                </div>

                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark">Prix</strong>
                                    </div>
                                    <span class="d-block"> $ ' . number_format($items["price"], 2, ',', '') . '</span>
                                </div>
                                
                           
                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark">Total</strong>
                                    </div>
                                    <span class="d-block"> $ ' . number_format($items["subtotal"], 2, ',', '') . '</span>
                                </div>
                       
                                <button type="button" name="remove" class="text-danger btn btn-link remove_inventory" id="' . $items["rowid"] . '">Retirer</button>
                            </div>                  
                ';
			if ($count <= 0) {
				$total = 0;
			} else $total += $items["subtotal"] * $tva / 100;
		}


		$output .= '
        <strong class="d-block text-right text-danger mt-3">
                            <a href="#">Sous-total avec TVA </a>  <p> $ ' . number_format($this->cart->total() + $total, 2, ',', '') . '</p>
                        </strong>
                 </div>
        
        ';
		if ($count == 0) {
			$output = '<h4 class="text-center">La Factures est vide</h4>';
		}
		return $output;
	}
}
