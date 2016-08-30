<?php

class SiteHomeController extends BaseSiteController
{
    public function __construct(){
        parent::__construct();
        FunctionLib::site_css('font-awesome/4.2.0/css/font-awesome.min.css', CGlobal::$POS_HEAD);
    }

    //trang chu
    public function index(){
        $this->header();
        $dataShow = array();
        $user_shop = array();
        $this->layout->content = View::make('site.SiteLayouts.Home')
            ->with('data',$dataShow)
            ->with('user_shop', $user_shop);
        $this->footer();
    }

    //trang danh sách san pham theo danh mục
    public function listProduct($cat_id){
        $this->header();
        $product = array();
        $user_shop = array();
        $this->layout->content = View::make('site.SiteLayouts.ListProduct')
            ->with('product',$product)
            ->with('user_shop', $user_shop);
        $this->footer();
    }
    public function detailProduct($cat_name, $pro_id, $pro_name){
        $this->header();
        $product = array();
        $user_shop = array();
        if($pro_id > 0){
            $product = Product::getProductByID($pro_id);
            //FunctionLib::debug($product);
            if ($product) {
                //check s?n ph?m có b? khóa hay ?n khong
                if($product->product_status == CGlobal::status_hide || $product->product_status == CGlobal::status_block){
                    return Redirect::route('site.Error');
                }
                $url = URL::current();
                $link_detail = FunctionLib::buildLinkDetailProduct($product->product_id,$product->product_name,$product->category_name);
                if ($url != $link_detail) {
                    return Redirect::to($link_detail);
                }
                $this->layout->title = $product->product_name . ' - shopcuatui.com.vn';
                $this->layout->title_seo = $product->product_name;
                $this->layout->url_seo = $link_detail;
                $this->layout->img_seo = '';
                $this->layout->des_seo = strip_tags($product->product_sort_desc);
            }
        }
        //get product hot
        $dataFieldProductHot['field_get'] = 'product_id,product_name,product_sort_desc,product_content,product_image,category_id';
        $dataFieldProductHot = Product::getProductHot($dataFieldProductHot, 5);
        
        $this->layout->content = View::make('site.SiteLayouts.DetailProduct')
            ->with('product',$product)
            ->with('dataFieldProductHot',$dataFieldProductHot)
            ->with('user_shop', $user_shop);
        $this->footer();
    }


    //trang list tin tuc
    public function homeNew(){
    	$this->header();
        $dataNew = array();
        //thong tin tim kiem
        $pageNo = (int) Request::get('page_no',1);
        $limit = 15;
        $offset = ($pageNo - 1) * $limit;
        $search = $data = array();
        $total = 0;
		
        $search['news_title'] = addslashes(Request::get('news_title', ''));
        $search['news_status'] = CGlobal::status_show;
        $search['field_get'] = 'news_id,news_title,news_desc_sort,news_image';//cac truong can lay
        
        $dataNew = News::searchByCondition($search, $limit, $offset,$total);
        $paging = $total > 0 ? Pagging::getNewPager(3, $pageNo, $total, $limit, $search) : '';
        
        //get product hot
        $dataFieldProductHot['field_get'] = 'product_id,product_name,product_sort_desc,product_content,product_image,category_id';
        $dataFieldProductHot = Product::getProductHot($dataFieldProductHot, 5);

        $this->layout->content = View::make('site.SiteLayouts.ListNews')
            ->with('dataNew',$dataNew)
            ->with('paging', $paging)
            ->with('dataFieldProductHot',$dataFieldProductHot);
        $this->footer();
    }
    //trang chi tiet tin tuc
    public function detailNew($new_id, $new_name){

        $this->header();
        $dataNew = $dataNewsSame = array();
        $user_shop = array();
        //get news detail
        if($new_id > 0) {
            $dataNew = News::getNewByID($new_id);
            //get news same
            if($dataNew != null){
                $dataField['field_get'] = 'news_id,news_title,news_desc_sort,news_content,news_category';
                $dataNewsSame = News::getSameNews($dataField, $dataNew->news_category, $new_id, 10);
            }
        }

        //get product hot
        $dataFieldProductHot['field_get'] = 'product_id,product_name,product_sort_desc,product_content,product_image,category_id,category_name';
        $dataFieldProductHot = Product::getProductHot($dataFieldProductHot, 5);

        $this->layout->content = View::make('site.SiteLayouts.DetailNews')
            ->with('dataNew',$dataNew)
            ->with('dataNewsSame',$dataNewsSame)
            ->with('dataFieldProductHot',$dataFieldProductHot)
            ->with('user_shop', $user_shop);
        $this->footer();
    }


