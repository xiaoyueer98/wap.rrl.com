<?php

/*
 * ְJobModel
 */

class JobModel extends Model
{
        /*
         * 获取最新职位数据总条数
         * @param  
         * @return int
         */

        public function new_job_count($title="")
        {
                
                $WebChatModel = M('job');
                if(empty($title)){
                        $sql = "select count(*) as num from stj_job where  stj_job.is_show=1 and stj_job.employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0";
                }else{
                        //关键词模糊查询
                        $keywordGroup = M("keyword_group")->where("keyword_group like '%" . $title . "%'")->getField("keyword_group");
                        if ($keywordGroup) {
                                $arKeywordGroup = explode(" ", $keywordGroup);
                                $titleTmp = "";
                                foreach ($arKeywordGroup as $keyword) {
                                        if ($keyword) {
                                                $titleTmp .=" or title like '%" . $keyword . "%' ";
                                        }
                                }
                        }
                        if (strlen($titleTmp) > 0) {
                                $where .=" (title like '%" . $title . "%' " . $titleTmp . ")  ";
                        } else {
                                $where .=" (title like '%" . $title . "%')  ";
                        }
                        $sql = "select count(*) as num from stj_job where {$where} and stj_job.is_show=1 and stj_job.employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0";
                }

                $countArr = $WebChatModel->query($sql);
                return $countArr[0]['num'];
        }

        /*
         * 获取最新职位列表
         * @param  
         * @return array
         */

        public function new_job_list($limit,$title="")
        {
                if(empty($title)){
                        $sql         = "select * from stj_job where stj_job.is_show=1 and stj_job.employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 order by orderid asc, checktime desc,starttime desc limit $limit";
                }else{
                        //关键词模糊查询
                        $keywordGroup = M("keyword_group")->where("keyword_group like '%" . $title . "%'")->getField("keyword_group");
                        if ($keywordGroup) {
                                $arKeywordGroup = explode(" ", $keywordGroup);
                                $titleTmp = "";
                                foreach ($arKeywordGroup as $keyword) {
                                        if ($keyword) {
                                                $titleTmp .=" or title like '%" . $keyword . "%' ";
                                        }
                                }
                        }
                        if (strlen($titleTmp) > 0) {
                                $where .=" (title like '%" . $title . "%' " . $titleTmp . ")  ";
                        } else {
                                $where .=" (title like '%" . $title . "%')  ";
                        }
                        
                        $sql = "select * from stj_job where {$where}  and stj_job.is_show=1  and stj_job.employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 order by orderid asc, checktime desc,starttime desc limit $limit";  
                }
                $return_data = $this->table('stj_job job')->query($sql);
                //echo "<pre>";var_dump($return_data);echo"</pre>";
                //得到岗位名称信息
                foreach ($return_data as $k => $v)
                {

                        $com_sql         = "select com.cpname,com.scale,com.id cpid from stj_company com where  com.id=" . $v['cpid']; //关联公司信息
                        $cas_sql         = "select cas.cascname from stj_casclist cas where cas.id=" . $v['jobplace']; //关联casclist
                        $recommended_sql = "select count(*) as num from stj_record where stj_record.j_id = {$v['id']}";
                        //echo $recommended_sql;die;
                        $return_data_com = $this->table('stj_company com')->query($com_sql);
                        //echo"<pre>";var_dump($return_data_com);echo"</pre>";
                        $return_data_cas = $this->table('stj_casclist cas')->query($cas_sql);
                        //echo"<pre>";var_dump($return_data_cas);echo"</pre>";
                        $recommendedArr  = $this->table('stj_record')->query($recommended_sql);
                        foreach ($return_data_com[0] as $k1 => $v1)
                        {
                                $return_data[$k][$k1] = $v1;
                        }
                        foreach ($return_data_cas[0] as $k1 => $v1)
                        {
                                $return_data[$k][$k1] = $v1;
                        }
                        //发布时间
                        $return_data[$k]['starttime']     = (($return_data[$k]['checktime'] != 0) ? date('Y-m-d', $return_data[$k]['checktime']) : date('Y-m-d', $return_data[$k]['starttime']));
                        //得到 公司规模 信息
                        $scaledata                        = getCascData('scale', $return_data_com[0]['scale'], "信息不明");
                        $return_data[$k]['scaledata']     = $scaledata;
                        //得到 学历要求 数据
                        $educationdata                    = getCascData('education', $return_data[$k]['education'], "信息不明");
                        $return_data[$k]['educationdata'] = $educationdata;

                        $return_data[$k]['recommendednum'] = $recommendedArr[0]['num'];
                        $return_data[$k]['posttimedata']   = timeFormat($return_data[$k]['posttime'], $format                            = 'Y-m-d');
                        $return_data[$k]['starttimedata']  = timeFormat($return_data[$k]['starttime'], $format                            = 'Y-m-d');
                        //得到 职位名称 数据
                        if (empty($return_data[$k]['title']))
                        {

                                $return_data[$k]['title'] = getCascList($return_data[$k]['Jobcate'], "信息不明");
                        }
                        //得到 薪资待遇 数据

                        $treatmentdata                    = getCascData('treatment', $return_data[$k]['treatment'], "信息不明");
                        $arTreatmentdata                  = explode("-", str_replace("元", "", $treatmentdata));
                         if(count($arTreatmentdata) ==1){
                            $return_data[$k]['treatmentdata'] = "80K以上";
                        }else{
                             $return_data[$k]['treatmentdata'] = ($arTreatmentdata[0] / 1000) . "K-" . ($arTreatmentdata[1] / 1000) . "K";
                        }
                        

                        //得到 工作经验 数据

                        $experiencedata                    = getCascData('experience', $return_data[$k]['experience'], "信息不明");
                        $return_data[$k]['experiencedata'] = str_replace("工作经验", "", $experiencedata);

                        //招聘资费处理
                        if ($return_data[$k]['Tariff'] > 10)
                        {

                                $return_data[$k]['Tariff'] = floor($return_data[$k]['Tariff'] * 0.8 / 100) * 100;
                        }
                        else
                        {
                                $return_data[$k]['Tariff'] = floor($return_data[$k]['treatment'] * $return_data[$k]['Tariff'] * 12 * 0.8 / 100) * 100;
                        }
                        //echo "<pre>";var_dump($return_data);echo"</pre>";
                }
                return $return_data;
        }

