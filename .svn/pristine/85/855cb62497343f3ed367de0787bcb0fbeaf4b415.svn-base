<?php

class RegAction extends Action {

        private $max_sms_number = 10;   //每个手机号一天允许发送的短信数量
        private $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";   //短信通道的地址
        private $sms_account = "account=cf_zpkj&password=renrenlie231&";

        /*
         * 注册xin
         */

        public function reg() {

                $userinfo = $_SESSION['userinfo'];

                if (!empty($userinfo)) {
                        header("location:/index.php?s=/Index/index");
                        exit;
                } else {
                        $this->display("/Login/reg_mobile");
                }
        }

        /*
         * 注册xin
         */

        public function reg_info() {

                $userArr = $_SESSION['userinfo'];
                if (!empty($userArr)) {
                        header("location:/index.php?s=/Index/index");
                        exit;
                } else {

                        $this->display("/Login/reg_info");
                }
        }

        /*
         * 保存注册信息
         */

        public function reg_save() {


                $rules = array(
                    array('username', 'require', '帐号必须填写'), //默认情况下用正则进行验证
                    array('password', 'require', '密码必须填写'),
                    array('username', '', '帐号名称已经存在！', 0, 'unique', 1), // 在新增的时候验证name字段是否唯一
                );

                $Userinfo = D("Userinfo");
                //echo "<pre>";var_dump($Userinfo);echo "</pre>";
                $member = D("Member");

                $data['password'] = md5(md5($_POST['password']));
                $data['username'] = $_POST['username'];
                $data['status'] = '1';
                $data['flag'] = '0';

                $card['username'] = $data['username'];
                $card['password'] = $data['password'];
                $card['pwd'] = $_POST['password'];
                $card['mobile'] = $_SESSION['mobile'];

                $card['activation'] = 1;
                $card['checkinfo'] = 'true';
                $card['regip'] = $_SERVER["REMOTE_ADDR"];
                $card['regtime'] = time();
                $card['logintime'] = time();
                $card['loginip'] = $_SERVER["REMOTE_ADDR"];

                if (date("Y-m-d") > "2015-05-01") {
                        $card['fromwhere'] = "wap_reg";
                } else {
                        $card['fromwhere'] = "wap注册送好礼";
                }
                $is_share = 0;
//                var_dump($_SESSION['shareurl']);
//                var_dump(C("SHARE_JOB_ID")); 
//                var_dump($_SESSION['shareaid']);
//                var_dump(C("SHARE_JON_OPEN"));
                //分享职位送大礼
                if ($_SESSION['shareurl'] && C("SHARE_JOB_ID") == $_SESSION['shareaid'] && (C("SHARE_JON_OPEN") == true)) {
                        $data['fromwhere'] = $_SESSION['shareurl'];
                        $data['is_gift'] = 1;
                        $data['fromusername'] = $_SESSION['shareuname'];
                        $card['fromwhere'] = "share";
                        $is_share = 1;
                }

                //判断该用户名中是否包含  wx_,qq_,renren_,sina_
                if (strpos($_POST['username'], "qq_") === 0 || strpos($_POST['username'], "wx_") === 0 || strpos($_POST['username'], "renren_") === 0 || strpos($_POST['username'], "sina_") === 0) {
                        echo json_encode(array("code" => "500", "msg" => "用户名不合法"));
                        die;
                }
                if (!$Userinfo->validate($rules)->create($_POST)) {
                        // 如果创建失败 表示验证没有通过 输出错误提示信息
                        echo json_encode(array("code" => "500", "msg" => $Userinfo->getError()));
                        die;
                } else {

                        // 验证通过 可以进行其他数据操作
                        $user_result = $Userinfo->add($data);

                        if ($user_result) {
                                $member_result = $member->add($card);
                                //默认登陆 调转到首页
                                $memberArr = $member->where("username='" . $data['username'] . "'")->find();

                                //setcookie("userinfo", serialize(array("userid" => $memberArr['id'], "username" => $data['username'])), time() + 24 * 3600);
                                $_SESSION["userinfo"] = array("userid" => $memberArr['id'], "username" => $data['username']);
                                setcookie("userinfo", serialize(array("userid" => $memberArr['id'], "username" => $data['username'])), time() + 3600 * 24 * 30, "/");
                                $_SESSION['mobile'] = null;
                                $_SESSION['leavetime'] = null;
                                $_SESSION["m" . $mobile] = null;


                                $_SESSION['shareurl'] = null;
                                $_SESSION['backurl'] = null;
                                $_SESSION['sharetag'] = null;
                                $_SESSION['sharechannel'] = null;
                                $_SESSION['shareaid'] = null;
                                $_SESSION['shareuname'] = null;

                                if ($is_share == 1) {
                                        echo json_encode(array("code" => "300", "msg" => "注册成功"));
                                } else {
                                        echo json_encode(array("code" => "200", "msg" => "注册成功"));
                                }
                                die;
                        } else {
                                echo json_encode(array("code" => "500", "msg" => "注册失败"));
                                die;
                        }
                }
        }

