<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong><?php echo $this->session->flashdata('success'); ?></strong>
            </div>
        <?php endif; ?>

      <?= form_open("commandes/soldes")?>
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
                
                <!--Card-->
            </div>
                
                <div class="col-md-6">
                    <div class="card">
                    <!--Card content-->
                    <div class="card-header">
                        <h4 class="text-center text-dark">Solde du <?= ($this->input->post('date_facture') !== null) ? date('d, M Y', strtotime($this->input->post('date_facture')))  : date('d, M Y')?>
                        </h4>
                    </div>
                    <div class="card-body pb-5">
                        <h4 class="text-center text-center text-dark">
                            $ <?= number_format($solde['subtotal'], 2, '.', '')?>
                        </h4>
                    </div>
                </div>
                </div>

                <?php
                    $session_data = $this->session->userdata('logged_in');
                    $user_role = $session_data['role_utilisateur'];
                ?>
                <?php if ($user_role ==='admin'): ?>
                    <div class="col-md-6">
                        <div class="card">
                        <!--Card content-->
                            <div class="card-header">
                                <h4 class="text-center text-center text-dark">Solde Total</h4>
                            </div>
                            <div class="card-body pb-0">
                                <h4 class="text-center text-center text-dark">
                                    $ <?= number_format($current['montant_entree'], 2, '.', '')?>
                                </h4>
                                <?php if($current['montant_entree'] >= 1): ?>
                                    <a class="nav-link text-center mb-1" href="<?= site_url('commandes/retrieve')?>">Retirer</a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    
                <?php endif ?>
                
                
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