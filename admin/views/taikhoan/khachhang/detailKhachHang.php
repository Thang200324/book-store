<!-- header -->
<?php include './views/layout/header.php' ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php' ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Quản lý danh sách tai khoan khach hang</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                <img src="<?= BASE_URL . $sanPham['anh_dai_dien'] ?>" style="width: 70%" alt="" onerror="this.onerror=null; this.src='https://scontent.fhan15-2.fna.fbcdn.net/v/t39.30808-1/323061019_530127885805157_4196446298933044251_n.jpg?stp=dst-jpg_p200x200&_nc_cat=111&ccb=1-7&_nc_sid=0ecb9b&_nc_ohc=AxsfpFnNrYgQ7kNvgGjoXou&_nc_ht=scontent.fhan15-2.fna&oh=00_AYDSa_VYAWn4Nh1ToYZZ4bTSQWDnO09Omsl9Q8cdAC56ag&oe=66AB529F'">                  
                </div>
            <div class="col-6">
            <div class="container">
                <table class="table table-borderless">
                    
                    <tbody style="font-size: x-large;">
                        <tr>
                            <th>Ho ten:</th>
                            <td><?= $khachHang['ho_ten'] ?? ''?></td>
                        </tr>
                        <tr>
                            <th>Ngay Sinh:</th>
                            <td><?= $khachHang['ngay_sinh']?? '' ?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><?= $khachHang['email']?? ''?></td>
                        </tr>
                        <tr>
                            <th>So dien thoai</th>
                            <td><?= $khachHang['so_dien_thoai']?? ''?></td>
                        </tr>
                        <tr>
                            <th>Gioi tinh</th>
                            <td><?= $khachHang['gioi_tinh']== 1 ? 'Nam': 'Nu'?></td>
                        </tr>
                        <tr>
                            <th>Dia chi:</th>
                            <td><?= $khachHang['dia_chi']?? ''?></td>
                        </tr>
                        <tr>
                            <th>Trang Thai</th>
                            <td><?= $khachHang['trang_thai'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?></td>
                        </tr>
                        
                    </tbody>
                    
                  
                </table>
                </div>
            </div>
            <div class="col-12">
                <h2>Thong tin mua hang</h2>
                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên người nhận</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($listDonHang as $key => $donHang): ?>
                                    <tr>
                                        <td><?= $key +1?></td>
                                        <td><?= $donHang['ma_don_hang'] ?></td>
                                        <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                                        <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                                        <td><?= $donHang['ngay_dat'] ?></td>
                                        <td><?= $donHang['tong_tien']?></td>
                                        <td><?= $donHang['ten_trang_thai']?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a
                                                    href=" <?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' . $donHang['id']?>">
                                                    <button class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                                </a>
                                                <a
                                                    href=" <?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $donHang['id']?>">
                                                    <button class="btn btn-warning"><i
                                                            class="fas fa-tools"></i></button>
                                                </a>
                                            </div>



                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>
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
<?php include './views/layout/footer.php' ?>
<!-- End footer -->


<!-- Page specific script -->

</body>

</html>