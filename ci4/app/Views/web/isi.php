<script src="<?php echo base_url() ?>/admin-lte-master/pesan/js/shoppingCart.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Beranda</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          



      </div><!-- /.container-fluid -->
      
      
    </section>
    <!-- /.content -->
    

</div>
<script>
  $('.info-box-number').each(function () {
    $(this).prop('Counter',-1).animate({
      Counter: $(this).text()
    }, {
      duration: 2450,
      easing: 'swing',
      step: function (now) {
        $(this).text(Math.ceil(now));
      }
    });
  });
</script>