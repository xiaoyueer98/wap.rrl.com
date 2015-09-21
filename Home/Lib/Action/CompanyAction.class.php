<?php

class CompanyAction extends Action {

        public function __construct() {
                parent::__construct();

                if (empty($_SESSION['cuserinfo'])) {
                        header("location:/");
                        die;
                } else {

                        $this->uid = $_SESSION['cuserinfo']['userid'];
                        $this->username = $_SESSION['cuserinfo']['username'];
                        if (!$this->result) {
                                $result = M("company")->where("id='" . $this->uid . "'")->find();
                                $arNature = M("cascadedata")->where("datagroup = 'nature' and datavalue=" . $result['nature'])->find();
                                $result['naturedata'] = $arNature['dataname'];
                                $arScale = M("cascadedata")->where("datagroup = 'scale' and datavalue=" . $result['scale'])->find();
                                $result['scaledata'] = $arScale['dataname'];
                                $arStage = M("cascadedata")->where("datagroup = 'stage' and datavalue=" . $result['stage'])->find();
                                $result['stagedata'] = $arStage['dataname'];
                                $result['brightregdata'] = ($result['brightreg'] ? date("Y-m-d", $result['brightreg']) : "");
                                $this->result = $result;
                        }
                }
        }

        /*
         * 企业完善资料页面
         */

        public function complete_info() {
                $result = $this->result;
                $result_old = $this->result;

                //为页面中下拉列表传值
                $objCascade = M("cascadedata");

                $arNatureList = $objCascade->where("datagroup = 'nature'")->order("orderid asc")->select();
                $arScaleList = $objCascade->where("datagroup = 'scale'")->order("orderid asc")->select();
                $arStageList = $objCascade->where("datagroup = 'stage'")->order("orderid asc")->select();

                $this->assign("arNatureList", $arNatureList);
                $this->assign("arScaleList", $arScaleList);
                $this->assign("arStageList", $arStageList);
                //如果有text传值过来
                if (!empty($_POST)) {
                        foreach ($_POST as $k => $v) {
                                $_POST[$k] = I("post." . $k, '', 'htmlspecialchars');
                        }

                        $result = $_POST;
                        $arNature = M("cascadedata")->where("datagroup = 'nature' and datavalue=" . $result['nature'])->find();
                        $result['naturedata'] = $arNature['dataname'];
                        $arScale = M("cascadedata")->where("datagroup = 'scale' and datavalue=" . $result['scale'])->find();
                        $result['scaledata'] = $arScale['dataname'];
                        $arStage = M("cascadedata")->where("datagroup = 'stage' and datavalue=" . $result['stage'])->find();
                        $result['stagedata'] = $arStage['dataname'];
                }
                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "基本信息", "url" => "/index.php?s=/Company/complete_info", "img" => "/Public/new-images/head-icon/m-icon7.png"),
                    array("name" => "安全设置", "url" => "/index.php?s=/Company/security_settings", "img" => "/Public/new-images/head-icon/m-icon8.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "完善资料");
                $this->assign("result", $result);
                $this->assign("result_old", $result_old);
                $this->assign("select", "info");
                $this->display("complete_info");
        }

        /*
         * 企业完善信息保存
         */

        public function complete_info_save() {

                foreach ($_POST as $k => $v) {
                        $_POST[$k] = I("post." . $k, '', 'htmlspecialchars');
                }

                if (empty($_POST['cpname']) || empty($_POST['mobile']) || empty($_POST['nature']) || empty($_POST['scale']) || empty($_POST['stage']) || empty($_POST['brightregdata']) || empty($_POST['webname']) || empty($_POST['intro']) || empty($_POST['bright']) || empty($_POST['address']) || empty($_POST['cnname']) || empty($_POST['telephone']) || empty($_POST['email']) || empty($_POST['id'])) {
                        echo json_encode(array("code" => "500", "msg" => "请完信息"));
                        die;
                }

                $rule = "/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/";
                preg_match($rule, $_POST['email'], $result);
                if (!$result) {
                        echo json_encode(array("code" => "500", "msg" => "请输入正确的邮箱"));
                        die;
                }


                $rule1 = "/^1[0-9]{10}$/A";
                preg_match($rule1, $_POST['mobile'], $result1);
                if (!$result1) {
                        echo json_encode(array("code" => "500", "msg" => "请输入正确的手机号码"));
                        die;
                }

                $data['id'] = $_POST['id'];
                $data['cpname'] = $_POST['cpname'];
                $data['mobile'] = $_POST['mobile'];
                $data['nature'] = $_POST['nature'];
                $data['scale'] = $_POST['scale'];
                $data['stage'] = $_POST['stage'];
                $data['email'] = $_POST['email'];
                $data['webname'] = $_POST['webname'];
                $data['intro'] = $_POST['intro'];
                $data['bright'] = $_POST['bright'];
                $data['address'] = $_POST['address'];
                $data['cnname'] = $_POST['cnname'];
                $data['telephone'] = $_POST['telephone'];
                $data['email'] = $_POST['email'];
                $data['brightreg'] = strtotime($_POST['brightregdata']);

                $companyOb = M("company");
                $companyOb->save($data);

                echo json_encode(array("code" => "200", "msg" => "完善信息成功"));
                die;
        }

        /*
         * 点击输入长内容时 跳转到的页面（完善资料）
         */

