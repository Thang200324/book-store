<?php 

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

require_once './controllers/BlogController.php';

require_once './controllers/Blog_DetailController.php';

require_once './controllers/AboutController.php';

require_once './controllers/ContactController.php';

require_once './controllers/ShopController.php'; // Controller cho trang shop

// Require toàn bộ file Models
require_once './models/Student.php';
require_once './models/SanPham.php';
// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
   '/' => (new HomeController())-> home(),
   'trangchu' => (new HomeController())->trangChu(),
   //  base_url /?act=trangchu
   'danh-sach-san-pham' => (new HomeController())->danhSachSanPham(),
   //  base_url /?act=danh-sach-san-pham
   //... tùy vào các action khác của HomeController
   //! route blog
   'blog' => (new BlogController())->index(),
   'blog-detail' => (new Blog_DetailController())->index(),

   //! route about
   'about' => (new AboutController())->index(),
    
   //! route contact
   'contact' => (new ContactController())->index(),

   //! route san pham
   'san-pham' => (new ShopController())-> index(),



};
// Route::match(['get', 'post'], '/blog', [BlogController::class, 'index'])->name('blog');
//Route::match(['get', 'post'], '/blog_detail', [Blog_DetailController::class, 'index'])->name('blog_detail');
