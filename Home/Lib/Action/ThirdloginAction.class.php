<?php

class ThirdloginAction extends Action {

        
        private $isCheckNickname = true;
        
        public function  login($type){
                
                empty($type) && $this->error('参数错误');

                //加载ThinkOauth类并实例化一个对象
                import("ORG.ThinkSDK.ThinkOauth");
                $sns = \ThinkOauth::getInstance($type);

                $url = $sns->getRequestCodeURL();

                //如果是微信用户需要将参数client_id变成appid
                if ($type == "weixin") {
                        $url = str_replace("client_id", "appid", $url);
                }else if($type == "renren"){
                        $url = $url."&display=mobile";
                }
                //var_dump($url);die;
                //跳转到授权页面
                redirect($url);
        }
        /*
         *新浪第三方登陆回调方法       
         */
        public function callbacksina() {

                $code = $_GET['code'];

                empty($code) && $this->error('参数错误');

                $this->callback($type = 'sina', $code);
        }
        /*
         *qq第三方登陆回调方法       
         */
        public function callbackqq() {

                $code = $_GET['code'];

                empty($code) && $this->error('参数错误');

                $this->callback($type = 'qq', $code);
        }
        /*
         *人人网第三方登陆回调方法       
         */
        public function callbackrenren() {

                $code = $_GET['code'];

                empty($code) && $this->error('参数错误');

                $this->callback($type = 'renren', $code);
        }
        /*
         *微信第三方登陆回调方法       
         */
        public function callbackweixin() {

                $code = $_GET['code'];

                empty($code) && $this->error('参数错误');

                $this->callback($type = 'weixin', $code);
        }
        
        public function callback($type = null, $code = null) {
                
                (empty($type) || empty($code)) && $this->error('参数错误');

                //加载ThinkOauth类并实例化一个对象
                import("ORG.ThinkSDK.ThinkOauth");
                $sns = \ThinkOauth::getInstance($type);
                //腾讯微博需传递的额外参数
                $extend = null;
             
                $token = $sns->getAccessToken($code, $extend);
//                echo "<pre>";
//                var_dump($token);
//                echo "</pre>";die;
                //获取当前登录用户信息
                if (is_array($token)) {

                        //设置登陆成功   
                        if ($type == "sina") {
                                $data['username'] = "sina_" . $token['openid'];
                                $this->otherLogin($data, "sina");
                        } elseif ($type == "qq") {

                                $this->qqLoginTest($token);
                        } elseif ($type == "renren") {
                                $data['username'] = "renren_" . $token['openid'];
                                $this->otherLogin($data, "renren");
                        } elseif ($type == "weixin") {

                                $data['username'] = "wx_" . $token['openid'];
                                $this->otherLogin($data, "weixin");
                        }
                } else {
                        header("location:?s=/Index/index");
                }
        }
        
        public function otherLogin($data, $from) {
                $isExitLogin = $this->isExitLogin($data);
                if ($isExitLogin === true) {
                        //用户的类型
                        $data['flag'] = 0;
                        $data['password'] = md5(md5(123456));
                        $data['status'] = 1;
                        $data['username'] = $data['username'];
                        $card['username'] = $data['username'];
                        $card['password'] = $data['password'];
                        $card['pwd'] = 123456;
                        $card['fromwhere'] = $from;
                        $card['activation'] = 1;
                        $card['regip'] = $_SERVER["REMOTE_ADDR"];
                        $card['regtime'] = time();
                        $card['logintime'] = time();
                                        

                        M("userinfo")->add($data);
                        M("member")->add($card);
                        
                        $uid = M("member")->getLastInsID();
                        $_SESSION['userinfo'] = array("userid" => $uid, "username" => $data['username']);
                        setcookie("userinfo",serialize(array("userid" => $uid, "username" => $data['username'])),time()+3600*24*30,"/");
                        $this -> loginRedirect();
                        
                }else{
                        $arMember = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                        M("member")->where("username='" . $data['username'] . "' and password='" . md5(md5(123456)) . "'")->save($arMember);
                        $_SESSION['userinfo'] = array("userid" => $isExitLogin['id'], "username" => $data['username']);
                        $this -> loginRedirect();
                }
        }

        public function isExitLogin($data) {
                $isExit = M("member")->where("username='$data[username]'")->find();
                if ($isExit) {
                        return $isExit;
                } else {
                        return true;
                }
        }
        public function qqLoginTest($token) {

                //得到openid 信息
                $info = $this->getQqOpenid($token['access_token']);


                //判断cookie中是否有昵称信息，如果有不去第三方获取
                if (!empty($_COOKIE["qq_" . $info['openid']])) {

                        $user_info['nickname'] = $_COOKIE["qq_" . $info['openid']];
                        $user_info['openid'] = $info['openid'];

                        $username = "qq_" . $info['openid'];
                        $arMember = M("member") -> where("username='{$username}'") -> find();
                        $_SESSION['userinfo']['userid'] = $arMember['id'];
                        $_SESSION['userinfo']['username'] =  $username;
                        setcookie("userinfo",serialize(array("userid" => $arMember['id'], "username" => $username)),time()+3600*24*30,"/");
                        $this->loginRedirect();
                } else {

                        $user_info = $this->getQqUinfo($info);
                }


                $data['nickname'] = "qq_" . $user_info['nickname'];
                $data['username'] = "qq_" . $user_info['openid'];

                setcookie("qq_" . $user_info['openid'], $data['nickname'], time() + 3600*24*30,"/");


                if ($this->isCheckNickname && $this->isExitQqNickname($data)) {

                        $this->updateUsername($data);
                        $arMember = M("member") -> where("username='{$data['username']}'") -> find();
                        $_SESSION['userinfo']['username'] = $data['username'];
                        $_SESSION['userinfo']['userid'] = $arMember['id'];
                        setcookie("userinfo",serialize(array("userid" => $arMember['id'], "username" => $data['username'])),time()+3600*24*30,"/");
                        $this->loginRedirect();
                        die;
                }

                if ($this->isExitQqOpenid($data)) {
                        //登陆
                        $arMember = M("member") -> where("username='{$data['username']}'") -> find();
                        $_SESSION['userinfo']['username'] = $data['username'];
                        $_SESSION['userinfo']['userid'] = $arMember['id'];
                        $this->loginRedirect();
                        die;
                } else {
                        //插入数据到用户信息数据
                        $this->addUserData($data);
                        $this->loginRedirect();
                        die;
                }
        }
        public function getQqOpenid($token) {
                $url = "https://graph.qq.com/oauth2.0/me?access_token=$token";
                $info = file_get_contents($url);
                //将返回值转为数组
                $info1 = substr($info, 9, -3);
                $info2 = json_decode($info1);
                $info3 = std_class_object_to_array($info2);
                $info3['token'] = $token;
                return $info3;
        }