        public function text() {
                foreach ($_POST as $k => $v) {
                        $_POST[$k] = I("post." . $k, '', 'htmlspecialchars');
                }
//                echo "<pre>";
//                var_dump($_POST);
//                echo "</pre>";
                //传入头部信息
                $this->assign("header_title", $_POST['desc']);
                $this->assign("data", $_POST);
                $this->display("text");
        }

        /*
         * 点击输入长内容时 跳转到的页面(发布职位)
         */

        public function send_job_text() {
                foreach ($_POST as $k => $v) {
                        $_POST[$k] = I("post." . $k, '', 'htmlspecialchars');
                }
//                echo "<pre>";
//                var_dump($_POST);
//                echo "</pre>";
                //传入头部信息
                $this->assign("header_title", $_POST['desc']);
                $this->assign("data", $_POST);
                $this->display("send_job_text");
        }

        /*
         * 完善资料验证手机号码页面
         */

        public function check_mobile() {
                foreach ($_POST as $k => $v) {
                        $_POST[$k] = I("post." . $k, '', 'htmlspecialchars');
                }

//                echo "<br/><br/></br/><br/><br/><pre>";
//                var_dump($_POST);
//                echo "</pre>";
                //传入头部信息
                $this->assign("header_title", "验证手机号");
                $this->assign("data", $_POST);
                $this->display("check_mobile");
        }

        /*
         * 企业合同状态页面
         */

        public function agreement_status() {
                $result = $this->result;
                if (empty($result['contract'])) {
                        $status = "未上传合同。";
                } elseif (empty($result['checkcontract'])) {
                        $status = "正在审核中......";
                } elseif ($result['checkcontract']) {
                        $status = "审核已通过。";
                }

                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "签订合同", "url" => "/index.php?s=/Company/agreement_status", "img" => "/Public/new-images/head-icon/m-icon7.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "签订合同");
                $this->assign("status", $status);
                $this->assign("select", "agreement");
                $this->display("agreement");
        }

        /*
         * 企业发布职位页面
         */

        public function send_job() {
                //细分行业
                $xfhy = array("A" => "互联网金融", "B" => "在线旅游", "C" => "教育", "D" => "健康医疗", "E" => "电子商务", "F" => "搜索", "G" => "传媒广告",
                    "H" => "移动互联网", "I" => "O2O", "J" => "社交", "K" => "游戏", "L" => "云计算/大数据", "M" => "招聘", "N" => "智能家居",
                    "O" => "智能电视", "P" => "企业服务", "Q" => "文化美术", "R" => "生活服务", "S" => "社会化营销", "T" => "运动体育", "U" => "安全",
                    "V" => "硬件", "W" => "分类信息", "X" => "非TMT(非互联网)");

                //行业类别
                $sql = "SELECT * FROM `stj_casclist` WHERE parentid = 2  order by orderid ASC";
                $arStrycate = M("casclist")->query($sql);
                foreach ($arStrycate as &$cate) {
                        $sql = "SELECT * FROM `stj_casclist` WHERE parentid = " . $cate['id'] . " order by orderid ASC";
                        $cate['casclist'] = M("casclist")->query($sql);
                }

                //职位类别
                $sql = "SELECT * FROM `stj_casclist` WHERE parentid =1  order by orderid ASC";
                $arJobcate = M("casclist")->query($sql);
                foreach ($arJobcate as &$jcate) {
                        $sql = "SELECT * FROM `stj_casclist` WHERE parentid = " . $jcate['id'] . " order by orderid ASC";
                        $jcate['casclist'] = M("casclist")->query($sql);
                }
//                echo "<br/><br/><br/><pre>";var_dump($arJobcate);echo "</pre>";
                //地区
                $sql = "SELECT * FROM `stj_casclist` WHERE parentid = 20 order by orderid ASC";
                $arArea = M("casclist")->query($sql);

                //语言能力
                $sql = "select DISTINCT dataname,datavalue from stj_cascadedata where datagroup='joblang' and dataname !=''  group by dataname order by orderid";
                $langData = M("cascadedata")->query($sql);

                //职位相关
                $objCascade = M("cascade");
                $arConfigBaseInfo = $objCascade->where("groupsign IN ('treatment',  'experience', 'education')")->select();

                if ($arConfigBaseInfo) {
                        $objCascadedata = M("cascadedata");
                        foreach ($arConfigBaseInfo as &$arrBaseInfo) {
                                $arConfigInfo = $objCascadedata->where("`datagroup` = " . "'" . $arrBaseInfo['groupsign'] . "'")->order("orderid asc")->select();
                                if ($arConfigInfo) {
                                        $arrBaseInfo['config_list'] = $arConfigInfo;
                                }
                        }
                }
                //月薪要求
                $arTreatment = $objCascadedata->where("`datagroup` = " . "'treatment'")->order("orderid asc")->select();
                //工作经验
                $arExperience = $objCascadedata->where("`datagroup` = " . "'experience'")->order("orderid asc")->select();
                //学历要求
                $arEducation = $objCascadedata->where("`datagroup` = " . "'education'")->order("orderid asc")->select();
               
                $default_mobile = (($this->result['mobile'] ? $this->result['mobile'] : $this->result['telephone']) ? ($this->result['mobile'] ? $this->result['mobile'] : $this->result['telephone']) : '');
                
                $this->assign("default_mobile", $default_mobile);
                $this->assign("xfhy", $xfhy);
                $this->assign("arTreatment", $arTreatment);
                $this->assign("arExperience", $arExperience);
                $this->assign("arEducation", $arEducation);
                $this->assign("langData", $langData);
                $this->assign("arJobcate", $arJobcate);
                $this->assign("arStrycate", $arStrycate);
                $this->assign("arArea", $arArea);

                //如果有text传值过来
                if (!empty($_POST)) {
                        foreach ($_POST as $k => $v) {
                                $_POST[$k] = I("post." . $k, '', 'htmlspecialchars');
                        }

                        $result = $_POST;
                        $_POST = array();
                }
                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "发布职位", "url" => "/index.php?s=/Company/send_job", "img" => "/Public/new-images/com-head-icon/send_job.png"),
                    array("name" => "正在招聘", "url" => "/index.php?s=/Companyabout/recording", "img" => "/Public/new-images/com-head-icon/recording.png"),
                    array("name" => "往期招聘", "url" => "/index.php?s=/Companyabout/recorded", "img" => "/Public/new-images/com-head-icon/recorded.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "发布职位");
                $this->assign("result", $result);
                $this->assign("select", "send_job");
                $this->display("send_job");
        }

