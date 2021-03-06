<?php

header("content-type:text/html;charset=utf-8");

// 定义ThinkPHP框架路径(相对于入口文件)
define('THINK_PATH', './ThinkPHP/');

//定义项目名称
define('APP_NAME', 'wap_renrenlie');

//定义项目路径
define('APP_PATH', './Home/');


define('BACK_URL', './index.php');
define('APP_DEBUG', true);
if (is_mobile_request() === false) {

        //pc访问手机端职位详情
        if (strpos($_SERVER['REQUEST_URI'], "/Job/job_detail_new/jobid/") !== false) {

                $requesString = explode("/jobid/", $_SERVER['REQUEST_URI']);
                $requesString = explode("&share=", $requesString[1]);

//            var_dump($requesString);die;
//                header("Location: http://m.renrenlie.com/index.php?s=/Job/job_detail_redirect/jobid/" . $requesString[0]);
//                die;
        }

//        to_pc();

//        header('Location: http://www.renrenlie.com/');
}

//加载框架入文件
require THINK_PATH . 'ThinkPHP.php';

function is_mobile_request() {
        $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
        $mobile_browser = '0';
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
                $mobile_browser++;
        if ((isset($_SERVER['HTTP_ACCEPT'])) and ( strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false))
                $mobile_browser++;
        if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
                $mobile_browser++;
        if (isset($_SERVER['HTTP_PROFILE']))
                $mobile_browser++;
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-'
        );
        if (in_array($mobile_ua, $mobile_agents))
                $mobile_browser++;
        if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
                $mobile_browser++;
        // Pre-final check to reset everything if the user is on Windows
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
                $mobile_browser = 0;
        // But WP7 is also Windows, with a slightly different characteristic
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
                $mobile_browser++;
        if ($mobile_browser > 0)
                return true;
        else
                return false;
}
//不是来自手机的访问就跳转到pc相应页面
function to_pc() {
        
        $referurl = $_SERVER['QUERY_STRING'];
        if(!empty($referurl)){
                $arShare = conn_db();
                foreach ($arShare as $v) {
                        if (strpos("s=" . $v['wapurl'], rtrim($referurl, ".html")) !== false) {
                                header("location:" . "http://www.renrenlie.com" . $v['pcurl']);
                                die;
                        }
                }
        }
}

//连接数据库
function conn_db() {
        @$conn = mysql_connect("127.0.0.1", "root", "");     //线下
//        @$conn = mysql_connect("localhost", "myrenrenlie", "W8ydG7TxHRaYZVcT");     //线上

        if (!$conn) {

                die(mysql_error());
        }
        $db_selected = mysql_select_db("renrenlie", $conn);
//        $db_selected = mysql_select_db("lierenren", $conn); //线上

        if (!$db_selected) {

                die(mysql_error());
        }

        //查找数据
        $sql = "select  *  from  stj_share_info";
        $re = mysql_query($sql);    //返回resource或false
        if (!$re) {

                die(mysql_error());
        }
        while ($arr = mysql_fetch_assoc($re)) {  //返回的数组包括关联数组
                $arShare[] = $arr;
        }

        return $arShare;
}

?>