        /*
         * 获取职位详情
         * @param  
         * @return array
         */

        public function get_detail($id)
        {

                if (!is_numeric($id))
                {



                        $return_data = $this->table('stj_job job')
                                ->field('job.title,job.report,job.report_number,job.type,job.employ,job.starttime,job.orderid,job.posttime,job.experience,job.jobplace,job.education,job.endtime,job.joblang,job.employ,com.cpname,com.remark,job.softlytip,com.webname,job.email,job.mobile,com.address,com.stage,com.nature,com.scale,com.brightreg,com.intro,com.bright,job.content,job.workdesc,job.treatment,job.Tariff,job.Jobcate,job.strycate,cas.cascname,com.id as cpid,job.id')
                                ->join('inner join stj_company com ON job.cpid = com.id')
                                ->join('inner join stj_casclist cas ON job.Jobplace = cas.id  and  job.guid="' . $id . '"')
                                ->find();
                        //echo $this->table('stj_job job') -> getLastSql();
                }
                else
                {
                        $return_data = $this->table('stj_job job')
                                ->field('job.title,job.report,job.report_number,job.type,job.employ,job.starttime,job.orderid,job.posttime,job.experience,job.jobplace,job.education,job.endtime,job.joblang,job.employ,com.cpname,com.remark,job.softlytip,com.webname,job.email,job.mobile,com.address,com.stage,com.nature,com.scale,com.brightreg,com.intro,com.bright,job.content,job.workdesc,job.treatment,job.Tariff,job.Jobcate,job.strycate,cas.cascname,com.id as cpid,job.id')
                                ->join('inner join stj_company com ON job.cpid = com.id')
                                ->join('inner join stj_casclist cas ON job.Jobplace = cas.id  and  job.id=' . $id)
                                ->find();
                }


//                $return_data = $this->table('stj_job job')
//                        ->field('job.title,job.employ,job.starttime,job.posttime,job.experience,job.jobplace,job.education,job.endtime,job.joblang,com.cpname,com.webname,job.email,job.mobile,com.address,com.stage,com.nature,com.scale,job.content,job.workdesc,job.treatment,job.Tariff,job.Jobcate,job.strycate,cas.cascname,com.id as cpid,job.id')
//                        ->join('inner join stj_company com ON job.cpid = com.id')
//                        ->join('inner join stj_casclist cas ON job.jobplace = cas.id  and  job.id=' . $id)
//                        ->find();
                //echo $this->table('stj_job job') -> getLastSql();
                if (empty($return_data))
                {
                        return $return_data;
                }
                //得到岗位名称信息
                if (empty($return_data['title']))
                {

                        $return_data['title'] = getCascList($return_data['Jobcate'], "信息不明");
                }
                //保留原来招聘资费
                $return_data['Tariff_old'] = $return_data['Tariff'];
                //招聘资费处理
                if ($return_data['Tariff'] > 10)
                {

                        $return_data['Tariff'] = floor($return_data['Tariff'] * 0.8 / 100) * 100;
                }
                else
                {
                        $return_data['Tariff'] = floor($return_data['treatment'] * $return_data['Tariff'] * 12 * 0.8 / 100) * 100;
                }
                //格式化公司成立日期
                $return_data['brightreg'] = date("Y-m-d", $return_data['brightreg']);
                //得到 公司阶段 数据

                $stagedata                = getCascData('stage', $return_data['stage'], "信息不明");
                $return_data['stagedata'] = $stagedata;

                //得到 公司性质 信息

                $naturedata                = getCascData('nature', $return_data['nature'], "信息不明");
                $return_data['naturedata'] = $naturedata;

                //得到 公司规模 信息

                $scaledata                = getCascData('scale', $return_data['scale'], "信息不明");
                $return_data['scaledata'] = $scaledata;

                //得到 行业类别 信息

                $strycatedata                = getCascList($return_data['strycate'], "信息不明");
                $return_data['strycatedata'] = $strycatedata;


                $joblangdata                = getCascData('joblang', $return_data['joblang'], "无要求");
                $return_data['joblangdata'] = $joblangdata;



                //得到 职位类别 信息

                $Jobcatedata                = getCascList($return_data['Jobcate'], "信息不明");
                $return_data['Jobcatedata'] = $Jobcatedata;

                //得到 工作地点 信息

                $jobplacedata                = getCascList($return_data['jobplace'], "信息不明");
                $return_data['jobplacedata'] = $jobplacedata;

                //得到 薪资待遇 数据

                $treatmentdata                = getCascData('treatment', $return_data['treatment'], "信息不明");
                $return_data['treatmentdata'] = $treatmentdata;

                //得到 工作经验 数据

                $experiencedata                = getCascData('experience', $return_data['experience'], "信息不明");
                $return_data['experiencedata'] = $experiencedata;

                //得到 学历要求 数据

                $educationdata                = getCascData('education', $return_data['education'], "信息不明");
                $return_data['educationdata'] = $educationdata;

                //将endtime时间变成字符串形式
                $return_data['endtimedata']   = date("Y-m-d", $return_data['endtime']);
                //将starttime时间变成字符串形式
                $return_data['starttimedata'] = date("Y-m-d", $return_data['starttime']);



                //查看已推荐人数
                $recommended_sql               = "select count(*) as num from stj_record where stj_record.j_id = {$id}";
                $recommendedArr                = $this->table('stj_record')->query($recommended_sql);
                $return_data['recommendednum'] = $recommendedArr[0]['num'];

                //echo $this ->getLastSql();
                //var_dump($return_data);
                return $return_data;
        }