        /*
         * 发布职位保存页面
         */

        public function send_job_save() {
//                echo "<br/><br/><br/><pre>";var_dump($_POST);echo "</pre>";
                if ($_POST['treatment'] == 8000 && $_POST['Tariff'] * 100 < 2000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位12000-15000元，招聘费不能低于2000"));
                        exit();
                } elseif ($_POST['treatment'] == 12000 && $_POST['Tariff'] * 100 < 3000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位12000-15000元，招聘费不能低于3000"));
                        exit();
                } elseif ($_POST['treatment'] == 15000 && $_POST['Tariff'] * 100 < 5000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位15000-20000元，招聘费不能低于5000"));
                        exit();
                } elseif ($_POST['treatment'] == 20000 && $_POST['Tariff'] * 100 < 10000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位20000-40000元，招聘费不能低于10000"));
                        exit();
                } elseif ($_POST['treatment'] == 40000 && $_POST['Tariff'] * 100 < 20000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位40000-60000元，招聘费不能低于20000"));
                        exit();
                } elseif ($_POST['treatment'] == 60000 && $_POST['Tariff'] * 100 < 30000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位60000-80000元，招聘费不能低于30000"));
                        exit();
                } elseif ($_POST['treatment'] == 80000 && $_POST['Tariff'] * 100 < 50000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位80000元以上，招聘费不能低于50000"));
                        exit();
                }

                $company = $this->result;
                $data['match_company'] = $_POST['match_company'];
                $data['match_industry'] = $_POST['match_industry'];

                $data['title'] = $_POST['title'];
                $data['Jobcate'] = $_POST['category'];
                $data['strycate'] = $_POST['industry'];
                $data['jobplace'] = $_POST['place'];
                $data['employ'] = $_POST['employ'];
                
                $data['report'] = $_POST['report_obj'];
                $data['report_number'] = $_POST['report_number'];

                $data['cpid'] = $company['id'];
                $data['treatment'] = $_POST['treatment'];
                $data['experience'] = $_POST['experience'];
                $data['education'] = $_POST['education'];
                $data['joblang'] = $_POST['joblang'];
                $data['orderid'] = 0;

                $data['starttime'] = time();
                $data['endtime'] = strtotime($_POST['endtime']);

                $data['Tariff'] = $_POST['Tariff'] * 100;
                $data['checkinfo'] = "false";
                $data['workdesc'] = $_POST['workdesc'];
                $data['content'] = $_POST['content'];

                $data['posttime'] = time();
                $data['guid'] = $this->create_guid();
                $data['cpname'] = $company['cpname'];
                $data['meth'] = $_POST['meth'];

                if ($data['meth'] == 2) {
                        $data['email'] = $_POST['jobperson'];
                        $data['mobile'] = $_POST['jobmobile'];
                } else {
                        $data['email'] = ($company['cnname'] ? $company['cnname'] : "");
                        $data['mobile'] = (($company['mobile'] ? $company['mobile'] : $company['telephone']) ? ($company['mobile'] ? $company['mobile'] : $company['telephone']) : '');
                }


                $res = M("job")->add($data);


                if ($res) {
                        /*                         * *****************************【推荐人】【发布职位】操作日志 begin****************************** */

                        $j_id = M("job")->getLastInsID(); //职位id
                        $arNoticeInfo = getCNoticeInfo(0, $_POST['title']);
                        $sLogtitle = $arNoticeInfo[0];
                        $sLogContent = $arNoticeInfo[1];
                        $username = $this->username;
                        $arCompany = M("company")->where("username='" . $username . "'")->find();

                        $arNotice = array(
                            "uid" => $this->uid,
                            "username" => $username,
                            "bt_id" => 0,
                            "j_id" => $j_id,
                            "title" => $sLogtitle,
                            "content" => $sLogContent,
                            "type" => 2,
                            "category" => 1,
                            "created_at" => time(),
                            "updated_at" => time()
                        );
                        M("notice_log")->add($arNotice);

                        /*                         * *****************************【推荐人】【发布职位】操作日志 begin****************************** */
                        $_POST = array();

                        //查看发布的职位有多少个匹配的获选人
                        $fitCount = M("resume")->where("'" . $data['title'] . "' like CONCAT('%',keyword,'%') and keyword !=''")->count();

                        if ($fitCount) {
                                $fitCount = $fitCount * 3;
                        } else {
                                $fitCount = mt_rand(3, 6);
                        }
                        
                        echo json_encode(array("code" => 200, "msg" => $fitCount));
                } else {
                        echo json_encode(array("code" => 500, "msg" => "创建失败"));
                }
        }

        /*
         * 修改面试状态时 跳转到的页面
         */

