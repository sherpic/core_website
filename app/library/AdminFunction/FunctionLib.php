<?php
/**
 * Created by PhpStorm.
 * User: MT969
 * Date: 6/5/2015
 * Time: 5:01 PM
 */

class FunctionLib {

    /**
     * @param $file_name
     */
    static function link_css($file_name, $position = 1) {
        if (is_array($file_name)) {
            foreach ($file_name as $v) {
                self::link_css($v);
            }
            return;
        }
        if (strpos($file_name, 'http://') !== false) {
            $html = '<link rel="stylesheet" href="' . $file_name . ((CGlobal::$css_ver) ? '?ver=' . CGlobal::$css_ver : '') . '" type="text/css">' . "\n";
            if ($position == CGlobal::$POS_HEAD && strpos(CGlobal::$extraHeaderCSS, $html) === false)
                CGlobal::$extraHeaderCSS .= $html . "\n";
            elseif ($position == CGlobal::$POS_END && strpos(CGlobal::$extraFooterCSS, $html) === false)
                CGlobal::$extraFooterCSS .= $html . "\n";
            return;
        } else {
            $html = '<link type="text/css" rel="stylesheet" href="' .Config::get('config.WEB_ROOT') . '/assets/' . $file_name . ((CGlobal::$css_ver) ? '?ver=' . CGlobal::$css_ver : '') . '" />' . "\n";
            if ($position == CGlobal::$POS_HEAD && strpos(CGlobal::$extraHeaderCSS, $html) === false)
                CGlobal::$extraHeaderCSS .= $html . "\n";
            elseif ($position == CGlobal::$POS_END && strpos(CGlobal::$extraFooterCSS, $html) === false)
                CGlobal::$extraFooterCSS .= $html . "\n";
        }
    }

    /**
     * @param $file_name
     */
    static function link_js($file_name, $position = 1) {
        if (is_array($file_name)) {
            foreach ($file_name as $v) {
                self::link_js($v);
            }
            return;
        }
        if (strpos($file_name, 'http://') !== false) {
            $html = '<script type="text/javascript" src="' . $file_name . ((CGlobal::$js_ver) ? '?ver=' . CGlobal::$js_ver : '') . '"></script>';
            if ($position == CGlobal::$POS_HEAD && strpos(CGlobal::$extraHeaderJS, $html) === false)
                CGlobal::$extraHeaderJS .= $html . "\n";
            elseif ($position == CGlobal::$POS_END && strpos(CGlobal::$extraFooterJS, $html) === false)
                CGlobal::$extraFooterJS .= $html . "\n";
            return;
        } else {
            $html = '<script type="text/javascript" src="' . Config::get('config.WEB_ROOT')  . '/assets/' . $file_name . ((CGlobal::$js_ver) ? '?ver=' . CGlobal::$js_ver : '') . '"></script>';
            if ($position == CGlobal::$POS_HEAD && strpos(CGlobal::$extraHeaderJS, $html) === false)
                CGlobal::$extraHeaderJS .= $html . "\n";
            elseif ($position == CGlobal::$POS_END && strpos(CGlobal::$extraFooterJS, $html) === false)
                CGlobal::$extraFooterJS .= $html . "\n";
        }
    }

    static function site_css($file_name, $position = 1) {
        if (is_array($file_name)) {
            foreach ($file_name as $v) {
                self::site_css($v);
            }
            return;
        }
        if (strpos($file_name, 'http://') !== false) {
            $html = '<link rel="stylesheet" href="' . $file_name . ((CGlobal::$css_ver) ? '?ver=' . CGlobal::$css_ver : '') . '" type="text/css">' . "\n";
            if ($position == CGlobal::$POS_HEAD && strpos(CGlobal::$extraHeaderCSS, $html) === false)
                CGlobal::$extraHeaderCSS .= $html . "\n";
            elseif ($position == CGlobal::$POS_END && strpos(CGlobal::$extraFooterCSS, $html) === false)
                CGlobal::$extraFooterCSS .= $html . "\n";
            return;
        } else {
            $html = '<link type="text/css" rel="stylesheet" href="' . url('', array(), Config::get('config.SECURE')) . '/assets/' . $file_name . ((CGlobal::$css_ver) ? '?ver=' . CGlobal::$css_ver : '') . '" />' . "\n";
            if ($position == CGlobal::$POS_HEAD && strpos(CGlobal::$extraHeaderCSS, $html) === false)
                CGlobal::$extraHeaderCSS .= $html . "\n";
            elseif ($position == CGlobal::$POS_END && strpos(CGlobal::$extraFooterCSS, $html) === false)
                CGlobal::$extraFooterCSS .= $html . "\n";
        }
    }

