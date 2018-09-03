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
        <h2>HOME</h2>
	    <p>Olá, <?=Utils::primeiro_nome($this->con_adm_usuario->nome)?>!</p>
        <ol class="breadcrumb">
            <li class="active">Home</li>
        </ol>
    </div>



    <div class="row clearfix">

        <div class="col-md-12 col-lg-6">
            <h3>Próximos transfers</h3>
	        <p>Fuso-horário de <?=date_default_timezone_get()?>: <strong id="relogio"></strong></p>
            <div class="card proximas">
                <div class="card-header">
                    <?php
                    $lista = Reserva::get_proximas();
                    if(!$lista)
                    {
                        ?><p>Nenhuma reserva futura.</p><?php
                    }
                    else
                    {
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
	                            <tbody>
	                                <?php 
	                                foreach ($lista as $reserva) 
	                                {
	                                    ?>
	                                    <tr>
	                                    	<td width="20" class="<?=$reserva->tipo?>"><i class="fa fa-circle"></i></td>
	                                        <td>
	                                            <a href="<?=DIR_ADM_HTM_ROOT?>reservas/editar/<?=$reserva->id?>">
	                                            	<strong><?=date('d/m H:i', strtotime($reserva->quando_criterio))?></strong>
	                                            	<?=$reserva->nome?></a>
	                                        </td>
	                                        <td><?=$reserva->get_comuna()?></td>
	                                    </tr>
	                                    <?php
	                                }
	                                ?>
	                            </tbody>
	                        </table>
	                    </div><!-- .table-responsive -->
                        <p><a href="<?=DIR_ADM_HTM_ROOT?>reservas/listar">Ver todas as reservas &raquo;</a></p>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div><!-- .col -->


    </div>




</div><!-- .container-fluid -->
</div><!-- .content-wrapper -->
</section>
<?php include(DIR_VIEW . 'admin/_inc/inc_footer.php'); ?>
</div><!-- .wrapper -->
<?php include(DIR_VIEW . 'admin/_inc/inc_js.php'); ?>

<script type="text/javascript">
function displayTime() {
    var time = moment().tz('<?=date_default_timezone_get()?>').format('HH:mm:ss');
    $('#relogio').html(time);
    setTimeout(displayTime, 1000);
}

$(document).ready(function() {
    displayTime();
});

</script>

</body>
</html>