        /*
         * 扫码直接注册的保存方法
         */

        public function reg_active_save() {
                if (empty($_POST['mobile'])) {
                        echo json_encode(array("code" => "500", "msg" => "参数错误"));
                        die;
                }
                $Userinfo = D("Userinfo");
                $member = D("Member");
                $username = $this->reg_username($Userinfo);
                $pwd = $_POST['password'];
                $data['password'] = md5(md5($pwd));
                $data['username'] = $username;
                $data['status'] = '1';
                $data['flag'] = '0';

                $card['username'] = $data['username'];

                if ($_POST['name'] && $_POST['industry']) {
                        $card['cnname'] = $_POST['name'];       //姓名
                        $card['jobtype'] = $_POST['industry'];       //所属行业
                }
                $card['password'] = $data['password'];
                $card['pwd'] = $pwd;
                $card['mobile'] = $_POST['mobile'];

                $card['activation'] = 1;
                $card['checkinfo'] = 'true';
                $card['regip'] = $_SERVER["REMOTE_ADDR"];
                $card['regtime'] = time();
                $card['logintime'] = time();
                $card['loginip'] = $_SERVER["REMOTE_ADDR"];
                $card['fromwhere'] = "扫码直接注册";

                $rules = array(
                    array('mobile', 'require', '手机号必须填写'), //默认情况下用正则进行验证
                    array('mobile', '', '手机号已经存在！', 0, 'unique', 1), // 在新增的时候验证mobile字段是否唯一
                );

                //判断该用户名中是否包含  wx_,qq_,renren_,sina_
                if (strpos($_POST['username'], "qq_") === 0 || strpos($_POST['username'], "wx_") === 0 || strpos($_POST['username'], "renren_") === 0 || strpos($_POST['username'], "sina_") === 0) {
                        echo json_encode(array("code" => "500", "msg" => "用户名不合法"));
                        die;
                }
                if (!$member->validate($rules)->create($_POST)) {
                        // 如果创建失败 表示验证没有通过 输出错误提示信息
                        echo json_encode(array("code" => "500", "msg" => $member->getError()));
                        die;
                } else {

                        // 验证通过 可以进行其他数据操作
                        $user_result = $Userinfo->add($data);

                        if ($user_result) {

                                $member_result = $member->add($card);
                                $memberArr = $member->where("username='" . $data['username'] . "'")->find();
                                //发送短信
                                $link_id = $member->getLastInsID();
                                $tag = "qrcodereg";
                                $comment = "扫码直接注册";
                                $content = "感谢您参与本次活动。登录人人猎账号为" . $_POST['mobile'] . "，密码为" . $pwd . "。如有疑问，请联系010-57188076。";
                                $re                   = smsChannel($_POST['mobile'], $content, $link_id, $tag, $comment);
                                $_SESSION["userinfo"] = array("userid" => $memberArr['id'], "username" => $data['username']);
                                setcookie("userinfo", serialize(array("userid" => $memberArr['id'], "username" => $data['username'])), time() + 3600 * 24 * 30, "/");
                                if ($re['code'] == "200") {
                                        echo json_encode(array("code" => "200", "msg" => $username));
                                        die;
                                } else {
                                        echo json_encode(array("code" => "300", "msg" => "注册成功，短信发送失败。请在我的资料中查看用户名，密码为$pwd。"));
                                        die;
                                }
                        } else {
                                echo json_encode(array("code" => "500", "msg" => "注册失败"));
                                die;
                        }
                }
        }

