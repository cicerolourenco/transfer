<!DOCTYPE html>
<html>
<head>
<?php include(DIR_VIEW . 'admin/_inc/inc_head.php'); ?>
</head>
<body class="theme-indigo light">
<div class="wrapper">
<?php include(DIR_VIEW . 'admin/_inc/inc_loader.php'); ?>
<?php include(DIR_VIEW . 'admin/_inc/inc_topbar.php'); ?>
<?php include(DIR_VIEW . 'admin/_inc/inc_menu.php'); ?>
<?php include(DIR_VIEW . 'admin/_inc/inc_sidebar.php'); ?>
<section>
<div class="content-wrapper">
<div class="container-fluid">

    <div class="page-header">
        <h2>COMUNA</h2>
        <ol class="breadcrumb">
            <li><a href="<?=DIR_ADM_HTM_ROOT?>">Home</a></li>
            <li><a href="<?=DIR_ADM_HTM_ROOT?>reservas">Regiões</a></li>
            <li class="active">Edição de comuna</li>
        </ol>
    </div>

    <div class="row clearfix"><div class="col-lg-12"><div class="card <?=$this->modo?>"><div class="body"><div class="row"><div class="col-xs-12">
        <div class="card-inner">
            <h4 class="card-inner-header">Dados da comuna</h4>
            <button type="button" title="Editar" class="btn btn-default waves-effect bt_editar"><i class="icon-display fa fa-pencil"></i></button>

            <form method="post" id="form_principal">

            <div class="row clearfix">
                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'nome', 'label'=>'Nome da comuna')); ?>
                </div>

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'preco3', 'label'=>'Preço para até 3 pessoas', 'obs'=>'Valor para o grupo todo (pesos)')); ?>
                </div>

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'preco4', 'label'=>'Preço para 4 pessoas', 'obs'=>'Valor para o grupo todo (pesos)')); ?>
                </div>

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'preco5', 'label'=>'Preço acima de 5 pessoas', 'obs'=>'Valor por pessoa (pesos)')); ?>
                </div>

            </div><!-- .row.clearfix -->

            
            <br />
            <div class="botoes">
                <button type="submit" class="btn btn-primary m-t-15 waves-effect bt_salvar ladda-button" data-style="zoom-in"><span class="ladda-label">SALVAR</span><span class="ladda-spinner"></span></button>
                <button type="button" class="btn btn-default m-t-15 waves-effect bt_cancelar" data-destino="listar">CANCELAR</button>

                <div class="preloader"><div class="spinner-layer spinner-primary"><div class="circle-clipper fl-left"><div class="circle"></div></div><div class="circle-clipper fl-right"><div class="circle"></div></div></div></div></div>
            </form>
        </div><!-- .card-inner --></div><!-- .col --></div><!-- .row --></div><!-- .body --></div><!-- .card --></div><!-- .col -->
    </div><!-- .row -->



</div><!-- .container-fluid -->
</div><!-- .content-wrapper -->
</section>
<?php include(DIR_VIEW . 'admin/_inc/inc_footer.php'); ?>
</div><!-- .wrapper -->
<?php include(DIR_VIEW . 'admin/_inc/inc_js.php'); ?>
</body>
</html>