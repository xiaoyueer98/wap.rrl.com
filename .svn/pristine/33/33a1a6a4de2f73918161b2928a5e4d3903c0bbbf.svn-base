

<?php

class CompanyaboutAction extends Action {

        Public function __construct() {
                parent::__construct();
                if (empty($_SESSION['cuserinfo'])) {
                        header("location:/");
                        die;
                } else {

                        $this->uid = $_SESSION['cuserinfo']['userid'];
                        $this->username = $_SESSION['cuserinfo']['username'];
                }
        }

        /*
         * 获取企业用户信息
         */

        Public function getCompanyInfo() {
                $result = M("company")->where("id='" . $this->uid . "'")->find();
                $arNature = M("cascadedata")->where("datagroup = 'nature' and datavalue=" . $result['nature'])->find();
                $result['naturedata'] = $arNature['dataname'];
                $arScale = M("cascadedata")->where("datagroup = 'scale' and datavalue=" . $result['scale'])->find();
                $result['scaledata'] = $arScale['dataname'];
                $arStage = M("cascadedata")->where("datagroup = 'stage' and datavalue=" . $result['stage'])->find();
                $result['stagedata'] = $arStage['dataname'];
                $result['brightregdata'] = ($result['brightreg'] ? date("Y-m-d", $result['brightreg']) : "");

                return $result;
        }

        /*
         * 正在发布职位
         */

        Public function recording() {
                $arCompany = $this->getCompanyInfo();
                $cpid = $arCompany['id'];
                $jobOb = new JobModel;
                $result = $jobOb->getCurrentJobList($cpid, 1, $start = 0, $len = 100);
//                echo "<pre>";var_dump($result);echo "</pre>";die;
                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "发布职位", "url" => "/index.php?s=/Company/send_job", "img" => "/Public/new-images/com-head-icon/send_job.png"),
                    array("name" => "正在招聘", "url" => "/index.php?s=/Companyabout/recording", "img" => "/Public/new-images/com-head-icon/recording.png"),
                    array("name" => "往期招聘", "url" => "/index.php?s=/Companyabout/recorded", "img" => "/Public/new-images/com-head-icon/recorded.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "正在招聘");
                $this->assign("result", $result);
                $this->assign("select", "send_job");
                $this->display("Company/recording");
        }

        /*
         * 增加招聘资费
         */

        Public function add_tariff() {

                $id = $_POST['id'];
                $fee = intval($_POST['fee']);
                if (empty($id) || empty($fee)) {
                        echo json_encode(array("code" => 500, "msg" => "参数异常"));
                        die;
                }
                $Tariff = M("job")->where("id=$id")->getField("Tariff");

                if (empty($Tariff) || $arJob['Tariff'] > $fee) {
                        echo json_encode(array("code" => 500, "msg" => "参数异常2"));
                        die;
                }
                $re = M("job")->save(array("id" => $id, "Tariff" => $fee));
                echo json_encode(array("code" => 200, "msg" => "增加成功！"));
                exit();
        }

        /*
         * 删除职位
         */

        Public function del_record() {
                $jobId = I("id");
                $data['id'] = $jobId;
                $data['is_deleted'] = 1;
                //查看当前职位是否有人投递简历
                $sRecordCount = M("record")->where("j_id='$jobId'")->count();
                if ($sRecordCount) {
                        echo json_encode(array("code" => 500, "msg" => "已经有人投递简历不允许删除！"));
                        exit();
                }
                $res = M("job")->save($data);
                if ($res) {
                        echo json_encode(array("code" => 200, "msg" => "ok！"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "操作失败！"));
                        exit();
                        //  $this->success("", U('Company/companyJobList'));
                }
        }

        /*
         * 历史发布职位
         */

        Public function recorded() {
                $arCompany = $this->getCompanyInfo();
                $cpid = $arCompany['id'];
                $jobOb = new JobModel;
                $result = $jobOb->getCurrentJobList($cpid, 2, $start = 0, $len = 100);
//                echo "<pre>";var_dump($result);echo "</pre>";die;
                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "发布职位", "url" => "/index.php?s=/Company/send_job", "img" => "/Public/new-images/com-head-icon/send_job.png"),
                    array("name" => "正在招聘", "url" => "/index.php?s=/Companyabout/recording", "img" => "/Public/new-images/com-head-icon/recording.png"),
                    array("name" => "往期招聘", "url" => "/index.php?s=/Companyabout/recorded", "img" => "/Public/new-images/com-head-icon/recorded.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "往期招聘");
                $this->assign("result", $result);
                $this->assign("select", "send_job");
                $this->display("Company/recorded");
        }

