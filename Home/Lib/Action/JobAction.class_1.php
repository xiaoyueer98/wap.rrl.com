<?php

class JobAction extends Action {

        private $isLogin = false;

        public function __construct() {
                parent::__construct();
                $this->isLogin = C("isLogin");
        }

        /*
         * 取出最新的职位
         */

        public function job_list() {

                $mOb = new JobModel;
                $result = $mOb->new_job_list("0,10");

                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "推荐职位", "url" => "/index.php?s=/Job/job_list", "img" => "/Public/new-images/head-icon/m-icon7.png"),
                    array("name" => "职位收藏", "url" => "/index.php?s=/Job/fav_job", "img" => "/Public/new-images/head-icon/m-icon8.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "推荐职位");
                $this->assign("result", $result);
                $this->assign("select", "collect");
                $this->display("Job/job_list");
        }

        /*
         * 得到最新职位列表
         * 
         * 参数  post
         *       page  页码
         *       number  显示条数
         *       
         * 
         * 返回值
         *       count  总条数
         *       result  最新职位列表
         */

        public function get_job_list() {

                $page = $_POST['page'];
                $size = $_POST['number'];

                $start = ($page - 1) * $size;

                $mOb = new JobModel;

                $num = $mOb->new_job_count(); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $mOb->new_job_list($limit);

                if (empty($result)) {
                        $result = array();
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         * 职位详情(新版)
         */

        public function job_detail_new() {

                $id = $_GET['jobid'];
                if (empty($id)) {
                        header("location:/index.php?s=/Job/job_list");
                        exit();
                }
                if (!is_numeric($id)) {
                        $jobTmpInfo = M("job")->where("guid='$id'")->find();
                        header("location:/index.php?s=/Job/job_detail_new/jobid/" . $jobTmpInfo['id']);
                        exit();
                }

                $jobOb = new JobModel();

                $result = $jobOb->get_detail($id);
                //var_dump($result);
                $tag = 0; //默认是未收藏状态
                //判断当前用户是否登陆，如果登陆判断当前页面当前用户是否已藏
                $userinfo = $_SESSION['userinfo'];

                if (!empty($userinfo)) {

                        $username = $userinfo['username'];

                        //判断当前页面当前用户是否已藏
                        $jcOb = M("job_collection");
                        $jcArr = $jcOb->where("username='" . $username . "' and status=1 and j_id=" . $id)->find();
                        //echo $jcOb ->getLastSql();
                        //var_dump($jcArr);
                        if (!empty($jcArr)) {
                                $tag = 1; //收藏表里有相关数据，改为已收藏状态
                        }
                }


                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////

                $shareUrl2 = rtrim($_GET['share'], ".html");
                $url = decrypt($shareUrl2, "share");
                if ($url == false) {
                        $shareUrl2 = str_replace(" ", "+", $shareUrl2);
                        $url = decrypt($shareUrl2, "share");
                }


                //如果是分享连接
                if ((strpos($url, "tag") !== false) && (strpos($url, "channel") !== false)) {

                        $arUrl = explode("&", $url);
                        $shareUrl2 = array();
                        foreach ($arUrl as $u) {
                                $au = explode("=", $u);
                                $shareUrl2[$au[0]] = $au[1];
                        }

                        $_SESSION['shareurl'] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                        $_SESSION['backurl'] = $_SERVER['HTTP_REFERER'];
                        $_SESSION['sharetag'] = $shareUrl2['tag'];
                        $_SESSION['sharechannel'] = $shareUrl2['channel'];
                        $_SESSION['shareaid'] = $shareUrl2['aid'];
                        $_SESSION['shareuname'] = $shareUrl2['uname'];
                        //echo "<pre>";var_dump($_SESSION);echo "</pre>";
                }

                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////
                //如果不是分享过来的，则判断登陆没有，如果没有登陆则不允许浏览

                if ($this->isLogin == true) {

                        setcookie("gourl", "/index.php?s=/Job/job_detail/id/" . $id, time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                } else {

                        setcookie("gourl", "", time() - 1, "/");
                }
                //分享相关
                $requestUrl = $_SERVER['QUERY_STRING'];
                $shareUrl = "http://m.renrenlie.com/index.php";

                if ($_SESSION['userinfo']['username']) {
                        $username = $_SESSION['userinfo']['username'];
                        $shareUrlTmp = "tag=ShareJob&channel=WapShare&aid=" . C('SHARE_JOB_ID') . "&uname=" . $username;

                        $shareUrl = $shareUrl . "?" . $requestUrl . "&share=" . encrypt($shareUrlTmp, "share");
                } else {
                        $username = "";
                        $shareUrl = $shareUrl . "?" . $requestUrl;
                }

                //得到热招职位
                $WxComModel = new CompanyModel();
                $result_job = $WxComModel->get_hot_job($result['cpid']);
                //得到评论列表
                $arComment = M("evaluate")->where("tag='record' and j_id={$result['id']} and status=0")->select();
                if (empty($arComment)) {
                        $arComment = array();
                }
                foreach ($arComment as $k => $v) {
                        $arComment[$k]['time'] = date("Y-m-d", $v['created_at']);
                }

                $share['url'] = $shareUrl;
                $share['title'] = "即刻分享" . $result['title'] . "职位，立得N个“百元”现金。";
                $share['description'] = "【人人猎】" . $result['cpname'] . "直招" . $result['title'] . "职位" . $result['employ'] . "人,月薪:" . $result['treatmentdata'] . " ，推荐或自荐成功入职即得推荐奖金" . $result['Tariff'] . "元。";
                $this->assign("shareurl", $shareUrl);
                $this->assign("share", $share);
                //echo "<pre>";var_dump($result);echo "</pre>";
                $this->assign("tag", $tag);
                $this->assign("result", $result);
                $this->assign("result_job", $result_job);
                $this->assign("arComment", $arComment);
                $this->assign("jobname", $result['title']);
                $this->assign("empty", "<div style='font-size: 14px;color: #b4b4b4;text-align:center;margin-top:10px;'>暂无评论！</div>");

                if (!empty($_SESSION['cuserinfo'])) {
                        //为引入的头部传入标题
                        $lArr = array(
                            array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                        );
                } else {
                        //为引入的头部传入标题
                        $lArr = array(
                            array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                            array("name" => "推荐职位", "url" => "/index.php?s=/Job/job_list", "img" => "/Public/new-images/head-icon/m-icon7.png"),
                            array("name" => "职位收藏", "url" => "/index.php?s=/Job/fav_job", "img" => "/Public/new-images/head-icon/m-icon8.png"),
                        );
                }
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "推荐职位");
                $this->assign("select", "collect");

                $this->display("./Job/job_detail_new");
        }

        /*
         * 当pc访问详情页面是的中间跳转页面
         */

        public function job_detail_redirect() {

                $jobid = $_GET['jobid'];
                $arJob = M("job")->where("id=" . $jobid)->find();
                if (empty($arJob)) {
                        header("location:http://www.renrenlie.com/");
                        die;
                } else {
                        header("location:http://www.renrenlie.com/Home/Index/EnterIndex2/comid/" . $arJob['cpid'] . "/jobid/" . $arJob['guid'] . ".html");
                        die;
                }
        }

        /*
         * 职位详情
         */

        public function job_detail() {

                $id = $_GET['id'];
                if (empty($id)) {
                        header("location:/index.php?s=/Index/index");
                        exit();
                }

                $jobOb = new JobModel();

                $result = $jobOb->get_detail($id);
                //var_dump($result);
                $tag = 0; //默认是未收藏状态
                //判断当前用户是否登陆，如果登陆判断当前页面当前用户是否已藏
                $userinfo = $_SESSION['userinfo'];

                if (!empty($userinfo)) {

                        $username = $userinfo['username'];

                        //判断当前页面当前用户是否已藏
                        $jcOb = M("job_collection");
                        $jcArr = $jcOb->where("username='" . $username . "' and status=1 and j_id=" . $id)->find();
                        //echo $jcOb ->getLastSql();
                        //var_dump($jcArr);
                        if (!empty($jcArr)) {
                                $tag = 1; //收藏表里有相关数据，改为已收藏状态
                        }
                }


                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////

                $shareUrl2 = rtrim($_GET['share'], ".html");
                $url = decrypt($shareUrl2, "share");
                if ($url == false) {
                        $shareUrl2 = str_replace(" ", "+", $shareUrl2);
                        $url = decrypt($shareUrl2, "share");
                }


                //如果是分享连接
                if ((strpos($url, "tag") !== false) && (strpos($url, "channel") !== false)) {

                        $arUrl = explode("&", $url);
                        $shareUrl2 = array();
                        foreach ($arUrl as $u) {
                                $au = explode("=", $u);
                                $shareUrl2[$au[0]] = $au[1];
                        }

                        $_SESSION['shareurl'] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                        $_SESSION['backurl'] = $_SERVER['HTTP_REFERER'];
                        $_SESSION['sharetag'] = $shareUrl2['tag'];
                        $_SESSION['sharechannel'] = $shareUrl2['channel'];
                        $_SESSION['shareaid'] = $shareUrl2['aid'];
                        $_SESSION['shareuname'] = $shareUrl2['uname'];
                        //echo "<pre>";var_dump($_SESSION);echo "</pre>";
                }

                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////
                //如果不是分享过来的，则判断登陆没有，如果没有登陆则不允许浏览

                if ($this->isLogin == true) {

                        setcookie("gourl", "/index.php?s=/Job/job_detail/id/" . $id, time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                } else {

                        setcookie("gourl", "", time() - 1, "/");
                }
                //分享相关
                $requestUrl = $_SERVER['QUERY_STRING'];
                $shareUrl = "http://m.renrenlie.com/index.php";

                if ($_SESSION['userinfo']['username']) {
                        $username = $_SESSION['userinfo']['username'];
                        $shareUrlTmp = "tag=ShareJob&channel=WapShare&aid=" . C('SHARE_JOB_ID') . "&uname=" . $username;

                        $shareUrl = $shareUrl . "?" . $requestUrl . "&share=" . encrypt($shareUrlTmp, "share");
                } else {
                        $username = "";
                        $shareUrl = $shareUrl . "?" . $requestUrl;
                }


                $share['url'] = $shareUrl;
                $share['title'] = "即刻分享" . $result['title'] . "职位，立得N个“百元”现金。";
                $share['description'] = "[renrenlie.com] " . $result['cpname'] . "直招" . $result['title'] . "职位" . $result['employ'] . "人,月薪:" . $result['treatmentdata'] . " ，推荐或自荐成功入职即得推荐费" . $result['Tariff'] . "元。";
                $this->assign("shareurl", $shareUrl);
                $this->assign("share", $share);
                $this->assign("tag", $tag);
                $this->assign("result", $result);
                $this->display("job_detail_new");
        }

        public function job_detail1() {

                $id = $_GET['id'];
                if (empty($id)) {
                        header("location:/index.php?s=/Index/index");
                        exit();
                }

                $jobOb = new JobModel();

                $result = $jobOb->get_detail($id);
                //var_dump($result);
                $tag = 0; //默认是未收藏状态
                //判断当前用户是否登陆，如果登陆判断当前页面当前用户是否已藏
                $userinfo = $_SESSION['userinfo'];

                if (!empty($userinfo)) {

                        $username = $userinfo['username'];

                        //判断当前页面当前用户是否已藏
                        $jcOb = M("job_collection");
                        $jcArr = $jcOb->where("username='" . $username . "' and status=1 and j_id=" . $id)->find();
                        //echo $jcOb ->getLastSql();
                        //var_dump($jcArr);
                        if (!empty($jcArr)) {
                                $tag = 1; //收藏表里有相关数据，改为已收藏状态
                        }
                }


                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////

                $shareUrl2 = rtrim($_GET['share'], ".html");
                $url = decrypt($shareUrl2, "share");
                if ($url == false) {
                        $shareUrl2 = str_replace(" ", "+", $shareUrl2);
                        $url = decrypt($shareUrl2, "share");
                }


                //如果是分享连接
                if ((strpos($url, "tag") !== false) && (strpos($url, "channel") !== false)) {

                        $arUrl = explode("&", $url);
                        $shareUrl2 = array();
                        foreach ($arUrl as $u) {
                                $au = explode("=", $u);
                                $shareUrl2[$au[0]] = $au[1];
                        }

                        $_SESSION['shareurl'] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                        $_SESSION['backurl'] = $_SERVER['HTTP_REFERER'];
                        $_SESSION['sharetag'] = $shareUrl2['tag'];
                        $_SESSION['sharechannel'] = $shareUrl2['channel'];
                        $_SESSION['shareaid'] = $shareUrl2['aid'];
                        $_SESSION['shareuname'] = $shareUrl2['uname'];
                }
                //echo "<pre>";var_dump($_SESSION);echo "</pre>";
                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////
                //如果不是分享过来的，则判断登陆没有，如果没有登陆则不允许浏览

                if ($this->isLogin == true) {

                        setcookie("gourl", "/index.php?s=/Job/job_detail1/id/" . $id, time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                } else {

                        setcookie("gourl", "", time() - 1, "/");
                }
                //分享相关
                $requestUrl = $_SERVER['QUERY_STRING'];
                $shareUrl = "http://m.renrenlie.com/index.php";

                if ($_SESSION['userinfo']['username']) {
                        $username = $_SESSION['userinfo']['username'];
                        $shareUrlTmp = "tag=ShareJob&channel=WapShare&aid=" . C('SHARE_JOB_ID') . "&uname=" . $username;

                        $shareUrl = $shareUrl . "?" . $requestUrl . "&share=" . encrypt($shareUrlTmp, "share");
                } else {
                        $username = "";
                        $shareUrl = $shareUrl . "?" . $requestUrl;
                }


                $share['url'] = $shareUrl;
                $share['title'] = "即刻分享" . $result['title'] . "职位，立得N个“百元”现金。";
                $share['description'] = "[renrenlie.com] " . $result['cpname'] . "直招" . $result['title'] . "职位" . $result['employ'] . "人,月薪:" . $result['treatmentdata'] . " ，推荐或自荐成功入职即得推荐费" . $result['Tariff'] . "元。";
                $this->assign("shareurl", $shareUrl);
                $this->assign("share", $share);
                //echo "<pre>";var_dump($result);echo "</pre>";
                $this->assign("tag", $tag);
                $this->assign("result", $result);
                $this->display("./Job/job_detail1");
        }

        /*
         * 收藏职位
         */

        public function collect_job() {
                if (!empty($_SESSION['cuserinfo'])) {
                        echo json_encode(array("code" => 500, "msg" => "您是企业账号，请登录推荐人账号再试！"));
                        die;
                }

                //如果参数为空，跳回职位详情页
                if (empty($_POST)) {
                        setcookie("gourl", "", time() - 1, "/");
                        echo json_encode(array("code" => 500, "msg" => "参数异常"));
                        die;
                }

                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/job_detail_new/jobid/" . $_POST['j_id'], time() + 3600, "/");
                        echo json_encode(array("code" => 400, "msg" => "未登录"));
                        die;
                } else {
                        setcookie("gourl", "", time() - 1, "/");

                        $_POST['uid'] = $userinfo['userid'];
                        $_POST['username'] = $userinfo['username'];
                        $_POST['created_at'] = time();
                        $_POST['updated_at'] = time();
                }

                //将收藏信息插入到 收藏职位表 job_collection
                $collectOb = M("job_collection");
                $jcArr = $collectOb->where("username='" . $_POST['username'] . "' and status=2 and j_id=" . $_POST['j_id'])->find();
                if (!empty($jcArr)) {
                        $collect_result = $collectOb->save(array("status" => 1, "updated_at" => time(), "id" => $jcArr['id']));
                } else {
                        $collect_result = $collectOb->add($_POST);
                }
                //echo $collectOb->getLastSql();
                if ($collect_result) {
                        echo json_encode(array("code" => 200, "msg" => "收藏成功"));
                        die;
                } else {
                        echo json_encode(array("code" => 500, "msg" => "收藏失败"));
                        die;
                }
        }

        /*
         * 取消收藏职位
         */

        public function cancel_collect_job() {

                $j_id = $_POST['j_id'];
                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_SESSION['userinfo'];

                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/job_detail_new/jobid/" . $j_id, time() + 3600, "/");
                        echo json_encode(array("code" => 400, "msg" => "未登录"));
                        die;
                } else {

                        setcookie("gourl", "", time() - 1, "/");
                        $uid = $userinfo['userid'];
                        $data['updated_at'] = time();

                        //查找该条收藏记录
                        $collectOb = M("job_collection");
                        $jcArr = $collectOb->where("uid='" . $uid . "' and status=1 and j_id=" . $j_id)->find();
                        $data['id'] = $jcArr['id'];
                        $data['status'] = 2;
                        $collect_result = $collectOb->save($data);
                        //echo $collectOb->getLastSql();
                        if ($collect_result) {

                                echo json_encode(array("code" => 200, "msg" => "取消收藏成功"));
                                die;
                        } else {

                                echo json_encode(array("code" => 400, "msg" => "取消收藏失败"));
                                die;
                        }
                }
        }

        /*
         * 取出收藏的职位列表
         */

        public function fav_job() {

                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/fav_job", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                } else {
                        setcookie("gourl", "", time() - 1, "/");
                }
                $WebChatModel = new JobCollectionModel();

                $userinfo = $_SESSION['userinfo'];
                $uid = $userinfo['userid'];

                $limit = "0,10"; //每页的数据数和内容$limit

                $result = $WebChatModel->fav_job_list($uid, $limit);

                if (empty($result)) {

                        $result = array();
                }

                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "推荐职位", "url" => "/index.php?s=/Job/job_list", "img" => "/Public/new-images/head-icon/m-icon7.png"),
                    array("name" => "职位收藏", "url" => "/index.php?s=/Job/fav_job", "img" => "/Public/new-images/head-icon/m-icon8.png"),
                );
                $this->assign("select", "collect");
                $this->assign("header_title", "职位收藏");
                $this->assign("lArr", $lArr);
                $this->assign("result", $result);
                $this->display("./Job/fav_list");
        }

        /*
         * 取出收藏的职位列表
         */

        public function fav_job_back() {

                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/fav_job", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                } else {
                        setcookie("gourl", "", time() - 1, "/");
                }

                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "推荐职位", "url" => "/index.php?s=/Job/job_list", "img" => "/Public/new-images/head-icon/m-icon7.png"),
                    array("name" => "职位收藏", "url" => "/index.php?s=/Job/fav_job", "img" => "/Public/new-images/head-icon/m-icon8.png"),
                );
                $this->assign("select", "collect");
                $this->assign("header_title", "职位收藏");
                $this->assign("lArr", $lArr);

                $this->display("./Job/collection_of_jobs");
        }

        /*
         * 获取收藏职位列表
         * 
         * 参数  POST
         *      page  页面
         *      number  显示条数
         * 
         * 返回值  json
         * 
         *      count   总条数
         *      result  收藏职位列表
         *     
         */

        public function get_favjob_list() {

                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                //首先查看这个职位是否已经被删除在job表中
                $WebChatModel = new JobCollectionModel();

                $userinfo = $_SESSION['userinfo'];
                $uid = $userinfo['userid'];
                $username = $userinfo['username'];

                $num = $WebChatModel->fav_job_count($uid); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $WebChatModel->fav_job_list($uid, $limit);

                if (empty($result)) {

                        $result = array();
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         * 正在推荐的职位
         */

        public function recommending() {


                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_SESSION['userinfo'];

                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/recommending", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                } else {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid = $userinfo['userid'];
                }
                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "正在推荐", "url" => "/index.php?s=/Job/recommending"),
                    array("name" => "历史推荐", "url" => "/index.php?s=/Job/recommended"),
                    array("name" => "回到首页", "url" => "/"),
                );
                $this->assign("select", "recommend");
                $this->assign("header_title", "正在推荐");
                $this->assign("lArr", $lArr);

                $this->display("./Job/is_recommended");
        }

        public function get_recommending_list() {

                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                $jobOb = New JobModel();

                $userinfo = $_SESSION['userinfo'];
                $uid = $userinfo['userid'];
                $username = $userinfo['username'];

                $num = $jobOb->recommend_job_count(1, $uid); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $jobOb->getRecommendJob(1, $limit, $uid);


                if (empty($result)) {

                        $result = array();
                }
                foreach ($result as $k => $v) {
                        $arNotice = M("notice_log")->where("type=1 and bt_id=" . $v['bt_id'])->order("id desc")->select();
                        if (empty($arNotice)) {
                                $arNotice = array();
                        } else {
                                foreach ($arNotice as $k1 => $v1) {
                                        $arNotice[$k1]['posttime'] = date("Y-m-d H:i", $v1['created_at']);
                                }
                        }

                        $result[$k]['notice_log'] = $arNotice;

                        //查看改用户是否已经评论过该职位
                        $arEvaluate = M("evaluate")->where("uid=" . $uid . " and pid=" . $result[$k]['recordid'] . " and tag='record'")->find();
                        if (empty($arEvaluate)) {
                                $result[$k]['is_evaluate'] = 1;
                        }
                }
//                echo "<pre>";var_dump($result);echo "</pre>";die;
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         * 历史推荐的职位
         */

        public function recommended() {


                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/recommended", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                } else {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid = $userinfo['userid'];
                }
                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "正在推荐", "url" => "/index.php?s=/Job/recommending"),
                    array("name" => "历史推荐", "url" => "/index.php?s=/Job/recommended"),
                    array("name" => "回到首页", "url" => "/"),
                );

                $this->assign("select", "recommend");
                $this->assign("header_title", "历史推荐");
                $this->assign("lArr", $lArr);

                $this->display("./Job/recommended_old");
        }

        /*
         * 获取正在收藏职位列表
         * 
         * 参数   post
         *       page   页码
         *       number 显示条数
         * 
         * 返回值  json
         * 
         *       count  总条数
         *       result  收藏职位列表
         */

        public function get_recommended_list() {

                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                $jobOb = new JobModel();

                $userinfo = $_SESSION['userinfo'];
                $uid = $userinfo['userid'];
                $username = $userinfo['username'];

                $num = $jobOb->recommend_job_count(2, $uid); //得到列表总条数
                //var_dump($num);
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $jobOb->getRecommendJob(2, $limit, $uid);

                if (empty($result)) {

                        $result = array();
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         * 我的账户
         */

        public function my_account() {


                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/my_account", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                } else {
                        setcookie("gourl", "", time() - 1, "/");
                        $username = $userinfo['username'];
                }

                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "资金明细", "url" => "/index.php?s=/Job/my_account", "img" => "/Public/new-images/head-icon/m-icon11.png"),
                    array("name" => "申请提现", "url" => "/index.php?s=/Usercenter/encash", "img" => "/Public/new-images/head-icon/m-icon12.png"),
                );

                $this->assign("header_title", "我的账户");
                $this->assign("select", "account");
                $this->assign("lArr", $lArr);

                $this->assign("username", $username);
                $this->display("./Account/selfaccount");
        }

        /*
         * 获取我的账户列表
         * 
         * 参数   post
         *       page   页码
         *       number 显示条数
         * 
         * 返回值  json
         * 
         *       count  总条数
         *       result 我的账户列表
         */

        public function get_account_list() {

                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                $acBObModel = new AccountBlanceModel();

                $userinfo = $_SESSION['userinfo'];
                $username = $userinfo['username'];
                $userinfoOb = M("userinfo");
                $userArr = $userinfoOb->where("username='" . $username . "'")->find();
                $uid = $userArr['userid'];

                $num = $acBObModel->my_account_count($uid); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $acBObModel->my_account_list($uid, $limit);

                if (empty($result)) {

                        $result = array();
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        public function my_account_info() {

                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/my_account_info", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                } else {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid = $userinfo['userid'];
                }
                $mOb = M("member");
                $mArr = $mOb->where("id=" . $uid)->find();

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

                $this->assign("mArr", $mArr);
                $this->display("./Account/my_account_info");
        }

        public function my_account_info_save() {

                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/my_account_info", time() + 3600, "/");
                        echo json_encode(array("code" => "400", "msg" => "未登录"));
                        die;
                } else {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid = $userinfo['userid'];
                }
                $bankname = I('post.bname', '', 'htmlspecialchars');
                $banknumber = I('post.bnum', '', 'htmlspecialchars');

                if (empty($bankname) || empty($banknumber)) {
                        echo json_encode(array("code" => "500", "msg" => "参数异常"));
                        die;
                }
                $mOb = M("member");
                $re = $mOb->save(array("id" => $uid, "bankname" => $bankname, "banknumber" => $banknumber));
                if ($re !== false) {
                        echo json_encode(array("code" => "200", "msg" => "保存成功"));
                        die;
                } else {
                        echo json_encode(array("code" => "500", "msg" => "保存失败"));
                        die;
                }
        }

        /*
         *         
         *  判断该用户为该职位已经推荐几个人
         */

        public function checkSelectUser() {


                $userinfo = $_SESSION['userinfo'];
                $userid = $userinfo['userid'];

                $jid = $_POST['jid'];
                $count = M("record")->where("j_id='$jid' and t_id='$userid'")->count();
                echo $count;
        }

        /*
         * 被推荐人列表页
         */

        public function push_resume_new() {
                $jobid = $_GET['jobid'];

                if (!empty($_SESSION['cuserinfo'])) {
                        header("location:/index.php?s=/Job/job_detail_new/jobid/" . $jobid);
                        die;
                }

                //如果为登陆，跳转到login页面
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/push_resume_new/jobid/" . $jobid, time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                }
                setcookie("gourl", "", time() - 1, "/");
                $this->assign('jobid', $jobid);

                $userinfo = $_SESSION['userinfo'];
                $uid = $userinfo['userid'];
                $username = $userinfo['username'];

                $resumeOb = new ResumeModel();
                $num = $resumeOb->resume_count($uid); //得到列表总条数
                if ($num == 0 && !empty($_GET['type'])) {
                        header("location:/index.php?s=/Job/add_resume_new/jobid/$jobid");
                        die;
                }
                $limit = "0,10";
                $result = $resumeOb->resume_list($uid, $limit, $jobid);

                foreach ($result as &$v) {
                        $v['isRecord'] = $this->resume_status($v['id'], $jobid);
                }

                $this->assign("result", $result);
                //echo "<pre>";var_dump($result);echo "</pre>";die;
                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "推荐职位", "url" => "/index.php?s=/Job/job_list", "img" => "/Public/new-images/head-icon/m-icon7.png"),
                    array("name" => "职位收藏", "url" => "/index.php?s=/Job/fav_job", "img" => "/Public/new-images/head-icon/m-icon8.png"),
                );
                $this->assign("lArr", $lArr);
                //$this->assign("select", "resume");
                $this->assign("header_title", "我的推荐");
                $this->assign("select", "collect");
                $this->display("./Job/candidate_resume");
        }

        /*
         * 判断该候选人的状态
         */

        function resume_status($resumeid, $jobid) {

                //查找公司id
                $arJob = M("job")->where("id=" . $jobid)->find();
                $cid = $arJob['cpid'];

                //判断该候选人是否已经推荐给该职位
                $isRecord = M("record")->where("bt_id=" . $resumeid . " AND j_id='$jobid'")->find();

                if ($isRecord) {
                        return "disabled";
                } else {
//                                
                        //判断该推荐人是否已经推荐给该企业的一个职位
                        $isThisCompany = M("record")->query("select *  from stj_record where bt_id=" . $resumeid . " and j_id in (select id from stj_job where cpid = $cid) and (audstart=1 or audstart=3 or audstart=5 or audstart=6) and status !=1");
                        if (!empty($isThisCompany)) {
                                return "isthiscompany";
                        } else {
                                //判断该职位是否已经推荐给3家企业
                                $isThreeCompany = M("record")->query("select *  from stj_record  r join stj_job b on  r.j_id = b.id  and r.bt_id =" . $resumeid . "  and (audstart=1 or audstart=3 or audstart=5 or audstart=6) and status !=1 group by  b.cpid;");

                                if (count($isThreeCompany) >= 3) {
                                        return "isthreecompany";
                                } else {
                                        return "";
                                }
                        }
                }
        }

        /*
         * 被推荐人列表页
         */

        public function push_resume() {

                $jobid = $_GET['jobid'];
                //如果为登陆，跳转到login页面
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/push_resume/jobid/" . $jobid, time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                }
                setcookie("gourl", "", time() - 1, "/");
                $this->assign('jobid', $jobid);

                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "候选人列表", "url" => "/index.php?s=/Usercenter/recommend_info"),
                    array("name" => "回到首页", "url" => "/"),
                );
                $this->assign("lArr", $lArr);
                //$this->assign("select", "resume");
                $this->assign("header_title", "我的推荐");
                $this->display("./Job/push_resume");
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

        public function get_resume_list() {

                //得到职位信息id
                $jobid = $_POST['jobid'];
                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                $userinfo = $_SESSION['userinfo'];
                $uid = $userinfo['userid'];
                $username = $userinfo['username'];

                $resumeOb = new ResumeModel();
                $num = $resumeOb->resume_count($uid); //得到列表总条数

                $limit = "$start,$size";
                $result = $resumeOb->resume_list($uid, $limit, $jobid);
                //var_dump($result);
                if (empty($result)) {

                        $result = array();
                }
                foreach ($result as &$v) {
                        $v['isRecord'] = $this->resume_status($v['id'], $jobid);
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         * 确定面试时间页面
         */

        public function resume_time_new() {
                if (strpos($_SERVER['HTTP_REFERER'], "push_resume_new") === false && strpos($_SERVER['HTTP_REFERER'], "add_resume_new") === false) {
                        header("location:?s=/Job/job_list");
                }
                //如果为登陆，跳转到login页面
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        header("location:?s=/Login/login");
                        die;
                }
                $jobid = $_GET['jobid'];
                $jid = $_GET['jid'];
                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "推荐职位", "url" => "/index.php?s=/Job/job_list", "img" => "/Public/new-images/head-icon/m-icon7.png"),
                    array("name" => "职位收藏", "url" => "/index.php?s=/Job/fav_job", "img" => "/Public/new-images/head-icon/m-icon8.png"),
                );
                $this->assign("lArr", $lArr);
                $this->assign("header_title", "候选人面试时间");
                $this->assign("jobid", $jobid);
                $this->assign("jid", $jid);
                $this->assign("select", "collect");
                $this->display("./Job/set_time_new");
        }

        /*
         * 确定面试时间页面
         */

        public function resume_time() {
                if (strpos($_SERVER['HTTP_REFERER'], "push_resume") === false) {

                        header("location:?s=/Index/index");
                }
                //如果为登陆，跳转到login页面
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        header("location:?s=/Login/login");
                        die;
                }
                $jobid = $_GET['jobid'];
                $jid = $_GET['jid'];
                $this->assign("header_title", "候选人面试时间");
                $this->assign("jobid", $jobid);
                $this->assign("jid", $jid);
                $this->display("./Job/set_time");
        }

        /*
         *  保存推荐人信息 到推荐记录表中record 
         */

        public function record_save() {
                if (empty($_POST['j_id']) || !is_numeric($_POST['j_id']) || empty($_POST['bt_id']) || !is_numeric($_POST['bt_id']) || empty($_POST['audstartdate'])) {
                        echo json_encode(array("code" => 500, "msg" => "参数异常"));
                        die;
                }

                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "index.php?s=/Job/job_detail_new/jobid/" . $_POST['j_id'], time() + 3600, "/");
                        echo json_encode(array("code" => 400, "msg" => "未登录"));
                        die;
                }

                $uid = $userinfo['userid'];
                $data['j_id'] = $_POST['j_id'];
                $data['t_id'] = $uid;
                $data['bt_id'] = $_POST['bt_id'];
                $data['posttime'] = time();
                $data['audstartdate'] = $_POST['audstartdate'];

                $arJob = M("job")->where("id=" . $data['j_id'])->find();

                $sJobTitle = $arJob['title'];
                if ($sJobTitle == '0') {
                        $sJobTitle = getCascList($arJob['Jobcate'], "信息不明");
                }
                $data['j_title'] = $sJobTitle;

                $recordOb = M("record");
                $isRecord = $recordOb->where("j_id=" . $data['j_id'] . " and bt_id=" . $data['bt_id'])->find();
                if (!empty($isRecord)) {
                        echo json_encode(array("code" => 500, "msg" => "该简历已经推荐给该职位"));
                        die;
                }
                $re = $recordOb->add($data);
                if ($re) {
                        /*                         * *************【推荐候选人】操作日志 begin******************************** */

                        $username = $userinfo['username'];
                        $arResume = M("resume")->where("id=" . $data['bt_id'])->find();
                        $sRecommended = $arResume['username'];  //候选人名称

                        $arCompany = M("company")->where("id=" . $arJob['cpid'])->find();
                        $sCompanyName = $arCompany['cpname']; //公司名称

                        $arNoticeInfo = getTNoticeInfo(1, $sRecommended, $sCompanyName, $sJobTitle);
                        $sLogtitle = $arNoticeInfo[0];
                        $sLogContent = $arNoticeInfo[1];

                        $arNotice = array(
                            "uid" => $uid,
                            "username" => $username,
                            "bt_id" => $data['bt_id'],
                            "j_id" => $data['j_id'],
                            "title" => $sLogtitle,
                            "content" => $sLogContent,
                            "created_at" => time(),
                            "updated_at" => time()
                        );
                        M("notice_log")->add($arNotice);

                        /*                         * *************【推荐候选人】操作日志 end******************************** */

                        echo json_encode(array("code" => "200", "msg" => "保存成功"));
                        die;
                } else {
                        echo json_encode(array("code" => "500", "msg" => "保存失败"));
                        die;
                }
        }

        /*
         * 增加推荐人/在线简历
         */

        public function add_resume_new() {

                //如果为登陆，跳转到login页面
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/add_resume_new", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                }
                setcookie("gourl", "", time() - 1, "/");

                foreach ($_POST as $k => $v) {
                        $_POST[$k] = I("post." . $k, '', 'htmlspecialchars');
                }
                //在职状态
                $objCascadedata = M("cascadedata");
                $arCascadedataInfo = $objCascadedata->where("datagroup='zzstart'")->select();
                $this->assign("stateArr", $arCascadedataInfo);

                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "推荐职位", "url" => "/index.php?s=/Job/job_list", "img" => "/Public/new-images/head-icon/m-icon7.png"),
                    array("name" => "职位收藏", "url" => "/index.php?s=/Job/fav_job", "img" => "/Public/new-images/head-icon/m-icon8.png"),
                );
                //传入头部信息
                $this->assign("data", $_POST);
                $this->assign("select", "collect");
                $this->assign("header_title", "在线简历");
                $this->assign("lArr", $lArr);


                $this->display("./Job/add_resume");
        }

        /*
         * 增加推荐人/在线简历
         */

        public function add_resume() {

                if (!empty($_SESSION['cuserinfo'])) {
                        header("location:/");
                        die;
                }
                //如果为登陆，跳转到login页面
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/add_resume", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                }
                setcookie("gourl", "", time() - 1, "/");

                foreach ($_POST as $k => $v) {
                        $_POST[$k] = I("post." . $k, '', 'htmlspecialchars');
                }
                //在职状态
                $objCascadedata = M("cascadedata");
                $arCascadedataInfo = $objCascadedata->where("datagroup='zzstart'")->select();
                $this->assign("stateArr", $arCascadedataInfo);

                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "在线简历", "url" => "/index.php?s=/Job/add_resume", "img" => "/Public/new-images/head-icon/m-icon5.png"),
                    array("name" => "候选人列表", "url" => "/index.php?s=/Usercenter/recommend_info", "img" => "/Public/new-images/head-icon/m-icon6.png"),
                );
                //传入头部信息
                $this->assign("data", $_POST);
                $this->assign("select", "resume");
                $this->assign("header_title", "在线简历");
                $this->assign("lArr", $lArr);

                $this->display("./Job/onlineresume");
        }

        /*
         * 保存增加的推荐人信息
         */

        public function add_resume_save() {

                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/add_resume", time() + 3600, "/");
                        echo json_encode(array("code" => "400", "msg" => "未登录"));
                        die;
                }
                $uid = $userinfo['userid'];
                setcookie("gourl", "", time() - 1, "/");

                foreach ($_POST as $k => $v) {
                        $_POST[$k] = I("post." . $k, '', 'htmlspecialchars');
                }
                if ((empty($_POST['username']) || empty($_POST['mobile']) || empty($_POST['exper']) || empty($_POST['age']) || empty($_POST['email']) || empty($_POST['qqnum']) || empty($_POST['because']) || empty($_POST['personal']) || empty($_POST['edu']) || empty($_POST['zige'])) && $_POST['type']) {
                        echo json_encode(array("code" => "500", "msg" => "请完善简历信息"));
                        die;
                } elseif (empty($_POST['username']) || empty($_POST['mobile'])  || empty($_POST['keyword'])  || empty($_POST['exper']) || empty($_POST['because']) || empty($_POST['edu'])) {
                        echo json_encode(array("code" => "500", "msg" => "请完善简历信息"));
                        die;
                }
                if (!is_numeric($_POST['age']) && !empty($_POST['type'])) {
                        echo json_encode(array("code" => "500", "msg" => "请输入正确的年龄"));
                        die;
                }
                $rule = "/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/";
                preg_match($rule, $_POST['email'], $result);
                if (!$result && !empty($_POST['type'])) {
                        echo json_encode(array("code" => "500", "msg" => "请输入正确的邮箱"));
                        die;
                }
                if (!is_numeric($_POST['qqnum']) && !empty($_POST['type'])) {
                        echo json_encode(array("code" => "500", "msg" => "请输入正确的qq号码"));
                        die;
                }

                $rule1 = "/^1[0-9]{10}$/A";
                preg_match($rule1, $_POST['mobile'], $result1);
                if (!$result1) {
                        echo json_encode(array("code" => "500", "msg" => "请输入正确的手机号码"));
                        die;
                }
                if ($_POST['type']) {
                        $data['type'] = $_POST['type'];
                } else {
                        if ($_COOKIE['upload']) {
                                $data['type'] = 5;
                        }
                }
                $data['username'] = $_POST['username'];
                $data['sex'] = $_POST['sex']?$_POST['sex']:"";
                $data['age'] = $_POST['age']?$_POST['age']:"";
                $data['state'] = $_POST['state']?$_POST['state']:"";
                $data['mobile'] = $_POST['mobile'];
                $data['email'] = $_POST['email'] ? $_POST['email'] : "";
                $data['qqnum'] = $_POST['qqnum'] ? $_POST['qqnum'] : "";
                $data['because'] = $_POST['because'];
                $data['personal'] = $_POST['personal'] ? $_POST['personal'] : "";
                $data['keyword'] = $_POST['keyword'] ? $_POST['keyword'] : "";
                $data['job_id'] = 0;
                $data['t_id'] = $uid;
                $data['keyid'] = getMillisecond();
                $data['audreason'] = 0;
                $data['posttime'] = time();

                $resumeOb = M("resume");
                $resumeOb->add($data);
                $iResumeid = $resumeOb->getLastInsID(); //最后插入的简历id
                //echo $resumeOb -> getLastSql();


                if ($_POST['edu']) {
                        $education = array();
                        $education['keyid'] = $data['keyid'];
                        $education['starttime'] = 0;
                        $education['endtime'] = 0;
                        $education['schoolname'] = 0;
                        $education['profess'] = 0;
                        $education['academic'] = 0;
                        $education['checkinfo'] = true;
                        $education['content'] = $_POST['edu'];
                        M("education")->add($education);
                }
                if ($_POST['exper']) {
                        $workexper = array();
                        $workexper['keyid'] = $data['keyid'];
                        $workexper['starttime'] = 0;
                        $workexper['endtime'] = 0;
                        $workexper['pname'] = 0;
                        $workexper['salary'] = 0;
                        $workexper['releaving'] = 0;
                        $workexper['checkinfo'] = true;
                        $workexper['intro'] = $_POST['exper'];
                        M("workexper")->add($workexper);
                }
                if ($_POST['zige']) {
                        $cercate = array();
                        $cercate['keyid'] = $data['keyid'];
                        $cercate['ceaname'] = 0;
                        $cercate['zhengshu'] = $_POST['zige'];
                        M("cercate")->add($cercate);
                }

                /*                 * **************【增加候选人】操作日志 begin************************* */

                $username = $userinfo['username'];
                $arNoticeInfo = getTNoticeInfo(0, $data['username']);
                $sLogtitle = $arNoticeInfo[0];
                $sLogContent = $arNoticeInfo[1];

                $arNotice = array(
                    "uid" => $uid,
                    "username" => $username,
                    "bt_id" => $iResumeid,
                    "title" => $sLogtitle,
                    "content" => $sLogContent,
                    "created_at" => time(),
                    "updated_at" => time()
                );

                M("notice_log")->add($arNotice);

                /*                 * **************【增加候选人】操作日志 end************************* */
                
                echo json_encode(array("code" => "200", "msg" => $iResumeid));
                die;
        }

        /*
         * 点击输入长内容时 跳转到的页面
         */

        public function text() {

                //如果为登陆，跳转到login页面
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/add_resume", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                }
                setcookie("gourl", "", time() - 1, "/");

                foreach ($_POST as $k => $v) {
                        $_POST[$k] = I("post." . $k, '', 'htmlspecialchars');
                }

                //echo "<pre>";var_dump($_POST);echo "</pre>";
                //为引入的头部传入标题
                $lArr = array(
                        // array("name" => "被推荐人", "url" => "/index.php?s=/Usercenter/recommend_info"),
                );
                //传入头部信息
                $this->assign("header_title", $_POST['desc']);
                $this->assign("lArr", $lArr);

                $this->assign("data", $_POST);
                $this->display("./Job/text");
        }

        /*
         * 点击输入长内容时 跳转到的页面
         */

        public function resume_text() {

                //如果为登陆，跳转到login页面
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/index.php?s=/Job/add_resume", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                }
                setcookie("gourl", "", time() - 1, "/");

                foreach ($_POST as $k => $v) {
                        $_POST[$k] = I("post." . $k, '', 'htmlspecialchars');
                }

                //echo "<pre>";var_dump($_POST);echo "</pre>";
                //为引入的头部传入标题
                $lArr = array(
                        // array("name" => "被推荐人", "url" => "/index.php?s=/Usercenter/recommend_info"),
                );
                //传入头部信息
                $this->assign("header_title", $_POST['desc']);
                $this->assign("lArr", $lArr);

                $this->assign("data", $_POST);
                $this->display("./Job/text_new");
        }

        /*
         * 
         */

        public function saveShareUrl() {
                $urlTmp = explode("share=", $_POST['url']);
                $data = array();

                $data['decrypturl'] = $_POST['url'];
                $url = decrypt($urlTmp[1], "share");

                $username = $_SESSION['userinfo']['username'];

                //如果是分享连接
                if ((strpos($url, "tag") !== false) && (strpos($url, "channel") !== false) && $username) {
                        $userinfo = M("userinfo")->where("username='$username'")->find();
                        $arUrl = explode("&", $url);
                        $shareUrl = array();
                        foreach ($arUrl as $u) {
                                $au = explode("=", $u);
                                $shareUrl[$au[0]] = $au[1];
                        }
                        $shareUrl2 = $urlTmp[0];
                        $shareUrlTmp = "tag=" . $shareUrl['tag'] . "&channel=" . $shareUrl['channel'] . "&aid=" . $shareUrl['aid'] . "&uname=" . $username;
                        $shareUrl2 = $shareUrl2 . $shareUrlTmp;
                        $data['url'] = $shareUrl2;
                        $activeInfo = M("active")->where("id='$shareUrl[aid]'")->find();
                        $data['uid'] = $userinfo['userid'];
                        $data['username'] = $userinfo['username'];
                        $data['tag'] = $shareUrl['tag'];
                        $data['channel'] = $shareUrl['channel'];
                        $data['activeid'] = $shareUrl['aid'];
                        $data['activename'] = $activeInfo['activename'];
                        $data['click'] = 0;
                        $data['num'] = 0;
                        $data['comment'] = '';
                        $data['created_at'] = $data['updated_at'] = time();
                        $isExit = M("share")->where("decrypturl='$_POST[url]' and status=1")->find();

                        if (!$isExit) {
                                M("share")->add($data);
                        }
                }
        }

        /*
         * 关于我们的职位 线上新媒体推广
         */

        public function new_job33() {
                //分享相关
                $requestUrl = $_SERVER['QUERY_STRING'];
                $shareUrl = "http://192.168.1.109:8106/index.php";
                if ($_SESSION['userinfo']['username']) {
                        $username = $_SESSION['userinfo']['username'];
                        $shareUrlTmp = "tag=ShareJob&channel=WebShare&aid=" . C('SHARE_JOB_ID') . "&uname=" . $username;

                        $shareUrl = $shareUrl . "?" . $requestUrl . "&share=" . encrypt($shareUrlTmp, "share");
                } else {
                        $username = "";
                        $shareUrl = $shareUrl . "?" . $requestUrl;
                }
                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////

                $shareUrl2 = rtrim($_GET['share'], ".html");
                $url = decrypt($shareUrl2, "share");
                if ($url == false) {
                        $shareUrl2 = str_replace(" ", "+", $shareUrl2);
                        $url = decrypt($shareUrl2, "share");
                }

                $isShare = 0;
                //如果是分享连接
                if ((strpos($url, "tag") !== false) && (strpos($url, "channel") !== false)) {
                        $isShare = true;
                        $arUrl = explode("&", $url);
                        $shareUrl2 = array();
                        foreach ($arUrl as $u) {
                                $au = explode("=", $u);
                                $shareUrl2[$au[0]] = $au[1];
                        }

                        $_SESSION['shareurl'] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                        $_SESSION['backurl'] = $_SERVER['HTTP_REFERER'];
                        $_SESSION['sharetag'] = $shareUrl2['tag'];
                        $_SESSION['sharechannel'] = $shareUrl2['channel'];
                        $_SESSION['shareaid'] = $shareUrl2['aid'];
                        $_SESSION['shareuname'] = $shareUrl2['uname'];
                }
                //echo "<pre>";var_dump($_SESSION);echo "</pre>";
                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////
                //是否分享过来的连接需要登陆
                if ($_SESSION['userinfo']['username']) {
                        $isShare = 0;
                }
                //如果不是分享过来的，则判断登陆没有，如果没有登陆则不允许浏览
//                if ($isShare == true || !$_SESSION['userinfo']['username']) {
//                        setcookie("gourl", "/index.php?s=/Job/job_detail/id/" . $id, time() + 3600, "/");
//                        header("location:/index.php?s=/Login/login");
//                } else {
//                        setcookie("gourl", "", time() - 1, "/");
//                }

                $title = "线上新媒体推广";
                $cpname = "北京众聘科技有限公司";
                $employ = "1";
                $treatmentdata = "7k-12k";
                $Tariff = "";

                $share['url'] = $shareUrl;
                $share['title'] = "即刻分享" . $title . "职位，立得N个“百元”现金。";
                //$share['description'] = "[renrenlie.com] " . $cpname . "直招" . $title . "职位" . $employ . "人,月薪:" . $treatmentdata . " ，推荐或自荐成功入职即得推荐费" . $Tariff . "元。";
                $share['description'] = "[renrenlie.com] " . $cpname . "直招" . $title . "职位" . $employ . "人,月薪:" . $treatmentdata . "。";
                $this->assign("shareurl", $shareUrl);
                $this->assign("share", $share);
                $this->display();
        }

        /*
         * 关于我们的职位 线下活动策划执行
         */

        public function new_job44() {
                //分享相关
                $requestUrl = $_SERVER['QUERY_STRING'];
                $shareUrl = "http://m.renrenlie.com/index.php";
                if ($_SESSION['userinfo']['username']) {
                        $username = $_SESSION['userinfo']['username'];
                        $shareUrlTmp = "tag=ShareJob&channel=WebShare&aid=" . C('SHARE_JOB_ID') . "&uname=" . $username;

                        $shareUrl = $shareUrl . "?" . $requestUrl . "&share=" . encrypt($shareUrlTmp, "share");
                } else {
                        $username = "";
                        $shareUrl = $shareUrl . "?" . $requestUrl;
                }
                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////

                $shareUrl2 = rtrim($_GET['share'], ".html");
                $url = decrypt($shareUrl2, "share");
                if ($url == false) {
                        $shareUrl2 = str_replace(" ", "+", $shareUrl2);
                        $url = decrypt($shareUrl2, "share");
                }

                $isShare = 0;
                //如果是分享连接
                if ((strpos($url, "tag") !== false) && (strpos($url, "channel") !== false)) {
                        $isShare = true;
                        $arUrl = explode("&", $url);
                        $shareUrl2 = array();
                        foreach ($arUrl as $u) {
                                $au = explode("=", $u);
                                $shareUrl2[$au[0]] = $au[1];
                        }

                        $_SESSION['shareurl'] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                        $_SESSION['backurl'] = $_SERVER['HTTP_REFERER'];
                        $_SESSION['sharetag'] = $shareUrl2['tag'];
                        $_SESSION['sharechannel'] = $shareUrl2['channel'];
                        $_SESSION['shareaid'] = $shareUrl2['aid'];
                        $_SESSION['shareuname'] = $shareUrl2['uname'];
                }
                //echo "<pre>";var_dump($_SESSION);echo "</pre>";
                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////
                //是否分享过来的连接需要登陆
                if ($_SESSION['userinfo']['username']) {
                        $isShare = 0;
                }
                //如果不是分享过来的，则判断登陆没有，如果没有登陆则不允许浏览
//                if ($isShare == true || !$_SESSION['userinfo']['username']) {
//                        setcookie("gourl", "/index.php?s=/Job/job_detail/id/" . $id, time() + 3600, "/");
//                        header("location:/index.php?s=/Login/login");
//                } else {
//                        setcookie("gourl", "", time() - 1, "/");
//                }

                $title = "线下活动策划";
                $cpname = "北京众聘科技有限公司";
                $employ = "1";
                $treatmentdata = "7k-12k";
                $Tariff = "";

                $share['url'] = $shareUrl;
                $share['title'] = "即刻分享" . $title . "职位，立得N个“百元”现金。";
                //$share['description'] = "[renrenlie.com] " . $cpname . "直招" . $title . "职位" . $employ . "人,月薪:" . $treatmentdata . " ，推荐或自荐成功入职即得推荐费" . $Tariff . "元。";
                $share['description'] = "[renrenlie.com] " . $cpname . "直招" . $title . "职位" . $employ . "人,月薪:" . $treatmentdata . "。";
                $this->assign("shareurl", $shareUrl);
                $this->assign("share", $share);
                $this->display();
        }

}
