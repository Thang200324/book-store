<?php 
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucControler.php';
require_once './controllers/AdminSanPhamControler.php';
require_once './controllers/AdminDonHangControler.php';
require_once './controllers/AdminUserControler.php';
require_once './controllers/AdminBaoCaoThongKeControler.php';
require_once './controllers/AdminTaiKhoanControler.php';


// Require toàn bộ file Models
require_once './models/AdminSanPham.php';
require_once './models/AdminDanhMuc.php';
require_once './models/AdminDonHang.php';
require_once './models/AdminUser.php';  
require_once './models/AdminTaiKhoan.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
  //! trang chu
  '/' => (new AdminBaoCaoThongKeControler())-> home(),
  //!route danh muc
   'danh-muc' => (new AdminDanhMucControler())->danhSachDanhMuc(),
   'form-them-danh-muc' => (new AdminDanhMucControler())->formAddDanhMuc(),
  'them-danh-muc' => (new AdminDanhMucControler())->postAddDanhMuc(),
  'form-sua-danh-muc' => (new AdminDanhMucControler())->formEditAddDanhMuc(),
  'sua-danh-muc' => (new AdminDanhMucControler())->postEditDanhMuc(),
  'xoa-danh-muc' => (new AdminDanhMucControler())->deleteDanhMuc(),
  
  //! route san pham
  'san-pham' => (new AdminSanPhamControler())->danhSachSanPham(),
  'form-them-san-pham' => (new AdminSanPhamControler())->formAddSanPham(),
  'them-san-pham' => (new AdminSanPhamControler())->postAddSanPham(),
   'form-sua-san-pham' => (new AdminSanPhamControler())->formEditSanPham(),
   'sua-san-pham' => (new AdminSanPhamControler())->postEditSanPham(),
   'sua-album-anh-san-pham' => (new AdminSanPhamControler())->postEditAnhSanPham(),
   'xoa-san-pham' => (new AdminSanPhamControler())->deleteSanPham(),
   'chi-tiet-san-pham' => (new AdminSanPhamControler())->detailSanPham(),

   //! route quản lý đơn hàng
  'don-hang' => (new AdminDonHangControler())->danhSachDonHang(),
   //'form-sua-don-hang' => (new AdminDonHangControler())->formEditDonHang(), 
   //'sua-don-hang' => (new AdminDonHangControler())->postEditDonHang(),
   //'xoa-don-hang' => (new AdminDonHangControler())->deleteDonHang(),
   'chi-tiet-don-hang' => (new AdminDonHangControler())->detailDonHang(),

   //! route tai khoan
   'tai-khoan' => (new AdminUserControler())->userListAll(),
   'tai-khoan-detail' => (new AdminUserControler())->userShowOne($_GET['id']),
   'tai-khoan-them' => (new AdminUserControler())->userCreate(),
   'tai-khoan-sua' => (new AdminUserControler())->userEdit($_GET['id']),
   'tai-khoan-xoa' => (new AdminUserControler())->userDelete($_GET['id']),

//! route quan ly tai khoan quan tri
// !quan ly tai khoan quan tri
'list-tai-khoan-quan-tri' => (new AdminTaiKhoanControler())->danhSachQuanTri(),
'form-them-quan-tri' => (new AdminTaiKhoanControler())->formAddQuanTri(),
'them-quan-tri' => (new AdminTaiKhoanControler())->postAddQuanTri(),
'form-sua-quan-tri' => (new AdminTaiKhoanControler())->formEditQuanTri(),
'sua-quan-tri' => (new AdminTaiKhoanControler())->postEditQuanTri(),

//! route reset Password 
'reset-password' => (new AdminTaiKhoanControler())->resetPassword(),

//! route quan ly tai khoan khach hang
'list-tai-khoan-khach-hang' => (new AdminTaiKhoanControler())->danhSachKhachHang(),
'form-sua-khach-hang' => (new AdminTaiKhoanControler())->formEditKhachHang(),
'sua-khach-hang' => (new AdminTaiKhoanControler())->postEditKhachHang(),
'chi-tiet-khach-hang' => (new AdminTaiKhoanControler())->detailKhachHang(),







};