        public function audstart_text() {

                foreach ($_GET as $k => $v) {
                        $_GET[$k] = I("get." . $k, '', 'htmlspecialchars');
                }
                if ($_GET['audstartid'] == 2) {
                        $_GET['desc'] = "不面试";
                } elseif ($_GET['audstartid'] == 4) {
                        $_GET['desc'] = "面试不通过";
                } elseif ($_GET['audstartid'] == 7) {
                        $_GET['desc'] = "已离职";
                } elseif ($_GET['audstartid'] == 8) {
                        $_GET['desc'] = "审核不通过";
                }
                //传入头部信息
                $this->assign("header_title", $_GET['desc']);
                $this->assign("data", $_GET);
                $this->display("audstart_text");
        }

        /*
         * 发送短信
         */

        public function sendMessage() {
                if($_POST['hash'] != md5("rrl_".$_SESSION['cookie'])){
                        return;
                }
               
                $telephone = $_POST['mobile'];
                $content = $_POST['msgcontent'];
                $res = smsChannel($telephone, $content, 0, "companyCallResume", "面试短信");
                // $res = $this->sendMsg($telephone, $content);
                if ($res == true) {
                        echo json_encode(array("code" => "200", "msg" => "发送成功!"));
                        exit();
                } else {
                        echo json_encode(array("code" => "500", "msg" => "短信系统繁忙,请您稍后重试!"));
                        exit();
                }
                exit();
                $res = smsChannel($telephone, $content, 0, "InterviewInvitation", "企业发送面试邀请短信");

                if ($res['code'] == "200") {
                        echo json_encode(array("code" => "200", "msg" => "发送成功!"));
                        exit();
                } else {
                        echo json_encode(array("code" => "500", "msg" => "系统繁忙,请您稍后重试!"));
                        exit();
                }
        }

        /*
         * 修改面试状态时 跳转到的页面
         */

