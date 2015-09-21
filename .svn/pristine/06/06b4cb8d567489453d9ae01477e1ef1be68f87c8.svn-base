<?php

class UsercenterAction extends Action
{
        /*
         * 推荐设置页面
         */

        function recommend_setting()
        {

                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo))
                {
                        setcookie("gourl", "?s=/Usercenter/recommend_setting", time() + 3600, "/");
                        header("location:?s=/Login/login");
                        die;
                }
                else
                {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid = $userinfo['userid'];
                }
                $memArr = M("member")->where("id=" . $uid)->find();
                //为引入的头部传入标题
                $this->assign("header_title", "推荐设置");
                $this->assign("memArr", $memArr);
                $this->display("./Job/recommended_settings");
        }

        /*
         * 推荐设置保存页面
         */

        function reco_set_save()
        {
                
        }

        /*
         * 被推荐人信息页面
         */

        function recommend_info()
        {


                //如果为登陆，跳转到login页面
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo))
                {
                        setcookie("gourl", "/index.php?s=/Usercenter/recommend_info/", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                }
                setcookie("gourl", "", time() - 1, "/");


                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "在线简历", "url" => "/index.php?s=/Job/add_resume", "img" => "/Public/new-images/head-icon/m-icon5.png"),
                    array("name" => "候选人列表", "url" => "/index.php?s=/Usercenter/recommend_info", "img" => "/Public/new-images/head-icon/m-icon6.png"),
                );
                //传入头部信息
                $this->assign("select", "resume");
                $this->assign("header_title", "候选人列表");
                $this->assign("lArr", $lArr);

                $this->display("./Job/recommended");
        }

        /*
         * 获取被推荐人列表
         * 
         * 参数  post
         *      jobid  职位id
         *      page   页码
         *      number  显示条数
         * 
         * 返回值 json 格式
         *      
         *        count   总条数
         *        result  被推荐人列表
         *    
         */

        public function get_recommeded_list()
        {

                $page  = $_POST['page'];
                $size  = $_POST['number'];
                $start = ($page - 1) * $size;

                $userinfo = $_SESSION['userinfo'];
                $uid      = $userinfo['userid'];
                $username = $userinfo['username'];

                $resumeOb = new ResumeModel();
                $num      = $resumeOb->resume_count($uid); //得到列表总条数

                $limit  = "$start,$size";
                $result = $resumeOb->recommend_list($uid, $limit);
                //var_dump($result);
                if (empty($result))
                {

                        $result = array();
                }
                $data = array(
                    'count'  => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         * 删除被推荐人信息 页面
         */

        function del_recommended()
        {

                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo))
                {
                        echo json_encode(array("code" => "400", "msg" => "未登录"));
                        die;
                }
                $r_id = $_POST['r_id'];
                if (empty($r_id))
                {
                        echo json_encode(array("code" => "500", "msg" => "参数异常"));
                        die;
                }
                $mOb = M("resume");
                $re  = $mOb->where("id=$r_id and isshow = 1")->save(array("isshow" => "0"));
                if ($re === false)
                {
                        echo json_encode(array("code" => "500", "msg" => "删除失败"));
                        die;
                }
                else
                {
                        echo json_encode(array("code" => "200", "msg" => "删除成功"));
                        die;
                }
        }

        /*
         * 修改被推荐人信息 页面
         */

        function upd_recommend()
        {
                
        }

        /*
         * 基本信息
         */

        function myinfo()
        {

                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo))
                {
                        setcookie("gourl", "?s=/Usercenter/myinfo", time() + 3600, "/");
                        header("location:?s=/Login/login");
                        die;
                }
                else
                {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid = $userinfo['userid'];
                }

                $memArr = M("member")->where("id=" . $uid)->find();
                if ($memArr['sex'] == "0")
                {
                        $memArr['sex_r'] = "男";
                }
                else
                {
                        $memArr['sex_r'] = "女";
                }

                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "安全设置", "url" => "/index.php?s=/Usercenter/modify_password", "img" => "/Public/new-images/head-icon/m-icon2.png"),
                    array("name" => "基本信息", "url" => "/index.php?s=/Usercenter/myinfo", "img" => "/Public/new-images/head-icon/m-icon3.png"),
                    array("name" => "收款账号", "url" => "/index.php?s=/Job/my_account_info", "img" => "/Public/new-images/head-icon/m-icon4.png"),
                );

                $this->assign("select", "info");
                $this->assign("header_title", "我的资料");
                $this->assign("lArr", $lArr);

                $this->assign("mArr", $memArr);
                $this->display("./Job/myinformation");
        }

        /*
         * 基本信息保存
         */

        function myinfo_save()
        {

                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo))
                {
                        setcookie("gourl", "/index.php?s=/Job/my_account_info", time() + 3600, "/");
                        echo json_encode(array("code" => "400", "msg" => "未登录"));
                        die;
                }
                else
                {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid = $userinfo['userid'];
                }

                $data['cnname'] = I('post.cnname', '', 'htmlspecialchars');
                $data['sex']    = I('post.sex', '', 'htmlspecialchars');
                $data['age']    = I('post.age', '', 'htmlspecialchars');
                $data['weixin'] = I('post.wx', '', 'htmlspecialchars');
                $data['qqnum'] = I('post.qqnum', '', 'htmlspecialchars');
                $data['id']     = $uid;

                if (empty($data['cnname']) || $data['sex'] == "" || $data['age'] == ""  || empty($data['id']))
                {
                        echo json_encode(array("code" => "500", "msg" => "参数异常"));
                        die;
                }
                //var_dump($data);
                $mOb = M("member");
                $re  = $mOb->save($data);
                if ($re !== false)
                {
                        echo json_encode(array("code" => "200", "msg" => "保存成功"));
                        die;
                }
                else
                {
                        echo json_encode(array("code" => "500", "msg" => "保存失败"));
                        die;
                }
        }

        function encash()
        {
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo))
                {
                        setcookie("gourl", "?s=/Usercenter/encash", time() + 3600, "/");
                        header("location:?s=/Login/login");
                        die;
                }
                else
                {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid      = $userinfo['userid'];
                        $username = $userinfo['username'];
                }
                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "资金明细", "url" => "/index.php?s=/Job/my_account", "img" => "/Public/new-images/head-icon/m-icon11.png"),
                    array("name" => "申请提现", "url" => "/index.php?s=/Usercenter/encash", "img" => "/Public/new-images/head-icon/m-icon12.png"),
                );

                $this->assign("select", "account");
                $this->assign("header_title", "我的账户");
                $this->assign("lArr", $lArr);

                $arAccount = M("account")->where("username='{$username}'")->find();
                if (!empty($arAccount))
                {
                        $account = $arAccount['account'];
                }
                else
                {
                        $account = 0;
                }
                $this->assign("accountMoney", $account);

                $this->display("Account/withdrawals");
        }

        function add_encash_log()
        {

                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo))
                {
                        setcookie("gourl", "?s=/Usercenter/encash", time() + 3600, "/");
                        echo json_encode(array("code" => "400", "msg" => "未登录"));
                        die;
                }
                else
                {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid      = $userinfo['userid'];
                        $username = $userinfo['username'];
                }
                if (empty($_POST['encashMoney']) || !is_numeric($_POST['encashMoney']))
                {
                        echo json_encode(array("code" => "500", "msg" => "参数异常"));
                        exit();
                }

                //查询提现记录总金额
                $sql                 = "select sum(account) as total from stj_enchashment where status =1  and username='$username'";
                $arEnchashment       = M("enchashment")->query($sql);
                $iEnchashmentAccount = intval($arEnchashment[0]['total']);

                //查看当前账户总金额
                $arAccount = M("account")->where("username='{$username}'")->find();
                if ($iEnchashmentAccount + $_POST['encashMoney'] > intval($arAccount['account']))
                {
                        echo json_encode(array("code" => "500", "msg" => "当前账户不足，或已有提款记录未处理！"));
                        exit();
                }
                else
                {
                        M("enchashment")->query("insert into stj_enchashment(uid,username,last_account,account,created_at,updated_at) values({$arAccount['uid']},'{$username}',{$arAccount['account']},{$_POST['encashMoney']}," . time() . "," . time() . ")");
                        $sAccountBalanceSql = "insert into stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at) value"
                                . "({$arAccount['uid']},'{$username}',{$arAccount['account']},{$arAccount['account']}-{$_POST['encashMoney']},'-{$_POST['encashMoney']}','','enchashmentask','提现申请中'," . time() . "," . time() . ")";
                        M("account_blance")->query($sAccountBalanceSql);
                        echo json_encode(array("code" => "200", "msg" => "申请提现成功"));
                        exit();
                }
        }

        /*
         *  修改密码展示页面      
         */

        Public function modify_password()
        {
                
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo))
                {
                        setcookie("gourl", "?s=/Usercenter/modify_password", time() + 3600, "/");
                        header("location:?s=/Login/login");
                        die;
                }
                else
                {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid      = $userinfo['userid'];
                        $username = $userinfo['username'];
                }


                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "安全设置", "url" => "/index.php?s=/Usercenter/modify_password", "img" => "/Public/new-images/head-icon/m-icon2.png"),
                    array("name" => "基本信息", "url" => "/index.php?s=/Usercenter/myinfo", "img" => "/Public/new-images/head-icon/m-icon3.png"),
                    array("name" => "收款账号", "url" => "/index.php?s=/Job/my_account_info", "img" => "/Public/new-images/head-icon/m-icon4.png"),
                );
                $this->assign("select", "info");
                $this->assign("header_title", "安全设置");
                $this->assign("lArr", $lArr);

                $this->assign("mArr", $memArr);
                $this->display("./Login/modify_password");
        }

        /*
         *  修改密码保存页面  
         *      params    post
         *          old_pwd  旧密码
         *          new_pwd  新密码
         *          re_pwd   重复新密码
         *      return  json
         *          code     返回值  200成功 500失败
         *          msg      提示信息
         *              
         */

        public function modify_password_save()
        {

                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo))
                {
                        setcookie("gourl", "?s=/Usercenter/modify_password", time() + 3600, "/");
                        echo json_encode(array("code" => "400", "msg" => "未登录"));
                        die;
                }
                else
                {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid      = $userinfo['userid'];
                        $username = $userinfo['username'];
                }
               

                $params['old_pwd'] = I("post.old_pwd", '', 'htmlspecialchars');
                $params['new_pwd'] = I("post.new_pwd", '', 'htmlspecialchars');
                $params['re_pwd']  = I("post.re_pwd", '', 'htmlspecialchars');
                
                if (empty($params['old_pwd']) || empty($params['new_pwd']) || empty($params['re_pwd']) || $params['new_pwd'] != $params['re_pwd'])
                {
                        echo json_encode(array("code" => "500", "msg" => "参数异常"));
                        die;
                }
                $arUserinfo = M("userinfo")->where("username='" . $username . "' and password='" . md5(md5($params['old_pwd'])) . "' and flag=0 and is_deleted=0")->find();
                if (empty($arUserinfo))
                {
                        echo json_encode(array("code" => "500", "msg" => "密码不正确"));
                        die;
                }
                M("userinfo")->startTrans();
                $re1 = M("userinfo")->where("userid='" . $arUserinfo['userid']."'")->save(array("password" => md5(md5($params['new_pwd']))));
                //echo M("userinfo")->getLastSql();
                $re2 = M("member")->where("username='" . $username . "' and password='" . md5(md5($params['old_pwd'])) . "'")->save(array("password" => md5(md5($params['new_pwd'])), "pwd" => $params['new_pwd']));
                //echo M("member")->getLastSql();
                if ($re1 === 0 || $re2 === 0) {
                        M("userinfo")->rollback();
                        echo json_encode(array("code" => "500", "msg" => "修改失败"));
                        die;
                }
                else {
                        M("userinfo")->commit();
                        echo json_encode(array("code" => "200", "msg" => "修改成功"));
                        $_SESSION['userinfo'] = null;
                        setcookie("userinfo", "", time() - 1, "/");
                        die;
                }
        }

}
