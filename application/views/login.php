<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container" id="loging_box">
    <div class="row text-center">  
        <img src=<?php echo base_url("/img/header.png"); ?>>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
            <h1 class="text-center login-title">Bienvenido al sistema</h1>
            <div class="account-wall">
                <img class="profile-img" src=<?php echo base_url("/img/icon-user.png"); ?> alt="">
                <form id="formusr" method="post" name="formusr" class="form-signin">
                    <input id="usuario" name="usuario" type="text" class="form-control" placeholder="Usuario" required autofocus>
                    <input id="contra" name="contra" type="password" class="form-control" placeholder="Password" required>
                    <button type="submit" id="alaversh" class="btn btn-lg btn-primary btn-block">Acceder</button>
                </form>
            </div>
        </div>
    </div>
</div>