        public function updateAudstartStatus() {

                $reasonid = $_POST['recordid'];
                $data['audstart'] = $_POST['audstartid'];
                if(!empty($_POST['reason'])){
                        $data['audreason'] = $_POST['reason'];
                }
                if(!empty($_POST['candidate_time'])){
                        $data['real_audstart_time'] = $_POST['candidate_time'];
                
                }
                $data['audstarttime'] = time();
                $type = $_POST['type'];
                $id = $_POST['id'];

                $status = M("record")->where("id='$reasonid'")->save($data);

                $status = $data['audstart'];
                $statusValue = getCascData("audstart", $status, "信息不明");

                //推荐info
                $recordinfo = M("record")->where("id='$reasonid'")->find();

                /*                 * *********************【推荐人/企业】【修改面试状态】操作日志  begin*********************************** */

                $resumeInfo = M("resume")->where("id=" . $recordinfo['bt_id'])->find();
                $arJobInfo = M("job")->where("id=" . $recordinfo['j_id'])->find();
                $arCompanyInfo = M("company")->where("id=" . $arJobInfo['cpid'])->find();
                if (!$arJobInfo['title']) {
                        $arJobInfo['title'] = M("casclist")->where("id='$arJobInfo[Jobcate]'")->getField("cascname");
                }
                if ($data['audreason']) {
                        $arTNoticeInfo = getTNoticeInfo(9, $resumeInfo['username'], $arCompanyInfo['cpname'], $arJobInfo['title'], "", $statusValue, $data['audreason']);
                        $arCNoticeInfo = getCNoticeInfo(9, $arJobInfo['title'], $resumeInfo['username'], $statusValue, $data['audreason']);
                } else {
                        $arTNoticeInfo = getTNoticeInfo(7, $resumeInfo['username'], $arCompanyInfo['cpname'], $arJobInfo['title'], "", $statusValue);
                        $arCNoticeInfo = getCNoticeInfo(7, $arJobInfo['title'], $resumeInfo['username'], $statusValue);
                }
                $sLogtitle = $arTNoticeInfo[0];
                $sLogContent = $arTNoticeInfo[1];
                $arNotice = array(
                    "uid" => $arCompanyInfo['id'],
                    "username" => $arCompanyInfo['username'],
                    "bt_id" => $recordinfo['bt_id'],
                    "j_id" => $recordinfo['j_id'],
                    "title" => $sLogtitle,
                    "content" => $sLogContent,
                    "created_at" => time(),
                    "updated_at" => time()
                );
                M("notice_log")->add($arNotice);

                $sLogtitle = $arCNoticeInfo[0];
                $sLogContent = $arCNoticeInfo[1];
                $arNotice = array(
                    "uid" => $arCompanyInfo['id'],
                    "username" => $arCompanyInfo['username'],
                    "bt_id" => $recordinfo['bt_id'],
                    "j_id" => $recordinfo['j_id'],
                    "title" => $sLogtitle,
                    "content" => $sLogContent,
                    "type" => 2,
                    "created_at" => time(),
                    "updated_at" => time()
                );
                M("notice_log")->add($arNotice);

                /*                 * *********************【推荐人/企业】【修改面试状态】操作日志  end*********************************** */

                //////////////////////////分享职位送大礼/////////////////////////////////
                if (C("SHARE_JON_OPEN") === true) {

                        //   $id = $_POST['rid'] = 499;
                        //如果是活动1并且是已入职状态则查看是否已经为推荐人的来源用户赠送过
                        $activiteID = C("SHARE_JOB_ID");
                        if ($status == 6 && $activiteID == 2) {
                                $activeInfo = M("active")->where("id='$activiteID' and status=1 and endtime>'" . date("Y-m-d H:i:s") . "'")->find();
                                if ($activeInfo) {

                                        $memberId = $recordinfo['t_id'];
                                        $userInfo = M("member")->where("id=" . $memberId . " AND fromwhere='share'")->find();
                                        if ($userInfo) {

                                                //如果存在还没有赠送过并且有来源的username，则赠送给分享人金额
                                                $userinfo = M("userinfo")->where("username='" . $userInfo[username] . "' and fromusername !=''")->find();

                                                if ($userinfo) {
                                                        $Recorduserinfo = M("userinfo")->where("username='" . $userinfo[fromusername] . "'")->find();
                                                        $accArr = M("account")->where("uid='$Recorduserinfo[userid]'")->find();
                                                        //查找推荐人之前的账户信息
                                                        $time = time();
                                                        if (empty($accArr)) {
                                                                //插入一条信息账户信息到account表中
                                                                $sql = "insert into   stj_account(uid,username,account,created_at,updated_at)  values($Recorduserinfo[userid],'$Recorduserinfo[username]'," . C('SHARE_JOB_RECORD_SUCCESS') . ",'$time','$time')";
                                                                M("account")->query($sql);
                                                                $newAccount = C('SHARE_JOB_RECORD_SUCCESS');
                                                                $account = 0;
                                                        } else {

                                                                //插入一条日志记录到account_balance中
                                                                $newAccount = $accArr['account'] + C('SHARE_JOB_RECORD_SUCCESS');
                                                                //更新账户表中的金额和更新时间
                                                                $sql = "update  stj_account  set account='{$newAccount}',updated_at='{$time}'  where id ={$accArr['id']}";
                                                                M("account")->query($sql);
                                                                $account = $accArr['account'];
                                                        }
                                                        $sql = "insert into  stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at)  values({$Recorduserinfo[userid]},'{$Recorduserinfo[username]}',{$account},$newAccount," . C('SHARE_JOB_RECORD_SUCCESS') . ",'','shareMoney','分享职位成功入职。','{$time}','{$time}')";
                                                        M("account_blance")->query($sql);
                                                        //首次推荐修改状态
                                                        $sql = "update  stj_share  set num=`num`+1  where decrypturl ='$userinfo[fromwhere]'";
                                                        M("share")->query($sql);
                                                }
                                        }
                                }
                        }

                        //如果是活动1并且是已入职状态并且此人是通过分享而来则赠送分享人奖励
                        $activiteID = C("SHARE_JOB_ID");
                        if ($status == 6 && $activiteID == 2) {
                                $activeInfo = M("active")->where("id='$activiteID' and status=1 and endtime>'" . date("Y-m-d H:i:s") . "'")->find();
                                if ($activeInfo) {

                                        $jobInfo = M("job")->where("id='$recordinfo[j_id]'")->find();
                                        $memberId = $jobInfo['cpid'];
                                        $userInfo = M("company")->where("id=" . $memberId . " AND fromwhere='share'")->find();
                                        if ($userInfo) {

                                                //如果存在还没有赠送过并且有来源的username，则赠送给分享人金额
                                                $userinfo = M("userinfo")->where("username='" . $userInfo[username] . "' and fromusername !=''")->find();

                                                if ($userinfo) {
                                                        $Recorduserinfo = M("userinfo")->where("username='" . $userinfo[fromusername] . "'")->find();
                                                        $accArr = M("account")->where("uid='$Recorduserinfo[userid]'")->find();
                                                        //查找推荐人之前的账户信息
                                                        $time = time();
                                                        if (empty($accArr)) {
                                                                //插入一条信息账户信息到account表中
                                                                $sql = "insert into   stj_account(uid,username,account,created_at,updated_at)  values($Recorduserinfo[userid],'$Recorduserinfo[username]'," . C('SHARE_JOB_COMPANY_SUCCESS') . ",'$time','$time')";
                                                                M("account")->query($sql);
                                                                $newAccount = C('SHARE_JOB_COMPANY_SUCCESS');
                                                                $account = 0;
                                                        } else {

                                                                //插入一条日志记录到account_balance中
                                                                $newAccount = $accArr['account'] + C('SHARE_JOB_COMPANY_SUCCESS');
                                                                //更新账户表中的金额和更新时间
                                                                $sql = "update  stj_account  set account='{$newAccount}',updated_at='{$time}'  where id ={$accArr['id']}";
                                                                M("account")->query($sql);
                                                                $account = $accArr['account'];
                                                        }
                                                        $sql = "insert into  stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at)  values({$Recorduserinfo[userid]},'{$Recorduserinfo[username]}',{$account},$newAccount," . C('SHARE_JOB_COMPANY_SUCCESS') . ",'','shareMoney','分享职位企业成功入职。','{$time}','{$time}')";
                                                        M("account_blance")->query($sql);
                                                        //首次推荐修改状态
                                                        $sql = "update  stj_share  set num=`num`+1  where decrypturl ='$userinfo[fromwhere]'";
                                                        M("share")->query($sql);
                                                }
                                        }
                                }
                        }
                }


                ////////////////////////////////推广奖利送大礼////////////////////////////////////////////////////////
                if (C("SHARE_RECOMMENDSHARE_OPEN") === true && $status == 6) {
                        $activiteID = C("SHARE_RECOMMENDSHARE_ID");
                        if ($status == 6 && $activiteID == 4) {
                                $activeInfo = M("active")->where("id='$activiteID' and status=1 and endtime>'" . date("Y-m-d H:i:s") . "'")->find();
                                if ($activeInfo) {

                                        $memberId = $recordinfo['t_id'];
                                        $userInfo = M("member")->where("id=" . $memberId . " AND fromwhere='recommentshare'")->find();

                                        if ($userInfo) {

                                                //如果存在还没有赠送过并且有来源的username，则赠送给分享人金额
                                                $userinfo = M("userinfo")->where("username='" . $userInfo[username] . "' and fromusername !=''")->find();

                                                if ($userinfo) {
                                                        $Recorduserinfo = M("userinfo")->where("username='" . $userinfo[fromusername] . "'")->find();
                                                        $accArr = M("account")->where("uid='$Recorduserinfo[userid]'")->find();
                                                        //查找推荐人之前的账户信息
                                                        $time = time();
                                                        if (empty($accArr)) {
                                                                //插入一条信息账户信息到account表中
                                                                $sql = "insert into   stj_account(uid,username,account,created_at,updated_at)  values($Recorduserinfo[userid],'$Recorduserinfo[username]'," . C('SHARE_RECOMMENDSHARE_RECORD_SUCCESS') . ",'$time','$time')";
                                                                M("account")->query($sql);
                                                                $newAccount = C('SHARE_RECOMMENDSHARE_RECORD_SUCCESS');
                                                                $account = 0;
                                                        } else {

                                                                //插入一条日志记录到account_balance中
                                                                $newAccount = $accArr['account'] + C('SHARE_RECOMMENDSHARE_RECORD_SUCCESS');
                                                                //更新账户表中的金额和更新时间
                                                                $sql = "update  stj_account  set account='{$newAccount}',updated_at='{$time}'  where id ={$accArr['id']}";
                                                                M("account")->query($sql);
                                                                $account = $accArr['account'];
                                                        }
                                                        $sql = "insert into  stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at)  values({$Recorduserinfo[userid]},'{$Recorduserinfo[username]}',{$account},$newAccount," . C('SHARE_RECOMMENDSHARE_RECORD_SUCCESS') . ",'','recommendShare ','推广分享奖励。 。','{$time}','{$time}')";
                                                        M("account_blance")->query($sql);
                                                        //首次推荐修改状态
                                                        $sql = "update  stj_share  set num=`num`+1  where decrypturl ='$userinfo[fromwhere]'";
                                                        M("share")->query($sql);
                                                }
                                        }
                                }
                        }


                        $activiteID = C("SHARE_RECOMMENDSHARE_ID");
                        if ($status == 6 && $activiteID == 4) {
                                $activeInfo = M("active")->where("id='$activiteID' and status=1 and endtime>'" . date("Y-m-d H:i:s") . "'")->find();
                                if ($activeInfo) {

                                        $jobInfo = M("job")->where("id='$recordinfo[j_id]'")->find();
                                        $memberId = $jobInfo['cpid'];
                                        $userInfo = M("company")->where("id=" . $memberId . " AND fromwhere='recommentshare'")->find();
                                        if ($userInfo) {

                                                //如果存在还没有赠送过并且有来源的username，则赠送给分享人金额
                                                $userinfo = M("userinfo")->where("username='" . $userInfo[username] . "' and fromusername !=''")->find();

                                                if ($userinfo) {
                                                        $Recorduserinfo = M("userinfo")->where("username='" . $userinfo[fromusername] . "'")->find();
                                                        $accArr = M("account")->where("uid='$Recorduserinfo[userid]'")->find();
                                                        //查找推荐人之前的账户信息
                                                        $time = time();
                                                        if (empty($accArr)) {
                                                                //插入一条信息账户信息到account表中
                                                                $sql = "insert into   stj_account(uid,username,account,created_at,updated_at)  values($Recorduserinfo[userid],'$Recorduserinfo[username]'," . C('SHARE_RECOMMENDSHARE_COMPANY_SUCCESS') . ",'$time','$time')";
                                                                M("account")->query($sql);
                                                                $newAccount = C('SHARE_RECOMMENDSHARE_COMPANY_SUCCESS');
                                                                $account = 0;
                                                        } else {

                                                                //插入一条日志记录到account_balance中
                                                                $newAccount = $accArr['account'] + C('SHARE_RECOMMENDSHARE_COMPANY_SUCCESS');
                                                                //更新账户表中的金额和更新时间
                                                                $sql = "update  stj_account  set account='{$newAccount}',updated_at='{$time}'  where id ={$accArr['id']}";
                                                                M("account")->query($sql);
                                                                $account = $accArr['account'];
                                                        }
                                                        $sql = "insert into  stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at)  values({$Recorduserinfo[userid]},'{$Recorduserinfo[username]}',{$account},$newAccount," . C('SHARE_RECOMMENDSHARE_COMPANY_SUCCESS') . ",'','recommendShare ','推广分享奖励。','{$time}','{$time}')";
                                                        M("account_blance")->query($sql);
                                                        //首次推荐修改状态
                                                        $sql = "update  stj_share  set num=`num`+1  where decrypturl ='$userinfo[fromwhere]'";
                                                        M("share")->query($sql);
                                                }
                                        }
                                }
                        }
                }
                // $recordInfo = M("record")->where("id='$reasonid'")->find();
                //  echo M("record")->getLastSql();
                if ($type == 1) {
                        echo json_encode("ok");
                } else {
                        header("location:/index.php?s=/Company/candidate/id/" . $id);
                        die;
                }
        }

