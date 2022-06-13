<!doctype html>
<html lang="fr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="<?php echo base_url()?>assets/img/officedatabase_104402.ico" rel="icon" type="image/ico">

    <title>Logistic | by Rick Soft</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()?>assets/css/vendor/signin.css" rel="stylesheet">
    <style>
    html,
    body {
    height: 100%;
    }

    body {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
    }

    .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
    }
    .form-signin .checkbox {
    font-weight: 400;
    }
    .form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
    }
    .form-signin .form-control:focus {
    z-index: 2;
    }
    .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    }
    </style>
</head>

<body class="text-center">
<div class="col col-md-4"></div>
<div class="col-md-4 col-sm-12">
<div class="card">
    <?php if ($this->session->flashdata('delay_expirate')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><?php echo $this->session->flashdata('delay_expirate'); ?></strong>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('connexion_failed')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><?php echo $this->session->flashdata('connexion_failed'); ?></strong>
        </div>
    <?php endif; ?>

    <?php echo form_open('login/index','class="form-signin"'); ?>
     <img class="mb-4 rounded" src="<?php echo base_url()?>assets/img/logo.jpg" alt="" width="300" height="150">
    <div class="card-body mb-5 p-5">
        <?php if (date('Y-m-d')>='2022-05-20'):?>
            <div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>L'application nécessite de nouvelles mises à jour</strong>
            </div>
        <?php else: ?>
        <h1 class="h3 mb-3 font-weight-normal">Login</h1>
            <label for="inputEmail" class="sr-only">Nom d'utilisateur</label>
            <input type="text" id="inputEmail" class="form-control" name="username" placeholder="Nom d'utilisateur" required autofocus>
            <label for="inputPassword" class="sr-only">Mot de passe</label>
            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
            <div class="checkbox mb-3">
                
            </div>
            <button class="btn btn-md btn-outline-primary btn-block" type="submit">Connexion</button>
        <?php endif; ?>
    </form>
    </div>
</div>
</div>
</body>
</html>
