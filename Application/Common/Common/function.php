<?php
/**
 * TODO 基础分页的相同代码封装，使前台的代码更少
 * @param $count 要分页的总记录数
 * @param int $pagesize 每页查询条数
 * @return \Think\Page
 */
function getpage($count, $pagesize = 8) {
    $p = new Think\Page($count, $pagesize);
    $p -> setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    $p -> setConfig('prev', '上一页');
    $p -> setConfig('next', '下一页');
    $p -> setConfig('last', '末页');
    $p -> setConfig('first', '首页');
    $p -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
    $p -> lastSuffix = false;
    //最后一页不显示为总页数
    return $p;
}
function getdatas($datas,$ziduan){
    $data=unserialize($datas);
    return $data[$ziduan];

}

function getdatas2($datas,$ziduan){
    $data=unserialize($datas);
    $data[$ziduan]=str_replace("周氏滋美"," <em> 周氏滋美 </em> ",$data[$ziduan]);
    return $data[$ziduan];

}

function gettitle($ziduan){

    $ziduan=str_replace("周氏滋美"," <em> 周氏滋美 </em> ",$ziduan);
    return $ziduan;

}

function gettujilist($a_id,$number){
    $article=M("Article")->find($a_id);

    $data=unserialize($article['tujilist']);

    $i=0;
    $array=array();
    foreach($data as $v){
        if($i<$number){
        $array[]=$v;
        }
        $i++;
    }


    return $array;
}

function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
{
    if(function_exists("mb_substr")){
        if($suffix)
            return mb_substr($str, $start, $length, $charset)."...";
        else
            return mb_substr($str, $start, $length, $charset);
    }
    elseif(function_exists('iconv_substr')) {
        if($suffix)
            return iconv_substr($str,$start,$length,$charset)."...";
        else
            return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef]
                  [x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
    $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
    $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
    $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."…";
    return $slice;
}
function tranTime($time) { 
    $rtime = date("Y-m-d H:i", $time); 
    $htime = date("H:i", $time); 
    $time = time() - $time; 
    if ($time < 60) { 
        $str = '刚刚'; 
    } elseif ($time < 60 * 60) { 
        $min = floor($time / 60); 
        $str = $min . '分钟前'; 
    } elseif ($time < 60 * 60 * 24) { 
        $h = floor($time / (60 * 60)); 
        $str = $h . '小时前 ' . $htime; 
    } elseif ($time < 60 * 60 * 24 * 3) { 
        $d = floor($time / (60 * 60 * 24)); 
        if ($d == 1) 
            $str = '昨天 ' . $htime; 
        else 
            $str = '前天 ' . $htime; 
    } 
    else { 
        $str = $rtime; 
    } 
    return $str; 
}

function get_url() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    echo get_url();
 }


/**
* 友好的时间显示
*
* @param int    $sTime 待显示的时间
* @param string $type  类型. normal | mohu | full | ymd | other
* @param string $alt   已失效
* @return string
*/
function friendlyDate($sTime,$type = 'normal',$alt = 'false') {
        //sTime=源时间，cTime=当前时间，dTime=时间差
        $cTime        =    time();
        $dTime        =    $cTime - $sTime;
        $dDay        =    intval(date("z",$cTime)) - intval(date("z",$sTime));
        //$dDay        =    intval($dTime/3600/24);
        $dYear        =    intval(date("Y",$cTime)) - intval(date("Y",$sTime));
        //normal：n秒前，n分钟前，n小时前，日期
        if($type=='normal'){
            if( $dTime < 60 ){
                return $dTime."秒前";
            }elseif( $dTime < 3600 ){
                return intval($dTime/60)."分钟前";
            //今天的数据.年份相同.日期相同.
            }elseif( $dYear==0 && $dDay == 0  ){
                //return intval($dTime/3600)."小时前";
                return '今天'.date('H:i',$sTime);
            }elseif($dYear==0){
                return date("m月d日 H:i",$sTime);
            }else{
                return date("Y-m-d H:i",$sTime);
            }
        }elseif($type=='mohu'){
            if( $dTime < 60 ){
                return $dTime."秒前";
            }elseif( $dTime < 3600 ){
                return intval($dTime/60)."分钟前";
            }elseif( $dTime >= 3600 && $dDay == 0  ){
                return intval($dTime/3600)."小时前";
            }elseif( $dDay > 0 && $dDay<=7 ){
                return intval($dDay)."天前";
            }elseif( $dDay > 7 &&  $dDay <= 30 ){
                return intval($dDay/7) . '周前';
            }elseif( $dDay > 30 ){
                return intval($dDay/30) . '个月前';
            }
        //full: Y-m-d , H:i:s
        }elseif($type=='full'){
            return date("Y-m-d , H:i:s",$sTime);
        }elseif($type=='ymd'){
            return date("Y-m-d",$sTime);
        }else{
            if( $dTime < 60 ){
                return $dTime."秒前";
            }elseif( $dTime < 3600 ){
                return intval($dTime/60)."分钟前";
            }elseif( $dTime >= 3600 && $dDay == 0  ){
                return intval($dTime/3600)."小时前";
            }elseif($dYear==0){
                return date("Y-m-d H:i:s",$sTime);
            }else{
                return date("Y-m-d H:i:s",$sTime);
            }
        }
}



