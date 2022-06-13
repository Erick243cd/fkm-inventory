

<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <a href="<?php echo base_url()?>pages/dashboards" target="_blank">Page d'accueil</a>
                    <span>/</span>
                    <span><?php echo $title;?></span>
                </h4>

            </div>

        </div>

        <!--Grid row-->
        <div class="row wow fadeIn">
            <!--Grid column-->
            <div class="col-md-12 mb-4">

                <!--Card-->
                <div class="card">
                    <!--Card content-->
                    <div class="card-body">
                        <a style="float: right" class="btn purple-gradient btn-sm"
                           href="<?php echo base_url() ?>users/create">Nouvel utilisateur</a>
                        <table id="dt-material-checkbox" class="table table-hover" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th class="th-sm">#</th>
                                <th class="th-sm">Nom</th>
                                <th>Rôle</th>
                                <th>Statut</th>
                                <th>Photo</th>
                                <th></th>
                            </tr>
                            </thead>
                            <!-- Table head -->

                            <!-- Table body -->
                            <tbody>
                                <?php foreach ($users as $user):?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo ucfirst($user['user_name'])?></td>
                                        <td><?php echo ucfirst($user['role_utilisateur'])?></td>
                                        <td><?php echo ucfirst($user['statut'])?></td>
                                        <td><img class="rounded" src="<?php echo base_url()?>assets/img/users/<?php echo $user['user_image']?>" width="50" height="50" alt="<?php echo ucfirst(word_limiter($user['user_name'],1))?>"></td>
                                        <td><a class="btn-outline-primary btn-sm" href="<?php echo base_url()?>users/edit_compte/<?php echo $user['id']; ?>">Editer</a></td>
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