        /*
         * 获取我的推荐数据总条数
         * @param  
         * @return int
         */

        public function recommend_job_count($type = 1, $uid)
        {

                $WebChatModel = M('job');
                if ($type == 1)
                {
                        $sql = "select count(*) as num from stj_job job join stj_record rec on job.id=rec.j_id  and job.employ>(select count(*) from stj_record  rec where rec.j_id = job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 and rec.t_id=$uid";
                        //echo $sql;
                }
                else
                {
                        $sql = "select count(*) as num from stj_job job join stj_record rec on job.id=rec.j_id  and rec.t_id=$uid and checkinfo='true' and (job.employ<(select count(*) from stj_record  rec where rec.j_id = job.id and audstart=6)  or is_deleted=1  or endtime < unix_timestamp(now()))";
                        //echo $sql;
                }
                $countArr = $WebChatModel->query($sql);
                return $countArr[0]['num'];
        }

        /*
         * 获取我的推荐数据列表
         * @param  
         * @return Array
         */

        public function getRecommendJob($type = 1, $limit, $uid)
        {

                if ($type == 1)
                {
                        $sql = "select *,rec.id recordid from stj_job job join stj_record rec on job.id=rec.j_id  and job.employ>(select count(*) from stj_record  rec where rec.j_id = job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 and rec.t_id=$uid order by orderid asc, starttime desc limit $limit";
                        //echo $sql;
                }
                else
                {
                        $sql = "select *,rec.id recordid from stj_job job join stj_record rec on job.id=rec.j_id  and rec.t_id=$uid and (job.employ<(select count(*) from stj_record  rec where rec.j_id = job.id and audstart=6)  or  is_deleted=1 or endtime < unix_timestamp(now())) order by orderid asc, starttime desc limit $limit";
                        //echo $sql;
                }
                $return_data = $this->table('stj_job')->query($sql);
                foreach ($return_data as $k => $v)
                {

                        //通过简历id bt_id 得到被推荐人姓名
                        $resumeOb                    = M("resume");
                        $resumeArr                   = $resumeOb->where("id=" . $return_data[$k]["bt_id"])->find();
                        $return_data[$k]['username'] = $resumeArr['username'];
                        //通过公司id cpid 得到公司名字
                        $comOb                       = M("company");
                        $comArr                      = $comOb->field('cpname')->where("id=" . $return_data[$k]["cpid"])->find();
                        $return_data[$k]['cpname']   = $comArr['cpname'];

                        //得到岗位名称信息
                        if (empty($return_data[$k]['title']))
                        {

                                $return_data[$k]['title'] = getCascList($return_data[$k]['Jobcate'], "信息不明");
                        }
                        //通过工作地点的信息
                        $cascOb                      = M("casclist");
                        $cascArr                     = $cascOb->field('cascname')->where("id=" . $return_data[$k]['jobplace'])->find();
                        $return_data[$k]['cascname'] = $cascArr['cascname'];

                        //得到 薪资待遇 数据
                        $treatmentdata                    = getCascData('treatment', $return_data[$k]['treatment'], "信息不明");
                        $arTreatmentdata                  = explode("-", str_replace("元", "", $treatmentdata));
                        $return_data[$k]['treatmentdata'] = ($arTreatmentdata[0] / 1000) . "K-" . ($arTreatmentdata[1] / 1000) . "K";


                        //招聘资费处理
                        if ($return_data[$k]['Tariff'] > 10)
                        {

                                $return_data[$k]['Tariff'] = floor($return_data[$k]['Tariff'] * 0.8 / 100) * 100;
                        }
                        else
                        {
                                $return_data[$k]['Tariff'] = floor($return_data[$k]['treatment'] * $return_data[$k]['Tariff'] * 12 * 0.8 / 100) * 100;
                        }
                        //得到 面试状态 信息

                        $audstartdata                    = getCascData('audstart', $return_data[$k]['audstart'], "信息不明");
                        $return_data[$k]['audstartdata'] = $audstartdata;

                        //已推荐的人数
                        $recommended_sql                 = "select count(*) as num from stj_record where stj_record.j_id = {$v['id']}";
                        $recommendedArr                  = $this->table('stj_record')->query($recommended_sql);
                        $return_data[$k]['recommendnum'] = $recommendedArr[0]['num'];
                }
                return $return_data;
        }

