<?php

class AdminDanhMucControler{
    public $modelDanhMuc;
        public function __construct()
        {
            $this->modelDanhMuc = new AdminDanhMuc();
        }
    public function danhSachDanhMuc(){
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/danhmuc/listDanhMuc.php';
    }

    public function formAddDanhMuc(){
        // ham dung de hien thi form nhan
        require_once './views/danhmuc/addDanhMuc.php';

    }
    public function postAddDanhMuc(){
        // them du lieu

        // kiem  tra du lieu co phai duoc them khong
        if($_SERVER['REQUEST_METHOD']=='POST'){

            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // tao mot mang trong de chua du lieu

            $error =[];
            if(empty($ten_danh_muc)){
                $error['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
            
            // neu co loi thi hien thi lai form
            if(empty($error)){
                // neu ko co loi thi tien hanh them danh muc
               // var_dump('ok');
               $this->modelDanhMuc->insertDanhMuc($ten_danh_muc,$mo_ta);
               header("Location: " . BASE_URL_ADMIN .'?act=danh-muc');
               exit();
            }else{
                require_once './views/danhmuc/addDanhMuc.php';
            }
        }
    }
    public function formEditAddDanhMuc(){
        // ham dung de hien thi form nhan
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
         if($danhMuc){
            require_once './views/danhmuc/editDanhMuc.php';

         }else{
            header("Location: " . BASE_URL_ADMIN .'?act=danh-muc');
            exit();

         }

    }
    public function postEditDanhMuc(){
        // them du lieu

        // kiem  tra du lieu co phai duoc them khong
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id= $_POST['id'];

            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // tao mot mang trong de chua du lieu

            $error =[];
            if(empty($ten_danh_muc)){
                $error['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
            
            // neu co loi thi hien thi lai form
            if(empty($error)){
                // neu ko co loi thi tien hanh sua danh muc
               // var_dump('ok');
               $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
               header("Location: " . BASE_URL_ADMIN .'?act=danh-muc');
               exit();
            }else{
                $danhMuc = ['id' => $id, 'ten_danh_muc' =>$ten_danh_muc, 'mo_ta' =>$mo_ta];
                require_once './views/danhmuc/editDanhMuc.php';
            }
        }
    }
    public function deleteDanhMuc(){
        // xoa du lieu
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if($danhMuc){
          $this->modelDanhMuc->destroyDanhMuc($id);
            
        }
        header("Location: " . BASE_URL_ADMIN .'?act=danh-muc');
        exit();
    }
}
