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
        <h2>RESERVA</h2>
        <ol class="breadcrumb">
            <li><a href="<?=DIR_ADM_HTM_ROOT?>">Home</a></li>
            <li><a href="<?=DIR_ADM_HTM_ROOT?>reservas">Reservas</a></li>
            <li class="active">Edição de reserva</li>
        </ol>
    </div>

    <div class="row clearfix"><div class="col-lg-12"><div class="card <?=$this->modo?>"><div class="body"><div class="row"><div class="col-xs-12">
        <div class="card-inner">
            <h4 class="card-inner-header">Dados de contato</h4>
            <button type="button" title="Editar" class="btn btn-default waves-effect bt_editar"><i class="icon-display fa fa-pencil"></i></button>

            <form method="post" id="form_principal">

            <div class="row clearfix">
                <div class="col-md-6 col-lg-4">
                    <?php \Campo::write($this, array('id'=>'nome', 'label'=>'Nome', 'obs'=>'Nome completo do responsável')); ?>
                </div>

                <div class="col-md-6 col-lg-4">
                    <?php \Campo::write($this, array('id'=>'email', 'label'=>'E-mail', 'type'=>'email')); ?>
                </div>

                <div class="col-md-6 col-lg-2">
                    <?php \Campo::write($this, array('id'=>'cpf', 'label'=>'CPF', 'maxlength'=>14, 'contador'=>true)); ?>
                </div>

                <div class="col-md-6 col-lg-2">
                    <?php \Campo::write($this, array('id'=>'telefone', 'label'=>'Telefone', 'maxlength'=>20)); ?>
                </div>
            </div><!-- .row.clearfix -->




            <h4 class="card-inner-header">Dados da reserva</h4>

            <div class="row clearfix">

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'tiporeserva', 'label'=>'Tipo', 'type'=>'select', 'lista'=>ReservaTipo::lista_select(), 'vazia'=>false, 'value'=>$this->tipo)); ?>
                </div>

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'qtd_adt', 'label'=>'Adultos', 'obs'=>'(10 anos ou mais)', 'type'=>'select', 'lista_simples'=>array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30))); ?>
                </div>

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'qtd_chd_5', 'label'=>'Bebês', 'obs'=>'(0 a 4 anos)', 'type'=>'select', 'lista_simples'=>array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30))); ?>
                </div>

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'qtd_chd_10', 'label'=>'Crianças', 'obs'=>'(5 a 9 anos)', 'type'=>'select', 'lista_simples'=>array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30))); ?>
                </div>

                <div class="col-md-6 col-lg-6">
                    <?php \Campo::write($this, array('id'=>'id_bairro', 'label'=>'Bairro', 'type'=>'select', 'lista'=>Bairro::lista_select(), 'vazia'=>true, 'value'=>$this->bairro)); ?>
                </div>

                <div class="col-md-6 col-lg-6">
                    <?php \Campo::write($this, array('id'=>'endereco_destino', 'label'=>'Endereço do destino')); ?>
                </div>

            </div><!-- .row.clearfix -->


            <h4 class="card-inner-header">Voos e horários</h4>

            <div class="row clearfix">

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'quando_chega', 'label'=>'Pouso previsto', 'type'=>'datetimedupla', 'obs'=>'Voo de chegada', 'obr'=>'')); ?>
                </div>

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'numero_voo_chega', 'label'=>'Número do voo', 'obs'=>'Voo de chegada', 'obr'=>'')); ?>
                </div>

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'bool_internacional', 'label'=>'Voo internacional?', 'type'=>'checkbox', 'classes'=>'agree')); ?>
                </div>

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'bool_duty_free', 'label'=>'Deseja passar no Duty Free?', 'label0'=>'Não', 'label1'=>'Sim, deseja', 'type'=>'checkbox', 'classes'=>'agree')); ?>
                </div>

            </div><!-- .row.clearfix -->

            <div class="row clearfix">

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'quando_parte', 'label'=>'Decolagem prevista', 'type'=>'datetimedupla', 'obs'=>'Voo de partida', 'obr'=>'')); ?>
                </div>

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'numero_voo_parte', 'label'=>'Número do voo', 'obs'=>'Voo de partida', 'obr'=>'')); ?>
                </div>

                <div class="col-md-6 col-lg-3">
                    <?php \Campo::write($this, array('id'=>'hora_parte_hotel', 'label'=>'Saída do hotel', 'type'=>'horapicker', 'obs'=>'Horário do retorno', 'obr'=>'')); ?>
                </div>

                <div class="col-md-6 col-lg-3 cond ver">
                    <label class="form-label">Preço</label>
                    <div class="form-group">
                        <div class="form-line">
                            <span class="value"><?php if($this->preco) { ?>CLP <?=Utils::formata_num($this->preco, 0)?><?php } ?></span>
                        </div>
                    </div>
                </div>                

                <div class="col-md-6 col-lg-3 cond editar">
                    <div class="toplabel">Preço <em>(CLP <?=Utils::formata_num($this->preco, 0)?>)</em></div>
                    <input type="checkbox" id="bool_recalcular" name="bool_recalcular" class="filled-in chk-col-light-blue">
                    <label for="bool_recalcular" class="checklabel">Recalcular valor</label>
                </div>

            </div><!-- .row.clearfix -->


            <h4 class="card-inner-header">Informações complementares</h4>

            <div class="row clearfix">

                <div class="col-md-12 col-lg-12">
                    <?php \Campo::write($this, array('id'=>'observacoes', 'label'=>'Observações', 'type'=>'textarea', 'maxlength'=>1000, 'contador'=>true, 'obr'=>false, 'obs'=>'Texto visível para o cliente, mesmo depois da reserva')); ?>
                </div>

                <div class="col-md-6 col-lg-6">
                    <?php \Campo::write($this, array('id'=>'id_indicacao', 'label'=>'Indicação', 'type'=>'select', 'lista'=>Indicacao::lista_select(), 'vazia'=>true, 'value'=>$this->indicacao)); ?>
                </div>

                <div class="col-md-6 col-lg-6">
                    <?php \Campo::write($this, array('id'=>'motorista', 'label'=>'Motorista', 'obr'=>false)); ?>
                </div>

                <?php
                if($this->objeto)
                {
                    ?>
                    <div class="col-md-6 col-lg-6">
                        <label class="form-label">Link de alteração</label>
                        <div class="form-group">
                            <span class="valor"><a href="<?=$this->objeto->get_link_altera()?>"><?=$this->hash?></a></span>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div><!-- .row.clearfix -->


            
            <div class="botoes">
                <button type="submit" class="btn btn-primary m-t-15 waves-effect bt_salvar ladda-button" data-style="zoom-in"><span class="ladda-label">SALVAR</span><span class="ladda-spinner"></span></button>
                <button type="button" class="btn btn-default m-t-15 waves-effect bt_cancelar" data-destino="listar">CANCELAR</button>

                <div class="preloader"><div class="spinner-layer spinner-primary"><div class="circle-clipper fl-left"><div class="circle"></div></div><div class="circle-clipper fl-right"><div class="circle"></div></div></div></div>
            </div><!-- .botoes -->


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