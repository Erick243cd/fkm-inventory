<main class="pt-5">
	<div class="container-fluid mt-5">
		<!-- Heading -->
		<div class="row wow fadeIn">
			<div class="col-md-12">
				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong><?php echo $this->session->flashdata('success'); ?></strong>
					</div>
				<?php endif; ?>
				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong><?php echo $this->session->flashdata('error'); ?></strong>
					</div>
				<?php endif; ?>
				<div class="col-md-12 mb-4">
					<div class="card">
						<div class="card-body">
							<a style="float: right" class="btn btn-success btn-sm"
							   href="<?php echo base_url() ?>" data-toggle="modal" data-target="#quickview">Facture</a>
							<table id="dt-material-checkbox" class="table table-striped" cellspacing="0" cellpadding="0"
								   width="100%">
								<thead>
								<tr class="text-center">
									<th class="th-sm"></th>
									<th class="th-sm"></th>
									<th class="th-sm"></th>
									<th class="th-sm"></th>
									<th class="th-sm" style="float: right;"></th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($articles as $row): ?>
									<tr>
										<td class="font-weight-bold"><?php echo ucfirst($row->designation) ?>
											( <?= number_format($row->prix_unitaire, 2, ',', '') ?> <?= $row->devise ?>)
										</td>
										<td><input type="text" disabled placeholder="Stock :<?= $row->qte_actuelle ?> " style="width:100px;" min="1" class="form-control quantity">
										</td>
										<td class="">
											<input type="number" placeholder="Quantité" style="width:100px;" min="1"
												   name="quantity" class="form-control quantity"
												   id="<?= $row->id_article ?>">
										</td>

										<input type="hidden" required placeholder="P.V"
											   value="<?= $row->prix_unitaire ?>"
											   name="Prix" class="form-control quantity"
											   id="sales_price<?= $row->id_article ?>">
										<td>
											<button type="button"
													name="add_cart" class="btn btn-default btn-sm add_cart"
													data-productname="<?= $row->designation ?>"
													data-price="<?= $row->prix_unitaire ?>"
													data-productid="<?= $row->id_article ?>"
													data-product_price_buy="<?= $row->prix_achat ?>"
													data-max_quantity="<?= $row->qte_actuelle ?>"
											>
												<span class="fa fa-plus"></span>
											</button>
										</td>
										<td style="float: right"> <?= $row->nom_categorie ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
								<!-- Table body -->
							</table>
							<!-- Table  -->

						</div>

					</div>
					<!--/.Card-->

				</div>
			</div>
			<div class="col col-lg-12">
				<div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview"
					 aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<?= form_open('commandes/create') ?>
							<div class="modal-header text-center">
								<h6 class="border-bottom border-gray pb-2 mb-0">Facture</h6>
							</div>
							<div class="modal-body" id="cart_details">
								<h4 class="text-center">La facture est vide</h4>
							</div>

							<div class="d-md-flex justify-content-center my-1 ml-3 mr-3 mt-0">
								<div class="form-group ">
									<label for="usd_amount">Réduction </label>
									<input type="number" class="form-control" name="amount_reduction" step="any">
								</div>
								<div class="form-group">
									<label for="usd_amount">Montant USD</label>
									<input type="number" class="form-control" name="usd_amount" step="any">
								</div>
								<div class="form-group">
									<label for="cdf_amount">Montant CDF</label>
									<input type="number" class="form-control" name="cdf_amount" step="any">
								</div>
								<div class="form-group">
									<label for="cdf_amount">Nom du client</label>
									<input type="text" class="form-control" name="client_name" step="any">
								</div>

								<label>
									Cash <input type="checkbox" name="is_cash" value="1" checked>
								</label>
							</div>

							<div class="modal-footer">
								<a class="btn btn-default" data-dismiss="modal">Fermer</a>
								<button type="submit" class="btn btn-primary"
										href="<?php echo base_url() ?>commandes/create">Enregistrer
								</button>
							</div>
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!--Grid row-->
		<div class="pt-4 mb-5"></div>
		<div class="pt-3 mb-2"></div>


	</div>
</main><!--Main layout-->
