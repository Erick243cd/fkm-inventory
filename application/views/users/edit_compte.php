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
        <div class="mt-5">
        <h2 style="color: darkorange; font-size: large;"><?php echo $title;?></h2>
        <img class="img-thumbnail float-lg-right"  src="<?php echo base_url()?>assets/img/users/<?php echo $user['user_image'];?>" alt="<?php echo $user['user_image'];?>" width="100" height="10">
        <?php echo validation_errors();?>
        <?php echo  form_open_multipart('users/update_compte');?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="hidden"  name="id" value="<?php echo $user['id'];?>">
                    <label for="">Rôle</label>
                    <select name="role_user" id="" class="form-control">
                        <option value="<?php echo $user['role_utilisateur'];?>"><?php echo ucfirst($user['role_utilisateur']);?></option>
                        <option value="admin">Admin</option>
                        <option value="billing">Billing Manager </option>
                        <option value="stock">Stock Manager</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Stutut</label>
                    <select name="statut" id="" class="form-control">
                        <option value="<?php echo $user['statut'];?>"><?php echo ucfirst($user['statut']);?></option>
                        <option value="online">Online</option>
                        <option value="offline">Offline</option>
                    </select>
                </div>
            </div>
        </div>
        <button  type="submit" class="btn btn-outline-success mb-5 ml-3" onclick="return confirm('Ces modifications seront appliquées, Voulez-vous continuer ?')">Modifier</button>
        </form>
        </div>
        <div class="pt-5 mb-5"></div>
        <div class="pt-1 mb-5"></div>
</div>
</main>
