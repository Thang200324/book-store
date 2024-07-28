<?php 

class HomeController
{
    public $modelSanPham;
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
    }
   public function home(){
    echo "Welcome";
   }
   public function trangChu(){
    echo "Trang Chu";
   }
   public function danhSachSanPham(){
    //echo "Chi Tiet San Pham: ";
   $listProduct = $this->modelSanPham->getAllProduct();
   //var_dump($listProduct);die();
   require_once './views/listProduct.php';
   }

}