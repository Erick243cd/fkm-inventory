<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link href="<?php echo base_url() ?>assets/img/favicon.png" rel="icon" type="image/png">
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
</head>

<body class="container">
<div class="card p-5 m-5">
	<div class="d-flex justify-content-between">
		<div class="col-sm-6 d-flex justify-content-start">

			<p class="ml-2 mt-2"><span class="font-weight-bold">KAZIC COMPANY SARL</span><br/>
				RCCM:/KHI/015-B-69, N° ID NAT/N60270B, N° IMPOT A1510169W, TVA N° 4324/2019<br/>
				Lubumbashi, RD Congo</p>
		</div>
		<div class="col-sm-3">
			<p><span class="font-weight-bold">Facture n° #: <?= $facture["fact_token"] ?></span><br/>
				Date : <?= date('M d, Y', strtotime($facture["date_facture"])) ?><br/>
				Due: <?= date('M d, Y') ?></p>
		</div>
		<div class="col-sm-3">
			<p><span class="font-weight-bold">Client: </span><br/>
				<?= $facture['client_name'] ?? $facture["client_token"] ?><br/>
			</p>
		</div>
	</div>
	<div class="card-body">
		<div class="d-flex justify-content-between">
<!--			<tr class="details">-->
<!--				<td>Reglement</td>-->
<!--				<td>--><?//= $facture['is_cash'] == 1 ? "Payée en Cash" : "Non reglée" ?><!--</td>-->
<!--			</tr>-->
		</div>
		<table class="table table-striped">
			<tr class="heading">
				<td>Designation</td>
				<td>Qté</td>
				<td>P.U</td>
				<td>Total</td>
			</tr>
			<?php foreach ($factures as $row): ?>
				<?php
				$total += $row->subtotal;
				?>
				<tr class="item">
					<td><?= $row->designation ?></td>
					<td>(<?= $row->qte_achetee ?>) <?= ($row->qte_achetee > 1) ? "pcs" : "pc" ?></td>
					<td>$<?= number_format($row->prix_unitaire, 2, '.', '') ?></td>
					<td>$<?= number_format($row->subtotal, 2, '.', '') ?></td>
				</tr>
			<?php endforeach ?>
		</table>
		<p class="font-weight-bold float-right" style="float: right; margin-left: 50%">Sous-total: $<?= number_format($total, 2, '.', '') ?></p>
	</div>
</div>
</body>
</html>

