
    <!-- CORE PLUGIN JS -->
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery/jquery.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/bootstrap/js/bootstrap.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/node-waves/waves.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/modernizr/modernizr.custom.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/screenfull/dist/screenfull.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jQuery-Storage-API/jquery.storageapi.js"></script>
    
    <!-- DATE/TIME PICKER -->
    <?php /* <script src="<?=DIR_HTM_VIEW?>admin/_plugins/momentjs/moment.js"></script>*/ ?>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/calendar/moment-with-locales.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/momentjs/moment-timezone-with-data.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>


    <!-- USADO JÁ NO LOGIN, então já pode ficar em todas as páginas -->
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-validation/jquery.validate.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-validation/localization/messages_pt_BR_codigo8.js"></script>


    <!-- LAYOUT JS -->
    <script src="<?=DIR_HTM_VIEW?>admin/_assets/js/demo.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_assets/js/layout.js"></script>


    <!-- jQuery DataTable -->
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <?php
    /*    
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/dataTables.keyTable.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/dataTables.responsive.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/responsive.bootstrap.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/dataTables.scroller.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/jquery-datatable/extensions/export/dataTables.fixedHeader.min.js"></script>
    */
    ?>


    <!-- Código8 -->
    <script src="<?=DIR_HTM_VIEW?>admin/_assets/js/codigo8/geral.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_assets/js/codigo8/dataTables.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_assets/js/codigo8/forms.js"></script>


    <!-- Notificações -->
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Alertify -->
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/alertify/js/alertify.js"></script>

    <!-- Calendário -->
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/calendar/fullcalendar.min.js"></script>
    <script src="<?=DIR_HTM_VIEW?>admin/_plugins/calendar/pt-br.js"></script>



    <!-- notificações no final da página -->
    <script type="text/javascript">
        <?php 
        // notificações
        if($this->msg_sucesso!='') { ?>Notifica.show('<?=$this->msg_sucesso?>', 'sucesso');<?php }
        if($this->msg_erro!='') { ?>Notifica.show('<?=$this->msg_erro?>', 'erro');<?php }
        ?>
    </script>


