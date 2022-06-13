
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <a href="<?php echo base_url()?>pages/dashboards" target="_blank">Page d'accueil</a>
                    <span>/</span>
                    <span><?php echo $title ?? "";?></span>
                </h4>

            </div>

        </div>

        <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-md-12 mb-4">

                <!--Card-->
                <div class="card">
                    <div class="card-header">
                        <h4 class="pt-3"><?php echo $title;?></h4>
                    </div>

                    <!--Card content-->
                    <div class="card-body">
                        <!-- Table  -->
                        <table id="dt-material-checkbox" class="table table-striped table-hover" cellspacing="0" width="100%">
                            <!-- Table head -->
                            <thead class="blue-grey lighten-4">
                                <tr>
                                    <th class="th-sm">Date</th>
                                    <th class="th-sm">#Numéro</th>
                                    <th class="th-sm">Client</th>
                                    <th class="th-sm"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($factures as $row):?>
                                    <tr>
                                        <td><?= $row->date_facture ?></td>
                                        <td><?= $row->fact_token ?></td>
                                        <td>CL-<?= $row->client_token ?></td>
                                        <td><a href="<?= site_url('commandes/factureDetail/'.$row->fact_token)?>" class="btn btn-sm btn-primary">Détails</a></td>
                                    </tr>
                                <?php endforeach;?>
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