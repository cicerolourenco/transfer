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
        <h2>RESERVAS</h2>
        <ol class="breadcrumb">
            <li><a href="<?=DIR_ADM_HTM_ROOT?>">Home</a></li>
            <li class="active">Reservas</li>
        </ol>
    </div>


    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        Listar reservas
                    </h2>
                </div>
                <div class="body">
                    <?php 
                    $lista = Reserva::lista();
                    if(!$lista)
                    {
                        ?><p>Nenhum registro encontrado.</p><?php
                    }
                    else
                    {
                        ?>
                        <table class="table table-bordered table-striped table-hover dataTable tb_dados">
                        <thead>
                            <tr>
                                <th width="65"></th>
                                <?php /*<th>Passageiros e preço</th>*/ ?>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Data chegada</th>
                                <th>Data partida</th>
                                <th>Comuna</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($lista as $reserva) 
                            {
                                ?>
                                <tr>
                                    <td>
                                        <a href="editar/<?=$reserva->id?>" type="button" title="Visualizar" class="btn btn-default waves-effect"><i class="icon-display fa fa-search"></i></a>
                                        <a href="excluir/<?=$reserva->id?>" type="button" title="Excluir" class="btn btn-default waves-effect confirm_del"><i class="icon-display fa fa-trash"></i></a>
                                    </td>
                                    <?php
                                    /*
                                    <td>
                                        <?=$reserva->qtd_pax?>,
                                        <?=floor($reserva->qtd_chd_10)?>,
                                        <?=floor($reserva->qtd_chd_5)?>,
                                        <?=$reserva->calcula_preco()?>
                                    </td>
                                    */
                                    ?>
                                    <td><?=$reserva->nome?></td>
                                    <td><a href="mailto:<?=$reserva->email?>"><?=$reserva->email?></a></td>
                                    <td><?=$reserva->telefone?></td>
                                    <td><?=date('d/m/Y à\s H:i', strtotime($reserva->quando_chega))?></td>
                                    <td><?=date('d/m/Y à\s H:i', strtotime($reserva->quando_parte))?></td>
                                    <td><?=$reserva->get_comuna()?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </div><!-- .body -->
            </div><!-- .card -->
        </div><!-- .col -->
    </div><!-- .row -->
                

</div><!-- .container-fluid -->
</div><!-- .content-wrapper -->
</section>
<?php include(DIR_VIEW . 'admin/_inc/inc_footer.php'); ?>
</div><!-- .wrapper -->
<?php include(DIR_VIEW . 'admin/_inc/inc_js.php'); ?>
</body>
</html>