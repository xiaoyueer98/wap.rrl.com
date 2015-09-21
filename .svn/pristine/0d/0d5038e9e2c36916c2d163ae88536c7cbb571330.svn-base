<?php

class RecommendAction extends Action
{

        private $isLogin = false;

        public function __construct()
        {
                parent::__construct();
                $this->isLogin = C("isLogin");
        }

        /*
         * 正在推荐的职位
         */

        public function recommending()
        {

                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_SESSION['userinfo'];

                if (empty($userinfo))
                {
                        setcookie("gourl", "/index.php?s=/Recommend/recommending", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                }
                else
                {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid = $userinfo['userid'];
                }

                $jobOb  = New JobModel();
                $limit  = "0,10";
                $result = $jobOb->getRecommendJob(1, $limit, $uid);

                if (empty($result))
                {
                        $result = array();
                }
                else
                {
                        //echo"<pre>";  var_dump($result);echo "</pre>";die;
                        foreach ($result as $k => $v)
                        {
                                $arNotice = M("notice_log")->where("type=1 and bt_id=" . $v['bt_id'])->order("id desc")->select();
                                if (empty($arNotice))
                                {
                                        $arNotice = array();
                                }
                                else
                                {
                                        foreach ($arNotice as $k1 => $v1)
                                        {
                                                $arNotice[$k1]['posttime'] = date("Y-m-d H:i", $v1['created_at']);
                                        }
                                }

                                $result[$k]['notice_log'] = $arNotice;

                                //查看改用户是否已经评论过该职位
                                $arEvaluate = M("evaluate")->where("uid=" . $uid . " and pid=" . $result[$k]['recordid'] . " and tag='record'")->find();
                                if (empty($arEvaluate))
                                {
                                        $result[$k]['is_evaluate'] = 1;
                                }
                        }
                }
                //echo "<pre>";var_dump($result);echo "</pre>";die;
                $this->assign("result", $result);


                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "正在推荐", "url" => "/index.php?s=/Recommend/recommending", "img" => "/Public/new-images/head-icon/m-icon9.png"),
                    array("name" => "历史推荐", "url" => "/index.php?s=/Recommend/recommended", "img" => "/Public/new-images/head-icon/m-icon10.png"),
                );
                $this->assign("select", "recommend");
                $this->assign("header_title", "正在推荐");
                $this->assign("lArr", $lArr);

