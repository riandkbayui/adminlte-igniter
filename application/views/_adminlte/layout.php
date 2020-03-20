<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->adminlte->websetting('setting_web_name') ?></title>
  <link rel="shortcut icon" href="<?php echo base_url($this->adminlte->websetting('setting_web_icon')) ?>" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/datepicker/css/bootstrap-datepicker3.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/toastr/toastr.min.css') ?>">
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.css') ?>"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>"> -->
<?php foreach ($css as $key => $var): ?>
  <link rel="stylesheet" href="<?php echo base_url($var) ?>">
<?php endforeach ?>

  <!-- jQuery -->
  <script src="<?php echo base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- moment -->
  <script src="<?php echo base_url('assets/') ?>plugins/moment/moment.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url('assets/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/') ?>dist/js/adminlte.js"></script>
  <!-- Custom -->
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/loading-overlay/loadingoverlay.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/number-format/jquery.number.min.js') ?>"></script>
  <!-- <script type="text/javascript" src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script> -->
  <!-- <script type="text/javascript" src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php foreach ($javascript as $key => $var): ?>
  <script type="text/javascript" src="<?php echo base_url($var) ?>"></script>
<?php endforeach ?>

  <script type="text/javascript">
      $.fn.select2.defaults.set("theme", "bootstrap4");
      $.fn.datepicker.defaults.format = "dd-mm-yyyy";
  </script>

</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper">

  <?php echo $navbar ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:(0)" class="brand-link">
      <img src="<?php echo base_url($this->adminlte->websetting('setting_web_icon')) ?>" alt="<?php echo $this->adminlte->websetting('setting_web_name') ?> Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $this->adminlte->websetting('setting_web_name') ?></span>
    </a>

    <!-- Sidebar -->
    <?php echo $sidebar ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="pt-3"></div>
        <?php echo $contents ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php echo $footer ?>

  <script type="text/javascript">
    var input_index = 0;
    $('.next').keypress(function(event) {
      if (event.key == "Enter" || event.keyCode == 13) {
        input_index = $(this).index('.next');
        $('.next').eq(input_index + 1).focus();
        return false;
      }
    });

    $(document).on('focus', '.select2', function() {
        $(this).siblings('select').select2('open');
    });

    $(document).on('keydown', '.select2-search__field', function (e) {
        if (e.which === 13) {
            $('.next').eq(input_index + 2).focus();
        }
    });
  </script>

</div>
<!-- ./wrapper -->

</body>
</html>
