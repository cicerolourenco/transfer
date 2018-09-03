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
        <h2>REGIÕES</h2>
        <ol class="breadcrumb">
            <li><a href="<?=DIR_ADM_HTM_ROOT?>">Home</a></li>
            <li class="active">Parceiros</li>
        </ol>
    </div>


    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        Listar parceiros
                    </h2>
                </div>
                <div class="body">
                    <?php 
                    $lista = Indicacao::lista();
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
                                <th width="80"></th>
                                <th>Nome</th>
                                <th>pid (ID do parceiro)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($lista as $parceiro) 
                            {
                                $disable_del = !$parceiro->pode_deletar() ? 'disabled' : '';
                                ?>
                                <tr>
                                    <td>
                                        <a href="editar/<?=$parceiro->id?>" type="button" title="Visualizar" class="btn btn-default waves-effect"><i class="icon-display fa fa-search"></i></a>
                                        <a href="excluir/<?=$parceiro->id?>" type="button" title="Excluir" class="btn btn-default waves-effect confirm_del" <?=$disable_del?> ><i class="icon-display fa fa-trash"></i></a>
                                    </td>
                                    <td><?=$parceiro->nome?></td>
                                    <td><?=$parceiro->id?></td>
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




    <!-- TESTE DE PARCEIROS -->
    <div class="row" style="display: none;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        Teste de parceiro
                    </h2>
                </div>
                <div class="body">
                    <form method="post" action="http://transferbrasil.cl/reservas/" target="_blank">
                        <input type="text" name="pid" placeholder="pid" />
                        <input type="text" name="qtd_adt" placeholder="adultos" />
                        <input type="text" name="qtd_chd_5" placeholder="bebês" />
                        <input type="text" name="qtd_chd_10" placeholder="crianças" />

                        <select class="input-group-field placeholder" name="id_bairro">
                            <option disabled selected hidden value="">Bairro</option>
                            <?php
                            $lista = Bairro::lista();
                            foreach($lista as $bairro)
                            {
                                ?>
                                <option value="<?=$bairro->id?>"><?=$bairro->nome?></option>
                                <?php
                            }
                            ?>
                        </select>

                        <input type="text" name="endereco_destino" placeholder="Endereço" />

                        <select class="input-group-field placeholder" name="tiporeserva">
                            <option disabled selected hidden value="">Tipo de reserva</option>
                            <?php
                            $lista = ReservaTipo::lista_select();
                            foreach($lista as $k=>$v)
                            {
                                ?>
                                <option value="<?=$k?>"><?=$v?></option>
                                <?php
                            }
                            ?>
                        </select>
                                                

                        <input type="hidden" name="etapa" value="1" />
                        <input type="submit" value="enviar" />
                    </form>
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