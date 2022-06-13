<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <a href="<?php echo base_url()?>pages/dashboards">Page d'accueil</a>
                    <span>/</span>
                    <span><?php echo $title;?></span>
                </h4>

            </div>

        </div>

<h2 style="color: darkorange; font-size: large;"><?php echo $title;?></h2>

<?php echo validation_errors();?>
<?php echo  form_open_multipart('users/create');?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Nom</label>
            <input type="text" class="form-control" name="username" required="required">
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Rôle</label>
            <select name="role_user" class="form-control" required>
                <option value="">Sélectionner</option>
                <option value="admin">Admin</option>
                <option value="billing">Billing Manager </option>
                <option value="stock">Stock Manager</option>
            </select>
        </div>
    </div>
    <button  type="submit" class="btn btn-outline-warning mb-5 ml-3">Enregistrer</button>
</div>
</form>
        <div class="pt-1 mb-1"></div>
</div>
</main>