        /*
         * 候选人简历页面
         */

        Public function view_resume() {
                //推荐记录id
                $id = intval($_GET['id']) > 0 ? intval($_GET['id']) : 0;
                //招聘信息id
                $jid = intval($_GET['jid']) > 0 ? intval($_GET['jid']) : 0;
                //推荐人id
                $btid = intval($_GET['btid']) > 0 ? intval($_GET['btid']) : 0;


                if (empty($id) || empty($jid) || empty($btid)) {
                        header("location:/");
                        die;
                }
                $result = M("resume")->where("id={$btid}")->find();
                $arJobInfo = M("job")->where("id='$jid'")->find();
                if (!$arJobInfo['title']) {
                        $arJobInfo['title'] = M("casclist")->where("id='$arJobInfo[Jobcate]'")->getField("cascname");
                }

                $arRecord = M("record")->where("id='$id'")->find();
                if ($arRecord['news_status'] == "0") {


                        /*                         * ***************************【推荐人/企业】企业查看简历操作日志 begin************************** */

                        $arCompanyInfo = M("company")->where("id={$arJobInfo['cpid']}")->find();
                        $username = $this->username;

                        $arTNoticeInfo = getTNoticeInfo(6, $resumeInfo['username'], $arCompanyInfo['cpname'], $arJobInfo['title']);
                        $sLogtitle = $arTNoticeInfo[0];
                        $sLogContent = $arTNoticeInfo[1];
                        $arNotice = array(
                            "uid" => $arCompanyInfo['id'],
                            "username" => $username,
                            "bt_id" => $btid,
                            "j_id" => $jid,
                            "title" => $sLogtitle,
                            "content" => $sLogContent,
                            "created_at" => time(),
                            "updated_at" => time()
                        );
                        M("notice_log")->add($arNotice);

                        $arCNoticeInfo = getCNoticeInfo(6, $arJobInfo['title'], $resumeInfo['username']);
                        $sLogtitle = $arCNoticeInfo[0];
                        $sLogContent = $arCNoticeInfo[1];
                        $arNotice = array(
                            "uid" => $arCompanyInfo['id'],
                            "username" => $username,
                            "bt_id" => $btid,
                            "j_id" => $jid,
                            "title" => $sLogtitle,
                            "content" => $sLogContent,
                            "type"=>2,
                            "created_at" => time(),
                            "updated_at" => time()
                        );
                        M("notice_log")->add($arNotice);

                        /*                         * ***************************【推荐人/企业】企业查看简历操作日志 begin************************** */
                        //修改新消息状态
                        M("record")->query("UPDATE stj_record set news_status=1 where id='$id'");
                }


                $result['sexdata'] = $result['sex'] ? "女" : "男";
                $result['agedata'] = $result['age'] ? $result['age'] : "未填";
                //在职状态
                $result['statedata'] = M("cascadedata")->where("datagroup='zzstart' and datavalue='$result[state]'")->getField("dataname");
                //工作经历
                $result['experiencedata'] = M("workexper")->where("keyid='$result[keyid]'")->getField("intro");
                $result['experiencedata'] = $result['experiencedata'] ? $result['experiencedata'] : "无";
                //教育经历
                $result['educationdata'] = M("education")->where("keyid='$result[keyid]'")->getField("content");
                $result['educationdata'] = $result['educationdata'] ? $result['educationdata'] : "无";
                //资格证书
                $result['zige'] = M("cercate")->where("keyid='$result[keyid]'")->getField("zhengshu");
                $result['zige'] = $result['zige'] ? $result['zige'] : "无";
                //推荐理由
                $result['because'] = $result['because'] ? $result['because'] : "无";


                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "发布职位", "url" => "/index.php?s=/Company/send_job", "img" => "/Public/new-images/com-head-icon/send_job.png"),
                    array("name" => "正在招聘", "url" => "/index.php?s=/Companyabout/recording", "img" => "/Public/new-images/com-head-icon/recording.png"),
                    array("name" => "往期招聘", "url" => "/index.php?s=/Companyabout/recorded", "img" => "/Public/new-images/com-head-icon/recorded.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "候选人简历");
                $this->assign("result", $result);
                $this->assign("select", "send_job");
                $this->display("Company/view_resume");
        }

        /*
         * 待付/已付账单页面
         */