        public function reg_active_save_back() {
                if (empty($_POST['mobile'])) {
                        echo json_encode(array("code" => "500", "msg" => "参数错误"));
                        die;
                }
                $Userinfo = D("Userinfo");
                $member = D("Member");
                $username = $this->reg_username($Userinfo);
                $pwd = substr($_POST['mobile'], 5);
                $data['password'] = md5(md5($pwd));
                $data['username'] = $username;
                $data['status'] = '1';
                $data['flag'] = '0';

                $card['username'] = $data['username'];

                if ($_POST['name'] && $_POST['industry']) {
                        $card['cnname'] = $_POST['name'];       //姓名
                        $card['jobtype'] = $_POST['industry'];       //所属行业
                }
                $card['password'] = $data['password'];
                $card['pwd'] = $pwd;
                $card['mobile'] = $_POST['mobile'];

                $card['activation'] = 1;
                $card['checkinfo'] = 'true';
                $card['regip'] = $_SERVER["REMOTE_ADDR"];
                $card['regtime'] = time();
                $card['logintime'] = time();
                $card['loginip'] = $_SERVER["REMOTE_ADDR"];
                $card['fromwhere'] = "扫码直接注册";

                $rules = array(
                    array('mobile', 'require', '手机号必须填写'), //默认情况下用正则进行验证
                    array('mobile', '', '手机号已经存在！', 0, 'unique', 1), // 在新增的时候验证mobile字段是否唯一
                );

                //判断该用户名中是否包含  wx_,qq_,renren_,sina_
                if (strpos($_POST['username'], "qq_") === 0 || strpos($_POST['username'], "wx_") === 0 || strpos($_POST['username'], "renren_") === 0 || strpos($_POST['username'], "sina_") === 0) {
                        echo json_encode(array("code" => "500", "msg" => "用户名不合法"));
                        die;
                }
                if (!$member->validate($rules)->create($_POST)) {
                        // 如果创建失败 表示验证没有通过 输出错误提示信息
                        echo json_encode(array("code" => "500", "msg" => $member->getError()));
                        die;
                } else {

                        // 验证通过 可以进行其他数据操作
                        $user_result = $Userinfo->add($data);

                        if ($user_result) {

                                $member_result = $member->add($card);
                                $memberArr = $member->where("username='" . $data['username'] . "'")->find();
                                //发送短信
                                $link_id = $member->getLastInsID();
                                $tag = "qrcodereg";
                                $comment = "扫码直接注册";
                                $content = "感谢您参与本次活动。登录人人猎账号为" . $username . "，密码为手机号后六位。如有疑问，请联系010-57188076。";
                                $re                   = smsChannel($_POST['mobile'], $content, $link_id, $tag, $comment);
                                $_SESSION["userinfo"] = array("userid" => $memberArr['id'], "username" => $data['username']);
                                setcookie("userinfo", serialize(array("userid" => $memberArr['id'], "username" => $data['username'])), time() + 3600 * 24 * 30, "/");
                                if ($re['code'] == "200") {
                                        echo json_encode(array("code" => "200", "msg" => $username));
                                        die;
                                } else {
                                        echo json_encode(array("code" => "300", "msg" => "注册成功，短信发送失败。请在我的资料中查看用户名，密码为注册手机号后六位。"));
                                        die;
                                }
                        } else {
                                echo json_encode(array("code" => "500", "msg" => "注册失败"));
                                die;
                        }
                }
        }

        function reg_username($Userinfo, $username = "") {
                if (empty($username)) {
                        $username = "user_" . mt_rand(100000, 999999);
                }
                $arU = $Userinfo->where("username='{$username}'")->find();

                if (!empty($arU)) {
                        return $this->reg_username($Userinfo, $username . "1");
                }

                return $username;
        }

        /*
         * 注册成功页面
         */