// 获取操作系统
function getOS() {
    $os = '';
    $Agent = $_SERVER['HTTP_USER_AGENT'];
    if (eregi('win', $Agent) && strpos($Agent, '95')) {
        $os = 'Win 95';
    } elseif (eregi('win 9x', $Agent) && strpos($Agent, '4.90')) {
        $os = 'Win ME';
    } elseif (eregi('win', $Agent) && ereg('98', $Agent)) {
        $os = 'Win 98';
    } elseif (eregi('win', $Agent) && eregi('nt 5.0', $Agent)) {
        $os = 'Win 2000';
    } elseif (eregi('win', $Agent) && eregi('nt 6.0', $Agent)) {
        $os = 'Win Vista';
    } elseif (eregi('win', $Agent) && eregi('nt 6.1', $Agent)) {
        $os = 'Win 7';
    } elseif (eregi('win', $Agent) && eregi('nt 5.1', $Agent)) {
        $os = 'Win XP';
    } elseif (eregi('win', $Agent) && eregi('nt 6.2', $Agent)) {
        $os = 'Win 8';
    } elseif (eregi('win', $Agent) && eregi('nt 6.3', $Agent)) {
        $os = 'Win 8.1';
    } elseif (eregi('win', $Agent) && eregi('nt 10', $Agent)) {
        $os = 'Win 10';
    } elseif (eregi('win', $Agent) && eregi('nt', $Agent)) {
        $os = 'Win NT';
    } elseif (eregi('win', $Agent) && ereg('32', $Agent)) {
        $os = 'Win 32';
    } elseif (ereg('Mi', $Agent)) {
        $os = '小米';
    } elseif (eregi('Android', $Agent) && ereg('LG', $Agent)) {
        $os = 'LG';
    } elseif (eregi('Android', $Agent) && ereg('M1', $Agent)) {
        $os = '魅族';
    } elseif (eregi('Android', $Agent) && ereg('MX4', $Agent)) {
        $os = '魅族4';
    } elseif (eregi('Android', $Agent) && ereg('M3', $Agent)) {
        $os = '魅族';
    } elseif (eregi('Android', $Agent) && ereg('M4', $Agent)) {
        $os = '魅族';
    } elseif (eregi('Android', $Agent) && ereg('Huawei', $Agent)) {
        $os = '华为';
    } elseif (eregi('Android', $Agent) && ereg('HM201', $Agent)) {
        $os = '红米';
    } elseif (eregi('Android', $Agent) && ereg('KOT', $Agent)) {
        $os = '红米4G版';
    } elseif (eregi('Android', $Agent) && ereg('NX5', $Agent)) {
        $os = '努比亚';
    } elseif (eregi('Android', $Agent) && ereg('vivo', $Agent)) {
        $os = 'Vivo';
    } elseif (eregi('Android', $Agent)) {
        $os = 'Android';
    } elseif (eregi('linux', $Agent)) {
        $os = 'Linux';
    } elseif (eregi('unix', $Agent)) {
        $os = 'Unix';
    } elseif (eregi('iPhone', $Agent)) {
        $os = '苹果';
    } else if (eregi('sun', $Agent) && eregi('os', $Agent)) {
        $os = 'SunOS';
    } elseif (eregi('ibm', $Agent) && eregi('os', $Agent)) {
        $os = 'IBM OS/2';
    } elseif (eregi('Mac', $Agent) && eregi('PC', $Agent)) {
        $os = 'Macintosh';
    } elseif (eregi('PowerPC', $Agent)) {
        $os = 'PowerPC';
    } elseif (eregi('AIX', $Agent)) {
        $os = 'AIX';
    } elseif (eregi('HPUX', $Agent)) {
        $os = 'HPUX';
    } elseif (eregi('NetBSD', $Agent)) {
        $os = 'NetBSD';
    } elseif (eregi('BSD', $Agent)) {
        $os = 'BSD';
    } elseif (ereg('OSF1', $Agent)) {
        $os = 'OSF1';
    } elseif (ereg('IRIX', $Agent)) {
        $os = 'IRIX';
    } elseif (eregi('FreeBSD', $Agent)) {
        $os = 'FreeBSD';
    } elseif ($os == '') {
        $os = 'Unknown';
    }
    return $os;
}




