

<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
<?= form_open("commandes/facturesByarticle")?>
        <div class="card mb-4 wow fadeIn not-print">
            <div class="card-body d-lg-flex">
                
                <div class="row" style="width: 100%; height: initial;">
                    <div class="col-sm-6 text-center content-center">
                     <input type="date" name="date_facture" class="form-control" style="size: 20px;" required>
                    </div>
                    <div class="col-sm-4 text-center"><input type="submit" class="btn btn-md btn-primary m-0" value="Charger">
                    </div>
                </div>
                </div>
            </div>
        </form>

        <!--Grid row-->
        <div class="row wow fadeIn">
            <!--Grid column-->
            <div class="col-md-12 mb-4">
                <h4 class="text-center text-dark font-weight-bold">Rapport de vente du <?= ($this->input->post('date_facture') !== null) ? date('d, M Y', strtotime($this->input->post('date_facture')))  : date('d, M Y')?>
                </h4>
                <!--Card-->
                <div class="card">
                    <!--Card content-->
                    <div class="card-body">
                        <table class="table table-striped" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th class="th-sm">Date</th>
                                <th class="th-sm">Article</th>
                                <th class="th-sm">Quantité</th>
                            </tr>
                            </thead>
                            <!-- Table head -->

                            <!-- Table body -->
                            <tbody>
                                <?php foreach ($factures as $row):?>
                                    <tr>
                                        <td><?= $row->date_facture ?></td>
                                        <td><?= $row->designation ?></td>
                                        <td><?= $row->qte_achetee ?></td>
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
</main>
<!--Main layout-->