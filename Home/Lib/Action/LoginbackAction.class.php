<?php

class LoginAction extends Action
{

        public function login()
        {

                //得到跳转到的地址
                if (!empty($_COOKIE['gourl']))
                {
                        $gourl = $_COOKIE['gourl'];
                }
                else
                {
                        $gourl = "/index.php?s=/Index/index.html";
                }

                $userArr = $_SESSION['userinfo'];
                if (!empty($userArr))
                {
                        header('location:' . $gourl);
                        die;
                }

                $this->assign("gourl", $gourl);
                $this->display("./Login/login");
        }

        public function judge_login()
        {
                if ($_POST['type'] == 1)
                {
                        $data['username']   = I('post.username', '', 'htmlspecialchars');
                        $data['password']   = md5(md5(I('post.password', '', 'htmlspecialchars')));
                        $data['status']     = 1;
                        $data['is_deleted'] = 0;
                        //判断是否有用户名和密码匹配的激活用户
                        $Userinfo           = M("userinfo");
                        $userArr            = $Userinfo->where($data)->find();

                        if ($userArr['userid'] > 0)
                        {

                                if ($userArr['flag'] == "1")
                                {
                                        echo json_encode(array("code" => 500, "msg" => "企业用户暂不支持登陆"));
                                        die;
                                }

                                $User       = D("Member"); // 实例化User对象
                                $check_user = $User->where("username='" . $data['username'] . "'")->find();

                                //修改登陆信息
                                $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                                $User->where("id=" . $check_user['id'])->save($arUserLogin);

                                //存进session信息                                
                                $_SESSION['userinfo'] = array("userid" => $check_user['id'], "username" => $data['username']);
                                setcookie("userinfo", serialize(array("userid" => $check_user['id'], "username" => $data['username'])), time() + 3600 * 24 * 30, "/");
//                                session("userinfo",array("userid" => $check_user['id'], "username" => $data['username']));
//                                session("expire",3600*24);

                                echo json_encode(array("code" => 200, "msg" => "登陆成功"));
                                die;
                        }
                        else
                        {
                                echo json_encode(array("code" => 500, "msg" => "用户名或密码错误"));
                                die;
                        }
                }
                elseif ($_POST['type'] == 2)
                {
                        $data['mobile']   = I('post.username', '', 'htmlspecialchars');
                        $data['password'] = md5(md5(I('post.password', '', 'htmlspecialchars')));

                        $arMember = M("member")->where("mobile='" . $data['mobile'] . "' and username not like 'qq_%' and username not like 'weixin_%' and username not like 'sina_%' and  username not like 'renren_%'")->find();

                        if (empty($arMember))
                        {
                                $arCompany = M("company")->where("mobile='" . $data['mobile'] . "'")->find();
                                if (!empty($arCompany))
                                {
                                        echo json_encode(array("code" => 500, "msg" => "企业用户暂不支持登陆"));
                                        die;
                                }
                                else
                                {
                                        echo json_encode(array("code" => 500, "msg" => "手机号或密码错误"));
                                        die;
                                }
                        }
                        else
                        {

                                $arUserinfo = M("userinfo")->where("username='" . $arMember['username'] . "' and  is_deleted=0")->find();
                                if ($arUserinfo['password'] != $data['password'])
                                {
                                        echo json_encode(array("code" => 500, "msg" => "手机号或密码错误"));
                                        die;
                                }
                                if ($arUserinfo['status'] == 0)
                                {
                                        echo json_encode(array("code" => 500, "msg" => "该用户未激活"));
                                        die;
                                }
                                else
                                {
                                        //修改登陆信息
                                        $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                                        M("member")->where("id=" . $arMember['id'])->save($arUserLogin);

                                        //存进session信息
                                        $_SESSION['userinfo'] = array("userid" => $arMember['id'], "username" => $arMember['username']);
                                        setcookie("userinfo", serialize(array("userid" => $check_user['id'], "username" => $data['username'])), time() + 3600 * 24 * 30, "/");
                                        echo json_encode(array("code" => 200, "msg" => "登陆成功"));
                                        die;
                                }
                        }
                }
        }

        public function logout()
        {

                if (!empty($_SESSION['userinfo']['username']) && substr($_SESSION['userinfo']['username'], 0, 3) == "qq_")
                {
                        setcookie($_SESSION['userinfo']['username'], "", time() - 1, "/");
                }
                $_SESSION['userinfo'] = null;
                setcookie("userinfo", "", time() - 1, "/");
                header("location:?s=/Index/index");
                die();
        }

}