        public function reg_success() {

                $userArr = $_SESSION['userinfo'];

                if (empty($userArr)) {
                        header("location:/index.php?s=/Index/index");
                        exit;
                } else {
                        $url = $_SERVER['HTTP_REFERER'];

//                        if(strpos($url,"reg_info") === false){
//                                echo "<div>请通过正常途径访问，<a href='/index.php?s=/Index/index'>点击</a>回到最新职位页面</div>";
//                                die;
//                        }else{
                        $this->display("./Login/erwei");

                        //  }
                }
        }

        /*
         * 修改密码第一步------填写手机号获取验证码
         */

        public function forget_password() {
                $userArr = $_SESSION['userinfo'];
                if (!empty($userArr)) {
                        header("location:/index.php?s=/Index/index");
                        exit;
                } else {
                        $this->display("/Login/forget_password");
                }
        }

        /*
         * 忘记密码和手机号注册 验证手机
         * 
         */

        public function check_mobile() {
                
                if($_POST['hash'] != md5("rrl_".$_SESSION['cookie'])){
                        return;
                }
                
                $type = $_POST['type'];
                $mobile = $_POST['mobile'];
                if (empty($mobile)) {
                        $mobile = $_SESSION['mobile'];
                }


                if ($type == 1) {
                        //查看该手机号是否已注册
                        $memberOb = M("member");

                        $mobileArr = $memberOb->query("select * from stj_member  m join stj_userinfo u where m.username=u.username and mobile='{$mobile}' and flag=0");
                        $mobileArr = $mobileArr[0];
                        if (empty($mobileArr)) {
                                echo json_encode(array("code" => '400', "msg" => "该手机未注册"));
                                die;
                        }
                } else {
                        //查看该手机号是否已注册
                        $memberOb = M("member");
                        //$mobileArr = $memberOb->where("mobile='" . $mobile . "'")->find();
                        $mobileArr = $memberOb->query("select * from stj_member  m join stj_userinfo u where m.username=u.username and mobile='{$mobile}' and flag=0");
                        $mobileArr = $mobileArr[0];

                        if (!empty($mobileArr)) {
                                echo json_encode(array("code" => '400', "msg" => "该手机已注册"));
                                die;
                        }
                        $mobileArr['id'] = 0;
                }
                //查看该手机号今天短信发送次数是否过于频繁
                $smslogOb = M("sms_log");
                $today = strtotime(date("Y-m-d"));
                $sended = $smslogOb->where("mobile='" . $mobile . "'  and status=2 and created_at>" . $today)->count();

                if ($sended >= $this->max_sms_number) {
                        echo json_encode(array("code" => '400', "msg" => "该号码发送验证码过于频繁，请稍后再发"));
                        die;
                }

                //发送验证码并存入session和日志表中
                $code = $this->getCode();
                $send_code = $code;

                if ($type == 1) {
                        $link_id = $mobileArr['id'];
                        $tag = "wapforgetpassword";
                        $comment = "wap忘记密码";
//                        $content = "【人人猎】您申请重置密码的验证码为" . $send_code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询400-668-5596。";
                        $content = "您申请重置密码的验证码为" . $send_code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
                } else {
                        $link_id = $mobileArr['id'];
                        $tag = "wapreg";
                        $comment = "wap注册";
//                        $content = "【人人猎】您申请成为renrenlie.com推荐人用户的验证码为" . $send_code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询400-668-5596。";
                        $content = "您申请成为renrenlie.com推荐人用户的验证码为" . $send_code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
                }


                if (!$_SESSION['leveltime']) {
                        //新短信通道
                        if ($type == 3) {
                                $content = "您申请成为renrenlie.com推荐人用户的验证码为" . $send_code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
                                $gets = smsChannel($mobile, $content, $link_id, $tag, $comment);
                                
                        } else {
                                $gets = smsChannel($mobile, $content, $link_id, $tag, $comment);
                        }
                        if ($gets['code'] == 200) {
                                $_SESSION["m" . $mobile] = $send_code;
                                $_SESSION["mobile"] = $mobile;
                                $_SESSION['leveltime'] = time();
                                echo json_encode(array("code" => 200, "msg" => "获取验证码成功"));
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "系统繁忙"));
                        }
                } elseif ((time() - $_SESSION['leveltime']) < 300) {  //小于3秒直接返回

                        echo json_encode(array("code" => 200, "msg" => $_SESSION["m" . $mobile]));
                        exit();
                } else {
                        //新短信通道
                        if ($type == 3) {
                                $content = "您申请成为renrenlie.com推荐人用户的验证码为" . $send_code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
                                $gets = smsChannel($mobile, $content, $link_id, $tag, $comment);
                        } else {
                                $gets = smsChannel($mobile, $content, $link_id, $tag, $comment);
                        }
                        if ($gets['code'] == 200) {
                                $_SESSION["m" . $mobile] = $send_code;
                                $_SESSION["mobile"] = $mobile;
                                $_SESSION['leveltime'] = time();
                                echo json_encode(array("code" => 200, "msg" => "获取验证码成功"));
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "请您稍后再试"));
                        }
                }
        }

        /*
         * 验证输入的验证码和发送的验证码是否相同
         */

        public function checkVerify() {

                $type = $_POST['type'];
                $verify = $_POST['verify'];
                $mobile = $_SESSION['mobile'];
                //var_dump($type);var_dump($verify);var_dump($mobile);
                if (empty($type) || empty($mobile) || empty($verify)) {
                        echo json_encode(array("code" => 500, "msg" => "验证失败"));
                        exit();
                }
                //var_dump($_SESSION["m" . $mobile]);var_dump($mobile);
                if ($_SESSION["m" . $mobile] == $verify) {
                        echo json_encode(array("code" => 200, "msg" => "验证成功"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "验证码不正确"));
                        exit();
                }
        }

        /*
         * 修改密码第二步-----重置密码
         */

        public function reset_password() {


                $userinfo = $_SESSION['userinfo'];

                if (!empty($userinfo)) {
                        header("location:/index.php");
                        exit;
                }
                $mobile = $_SESSION['mobile'];
                if (empty($mobile)) {
                        header("location:/index.php");
                        exit;
                }
                $mOb = M("member");
                $mobileArrAll = $mOb->query("select m.* from stj_member  m join stj_userinfo u where m.username=u.username and mobile='{$mobile}' and flag=0  ");
//                echo "<pre>";var_dump($mobileArrAll);echo "</pre>";
                $usernamestr = "";
                foreach ($mobileArrAll as $k => $v) {
                        if($v['fromwhere'] == "qq"){
                                 $usernamestr .= " , qq用户";
                        }elseif($v['fromwhere'] == "weixin"){
                                 $usernamestr .= " , 微信用户";
                        }elseif($v['fromwhere'] == "sina"){
                                 $usernamestr .= " , 新浪用户";
                        }elseif($v['fromwhere'] == "renren"){
                                 $usernamestr .= " , 人人用户";
                        }else{
                                 $usernamestr .= " , " . $v['username'];
                        }
                }
                $username = substr($usernamestr, 3);
                $this->assign("username", $username);
                $this->display("/Login/forget_reset");
        }

        public function password_save() {

                $mobile = $_SESSION['mobile'];
                $pwd = $_POST['password'];
                $password = md5(md5($pwd));
                if (empty($mobile)) {
                        echo json_encode(array("code" => 500, "msg" => "参数异常"));
                        die;
                }

                $mobileArrAll = M("member")->query("select * from stj_member  m join stj_userinfo u where m.username=u.username and mobile='{$mobile}' and flag=0  ");
                $memArrs = $mobileArrAll;

                if (empty($memArrs)) {
                        echo json_encode(array("code" => 500, "msg" => "该用户不存在"));
                        exit();
                }
                foreach ($memArrs as $memArr) {
                        M("member")->query("update stj_member set password='{$password}',pwd='{$pwd}' where id={$memArr['id']}");
                        M("userinfo")->query("update stj_userinfo set password='{$password}' where username='{$memArr['username']}' and flag=0");
                }
                $_SESSION['mobile'] = null;
                $_SESSION['leavetime'] = null;
                echo json_encode(array("code" => 200, "msg" => "修改成功"));
                exit();
        }

        function getCode($num = 6) {
                $randStr = str_shuffle('1234567890');
                $rand = substr($randStr, 0, 6);
                return $rand;
        }

}
