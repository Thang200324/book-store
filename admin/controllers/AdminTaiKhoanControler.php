<?php
 class AdminTaiKhoanControler {
    public $modelsTaiKhoan;
    public $modelsDonHang;


    public function __construct() {
        $this->modelsTaiKhoan = new AdminTaiKhoan();
        $this->modelsDonHang = new AdminDonHang();
    }
    public function danhSachQuanTri() {
       $listQuanTri = $this->modelsTaiKhoan->getAllTaiKhoan(1);
       //var_dump($listQuanTri);die;
       require_once './views/taikhoan/quantri/listQuanTri.php';
    }
    public function formAddQuanTri(){
        require_once './views/taikhoan/quantri/addQuanTri.php';
        deleteSessionError();
    }
    public function postAddQuanTri(){
        // them du lieu

        // kiem  tra du lieu co phai duoc them khong
        if($_SERVER['REQUEST_METHOD']=='POST'){

            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];

            // tao mot mang trong de chua du lieu

            $errors =[];
            if(empty($ho_ten)){
                $error['ho_ten'] = 'Tên  không được để trống';
            }
            if(empty($email)){
                $error['email'] = 'Email không được để trống';
            }
            $_SESSION['error'] = $errors;
            // neu co loi thi tien hanh them tai khoan
            if(empty($errors)){
                // neu ko co loi thi tien hanh them tai khoan
               // var_dump('ok');
              // dat password mac dinh - 123abc
              $password = password_hash('123@123ab', PASSWORD_BCRYPT);
              //var_dump($password);die;
              // khai bao chuc cu
              $chuc_vu_id = 1;
            $this->modelsTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);


               header("Location: " . BASE_URL_ADMIN .'?act=list-tai-khoan-quan-tri');
               exit();
            }else{
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN .'?act=form-them-quan-tri');
                exit();
            }
        }
    }
    public function formEditQuanTri () {
        $id_quan_tri = $_GET['id_quan_tri'];
        $quanTri = $this->modelsTaiKhoan->getDetailTaiKhoan($id_quan_tri);
        //var_dump($quanTri);die;

        require_once './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();

    }
    public function postEditQuanTri()
    {
        // them du lieu

        // kiem  tra du lieu co phai duoc them khong
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //lay ra du lieu
            // lay ra du lieu cu cua san pham
            $quan_tri_id = $_POST['quan_tri_id'] ?? '';
            // Truy van


            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            
         


            // tao mot mang trong de chua du lieu

            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Vui long chon trang thai';
            }
            



            $_SESSION['error'] = $errors;

            // logic sua anh
           

            // neu co loi thi hien thi lai form
            if (empty($errors)) {
                // neu ko co loi thi tien hanh them san pham

               $this->modelsTaiKhoan->updateTaiKhoan($quan_tri_id, $ho_ten, $email, $so_dien_thoai, $trang_thai);
                header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');

                exit();
            } else {
                //trả về form lỗi
                //đặt chỉ thị xóa session sau khi hiện thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit();
            }
        }
    }
    public function resetPassword() {
        $tai_khoan_id = $_GET['id_quan_tri'];
        $tai_khoan = $this->modelsTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
        $password = password_hash('123@123ab', PASSWORD_BCRYPT);

        $status =$this->modelsTaiKhoan->resetPassword($tai_khoan_id, $password);
        //var_dump($status);die();
        if($status && $tai_khoan['chuc_vu_id']) {
            header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
        }elseif($status && $tai_khoan['chuc_vu_id']) {
            header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
            exit();
        }else{
            var_dump("loi khi reset tai khoan");die();
        }
    }
    
    public function danhSachKhachHang() {
       $listKhachHang = $this->modelsTaiKhoan->getAllTaiKhoan(2);
       //var_dump($listQuanTri);die;
       require_once './views/taikhoan/khachhang/listKhachHang.php';
    }
    public function formEditKhachHang () {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelsTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        //var_dump($quanTri);die;

        require_once './views/taikhoan/khachhang/editKhachHang.php';
        deleteSessionError();

    }
    public function postEditKhachHang()
    {
        // them du lieu

        // kiem  tra du lieu co phai duoc them khong
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //lay ra du lieu
            // lay ra du lieu cu cua san pham
            $khach_hang_id = $_POST['khach_hang_id'] ?? '';
            // Truy van

            
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
         
            // tao mot mang trong de chua du lieu

            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngay sinh không được để trống';
            }
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'Gioi tinh không được để trống';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Dia chi không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Vui long chon trang thai';
            }
   
            $_SESSION['error'] = $errors;

            // logic sua anh

            // neu co loi thi hien thi lai form
            if (empty($errors)) {
                // neu ko co loi thi tien hanh them san pham

               $abc = $this->modelsTaiKhoan->updateKhachHang($khach_hang_id, $ho_ten, $email, $so_dien_thoai, $ngay_sinh,$gioi_tinh, $dia_chi, $trang_thai);
                header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
                exit();
            } else {
                //trả về form lỗi
                //đặt chỉ thị xóa session sau khi hiện thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
                exit();
            }
        }
    }
    public function detailKhachHang() {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this-> modelsTaiKhoan-> getDetailTaiKhoan($id_khach_hang);
          
       // $listDonHang = $this->modelsDonHang->getDonHangFormKhachHang($id_khach_hang);
        require_once './views/taikhoan/khachhang/detailKhachHang.php';
    }
 }