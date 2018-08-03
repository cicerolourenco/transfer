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
        <h2>AGENDA</h2>
        <p>Reservas no fuso-horário de Santiago/Chile: <strong id="relogio"></strong></p>
        <ol class="breadcrumb">
            <li><a href="<?=DIR_ADM_HTM_ROOT?>">Home</a></li>
            <li class="active">Agenda</li>
        </ol>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div id="calendar"></div>
        </div><!-- .col -->
    </div><!-- .row -->


                

</div><!-- .container-fluid -->
</div><!-- .content-wrapper -->
</section>
<?php include(DIR_VIEW . 'admin/_inc/inc_footer.php'); ?>
</div><!-- .wrapper -->
<?php include(DIR_VIEW . 'admin/_inc/inc_js.php'); ?>

<script type="text/javascript">
$(function() {
    $('#calendar').fullCalendar({
        locale: 'pt-br',
        timeFormat: 'HH:mm',
        header: {
            left: 'title',
            center: '',
            right: 'today prev,next month,basicWeek,listWeek'
        },
        resources: [
            {
              id: 'a',
              title: 'Reserva'
            }
          ],
          events: <?=Reserva::get_eventos()?>
    })
});   


function displayTime() {
    var time = moment().tz('America/Santiago').format('HH:mm:ss');
    $('#relogio').html(time);
    setTimeout(displayTime, 1000);
}

$(document).ready(function() {
    displayTime();
});

</script>

</body>
</html>