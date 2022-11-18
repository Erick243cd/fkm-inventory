<main class="pt-5">
	<div class="container-fluid mt-5">

		<!-- Heading -->
		<div class="card mb-4 wow fadeIn">

			<!--Card content-->
			<div class="card-body d-sm-flex justify-content-between">

				<h4 class="mb-2 mb-sm-0 pt-1">
					<a href="<?php echo base_url() ?>pages/dashboards" target="_blank">Page d'accueil</a>
					<span>/</span>
					<span><?php echo $title ?? ""; ?></span>
				</h4>

			</div>

		</div>

		<!--Grid row-->
		<div class="row wow fadeIn">

			<!--Grid column-->
			<div class="col-md-12 mb-4">
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

				<!--Card-->
				<div class="card">
					<!--Card content-->
					<div class="card-body">
						<!-- Table  -->
						<table id="dt-material-checkbox" class="table table-striped table-hover" cellspacing="0"
							   width="100%">
							<a href="<?= base_url()?>shopping_cart" class="btn btn-success btn-sm float-right">Nouvelle facture</a>
							<!-- Table head -->
							<thead class="blue-grey lighten-4">
							<tr>
								<th class="th-sm">#Numéro</th>
								<th class="th-sm">Date</th>
								<th class="th-sm">Client</th>
								<th class="th-sm">Status</th>

								<th class="th-sm"></th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($factures as $row): ?>
								<tr>
									<td><?= $row->fact_token ?></td>
									<td><?= $row->date_facture ?></td>
									<td><?= isset($row->client_name) ? $row->client_name : $row->client_token; ?></td>

									<td class="<?= $row->is_cash == 1 ? "text-success" : "text-danger"; ?>">
										<?= $row->is_cash == 1 ? "Payée" : "Non payée"; ?>
									</td>

									<td><a href="<?= site_url('commandes/factureDetail/' . $row->fact_token) ?>"
										   class="btn btn-sm btn-primary">Détails</a>
										<a onclick="return confirm('Cette action est irreversible, voulez-vous continuer')"
										   href="<?= site_url('commandes/cancelFacture/' . $row->fact_token) ?>"
										   class="btn btn-sm btn-danger">Annuler</a>
									</td>
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
			<!--Grid column-->

			<!--Grid column-->

		</div>
		<!--Grid row-->
		<div class="pt-4 mb-5"></div>
		<div class="pt-3 mb-2"></div>

	</div>
</main><!--Main layout-->
