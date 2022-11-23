<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link href="<?php echo base_url()?>assets/img/favicon.png" rel="icon" type="image/png">
    <title><?= $title ?? "Facture n°". $facture['fact_token'] ?></title>
      <?php 
        $total = null; 
      ?>
    <style>
      .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
      }

      .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
      }

      .invoice-box table td {
        padding: 5px;
        vertical-align: top;
      }

      .invoice-box table tr td:nth-child(2) {
        text-align: right;
      }

      .invoice-box table tr.top table td {
        padding-bottom: 20px;
      }

      .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
      }

      .invoice-box table tr.information table td {
        padding-bottom: 40px;
      }

      .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
      }

      .invoice-box table tr.details td {
        padding-bottom: 20px;
      }

      .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
      }

      .invoice-box table tr.item.last td {
        border-bottom: none;
      }

      .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
      }

      @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
          width: 100%;
          display: block;
          text-align: center;
        }

        .invoice-box table tr.information table td {
          width: 100%;
          display: block;
          text-align: center;
        }
      }

      /** RTL **/
      .invoice-box.rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      }

      .invoice-box.rtl table {
        text-align: right;
      }

      .invoice-box.rtl table tr td:nth-child(2) {
        text-align: left;
      }
    </style>
  </head>

  <body>
    <div class="invoice-box">
      <table cellpadding="0" cellspacing="0">
        <tr class="top">
          <td colspan="2">
            <table>
              <tr>
                <td class="title">
                  <img src="<?php echo base_url()?>assets/img/favicon.png" alt="Logo" style="width: 100px; max-width: 200px; border-radius: 10px;" />
                </td>

                <td>
                  Facture n° #: <?= $facture["fact_token"]?><br/>
                  Date :  <?= date('M d, Y', strtotime($facture["date_facture"])) ?><br />
                  Due: <?= date('M d, Y')?>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr class="information">
          <td colspan="2">
            <table>
              <tr>
                <td>
                 KAZIC COMPANY SARL<br />
                  Adresse complete<br />
                  Lubumbashi, RD Congo
                </td>
                <td>Client: <br/>
                  <?= $facture['client_name'] ?? $facture["client_token"]?><br />
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr class="heading">
          <td>Méthode de Paiement</td>
          <td style="float: right">#Paiement</td>
        </tr>

        <tr class="details">
          <td>Reglement</td>
          <td><?= $facture['is_cash']==1 ? "Payée en Cash" : "Non reglée"?></td>
        </tr>

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
            <td><?= $row->designation?></td>
            <td>(<?= $row->qte_achetee?>) <?= ($row->qte_achetee >1) ? "pcs":"pc"?></td>
            <td>CDF<?= number_format($row->prix_unitaire, 2, '.', '')?></td>
            <td>CDF<?= number_format($row->subtotal, 2, '.', '')?></td>
         </tr>
        <?php endforeach ?>

        <tr class="total">
          <td></td>

          <td style="float: right; margin-left: 50%">Sous-total: CDF<?= number_format($total, 2, '.', '')?></td>
        </tr>
      </table>
    </div>
  </body>
</html>