    /**
     * @param $file_name
     */
    static function site_js($file_name, $position = 1) {
        if (is_array($file_name)) {
            foreach ($file_name as $v) {
                self::link_js($v);
            }
            return;
        }
        if (strpos($file_name, 'http://') !== false) {
            $html = '<script type="text/javascript" src="' . $file_name . ((CGlobal::$js_ver) ? '?ver=' . CGlobal::$js_ver : '') . '"></script>';
            if ($position == CGlobal::$POS_HEAD && strpos(CGlobal::$extraHeaderJS, $html) === false)
                CGlobal::$extraHeaderJS .= $html . "\n";
            elseif ($position == CGlobal::$POS_END && strpos(CGlobal::$extraFooterJS, $html) === false)
                CGlobal::$extraFooterJS .= $html . "\n";
            return;
        } else {
            $html = '<script type="text/javascript" src="' . url('', array(), Config::get('config.SECURE')) . '/assets/' . $file_name . ((CGlobal::$js_ver) ? '?ver=' . CGlobal::$js_ver : '') . '"></script>';
            if ($position == CGlobal::$POS_HEAD && strpos(CGlobal::$extraHeaderJS, $html) === false)
                CGlobal::$extraHeaderJS .= $html . "\n";
            elseif ($position == CGlobal::$POS_END && strpos(CGlobal::$extraFooterJS, $html) === false)
                CGlobal::$extraFooterJS .= $html . "\n";
        }
    }

    public static $array_allow_image = array(
        'jpg',
        'png',
        'jpeg'
    );

    public static $size_image_max = 1048576;

    public  static function numberToWord($s, $lang = 'vi') {
        $ds = 0;
        $so = $hang = array();

        $viN = array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
        $viRow = array("", "nghìn", "triệu", "tỷ");

        $enN = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine");
        $enRow = array("", "thousand", "million", "billion");

        if ($lang == 'vi') {
            $so = $viN;
            $hang = $viRow;
        } else {
            $so = $enN;
            $hang = $enRow;
        }

        $s = str_replace(",", "", $s);
        $ds = (int) $s;
        if ($ds == 0) {
            return "không ";
        }

        $i = $j = $donvi = $chuc = $tram = 0;
        $i = strlen($s);

        $Str = "";
        if ($i == 0)
            $Str = "";
        else {
            $j = 0;
            while ($i > 0) {
                $donvi = substr($s, $i - 1, 1);
                $i = $i - 1;
                if ($i > 0) {
                    $chuc = substr($s, $i - 1, 1);
                } else {
                    $chuc = -1;
                }
                $i = $i - 1;
                if ($i > 0) {
                    $tram = substr($s, $i - 1, 1);
                } else {
                    $tram = -1;
                }
                $i = $i - 1;
                if ($donvi > 0 || $chuc > 0 || $tram > 0 || $j == 3)
                    $Str = $hang[$j] . " " . $Str;
                $j = $j + 1;
                if ($j > 3)
                    $j = 1;
                if ($donvi == 1 && $chuc > 1)
                    $Str = "mốt" . " " . $Str;
                else {
                    if ($donvi == 5 && $chuc > 0)
                        $Str = "lăm" . " " . $Str;
                    else if ($donvi > 0)
                        $Str = $so[$donvi] . " " . $Str;
                }
                if ($chuc < 0)
                    break;
                else
                    if ($chuc == 0 && $donvi > 0)
                        $Str = "lẻ" . " " . $Str;
                if ($chuc == 1)
                    $Str = "mười" . " " . $Str;
                if ($chuc > 1)
                    $Str = $so[$chuc] . " " . "mươi" . " " . $Str;
                if ($tram < 0)
                    break;
                else
                    if ($tram > 0 || $chuc > 0 || $donvi > 0)
                        $Str = $so[$tram] . " " . "trăm" . " " . $Str;
            }
        }
        return strtoupper(substr($Str, 0, 1)) . substr($Str, 1, strlen($Str) - 1) . ($lang == 'vi' ? "đồng" : 'vnd');
    }
    static function debug($array) {
        if($_SERVER['HTTP_HOST'] != 'shopcuatui.vn') {
            echo '<pre>';
            print_r($array);
            die;
        }
    }
    /**
     * build html select option
     *
     * @param array $options_array
     * @param int $selected
     * @param array $disabled
     */
    static function getOption($options_array, $selected, $disabled = array()) {
        $input = '';
        if ($options_array)
            foreach ($options_array as $key => $text) {
                $input .= '<option value="' . $key . '"';
                if (!in_array($selected, $disabled)) {
                    if ($key === '' && $selected === '') {
                        $input .= ' selected';
                    } else
                        if ($selected !== '' && $key == $selected) {
                            $input .= ' selected';
                        }
                }
                if (!empty($disabled)) {
                    if (in_array($key, $disabled)) {
                        $input .= ' disabled';
                    }
                }
                $input .= '>' . $text . '</option>';
            }
        return $input;
    }