/*
 * 获取浏览器信息
 */
function getUserBrowser() {
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Maxthon')) {
        $browser = 'Maxthon';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 12.0')) {
        $browser = 'IE12.0';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 11.0')) {
        $browser = 'IE11.0';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 10.0')) {
        $browser = 'IE10.0';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0')) {
        $browser = 'IE9.0';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0')) {
        $browser = 'IE8.0';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0')) {
        $browser = 'IE7.0';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
        $browser = 'IE6.0';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'NetCaptor')) {
        $browser = 'NetCaptor';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape')) {
        $browser = 'Netscape';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Lynx')) {
        $browser = 'Lynx';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')) {
        $browser = 'Opera';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
        $browser = 'Chrome';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
        $browser = 'Firefox';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')) {
        $browser = 'Safari';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iphone') || strpos($_SERVER['HTTP_USER_AGENT'], 'ipod')) {
        $browser = 'iphone';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'ipad')) {
        $browser = 'iphone';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'android')) {
        $browser = 'android';
    } else {
        $browser = 'other';
    }
    return $browser;
}



/**
 * 验证码检查
 */
    function check_verify($code, $id = ""){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

  // function Getaddress($ip=''){
  //  if(empty($ip)){
  //      $ip = $this->Getip();    
  //  }
  //  $ipadd = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?ip=".$ip);//根据新浪api接口获取
  //  if($ipadd){
  //   $charset = iconv("gbk","utf-8",$ipadd);   
  //   preg_match_all("/[\x{4e00}-\x{9fa5}]+/u",$charset,$ipadds);
    
  //   return $ipadds;   //返回一个二维数组
  //  }else{return "addree is none";}  
  // } 


    /*
     * 删除缓存方法
     */
    function delFileByDir($dir) {
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {

                $fullpath = $dir . "/" . $file;
                if (is_dir($fullpath)) {
                    delFileByDir($fullpath);
                } else {
                    unlink($fullpath);
                }
            }
        }
        closedir($dh);
    }


    //获取员工姓名
    function getMemberUserName($id)
    {
        if(empty($id)){
            return "";
        }

        $m = M('member_list')->where('m_id='.$id)->field('username')->find();
        if($m){
           return $m['username'] ; 
        }else{
            return "";
        }
           
    }


    
    //登录日志记录
    function loginlog($uid,$username,$description,$status) {
       
        $hlog['admin_id'] = $uid;
        $hlog['admin_name'] = $username;
        $hlog['description'] = $description;
        $hlog['status'] = $status;  
        $hlog['add_time'] = time();
        $log = M('Log');
        $log->add($hlog);
    }




    function p ($array){
        dump($array,1,'<pre>',0);	
    }

    function get_avatar_name(){
            return 'temp';
    }
	
    function sendMail($to, $title, $content) {
     
        Vendor('PHPMailer.PHPMailerAutoload');     
        $mail = new PHPMailer(); //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
        $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
        $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
        $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
        $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
        $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
        $mail->AddAddress($to,"尊敬的客户");
        $mail->WordWrap = 50; //设置每行字符长度
        $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
        $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
        $mail->Subject =$title; //邮件主题
        $mail->Body = $content; //邮件内容
        $mail->AltBody = ""; //邮件正文不支持HTML的备用显示
        return($mail->Send());
    }

    function subtext($text, $length)
    {
    	if(mb_strlen($text, 'utf8') > $length)
    		return mb_substr($text, 0, $length, 'utf8').'...';
    	return $text;
    }
    
/**************************数据备份操作*****************************/

    /**
    * 格式化字节大小
    * @param  number $size      字节数
    * @param  string $delimiter 数字和单位分隔符
    * @return string            格式化后的带单位的大小
    * @author slackck <876902658@qq.com>
    */
    function format_bytes($size, $delimiter = '') {
    $units = array(' B', ' KB', ' MB', ' GB', ' TB', ' PB');
		for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
		return round($size, 2) . $delimiter . $units[$i];
    }
    
    
?>