    //trang 404
    public function pageError(){
        $this->header();
        $dataShow = array();
        $this->layout->content = View::make('site.SiteLayouts.PageError')
            ->with('data',$dataShow)
            ->with('user', $this->user);
        $this->footer();
    }


    /***************************************************************************************************
     * Page lien quan tới shop
     ***************************************************************************************************
     */
    /**
     * Trang chủ của shop
     */
    public function shopIndex($shop_id = 0){
        $this->header();
        $product = array();
        $user_shop = array();
        $this->layout->content = View::make('site.SiteLayouts.ShopHome')
            ->with('product',$product)
            ->with('user_shop', $user_shop);
        $this->footer();
    }
    /**
     * Trang list sản phẩm của shop
     */
    public function shopListProduct($shop_id = 0,$cat_id = 0){
        $this->header();
        $product = array();
        $user_shop = array();
        $this->layout->content = View::make('site.SiteLayouts.ShopListProduct')
            ->with('product',$product)
            ->with('user_shop', $user_shop);
        $this->footer();
    }


    /**
     * Login và logout, đăng ký shop
     */
    public function shopLogin(){
        FunctionLib::site_css('frontend/css/login.css', CGlobal::$POS_HEAD);
        if(sizeof($this->user) > 0){
            return Redirect::route('shop.adminShop');
        }
        $this->header();
        $error = '';
        $this->layout->content = View::make('site.ShopLayouts.ShopLogin')
            ->with('error',$error)
            ->with('user', $this->user);
        $this->footer();
    }
    public function login($url = ''){
        FunctionLib::site_css('frontend/css/login.css', CGlobal::$POS_HEAD);
        $this->header();
        $user_shop = trim(Request::get('user_shop_login', ''));
        $password = trim(Request::get('password_shop_login', ''));
        $error = '';
        if ($user_shop != '' && $password != '') {
            if (strlen($user_shop) < 3 || strlen($user_shop) > 50 || preg_match('/[^A-Za-z0-9_\.@]/', $user_shop) || strlen($password) < 5) {
                $error = 'Không tồn tại tên đăng nhập!';
            } else {
                $userShop = UserShop::getUserByName($user_shop);
                if ($userShop !== NULL) {
                    if ($userShop->shop_status == CGlobal::status_hide || $userShop->shop_status == CGlobal::status_block) {
                        $error = 'Tài khoản bị khóa!';
                    } elseif ($userShop->shop_status == CGlobal::status_show) {
                        if ($userShop->user_password == User::encode_password($password)) {
                            Session::put('user_shop', $userShop, 60*24);
                            //cập nhật login
                            $dataUpdate['is_login'] = CGlobal::SHOP_ONLINE;
                            $dataUpdate['shop_time_login'] = time();
                            UserShop::updateData($userShop->shop_id,$dataUpdate);

                            if ($url === '' || $url === 'login') {
                                return Redirect::route('shop.adminShop');
                            } else {
                                return Redirect::to(self::buildUrlDecode($url));
                            }

                        } else {
                            $error = 'Mật khẩu không đúng!';
                        }
                    }
                } else {
                    $error = 'Không tồn tại shop này trên hệ thống!';
                }
            }
        } else {
            $error = 'Chưa nhập thông tin đăng nhập!';
        }

        $this->layout->content = View::make('site.ShopLayouts.ShopLogin')
            ->with('error', $error);
        $this->footer();
    }
    public function shopLogout(){
        if (Session::has('user_shop')) {
            //cap nhat thoi gian logout
            $userShop = Session::get('user_shop');
            $dataUpdate['is_login'] = CGlobal::SHOP_OFFLINE;
            $dataUpdate['shop_time_logout'] = time();
            UserShop::updateData($userShop->shop_id,$dataUpdate);

            Session::forget('user_shop');//xóa session
        }
        return Redirect::route('site.shopLogin', array('url' => self::buildUrlEncode(URL::previous())));
    }

