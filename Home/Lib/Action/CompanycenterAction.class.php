<?php

class CompanycenterAction extends Action
{
        
        private $max_sms_number = 10;
        /*
         * 企业修改绑定手机号 验证手机
         * 
         */

        public function check_mobile()
        {
                
                if($_POST['hash'] != md5("rrl_".$_SESSION['cookie'])){
                        return;
                }
               
                $type   = $_POST['type'];
                $mobile = $_POST['mobile'];
                if (empty($mobile))
                {
                        $mobile = $_SESSION['mobile'];
                }

                if ($type == 1)
                {
                        //查看该手机号是否已注册
                        $comOb        = M("company");
                        $mobileArrAll = $comOb->query("select * from stj_company  m join stj_userinfo u where m.username=u.username and mobile='{$mobile}' and flag=1 ");
                        //echo $memberOb ->getLastSql();

                        if (!empty($mobileArrAll))
                        {

                                echo json_encode(array("code" => '500', "msg" => "该手机号已经注册"));
                                die;
                        }
                }

                //查看该手机号今天短信发送次数是否过于频繁
                $smslogOb = M("sms_log");
                $today    = strtotime(date("Y-m-d"));
                $sended   = $smslogOb->where("mobile='" . $mobile . "'  and status=2 and created_at>" . $today)->count();

                if ($sended >= $this->max_sms_number)
                {
                        echo json_encode(array("code" => '400', "msg" => "该号码发送验证码过于频繁，请稍后再发"));
                        die;
                }

                //发送验证码并存入session和日志表中
                $code      = getCode();
                $send_code = $code;

                if ($type == 1)
                {
                        $link_id = 0;
                        $tag     = "wapcompanychangetel";
                        $comment = "wap企业修改绑定手机";
                        $content = "您申请重置密码的验证码为" . $send_code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
                }

                if (!$_SESSION['leveltime'])
                {
                        $gets = smsChannel($mobile, $content, $link_id, $tag, $comment);
                        if ($gets['code'] == 200)
                        {
                                $_SESSION["m" . $mobile] = $send_code;
                                $_SESSION["mobile"]      = $mobile;
                                $_SESSION['leveltime']   = time();
                                echo json_encode(array("code" => 200, "msg" => "获取验证码成功"));
                        }
                        else
                        {
                                echo json_encode(array("code" => 500, "msg" => "系统繁忙"));
                        }
                }
                elseif ((time() - $_SESSION['leveltime']) < 60)
                {

                        echo json_encode(array("code" => 200, "msg" => $_SESSION["m" . $mobile]));
                        exit();
                }
                else
                {

                        $gets = smsChannel($mobile, $content, $link_id, $tag, $comment);
                        if ($gets['code'] == 200)
                        {
                                $_SESSION["m" . $mobile] = $send_code;
                                $_SESSION["mobile"]      = $mobile;
                                $_SESSION['leveltime']   = time();
                                echo json_encode(array("code" => 200, "msg" => "获取验证码成功"));
                        }
                        else
                        {
                                echo json_encode(array("code" => 500, "msg" => "系统繁忙"));
                        }
                }
        }

        
        /*
         * 验证输入的验证码和发送的验证码是否相同
         */

        public function checkVerify()
        {

                $type   = $_POST['type'];
                $verify = $_POST['verify'];
                $mobile = $_SESSION['mobile'];
                //var_dump($type);var_dump($verify);var_dump($mobile);
                if (empty($type) || empty($mobile) || empty($verify))
                {
                        echo json_encode(array("code" => 500, "msg" => "验证失败"));
                        exit();
                }
                //var_dump($_SESSION["m" . $mobile]);var_dump($mobile);
                if ($_SESSION["m" . $mobile] == $verify)
                {       $_SESSION['com_change_mobile'] = $mobile;
                        echo json_encode(array("code" => 200, "msg" => "验证成功"));
                        exit();
                }
                else
                {
                        echo json_encode(array("code" => 500, "msg" => "验证码不正确"));
                        exit();
                }
        }

        

}
