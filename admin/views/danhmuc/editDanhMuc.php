<!-- header -->
<?php include './views/layout/header.php'?>
  <!-- Navbar -->
  <?php include './views/layout/navbar.php'?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include './views/layout/sidebar.php'?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Sua danh muc san phan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="card card-primary">
            
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= BASE_URL_ADMIN . '?act=sua-danh-muc'?>" method="POST">
                <input type="text" name="id" value="<?= $danhMuc['id']?>" hidden>
                <div class="card-body">
                  <div class="form-group">
                    <label >Ten danh muc</label>
                    <input type="text" class="form-control" name="ten_danh_muc" value="<?= $danhMuc['ten_danh_muc']?>" placeholder="Nhap ten danh muc">
                    <?php if(isset($errors['ten_danh_muc'])) {?>
                      <p class="text-danger"><?= $errors['ten_danh_muc']?></p>
                   <?php }?>
                  </div>
                  <div class="form-group">
                    <label >Mo ta danh muc</label>
                    <textarea name="mo_ta" id="" class="form-control" placeholder="nhap mo ta"><?= $danhMuc['mo_ta']?></textarea>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   <!-- Footer -->
    <?php include './views/layout/footer.php'?>
    <!-- End footer -->
     
 
<!-- Page specific script -->

</body>
</html>