        /*
         * 企业查看候选人页面
         */

        public function candidate() {

                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "推荐记录", "url" => "/index.php?s=/Company/candidate", "img" => "/Public/new-images/com-head-icon/tjjl.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "推荐记录");
                $this->assign("select", "candidate");
                $job_id = $_GET['id'];
                if (empty($job_id) || !is_numeric($job_id)) {
                        $job_id = 0;
                }
                $arInfo = $this->getJobInfo(1, $job_id);
                if (!$arInfo) {
                        header("location:/");
                        die;
                }
                $this->assign("arInfo", $arInfo);
//                echo "<br/><br/><br/><br/><pre>";
//                var_dump($arInfo['arRecordList']);
//                echo "</pre>";
                $this->display("job_list");
        }

        public function getJobInfo($page, $job_id = 0, $num = 10) {
                $id = $job_id;
                $start = ($page - 1 ) * $num;
                $checkUserPavi = $this->checkUserPaviliong();
                $checkUserPavi['telephone'] = ($checkUserPavi['mobile'] ? $checkUserPavi['mobile'] : $checkUserPavi['telephone']);
                if ($checkUserPavi === false) {
                        return false;
                }

                $jobInfoTmp = array();

                //获取职位信息
                if ($id) {
                        $jobInfoTmp = M("job")->where("id='$id'")->find();
                        //职位名称
                        if (!$jobInfoTmp['title']) {
                                $jobInfoTmp['title'] = M("casclist")->where("id='$jobInfoTmp[Jobcate]'")->getField("cascname");
                        }
                }

                $arJobList = M("job")->where("cpid=" . $checkUserPavi['id'] . " and is_deleted=0 and checkinfo='true' and endtime>" . time())->order("id desc")->select();

                $checked = $checkUserPavi['checkinfo'];

                if ($checked == "true") {
                        $arJobIDTmp = array();
                        if ($arJobList) {

                                if ($id) {
                                        $where = " and j_id='$id'";
                                } else {
                                        foreach ($arJobList as &$jobInfo) {
                                                if (!$jobInfo['title']) {
                                                        $jobInfo['title'] = M("casclist")->where("id='$jobInfo[Jobcate]'")->getField("cascname");
                                                }
                                                array_push($arJobIDTmp, $jobInfo['id']);
                                        }
                                        $sJobIDTmp = implode(",", $arJobIDTmp);

                                        $where = " and j_id in (" . $sJobIDTmp . ")";
                                }
                                $count = M("record")->where("status=2  " . $where)->count();
                                $arRecordList = M("record")->where("status=2 " . $where)->order("j_id desc,id desc")->limit($start, $num)->select();

                                if ($arRecordList) {
                                        foreach ($arRecordList as $key => &$record) {
                                                $Resume = M("resume")->where("id=" . $record['bt_id'])->find();
                                                $record['bt_username'] = $Resume['username'];
                                                $job = M("job")->where("id='$record[j_id]'")->find();

                                                //职位名称
                                                if (!$job['title']) {
                                                        $record['title'] = M("casclist")->where("id='$job[Jobcate]'")->getField("cascname");
                                                } else {
                                                        $record['title'] = $job['title'];
                                                }

                                                $record['t_username'] = M("member")->where("id='$Resume[t_id]'")->getField("username");
                                                $record['state'] = getCascData('zzstart', $Resume['state']);
                                                $record['mobile'] = $Resume['mobile'];
                                                $record['sink'] = ($record['sink'] == 1 ? "未打款" : "已打款");
                                                $Resume['posttime'] = ($record['posttime'] != 0 ? date("Y-m-d", $record['posttime']) : "");
                                                $record['audstart_status'] = $record[audstart];
                                                $record['audstart'] = M("cascadedata")->where("datavalue='$record[audstart]' and datagroup='audstart'")->getField("dataname");
                                                $record['audstartdate'] = ($record['audstartdate'] ? $record['audstartdate'] : "电话沟通");
                                        }
                                }
                        } else {
                                $arRecordList = false;
                        }
                }
                $arAudreasonList = M("cascadedata")->where("datagroup='audstart'")->order("orderid asc")->select();


                return array(
                    "company" => $checkUserPavi,
                    "arAudreasonList" => $arAudreasonList,
                    "checked" => $checked,
                    "arRecordList" => $arRecordList,
                    "arJobList" => $arJobList,
                    "jobInfoTmp" => $jobInfoTmp,
                    "id" => $id
                );
        }