        function getQqUinfo($info) {

                $token = $info['token'];
                $key = $info['client_id'];
                $openid = $info['openid'];
                $userinfoUrl = "https://graph.qq.com/user/get_user_info?access_token=$token&oauth_consumer_key=$key&openid=$openid";
                $userinfo = file_get_contents($userinfoUrl);

                $user_info = std_class_object_to_array(json_decode($userinfo));
                $user_info['openid'] = $openid;
                return $user_info;
        }
        public function loginRedirect() {

                //得到跳转到的地址
                if (!empty($_COOKIE['gourl'])) {
                        $gourl = $_COOKIE['gourl'];
                        header("location:".$gourl);
                } else {
                        $gourl = "/index.php?s=/Index/index.html";
                        header("location:".$gourl);
                }
                
        }
        public function isExitQqNickname($data) {

                $isExit = M("member")->where("username='{$data['nickname']}'")->find();
                if ($isExit) {
                        return true;
                } else {
                        return false;
                }
        }
        /*
         * 判断存不存在用户名是qq_openid
         */

        public function isExitQqOpenid($data) {

            $isExit = M("member")->where("username='{$data['username']}'")->find();
            if ($isExit) {
                return true;
            } else {
                return false;
            }
        }
         /*
         * 新增数据到userinfo和member
         */

        public function addUserData($da) {
                //用户的类型
                $data['flag'] = 0;
                $data['password'] = md5(md5(123456));
                $data['status'] = 1;
                $data['username'] = $da['username'];
                $card['username'] = $da['username'];
                $card['password'] = $data['password'];
                $card['pwd'] = 123456;
                $card['fromwhere'] = "qq";
                $card['activation'] = 1;
                $card['regip'] = $_SERVER["REMOTE_ADDR"];
                $card['regtime'] = time();
                $card['logintime'] = time();


                M("userinfo")->add($data);
                M("member")->add($card);

                $uid = M("member") -> getLastInsID();
                $_SESSION['userinfo']['username'] = $data['username'];
                $_SESSION['userinfo']['userid'] = $uid;

                $this->loginRedirect();
        }
        public function updateUsername($data) {

                //修改username 和 nickname
                $user = M("userinfo");
                $userArr = $user->where("username='{$data['nickname']}'")->find();
                $memberArr = M("member")->where("username='{$data['nickname']}'")->find();

                $user->startTrans();
                $re1 = $user->query("update stj_userinfo set username='{$data['username']}' where username='{$data['nickname']}' and userid='{$userArr['userid']}'");  //userinfo
                //echo $user->getLastSql()."<br/>";
                $re2 = M("member")->query("update stj_member set username='{$data['username']}' where username='{$data['nickname']}' and  id={$memberArr['id']}"); //member
                //echo M("member")->getLastSql()."<br/>";
                $re3 = M("account")->query("update stj_account set username='{$data['username']}' where username='{$data['nickname']}' and uid={$userArr['userid']}");
                //echo M("account")->getLastSql()."<br/>";
                $re4 = M("account_blance")->query("update stj_account set username='{$data['username']}' where username='{$data['nickname']}' and uid={$userArr['userid']}");
                //echo M("account_blance")->getLastSql()."<br/>";
                $re5 = M("job_collection")->query("update stj_job_collection set username='{$data['username']}' where username='{$data['nickname']}' and uid={$memberArr['id']}");
                //echo M("job_collection")->getLastSql()."<br/>";
                $re6 = M("share")->query("update stj_share set username='{$data['username']}' where username='{$data['nickname']}' and uid={$userArr['userid']}");
                //echo M("share")->getLastSql()."<br/>";
                $re7 = M("enchashment")->query("update stj_enchashment set username='{$data['username']}' where username='{$data['nickname']}' and uid={$userArr['userid']}");
                //echo M("enchashment")->getLastSql()."<br/>";
                //var_dump($re1);var_dump($re2);var_dump($re3);var_dump($re4);var_dump($re5);var_dump($re6);var_dump($re7);echo "<br/>";
                if ($re1 === false || $re2 === false || $re3 === false || $re4 === false || $re5 === false || $re6 === false || $re7 === false) {
                        //echo "1<br/>";
                        $user->rollback();
                } else {
                        //echo "2<br/>";
                        $user->commit();
                }
                
        }
     


}
