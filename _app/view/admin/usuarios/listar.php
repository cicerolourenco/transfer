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
        <h2>USUÁRIOS</h2>
        <ol class="breadcrumb">
            <li><a href="<?=DIR_ADM_HTM_ROOT?>">Home</a></li>
            <li class="active">Listar usuários</li>
        </ol>
    </div>


    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        Listar usuários
                    </h2>
                </div>
                <div class="body">
                    <?php 
                    $rep = new TRepository('UsuarioCMS');
                    $crit = new TCriteria();
                    $crit->setProperty('order', 'nome');
                    $lista = $rep->load($crit);

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
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $usuarioLogado = unserialize($_SESSION['con_adm_usuario']);

                            foreach ($lista as $usuario) 
                            {
                                $disabled = $usuario->id == $usuarioLogado->id ? 'disabled' : '';
                                ?>
                                <tr>
                                    <td>
                                        <a href="editar/<?=$usuario->id?>" type="button" title="Visualizar" class="btn btn-default waves-effect"><i class="icon-display fa fa-search"></i></a>
                                        <a href="excluir/<?=$usuario->id?>" type="button" title="Excluir" class="btn btn-default waves-effect confirm_del" <?=$disabled?>><i class="icon-display fa fa-trash"></i></a>
                                    </td>
                                    <td><?=$usuario->nome?></td>
                                    <td><a href="mailto:<?=$usuario->email?>"><?=$usuario->email?></a></td>
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