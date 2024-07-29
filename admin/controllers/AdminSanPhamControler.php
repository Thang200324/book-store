<?php

class AdminSanPhamControler
{
    public $modelSanPham;
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachSanPham()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/sanpham/listSanPham.php';
    }

    public function formAddSanPham()
    {
        // ham dung de hien thi form nhan
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanpham/addSanPham.php';
        //Sóa session
        deleteSessionError();
    }

    public function postAddSanPham()
    {
        // them du lieu

        // kiem  tra du lieu co phai duoc them khong
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'];

            //Lưu hình ảnh vào 
            $file_thumb = uploadFile($hinh_anh, './uploads/');
            //var_dump($file_thumb);die();
            $img_array = $_FILES['img_array'];
            // tao mot mang trong de chua du lieu

            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
            }
            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'Giá khuyến mãi sản phẩm không được để trống';
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
            }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống';
            }
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục sản phẩm không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái sản phẩm không được để trống';
            }
            if ($hinh_anh['error'] !== 0) {
                $errors['hinh_anh'] = 'Ảnh sản phẩm không được để trống';
            }

            $_SESSION['error'] = $errors;

            // neu co loi thi hien thi lai form
            if (empty($errors)) {
                // neu ko co loi thi tien hanh them san pham

                // var_dump('ok');

                $san_pham_id = $this->modelSanPham->insertSanPham(
                    $ten_san_pham,
                    $gia_san_pham,
                    $gia_khuyen_mai,
                    $so_luong,
                    $ngay_nhap,
                    $danh_muc_id,
                    $trang_thai,
                    $mo_ta,
                    $file_thumb
                );

                if (!empty($img_array['name'])) {
                    foreach ($img_array['name'] as $key => $value) {
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key],
                        ];

                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->modelSanPham->insertAbumAnhSanPham($san_pham_id, $link_hinh_anh);
                    }
                }

                header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                //trả về form lỗi
                //đặt chỉ thị xóa session sau khi hiện thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-them-san-pham');
                exit();
            }
        }
    }

    public function formEditSanPham()
    {
        // ham dung de hien thi form nhan
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $ListDanhMuc = $this->modelDanhMuc->getAllDanhMuc(); //
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        if ($sanPham) {
            require_once './views/sanpham/editSanPham.php';
            deleteSessionError();
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }
    public function postEditSanPham()
    {
        // them du lieu

        // kiem  tra du lieu co phai duoc them khong
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //lay ra du lieu
            // lay ra du lieu cu cua san pham
            $san_pham_id = $_POST['san_pham_id'] ?? '';
            // Truy van
            $sanPhamOId = $this->modelSanPham->getDetailSanPham($san_pham_id);

            $old_file = $sanPhamOId['hinh_anh']; // lay du lieu de phuc vu anh

            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'] ?? null;
         


            // tao mot mang trong de chua du lieu

            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
            }
            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'Giá khuyến mãi sản phẩm không được để trống';
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
            }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống';
            }
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục sản phẩm không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái sản phẩm không được để trống';
            }



            $_SESSION['error'] = $errors;

            // logic sua anh
            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                // upload file moi
                $new_file = uploadFile($hinh_anh, './uploads/');
                if (!empty($old_file)) { // new co anh cu thi xoa di
                    deleteFile($old_file);
                }
            } else {
                $new_file = $old_file;
            }

            // neu co loi thi hien thi lai form
            if (empty($errors)) {
                // neu ko co loi thi tien hanh them san pham

                $check = $this->modelSanPham->updateSanPham($san_pham_id, $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $new_file);
                if($check) {
                    $_SESSION['success_message'] = 'Cập nhật sản phẩm thành công!';
                }
                header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();
                
            } else {
                //trả về form lỗi
                //đặt chỉ thị xóa session sau khi hiện thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
    }

    // sua album anh
    // - sua anh cu
    //     + them anh moi
    //     + khong them anh moi
    // - khong sua anh cu
    //     + them anh moi
    //     + khong them anh moi
    // - xoa anh cu
    //     + them anh moi
    //     + khong them anh moi

    public function postEditAnhSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'] ?? '';

            // lay danh sach san pham hien tai cua san pham
            $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);

            // xu ly anh duoc gui tu form
            $img_array = $_FILES['img_array'];
            $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
            $current_img_ids = $_POST['current_img_ids'] ?? [];

            // khai bao mang de luu them moi hoac thay the 

            $upload_file = [];

            // upload anh moi hoac thay the anh cu 
            foreach($img_array['name'] as $key=>$value){
                if($img_array['error'][$key] == UPLOAD_ERR_OK){
                    $new_file = uploadFileAlbum($img_array, './uploads/', $key);
                    if($new_file){
                        $upload_file[]= [
                            'id' => $current_img_ids[$key] ?? null,
                            'file' => $new_file
                        ];
                    }
                }
            }

            // luu anh moi vao db va xoa anh cu neu co 
            foreach($upload_file as $file_info){
                if($file_info['id']){
                    $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];

                    // cap nhat anh cu 
                    $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);

                    // xoa anh cu
                    deleteFile( $old_file);
                }else{
                    // them anh moi
                    $this->modelSanPham->insertAbumAnhSanPham($san_pham_id, $file_info['file']);
                }
            }
            // xu ly xoa anh 
            foreach($listAnhSanPhamCurrent as $anhSP){
                $anh_id = $anhSP['id'];
                if(in_array($anh_id, $img_delete)){
                    // xoa anh trong db 
                    $this->modelSanPham->destroyAnhSanPham($anh_id);

                    // xoa file 
                    deleteFile($anhSP['link_hinh_anh']);
                }
            }
            header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
                exit();
        }
    }


    

    
    public function deleteSanPham(){
        // xoa du lieu
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        

        if($sanPham){
            deleteFile($sanPham['hinh_anh']);

          $this->modelSanPham->destroySanPham($id);
            
        }
        if($listAnhSanPham){
            foreach($listAnhSanPham as $key=> $anhSP){
                deleteFile($anhSP['link_hinh_anh']);
                $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
            }
        }
        header("Location: " . BASE_URL_ADMIN .'?act=san-pham');
        exit();
    }
    public function detailSanPham()
    {
        // ham dung de hien thi form nhan
        $id = $_GET['id_san_pham'];
        
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
       
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        if ($sanPham) {
            require_once './views/sanpham/detailSanPham.php';
        
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }

}