        /*
         * 验证用户是否存在
         */

        public function checkUserPaviliong() {
                $username = $this->username;
                $userInfo = M("company")->where("username='$username'")->find();
                if (empty($userInfo)) {
                        return false;
                }
                return $userInfo;
        }

        /*
         * 企业招聘进度
         */

        public function process_track() {

                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "进程跟踪", "url" => "/index.php?s=/Company/process_track", "img" => "/Public/new-images/com-head-icon/jcgz.png"),
                    array("name" => "待付账单", "url" => "/index.php?s=/Companyabout/pay/act/paying", "img" => "/Public/new-images/com-head-icon/dfzd.png"),
                    array("name" => "付款记录", "url" => "/index.php?s=/Companyabout/pay/act/paid", "img" => "/Public/new-images/com-head-icon/fkjl.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "进程跟踪");
                $this->assign("select", "record");

                $jobList = $this->get_process_list(1, 10);
                $this->assign("jobList", $jobList);

                $this->display("process");
        }

        /*
         * 获取企业招聘职位列表
         */

        Public function get_process_list($page, $num) {
                //推荐进度
                $username = $this->username;
                $start = ($page - 1) * $num;
                $sql = "SELECT distinct(j_id) from stj_notice_log where type=2 and username='{$username}' limit {$start},{$num}";
                $jobList = M("notice_log")->query($sql);
                if ($jobList) {
                        foreach ($jobList as &$jobID) {
                                $jobInfo = M("job")->where("id='$jobID[j_id]'")->find();
                                //职位名称
                                if (!$jobInfo['title']) {
                                        $jobID['title'] = M("casclist")->where("id='$jobInfo[Jobcate]'")->getField("cascname");
                                } else {
                                        $jobID['title'] = $jobInfo['title'];
                                }
                                $jobID['Tariff'] = $jobInfo['Tariff'];
                                $jobID['employ'] = $jobInfo['employ'];
                                $logList = M("notice_log")->where("j_id='$jobID[j_id]' and type=2")->order("j_id desc,created_at desc")->select();
                                $jobID['logList'] = $logList;
                        }
                }
                return $jobList;
        }

