<!DOCTYPE html>
<html>
<head>
<?php include(DIR_VIEW . 'admin/_inc/inc_head.php'); ?>
</head>
<body class="login-page">
<div class="login-box">
    <div class="card">
        <div class="body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-logo">
                        <img src="<?=DIR_HTM_VIEW?>admin/_assets/images/transfer-brasil.png" alt="" class="img-responsive align-center">
                    </div>
                </div>
            </div>
            <form id="log_in" method="POST">
                <div class="input-group addon-line">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" value="<?=$_POST['email']?>" placeholder="E-mail" required autofocus>
                    </div>
                </div>
                <div class="input-group addon-line">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                    </div>
                </div>
                <!--
                <div class="row">
                    <div class="col-xs-12 align-right p-t-5">
                        <a href="esqueci.php">Esqueceu a senha?</a>
                    </div>
                </div>
                -->

                <button class="btn btn-block btn-primary waves-effect" type="submit">ENTRAR</button>
            </form>

        </div><!-- .body -->

        <?php
        if($this->erro[0]!=0)
        {
            ?>
            <div class="alert dark alert-danger alert-icon" role="alert">
                <i class="material-icons">clear</i>
                <?=$this->erro[1]?>
            </div><!-- .alert -->
            <?php
        }
        ?>

    </div><!-- .card -->
</div><!-- .login-box -->


<?php include(DIR_VIEW . 'admin/_inc/inc_js.php'); ?>
</body>
</html>