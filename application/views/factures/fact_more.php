<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link href="<?php echo base_url() ?>assets/img/favicon.png" rel="icon" type="image/png">
	<!--	Core MDB-->
	<link href="<?= base_url() ?>assets/dashboards/css/mdb.min.css" rel="stylesheet">
	<!--	Font-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/dashboards/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="<?= base_url() ?>assets/dashboards/css/bootstrap.min.css" rel="stylesheet">

	<title><?= $title ?? "Facture n°" . $facture['fact_token'] ?></title>
	<?php
	$total = null;
	?>

	<style>
		@media print {
			.not-print {
				display: none;
			}
		}
	</style>
</head>

<body class="container">
<div class="card p-5 m-5">
	<div class="row">
		<div class="col-md-2 w-25">
			<img src="<?= base_url() ?>assets/img/logo-kazic.png" alt="Logo"
				 style="width: 200px; margin-top: -10px!important;">
		</div>
		<div class="col-md-10 text-center justify-content-center mb-0 w-75">
			<h4>KAZIC COMPANY SARL</h4>
			<p class="mt-2" style="margin-left: -20px">
				RCCM:/KHI/015-B-69, N° ID 6-83- N6027013, N° IMPOT A1510169W<br>
				N° CNSS :1016908900, N° ARSP: 2939045026 <br>
				<span class="font-italic">Tel : (243) 811 401 563 / 971 702 221</span><br>
				Email : Kazicompany1@gmail.com/TVA N° 4324/2019
			</p>
		</div>
	</div>

	<div class="row" style="margin-top: -10px">
		<div class="col-md-12">
			<p class="ml-2 font-weight-bold text-center">
				N°COMPTE RAWBANK : 25130-01040799801-94/USD KASIC COMPANY SARL <br>
				N°COMPTE EQUITY BANK : 00516-62000012286-06/USD KASIC COMPANY SARL <br>
				N°COMPTE FBN BANK : 00014-25000-20320844869-93/USD KASIC COMPANY SARL
			</p>
			<hr>
		</div>
	</div>

	<div class="d-flex justify-content-between">
		<div class="col-sm-6 d-flex justify-content-start">
		</div>
		<div class="col-sm-3">
			<p><span class="font-weight-bold">Facture n° : <?= $facture["fact_token"] ?></span><br/>
				<span class="font-weight-bold">Date</span> : <?= date('d-m-Y', strtotime($facture["date_facture"])) ?>
				<br>
				<a href="<?= site_url('commandes')?>" class="not-print link-message"> Liste des factures</a>
			</p>
		</div>
		<div class="col-sm-3 text-right pr-4">
			<p><span class="font-weight-bold">Client </span><br/>
				<?= $facture['client_name'] !== '' ? $facture['client_name'] : $facture["client_token"] ?><br/>

				<a href="<?= site_url('shopping_cart')?>" class="not-print link-message"> Nouvelle facture</a>
			</p>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-striped table-bordered">
			<thead>
			<th>Designation</th>
			<th>Qté</th>
			<th>P.U</th>
			<th>Total</th>
			</thead>

			<?php $suffix = ''; ?>
			<?php foreach ($factures as $row): ?>
				<?php
				$total += $row->subtotal;
				if ($row->qte_achetee > 1 && $row->unityName != 'Rouleau') {
					$suffix = 's';
				} elseif ($row->qte_achetee > 1 && $row->unityName === 'Rouleau') {
					$suffix = 'x';
				}
				?>
				<tr class="font-weight-bold">
					<td class="font-weight-bold"><?= $row->designation ?></td>
					<td class="font-weight-bold"><?= $row->qte_achetee . "  $row->unityName" . $suffix ?> </td>
					<td class="font-weight-bold">$<?= number_format($row->prix_unitaire, 2, '.', '') ?></td>
					<td class="font-weight-bold">$<?= number_format($row->subtotal, 2, '.', '') ?></td>
				</tr>
			<?php endforeach ?>
		</table>
		<div class="float-right border-dark m-1 w-50">
			<h4 class="border border-default font-weight-bold ml-5 p-2 text-right" style="letter-spacing: 2px">Total
				TTC: $<?= number_format($total, 2, '.', '') ?></h4>
			<?php
			$tva = $total * 0.16;

			if ($facture['product_tva'] > 0): ?>
				<p class="font-weight-bold text-right" style="letter-spacing: 2px">Total HTVA :
					$<?= number_format($total - $tva, '2', '.', ' ') ?><br>
					Total TVA (16%) : $<?= number_format($tva, '2', '.', ' ') ?></p>

			<?php endif; ?>
		</div>

	</div>
</div>
</body>
</html>