        /*
         * 获取企业招聘职位列表ajax
         */

        Public function get_process_list_ajax() {

                $page = $_POST['page'];
                $num = $_POST['number'];
                $username = $this->username;
                $sql = "SELECT count(distinct(j_id)) as num from stj_notice_log where type=2 and username='{$username}'";
                $countArr = M("notice_log")->query($sql);
                $count = $countArr[0]['num'];
                $jobList = $this->get_process_list($page, $num);
                $arData = array(
                    "count" => $count,
                    "result" => $jobList
                );
                echo json_encode($arData);
        }

        /*
         * 安全设置
         */

        public function security_settings() {

                if (strpos($this->username, "qq_") === 0 || strpos($this->username, "weixin") === 0 || strpos($this->username, "sina") === 0 || strpos($this->username, "renren") === 0) {

                        echo "<script>alert('第三方登陆用户无法修改密码');location.href='/';</script>";
                        die;
                }

                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "基本信息", "url" => "/index.php?s=/Company/complete_info", "img" => "/Public/new-images/head-icon/m-icon7.png"),
                    array("name" => "安全设置", "url" => "/index.php?s=/Company/security_settings", "img" => "/Public/new-images/head-icon/m-icon8.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "安全设置");
                $this->assign("result", $result);
                $this->assign("select", "info");
                $this->display("modify_password");
        }

        /*
         *  安全设置保存页面  
         *      params    post
         *          old_pwd  旧密码
         *          new_pwd  新密码
         *          re_pwd   重复新密码
         *      return  json
         *          code     返回值  200成功 500失败
         *          msg      提示信息
         *              
         */

        public function modify_password_save() {
                $params['old_pwd'] = I("post.old_pwd", '', 'htmlspecialchars');
                $params['new_pwd'] = I("post.new_pwd", '', 'htmlspecialchars');
                $params['re_pwd'] = I("post.re_pwd", '', 'htmlspecialchars');

                if (empty($params['old_pwd']) || empty($params['new_pwd']) || empty($params['re_pwd']) || $params['new_pwd'] != $params['re_pwd']) {
                        echo json_encode(array("code" => "500", "msg" => "参数异常"));
                        die;
                }
                $arUserinfo = M("userinfo")->where("username='" . $this->username . "' and password='" . md5(md5($params['old_pwd'])) . "' and flag=1 and is_deleted=0")->find();
                if (empty($arUserinfo)) {
                        echo json_encode(array("code" => "500", "msg" => "原始密码不正确"));
                        die;
                }
                M()->startTrans();
                $re1 = M("userinfo")->where("userid='" . $arUserinfo['userid'] . "'")->save(array("password" => md5(md5($params['new_pwd']))));
//                echo M("userinfo")->getLastSql();
                $re2 = M("company")->where("username='" . $this->username . "' and password='" . md5(md5($params['old_pwd'])) . "'")->save(array("password" => md5(md5($params['new_pwd'])), "pwd" => $params['new_pwd']));
//                echo M("company")->getLastSql();
                if ($re1 === 0 || $re2 === 0) {
                        M()->rollback();
                        echo json_encode(array("code" => "500", "msg" => "修改失败"));
                        die;
                } else {
                        M()->commit();
                        echo json_encode(array("code" => "200", "msg" => "修改成功"));
                        $_SESSION['cuserinfo'] = null;
                        die;
                }
        }

        //生成职位的长id
        function create_guid() {
                $microTime = microtime();
                list($a_dec, $a_sec) = explode(" ", $microTime);
                $dec_hex = dechex($a_dec * 1000000);
                $sec_hex = dechex($a_sec);
                $this->ensure_length($dec_hex, 5);
                $this->ensure_length($sec_hex, 6);
                $guid = "";
                $guid .= $dec_hex;
                $guid .= $this->create_guid_section(3);
                $guid .= '-';
                $guid .= $this->create_guid_section(4);
                $guid .= '-';
                $guid .= $this->create_guid_section(4);
                $guid .= '-';
                $guid .= $this->create_guid_section(4);
                $guid .= '-';
                $guid .= $sec_hex;
                $guid .= $this->create_guid_section(6);
                return $guid;
        }

        function ensure_length(&$string, $length) {
                $strlen = strlen($string);
                if ($strlen < $length) {
                        $string = str_pad($string, $length, "0");
                } else if ($strlen > $length) {
                        $string = substr($string, 0, $length);
                }
        }

        function create_guid_section($characters) {
                $return = "";
                for ($i = 0; $i < $characters; $i++) {
                        $return .= dechex(mt_rand(0, 15));
                }
                return $return;
        }

}