        /*
         * 获取招聘职位
         * @param  
         * @return Array
         */

        public function getCurrentJobList($cpid, $type, $start, $len)
        {

                $today = strtotime(date("Y-m-d"));
                if ($type == 1)
                {
                        $arJobList = M("job")->where("cpid='$cpid' and is_deleted = 0 and endtime>$today")->select();
                        $jobidlist = array();
                        if ($arJobList)
                        {
                                foreach ($arJobList as $jobinfo)
                                {
                                        if ($type == 1)
                                        {
                                                $recordCount = M("record")->where("j_id='$jobinfo[id]' and audstart=6")->count();

                                                if ($recordCount < $jobinfo['employ'])
                                                {
                                                        array_push($jobidlist, $jobinfo['id']);
                                                }
                                        }
                                }
                        }
                }
                else
                {
                        $arJobList = M("job")->where("cpid='$cpid' and is_deleted = 0")->select();
                        $jobidlist = array();
                        if ($arJobList)
                        {
                                foreach ($arJobList as $jobinfo)
                                {
                                        $recordCount = M("record")->where("j_id='$jobinfo[id]' and audstart=6")->count();

                                        if (($jobinfo['endtime'] < strtotime(date("Y-m-d H:i:s"))) || $recordCount >= $jobinfo['employ'])
                                        {
                                                array_push($jobidlist, $jobinfo['id']);
                                        }
                                }
                        }
                }
                if (!empty($jobidlist))
                {
                        $idIn    = implode(",", $jobidlist);
                        $count   = M("job")->where("cpid = '$cpid' and is_deleted = 0 and id in (" . $idIn . ")")->count();
                        $jobList = M("job")->where("cpid = '$cpid' and is_deleted = 0 and id in (" . $idIn . ")")->order("starttime desc")->limit($start, $len)->select();
                        if ($jobList)
                        {
                                $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * $size + 1;
                                foreach ($jobList as $key => &$job)
                                {
                                        $jobid                    = $job['id'];
                                        $jobList[$key]['endtime'] = date("Y-m-d", $job['endtime']);
                                        $jobList[$key]['status']  = (($job['checkinfo'] == "true") ? "审核通过" : "正在审核");
                                        $total                    = M("record")->where("j_id = '$jobid' and status=2")->count();
                                        $noread                   = M("record")->where("j_id = '$jobid' and status=2 and news_status = 0 ")->count();

                                        $jobList[$key]['total']  = $total;
                                        $jobList[$key]['noread'] = $noread ? $noread : 0;
                                        if (!$job['title'])
                                        {
                                                $job['title'] = M("casclist")->where("id='$job[Jobcate]'")->getField("cascname");
                                        }
                                        else
                                        {
                                                $job['title'] = $job['title'];
                                        }
                                       
                                }
                        }
                }
                else
                {

                        $jobList = array();
                }
                return $jobList;
        }

}

?>