    //trang register
    public function shopRegister(){
        FunctionLib::site_css('frontend/css/register.css', CGlobal::$POS_HEAD);
        $this->header();
        $dataShow = array();
        $this->layout->content = View::make('site.ShopLayouts.shopRegister')
            ->with('error',array())
            ->with('data',$dataShow)
            ->with('user', $this->user);
        $this->footer();
    }
    public function postShopRegister(){
        FunctionLib::site_css('frontend/css/register.css', CGlobal::$POS_HEAD);
        $this->header();
        $dataSave = $error = array();

        $dataSave['user_shop'] = addslashes(Request::get('user_shop'));
        $dataSave['user_password'] = addslashes(Request::get('user_password'));
        $dataSave['rep_user_password'] = addslashes(Request::get('rep_user_password'));

        $dataSave['shop_phone'] = addslashes(Request::get('shop_phone'));
        $dataSave['shop_email'] = addslashes(Request::get('shop_email'));

        $error = $this->validUserInforShop($dataSave);
        if (empty($error)) {
            unset($dataSave['rep_user_password']);
            //gan co dinh 1 shop khi dang ky
            $dataSave['number_limit_product'] = CGlobal::SHOP_NUMBER_PRODUCT_FREE;
            $dataSave['is_shop'] = CGlobal::SHOP_FREE;
            $dataSave['shop_created'] = time();
            //login luon
            $dataSave['shop_time_login'] = CGlobal::SHOP_ONLINE;
            $dataSave['is_login'] = time();

            $shop_id = UserShop::addData($dataSave);
            if($shop_id > 0) {
                $userShop = UserShop::find($shop_id);
                if($userShop){
                    Session::put('user_shop', $userShop, 60*24);
                    return Redirect::route('shop.adminShop');
                }
            }
        }
        $this->layout->content = View::make('site.ShopLayouts.shopRegister')
            ->with('error',$error)
            ->with('data',$dataSave)
            ->with('user', $this->user);
        $this->footer();
    }
    private function validUserInforShop($data=array()) {
        $error = array();
        if(!empty($data)) {
            if(isset($data['user_shop']) && $data['user_shop'] == '') {
                $error[] = 'Tên đăng nhập không được bỏ trống';
            }
            if(isset($data['shop_phone']) && $data['shop_phone'] == '') {
                $error[] = 'Điện thoại liên hệ không được bỏ trống';
            }
            if(isset($data['shop_email']) && $data['shop_email'] == '') {
                $error[] = 'Email không được bỏ trống';
            }
            if(isset($data['user_password']) && $data['user_password'] == '') {
                $error[] = 'Bạn chưa nhập password';
            }else{
                if(isset($data['rep_user_password']) && $data['rep_user_password'] == '') {
                    $error[] = 'Bạn chưa nhập lại password';
                }elseif(strcmp($data['user_password'],$data['rep_user_password']) != 0){
                    $error[] = 'Bạn nhập lại password chưa đúng';
                }
            }
            return $error;
        }
        return $error;
    }
    
    //Duy them page danh sách sản phẩm trong giỏ hàng
    public function listCartOrder(){
    	$this->header();
    	$this->layout->content = View::make('site.SiteLayouts.listCartOrder');
    	$this->footer();
    }
    public function sendCartOrder(){
    	$this->header();
    	$this->layout->content = View::make('site.SiteLayouts.sendCartOrder');
    	$this->footer();
    }
    
	public function page404(){
    	$this->header();
    	$this->layout->content = View::make('site.SiteLayouts.page404');
    	$this->footer();
    }
    
    public function thanksBuy(){
    	$this->header();
    	$this->layout->content = View::make('site.SiteLayouts.thanksBuy');
    	$this->footer();
    }
    public function searchProduct(){
    	$this->header();
    	$this->layout->content = View::make('site.SiteLayouts.searchProduct');
    	$this->footer();
    }
    
}