                $this->display("recommending");
        }

        public function get_recommending_list()
        {

                $page  = $_POST['page'];
                $size  = $_POST['number'];
                $start = ($page - 1) * $size;

                $jobOb = New JobModel();

                $userinfo = $_SESSION['userinfo'];
                $uid      = $userinfo['userid'];
                $username = $userinfo['username'];

                $num   = $jobOb->recommend_job_count(1, $uid); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $jobOb->getRecommendJob(1, $limit, $uid);


                if (empty($result))
                {

                        $result = array();
                }
                foreach ($result as $k => $v)
                {
                        $arNotice = M("notice_log")->where("type=1 and bt_id=" . $v['bt_id'])->order("id desc")->select();
                        if (empty($arNotice))
                        {
                                $arNotice = array();
                        }
                        else
                        {
                                foreach ($arNotice as $k1 => $v1)
                                {
                                        $arNotice[$k1]['posttime'] = date("Y-m-d H:i", $v1['created_at']);
                                }
                        }

                        $result[$k]['notice_log'] = $arNotice;

                        //查看改用户是否已经评论过该职位
                        $arEvaluate = M("evaluate")->where("uid=" . $uid . " and pid=" . $result[$k]['recordid'] . " and tag='record'")->find();
                        if (empty($arEvaluate))
                        {
                                $result[$k]['is_evaluate'] = 1;
                        }
                }
//                echo "<pre>";var_dump($result);echo "</pre>";die;
                $data = array(
                    'count'  => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        function text_evaluate()
        {
                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "正在推荐", "url" => "/index.php?s=/Recommend/recommending", "img" => "/Public/new-images/head-icon/m-icon9.png"),
                    array("name" => "历史推荐", "url" => "/index.php?s=/Recommend/recommended", "img" => "/Public/new-images/head-icon/m-icon10.png"),
                );

                $this->assign("select", "recommend");
                $this->assign("header_title", "评论");
                $this->assign("lArr", $lArr);

                $this->display("text_evaluate");
        }

        /*
         * 历史推荐的职位
         */

        public function recommended()
        {


                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_SESSION['userinfo'];
                if (empty($userinfo))
                {
                        setcookie("gourl", "/index.php?s=/Recommend/recommended", time() + 3600, "/");
                        header("location:/index.php?s=/Login/login");
                        die;
                }
                else
                {
                        setcookie("gourl", "", time() - 1, "/");
                        $uid = $userinfo['userid'];
                }
                $jobOb  = New JobModel();
                $limit  = "0,10";
                $result = $jobOb->getRecommendJob(2, $limit, $uid);

                if (empty($result))
                {
                        $result = array();
                }
                else
                {
                        //echo"<pre>";  var_dump($result);echo "</pre>";die;
                        foreach ($result as $k => $v)
                        {
                                $arNotice = M("notice_log")->where("type=1 and bt_id=" . $v['bt_id'])->order("id desc")->select();
                                if (empty($arNotice))
                                {
                                        $arNotice = array();
                                }
                                else
                                {
                                        foreach ($arNotice as $k1 => $v1)
                                        {
                                                $arNotice[$k1]['posttime'] = date("Y-m-d H:i", $v1['created_at']);
                                        }
                                }

                                $result[$k]['notice_log'] = $arNotice;

                                //查看改用户是否已经评论过该职位
                                $arEvaluate = M("evaluate")->where("uid=" . $uid . " and pid=" . $result[$k]['recordid'] . " and tag='record'")->find();
                                if (empty($arEvaluate))
                                {
                                        $result[$k]['is_evaluate'] = 1;
                                }
                        }
                }
                //为引入的头部传入标题
                $lArr = array(
                    array("name" => "回到首页", "url" => "/", "img" => "/Public/new-images/head-icon/m-icon1.png"),
                    array("name" => "正在推荐", "url" => "/index.php?s=/Recommend/recommending", "img" => "/Public/new-images/head-icon/m-icon9.png"),
                    array("name" => "历史推荐", "url" => "/index.php?s=/Recommend/recommended", "img" => "/Public/new-images/head-icon/m-icon10.png"),
                );
                $this->assign("result", $result);
                $this->assign("select", "recommend");
                $this->assign("header_title", "历史推荐");
                $this->assign("lArr", $lArr);

                $this->display("recommended");
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

        public function get_recommended_list()
        {

                $page  = $_POST['page'];
                $size  = $_POST['number'];
                $start = ($page - 1) * $size;

                $jobOb = new JobModel();

                $userinfo = $_SESSION['userinfo'];
                $uid      = $userinfo['userid'];
                $username = $userinfo['username'];

                $num   = $jobOb->recommend_job_count(2, $uid); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $jobOb->getRecommendJob(2, $limit, $uid);

                if (empty($result))
                {

                        $result = array();
                }
                foreach ($result as $k => $v)
                {
                        $arNotice = M("notice_log")->where("type=1 and bt_id=" . $v['bt_id'])->order("id desc")->select();
                        if (empty($arNotice))
                        {
                                $arNotice = array();
                        }
                        else
                        {
                                foreach ($arNotice as $k1 => $v1)
                                {
                                        $arNotice[$k1]['posttime'] = date("Y-m-d H:i", $v1['created_at']);
                                }
                        }

                        $result[$k]['notice_log'] = $arNotice;

                        //查看改用户是否已经评论过该职位
                        $arEvaluate = M("evaluate")->where("uid=" . $uid . " and pid=" . $result[$k]['recordid'] . " and tag='record'")->find();
                        if (empty($arEvaluate))
                        {
                                $result[$k]['is_evaluate'] = 1;
                        }
                }
                $data = array(
                    'count'  => $num,
                    'result' => $result,
                );
                //echo "<pre>";var_dump($result);echo "</pre>";die;
                echo json_encode($data);
        }

        /*
         * 评论保存方法 
         * 
         *  params
         *      recordid  招聘记录id
         *      j_id      职位id
         *      pname     公司名称
         *      content   评论内容     
         */

        function add_evaluate()
        {
                $params = $_POST;
                //var_dump($params);die;
                if (!empty($params['recordid']) && !empty($params['j_id']) && !empty($params['pname']) && !empty($params['content']))
                {
                        $userinfo   = $_SESSION['userinfo'];
                        $uid        = $userinfo['userid'];
                        $username   = $userinfo['username'];
                        $arEvaluate = M("evaluate")->where("uid=" . $uid . " and pid=" . $params['recordid'] . " and tag='record'")->find();
                        if (empty($arEvaluate))
                        {

                                $data['pid']        = $params['recordid'];
                                $data['j_id']       = $params['j_id'];
                                $data['pname']      = $params['pname'];
                                $data['content']    = $params['content'];
                                $data['tag']        = "record";
                                $data['loginip']    = $_SERVER['REMOTE_ADDR'];
                                $data['uid']        = $uid;
                                $data['username']   = $username;
                                $data['checkinfo']  = 'true';
                                $data['pid']        = $params['recordid'];
                                $data['created_at'] = $data['updated_at'] = time();
                                M("evaluate")->add($data);
                        }
                }
                if (empty($_POST['type']))
                {
                        header("location:/index.php?s=/Recommend/recommending");
                        die;
                }
                else
                {
                        header("location:/index.php?s=/Recommend/recommended");
                        die;
                }
        }

}