        Public function pay() {
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "进程跟踪", "url" => "/index.php?s=/Company/process_track", "img" => "/Public/new-images/com-head-icon/jcgz.png"),
                    array("name" => "待付账单", "url" => "/index.php?s=/Companyabout/pay/act/paying", "img" => "/Public/new-images/com-head-icon/dfzd.png"),
                    array("name" => "付款记录", "url" => "/index.php?s=/Companyabout/pay/act/paid", "img" => "/Public/new-images/com-head-icon/fkjl.png"),
                );
                $this->assign("lArr", $lArr);
                
                $this->assign("select", "record");

                if ($_GET['act'] == "paying") {
                        $result = $this->getPaymentList(1);
                        $this->assign("result", $result);
                        $this->assign("header_title", "待付账单");
                        $this->display("Company/paying");
                } else {
                        $result = $this->getPaymentList(2);
                        $this->assign("result", $result);
                        $this->assign("header_title", "付款记录");
                        $this->display("Company/paid");
                }
        }

        /*
         * 待付账单获取列表
         */

        public function getPaymentList($type = 1) {
                $arCompany = $this->getCompanyInfo();
                $cpid = $arCompany['id'];
                $jobList = M("job")->field("id")->where("cpid = '$cpid'")->select();
                if ($jobList) {
                        foreach ($jobList as $job) {
                                $jobs[] = $job['id'];
                        }
                }
                $jobids = implode(',', $jobs);
                if ($type == 1) {
                        $count = M("record")->where("j_id in ($jobids) and audstart=6 AND sink=1")->count();
                        $payList = M("record")->where("j_id in ($jobids) and audstart =6 AND sink=1")->order("id desc")->limit($page->firstRow, $page->listRows)->select();
//                        echo "<br/><br/><br/><br/><br/><pre>";var_dump();echo "</pre>";
                } else {
                        $count = M("record")->where("j_id in ($jobids) and audstart=6 AND sink=2")->count();
                        $payList = M("record")->where("j_id in ($jobids) and audstart =6 AND sink=2")->order("id desc")->limit($page->firstRow, $page->listRows)->select();
                }
//                echo "<pre>";var_dump($payList);echo "</pre>";
                if ($payList) {
                        foreach ($payList as $key => $pay) {
                                $job = M("job")->where("id = '" . $pay['j_id'] . "'")->find();

                                $payList[$key]['sort_id'] = $i++;
                                $tname = M("member")->field("username")->where("id = '" . $pay['t_id'] . "'")->find();
                                $btname = M("resume")->field("username")->where("id = '" . $pay['bt_id'] . "'")->find();
                                if (!$job['title']) {
                                        $job['title'] = M("casclist")->where("id='$job[Jobcate]'")->getField("cascname");
                                } else {
                                        $job['title'] = $job['title'];
                                }
                                //面试状态
                                $mianshistatus = M("cascadedata")->where("datagroup='audstart' and datavalue='$pay[audstart]'")->find();
                                $payList[$key]['msstatus'] = $mianshistatus['dataname'];
                                $payList[$key]['posttime'] = date("Y-m-d", $pay['posttime']);
                                $payList[$key]['tname'] = $tname['username'];
                                $payList[$key]['btname'] = $btname['username'];
                                $payList[$key]['Jobcate'] = $job['title'];
                                $payList[$key]['Tariff'] = $job['Tariff'];
                                $payList[$key]['status'] = (($pay['sink'] == 1) ? "未打款" : "已打款");
                        }

                        return $payList;
                } else {
                        return array();
                }
        }

        /*
         * 发布职位的那个详情页面
         */

        public function job_detail() {

                $id = $_GET['id'];
                if (!$id) {
                        header("location:/Companyabout/recording");
                        die;
                }
                $jobOb = new JobModel();
                $arJob = $jobOb->get_detail($id);
                $this->assign("arJob", $arJob);

                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "发布职位", "url" => "/index.php?s=/Company/send_job", "img" => "/Public/new-images/com-head-icon/send_job.png"),
                    array("name" => "正在招聘", "url" => "/index.php?s=/Companyabout/recording", "img" => "/Public/new-images/com-head-icon/recording.png"),
                    array("name" => "往期招聘", "url" => "/index.php?s=/Companyabout/recorded", "img" => "/Public/new-images/com-head-icon/recorded.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "职位详情");
                $this->assign("select", "send_job");

                $this->display("Company/job_detail");
        }

}
