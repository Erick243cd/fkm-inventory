<main class="pt-5 mx-lg-5">
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
                <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a style="float: right" class="btn btn-success btn-sm"
                           href="<?php echo base_url() ?>" data-toggle="modal" data-target="#quickview">Facture</a>
                        <table id="dt-material-checkbox" class="table table-striped" cellspacing="0" cellpadding="0" width="100%">
                            <thead class="blue-grey lighten-4">
                            <tr class="text-center">
                                <th class="th-sm"></th>
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
                                    <td style="float: left;"><img class="rounded" src="<?php echo base_url() ?>assets/img/articles/<?= $row->image_article ?>" width="50" height="40"></td>
                                    <td class="font-weight-bold"><?php echo ucfirst($row->designation) ?> <?= number_format($row->prix_unitaire, 2, ',', '') ?> <?= $row->devise ?></td>
                                    <td class=""><input type="number" placeholder="Quantité" style="width:100px;" min="1" name="quantity" class="form-control quantity" id="<?= $row->id_article?>"></td>

                                        <td>
                                        <input type="number" placeholder="P.V" value="<?= $row->prix_unitaire?>" style="width:100px;" min="1" name="Prix" class="form-control quantity" id="sales_price<?= $row->id_article?>"></td>
                                    
                                    <td><button type="button"
                                           name="add_cart" class="btn btn-default btn-sm add_cart"
                                           data-productname="<?= $row->designation?>"
                                           data-price="<?= $row->prix_unitaire?>"
                                           data-productid="<?= $row->id_article?>"
                                           data-product_price_buy="<?= $row->prix_achat?>"><span class="fa fa-plus"></span>
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
                <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
                    <div  class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                            <div class="modal-header text-center">
                                <h6 class="border-bottom border-gray pb-2 mb-0">Facture</h6>
                            </div>
                            <div class="modal-body" id="cart_details">
                                    <h4 class="text-center">La facture est vide</h4>
                            </div>

                            <div class="modal-footer">
                                <a class="btn btn-default" data-dismiss="modal">Fermer</a>
                                <a class="btn btn-primary" href="<?php echo base_url()?>commandes/create" name="envoyer">Enregistrer</a>
                            </div>
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