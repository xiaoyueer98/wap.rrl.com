<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * ThinkPHP惯例配置文件
 * 该文件请不要修改，如果要覆盖惯例配置的值，可在项目配置文件中设定和惯例不符的配置项
 * 配置名称大小写任意，系统会统一转换成小写
 * 所有配置参数都可以在生效前动态改变
 * @category Think
 * @package  Common
 * @author   liu21st <liu21st@gmail.com>
 * @version  $Id: convention.php 3088 2012-07-29 09:12:19Z luofei614@gmail.com $
 */
defined('THINK_PATH') or exit();
define('URL_CALLBACK', 'http://m.renrenlie.com/index.php?s=/Thirdlogin/callback');

$THINK_SDK_RENREN = array(
    'APP_KEY' => 'a120f1c4c89b40e59abcc2749e0b4f72', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '77bc11c11c9f437e8578633d4d5d3d71', //应用注册成功后分配的KEY
    'CALLBACK' => URL_CALLBACK . 'renren&',
);
$THINK_SDK_QQ = array(
    'APP_KEY' => '101197941', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '138e32dab59c912a00a814316b787cea', //应用注册成功后分配的KEY
    'CALLBACK' => URL_CALLBACK . 'qq&',
);
$THINK_SDK_WEIXIN = array(
    // 'APP_KEY' => 'wxf2310b20ba7d362c', //应用注册成功后分配的 APP ID
    // 'APP_SECRET' => '43396c539e07fd12aa1f77b96b427aad', //应用注册成功后分配的KEY
    'APP_KEY' => 'wxe0a92d30dcce1564', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '9807957335ed7a9071459d0ed72676aa', //应用注册成功后分配的KEY
    'CALLBACK' => URL_CALLBACK . 'weixin&',
);
$THINK_SDK_SINA = array(
    'APP_KEY' => '1471489106', //应用注册成功后分配的 APP ID   
    'APP_SECRET' => 'becfef84fa57123e21d88c0faf17fe12', //应用注册成功后分配的KEY
    'CALLBACK' => URL_CALLBACK . 'sina&',
);
$WEIXIN_CONFIG = array(
    
        "wxappid" => "wx5aee7c9e7c2eb969", //微信公众号appid
        "mch_id" => "1235001902",  //微信支付商户id
        "appsecret" => "44062163dcb3b4627a53bf0ac164c87d", //公众号appsecert
        "KEY" => "1235001902905115wx5aee7c9e7c2eb9",   //api秘钥
        
        "SSLCERT_PATH" => '/Public/cert/apiclient_cert.pem',
        "SSLKEY_PATH" => '/Public/cert/apiclient_key.pem',
        "CA_PATH" => '/Public/cert/rootca.pem',
);
return array(
    'SHOW_PAGE_TRACE' => false,
    /* 默认设定 */
    'DEFAULT_M_LAYER' => 'Model', // 默认的模型层名称
    'DEFAULT_C_LAYER' => 'Action', // 默认的控制器层名称
    'DEFAULT_V_LAYER' => 'Tpl', // 默认的视图层名称
    'DEFAULT_APP' => '@', // 默认项目名称，@表示当前项目
    'DEFAULT_THEME' => '', // 默认模板主题名称
    'DEFAULT_GROUP' => 'Home', // 默认分组
    'DEFAULT_MODULE' => 'Index', // 默认模块名称
    'DEFAULT_ACTION' => 'index', // 默认操作名称
    'DEFAULT_TIMEZONE' => 'PRC', // 默认时区

    /* 数据库设置 */
//    'DB_TYPE' => 'mysql', // 数据库类型
//    'DB_HOST' => 'localhost', //数据库地址
//    'DB_NAME' => 'lierenren', //管理库名称，数据库初始化时已定，无需修改
//    'DB_USER' => 'myrenrenlie', //数据库用户名
//    'DB_PWD' => 'W8ydG7TxHRaYZVcT', //数据库密码ie', //数据库用户名
     'DB_HOST' => '127.0.0.1', // 服务器地址
     'DB_NAME' => 'renrenlie', // 数据库名
     'DB_USER' => 'root', // 用户名
     'DB_PWD' => '', // 密码
    'DB_PORT' => '3306', // 端口
    'DB_PREFIX' => 'stj_', // 数据库表前缀


    /* URL设置 */
    'URL_CASE_INSENSITIVE' => false, // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL' => 2, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式，提供最好的用户体验和SEO支持
    'URL_PATHINFO_DEPR' => '/', // PATHINFO模式下，各参数之间的分割符号
    'URL_PATHINFO_FETCH' => 'ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL', // 用于兼容判断PATH_INFO 参数的SERVER替代变量列表
    'URL_HTML_SUFFIX' => 'html', // URL伪静态后缀设置
    'URL_DENY_SUFFIX' => 'ico|png|gif|jpg', // URL禁止访问的后缀设置
    'URL_PARAMS_BIND' => true, // URL变量绑定到Action方法参数
    'URL_404_REDIRECT' => '', // 404 跳转页面 部署模式有效
    
    //领取红包参数
    'RED_PACKAGE_OPEN' => true,
    'RED_PACKAGE_ID' => 5,
    'RED_PACKAGE_COUNT' => 500,
    
    
    'SHARE_JON_OPEN' => true,
    'SHARE_JOB_ID' => 2,
    'SHARE_JOB_RECORD' => 20,
    'SHARE_JOB_RECORD_SUCCESS' => 50,
    'SHARE_JOB_COMPANY' => 20,
    'SHARE_JOB_COMPANY_SUCCESS' => 50,
    
    
    'SHARE_RECOMMENDSHARE_OPEN' => true,
    'SHARE_RECOMMENDSHARE_ID' => 4,
    'SHARE_RECOMMENDSHARE_RECORD' => 10,
    'SHARE_RECOMMENDSHARE_RECORD_SUCCESS' => 30,
    'SHARE_RECOMMENDSHARE_COMPANY' => 10,
    'SHARE_RECOMMENDSHARE_COMPANY_SUCCESS' => 30,
    
    //职位详情页面是否需要登录开关
    'isLogin' => false, 
    //SDK 此处可以些到外部include进来然后array_merge
    'THINK_SDK_RENREN' => $THINK_SDK_RENREN,
    'THINK_SDK_QQ' => $THINK_SDK_QQ,
    'THINK_SDK_SINA' => $THINK_SDK_SINA,
    'THINK_SDK_WEIXIN' => $THINK_SDK_WEIXIN,
    
);