    /**
     * build html select option mutil
     *
     * @param array $options_array
     * @param array $arrSelected
     */
    static function getOptionMultil($options_array, $arrSelected) {
        $input = '';
        if ($options_array)
            foreach ($options_array as $key => $text) {
                $input .= '<option value="' . $key . '"';
                if ($key === '' && empty($arrSelected)) {
                    $input .= ' selected';
                } else
                    if (!empty($arrSelected) && in_array($key, $arrSelected)) {
                        $input .= ' selected';
                    }
                $input .= '>' . $text . '</option>';
            }
        return $input;
    }


    public static function sortArrayASC (&$array, $key) {
        $sorter=array();
        $ret=array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        $array=$ret;
    }
    static function safe_title($text) {
        $text = FunctionLib::post_db_parse_html($text);
        $text = FunctionLib::stripUnicode($text);
        $text = self::_name_cleaner($text, "-");
        $text = str_replace("----", "-", $text);
        $text = str_replace("---", "-", $text);
        $text = str_replace("--", "-", $text);
        $text = trim($text, '-');

        if ($text) {
            return $text;
        } else {
            return "shop";
        }
    }

    //cackysapxepgannhau
    static function stringtitle($text) {
        $text = FunctionLib::post_db_parse_html($text);
        $text = FunctionLib::stripUnicode($text);
        $text = self::_name_cleaner($text, "-");
        $text = str_replace("----", "-", $text);
        $text = str_replace("---", "-", $text);
        $text = str_replace("--", "-", $text);
        $text = str_replace("-", "", $text);
        $text = trim($text);

        if ($text) {
            return $text;
        } else {
            return "shop";
        }
    }


    static function post_db_parse_html($t = "") {
        if ($t == "") {
            return $t;
        }

        $t = str_replace("&#39;", "'", $t);
        $t = str_replace("&#33;", "!", $t);
        $t = str_replace("&#036;", "$", $t);
        $t = str_replace("&#124;", "|", $t);
        $t = str_replace("&amp;", "&", $t);
        $t = str_replace("&gt;", ">", $t);
        $t = str_replace("&lt;", "<", $t);
        $t = str_replace("&quot;", '"', $t);

        $t = preg_replace("/javascript/i", "j&#097;v&#097;script", $t);
        $t = preg_replace("/alert/i", "&#097;lert", $t);
        $t = preg_replace("/about:/i", "&#097;bout:", $t);
        $t = preg_replace("/onmouseover/i", "&#111;nmouseover", $t);
        $t = preg_replace("/onmouseout/i", "&#111;nmouseout", $t);
        $t = preg_replace("/onclick/i", "&#111;nclick", $t);
        $t = preg_replace("/onload/i", "&#111;nload", $t);
        $t = preg_replace("/onsubmit/i", "&#111;nsubmit", $t);
        $t = preg_replace("/applet/i", "&#097;pplet", $t);
        $t = preg_replace("/meta/i", "met&#097;", $t);

        return $t;
    }

