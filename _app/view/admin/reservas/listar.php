<!DOCTYPE html>
<html>
<head>
    <?php include(DIR_VIEW . 'admin/_inc/inc_head.php'); ?>
    <style type="text/css">
        .bt_icon {
            display: inline-block;
            margin-bottom: 30px;
            padding: 10px 10px 5px 10px;
            border: 1px solid #eee;
            color: #666;
        }
        .bt-icon:hover {
            background-color: #f5f5f5;
            border-color: #ddd;
        }
    </style>
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
                        <a href="#" id="bt_export_excel" class="bt_icon" title="download"><i class="icon-display material-icons">file_download</i></a>
                        <?php
                        Reserva::cria_export();
                        ?>
                        <table class="table table-bordered table-striped table-hover dataTable tb_dados">
                        <thead>
                            <tr>
                                <th width="65"></th>
                                <?php /*<th>Passageiros e preço</th>*/ ?>
                                <th>Nome</th>
                                <th>Pessoas</th>
                                <th>Data chegada</th>
                                <th>Data partida</th>
                                <th>Hora hotel</th>
                                <th>Endereço</th>
                                <th>Motorista</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($lista as $reserva) 
                            {
                                $quando_chega_fmt = $reserva->quando_chega==null ? '---' : date('d/m/Y à\s H:i', strtotime($reserva->quando_chega));
                                $quando_parte_fmt = $reserva->quando_parte==null ? '---' : date('d/m/Y à\s H:i', strtotime($reserva->quando_parte));
                                $hora_parte_hotel_fmt = $reserva->hora_parte_hotel==null ? '---' : date('H:i', strtotime($reserva->hora_parte_hotel));
                                ?>
                                <tr>
                                    <td>
                                        <a href="editar/<?=$reserva->id?>" type="button" title="Visualizar" class="btn btn-default waves-effect"><i class="icon-display fa fa-search"></i></a>
                                        <a href="excluir/<?=$reserva->id?>" type="button" title="Excluir" class="btn btn-default waves-effect confirm_del"><i class="icon-display fa fa-trash"></i></a>
                                    </td>
                                    <td><?=$reserva->nome?></td>
                                    <td><?=$reserva->get_qtd_pax()?></td>
                                    <td><?=$quando_chega_fmt?></td>
                                    <td><?=$quando_parte_fmt?></td>
                                    <td><?=$hora_parte_hotel_fmt?></td>
                                    <td><?=$reserva->endereco_destino?></td>
                                    <td><?=$reserva->motorista?></td>
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

<script type="text/javascript">
    $(document).ready(function () {
        $('#bt_export_excel').on('click', function() {
            var excel = new Excel();
            excel.export('#tbexport', 'reservas', 'reservas.xls');
        });
    });
</script>
</body>
</html>