    static function stripUnicode($str) {
        if (!$str)
            return false;
        $marTViet = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă",
            "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề"
        , "ế", "ệ", "ể", "ễ",
            "ì", "í", "ị", "ỉ", "ĩ",
            "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ"
        , "ờ", "ớ", "ợ", "ở", "ỡ",
            "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
            "ỳ", "ý", "ỵ", "ỷ", "ỹ",
            "đ",
            "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă"
        , "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
            "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
            "Ì", "Í", "Ị", "Ỉ", "Ĩ",
            "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ"
        , "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
            "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
            "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
            "Đ");

        $marKoDau = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a"
        , "a", "a", "a", "a", "a", "a",
            "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
            "i", "i", "i", "i", "i",
            "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o"
        , "o", "o", "o", "o", "o",
            "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
            "y", "y", "y", "y", "y",
            "d",
            "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A"
        , "A", "A", "A", "A", "A",
            "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
            "I", "I", "I", "I", "I",
            "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O"
        , "O", "O", "O", "O", "O",
            "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
            "Y", "Y", "Y", "Y", "Y",
            "D");

        $str = str_replace($marTViet, $marKoDau, $str);
        return $str;
    }

    static function _name_cleaner($name, $replace_string = "_") {
        return preg_replace("/[^a-zA-Z0-9\-\_]/", $replace_string, $name);
    }

    /**
     * convert from str to array
     *
     * @param string $str_item
     */
    static function standardizeCartStr($str_item) {
        if (empty($str_item))
            return 0;
        $str_item = trim(preg_replace('#([\s]+)|(,+)#', ',', trim($str_item)));
        $data = explode(',', $str_item);
        $arrItem = array();
        foreach ($data as $item) {
            if ($item != '')
                $arrItem[] = $item;
        }
        if (empty($arrItem))
            return 0;
        else
            return $arrItem;
    }
    static function numberFormat($number = 0) {
        if ($number >= 1000) {
            return number_format($number, 0, ',', '.');
        }
        return $number;
    }

    public static function checkRegexEmail($str=''){
        if($str != ''){
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if (!preg_match($regex, $str)){
                return false;
            }
            return true;
        }
        return false;
    }

    static function substring($str, $length = 100, $replacer='...'){
    	$str = strip_tags($str);
    	if(strlen($str) <= $length){
    		return $str;
    	}
    	$str = trim(@substr($str,0,$length));
    	$posSpace = strrpos($str,' ');
    	$replacer="...";
    	return substr($str,0,$posSpace).$replacer;
    }
    
    /**
     * @param int $pro_id
     * @param string $pro_name
     * @param string $cat_name
     * @return string
     */
    static function buildLinkDetailProduct($pro_id = 0,$pro_name = 'sản phẩm',$cat_name = 'danh mục'){
        if($pro_id > 0){
            return URL::route('site.detailProduct', array('cat'=>strtolower(FunctionLib::safe_title($cat_name)),'name'=>strtolower(FunctionLib::safe_title($pro_name)),'id'=>$pro_id));
        }
        return '#';
    }

    /**
     * @param int $new_id
     * @param string $new_name
     * @param string $cat_name
     * @return string
     */
    static function buildLinkDetailNews($new_id = 0,$new_name = 'tin tức'){
        if($new_id > 0){
            return URL::route('site.detailNew', array('name'=>strtolower(FunctionLib::safe_title($new_name)),'id'=>$new_id));
        }
        return '#';
    }

    /**
     * @param string $file_name
     * @param int $id
     * @param string $folder
     * @param bool|true $is_delDir
     */
    static function deleteFileUpload($file_name = '', $id = 0, $folder = CGlobal::FOLDER_PRODUCT, $is_delDir = true){
        if($file_name != '') {
            $path = ($folder != '' && $id >0) ? Config::get('config.DIR_ROOT').'/uploads/' .$folder. '/'. $id: '';
            if($file_name != ''){
                if($path != ''){
                    if(is_file($path.'/'.$file_name)){
                        @unlink($path.'/'.$file_name);
                    }
                }
            }
            //Xoa thu muc
            if($is_delDir) {
                if($path != ''){
                    if(is_dir($path)) {
                        @rmdir($path);
                    }
                }
            }
        }
    }

    /**
     * @param string $file_name
     * @param int $id
     * @param string $folder
     * @param string $folderSize
     * @param bool|true $is_delDir
     */
    static function deleteFileThumb($file_name = '', $id = 0, $folder = CGlobal::FOLDER_PRODUCT, $folderSize = '100x100', $is_delDir = true){
        if($file_name != '') {
            $dirRootItem = Config::get('config.DIR_ROOT').'/uploads/thumbs/'.$folder.'/'.$id;
            $dirImgThumb = $dirRootItem.'/'.$folderSize; //thu muc chua anh Thumb
            if($file_name != ''){
                if($dirImgThumb != ''){
                    if(is_file($dirImgThumb.'/'.$file_name)){
                        @unlink($dirImgThumb.'/'.$file_name);
                    }
                }
            }
            if($is_delDir) {
                //xoa thu muc theo size
                if($dirImgThumb != ''){
                    if(is_dir($dirImgThumb)) {
                        @rmdir($dirImgThumb);
                    }
                }
                //xoa thu muc theo ID
                if($dirRootItem != ''){
                    if(is_dir($dirRootItem)) {
                        @rmdir($dirRootItem);
                    }
                }
            }
        }
    }

    /**
     * @param int $banner_type
     * @param int $banner_page
     * @param int $banner_category_id
     * @param int $banner_shop_id
     * @return array
     */
     static function getBannerAdvanced($banner_type = 0, $banner_page = 0, $banner_category_id = 0, $banner_shop_id = 0){
         $result = array();
         $arrBanner = Banner::getBannerAdvanced($banner_type, $banner_page, $banner_category_id, $banner_shop_id);
         if($arrBanner && sizeof($arrBanner) > 0){
            foreach($arrBanner as $banner){
                //banner chạy thời gian
                if($banner->banner_is_run_time == CGlobal::BANNER_IS_RUN_TIME){
                    $today = time();
                    if($banner->banner_start_time < $today && $banner->banner_end_time > $today){
                        $result[] = $banner;
                    }
                }
                //banner của shop dang hoat dong
                elseif($banner->banner_is_shop == CGlobal::BANNER_IS_SHOP && $banner->banner_shop_id > 0){
                    $arrShopShow = UserShop::getShopAll();
                    if(in_array($banner->banner_shop_id,array_keys($arrShopShow))){
                        $result[] = $banner;
                    }
                }else{
                    $result[] = $banner;
                }
            }
         }
         return $result;
     }
     
     //Get OS
     public static function getOS(){
     	$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
     	$os_platform   =   "Unknown OS Platform";
     	$os_array      =   array(
     			'/windows nt 10/i'      =>  'Windows 10',
     			'/windows nt 6.3/i'     =>  'Windows 8.1',
     			'/windows nt 6.2/i'     =>  'Windows 8',
     			'/windows nt 6.1/i'     =>  'Windows 7',
     			'/windows nt 6.0/i'     =>  'Windows Vista',
     			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
     			'/windows nt 5.1/i'     =>  'Windows XP',
     			'/windows xp/i'         =>  'Windows XP',
     			'/windows nt 5.0/i'     =>  'Windows 2000',
     			'/windows me/i'         =>  'Windows ME',
     			'/win98/i'              =>  'Windows 98',
     			'/win95/i'              =>  'Windows 95',
     			'/win16/i'              =>  'Windows 3.11',
     			'/macintosh|mac os x/i' =>  'Mac OS X',
     			'/mac_powerpc/i'        =>  'Mac OS 9',
     			'/linux/i'              =>  'Linux',
     			'/ubuntu/i'             =>  'Ubuntu',
     			'/iphone/i'             =>  'iPhone',
     			'/ipod/i'               =>  'iPod',
     			'/ipad/i'               =>  'iPad',
     			'/android/i'            =>  'Android',
     			'/blackberry/i'         =>  'BlackBerry',
     			'/webos/i'              =>  'Mobile',
     			'/windows phone os/i'   =>  'WindowsPhone',
     	);
     
     	foreach ($os_array as $regex => $value) {
     		if (preg_match($regex, $user_agent)) {
     			$os_platform    =   $value;
     		}
     	}
     
     	return $os_platform;
     }
     public static function checkOS(){
     	$screenWidth = FunctionLib::getOS();
     	if( $screenWidth == 'iphone' || $screenWidth == 'ipod' || $screenWidth == 'ipad' || $screenWidth == 'Android'
     		|| $screenWidth == 'Blackberry' || $screenWidth == 'Webos' || $screenWidth=='WindowsPhone'){
     		return 1;
     	}else{
     		return 0;
     	}
     }
}