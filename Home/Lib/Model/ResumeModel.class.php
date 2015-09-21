<?php

/*
 * ְResumeModel
 */


class ResumeModel extends Model {
        /*
         * 获取当前用户的可推荐人数目
         * @param  
         * @return int
         */

        public function resume_count($uid) {
                $WebChatModel = M("resume");
                $count = $WebChatModel->where("t_id=" . $uid)->count();

                return $count;
        }

        /*
         * 获取当前用户的可推荐人列表
         * @param  
         * @return array
         */

        public function resume_list($uid, $limit, $jobid) {

                $return_data = $this->table("stj_resume res")
                        ->field("res.username,res.id,res.state,res.sex,res.job_id,res.keyid,res.mobile,res.sex")
                        ->where("t_id=" . $uid)
                        ->order("id desc")
                        ->limit($limit)
                        ->select();
                //echo "<pre>";var_dump($return_data);echo"</pre>";
            
                //得到岗位名称信息
                foreach ($return_data as $k => $v) {
                       

                        //得到 公司阶段 数据

                        $statedata = getCascData('zzstart', $return_data[$k]['state'], "信息不明");
                        $return_data[$k]['statedata'] = $statedata;

                        //判断某个简历是否已经被推荐到这个职位
                        $recordOb = M('record');
//                        $recordArr = $recordOb->where("bt_id=" . $return_data[$k]['id'] . " and t_id=" . $uid . " and j_id=" . $jobid." and (audstart=1 or audstart=3 or audstart=5 or audstart=6) and status !=1")->find();
                        $recordArr = $recordOb->where("bt_id=" . $return_data[$k]['id'] . " and t_id=" . $uid . " and j_id=" . $jobid)->find();
                        //echo $recordOb -> getLastSql();
                        if (!empty($recordArr)) {
                                $return_data[$k]['deadline'] = 1; //已经推荐过得状态
                        } else {
                                $return_data[$k]['deadline'] = 0; //已经推荐过得状态
                        }
                        if($return_data[$k]['sex'] == 0){
                               $return_data[$k]['sex'] = "男"; 
                        }else{
                               $return_data[$k]['sex'] = "女"; 
                        }
                }
                return $return_data;
        }
        
        /*
         * 获取当前用户的可推荐人信息数目
         * @param  
         * @return int
         */

        public function recommend_count($uid) {
                $WebChatModel = M("resume");
                $count = $WebChatModel->where("t_id=" . $uid." and isshow=1")->count();

                return $count;
        }

        
        /*
         * 获取当前用户的可推荐人信息列表
         * @param  
         * @return array
         */

        public function recommend_list($uid, $limit) {

                $return_data = $this->table("stj_resume res")
                        ->field("res.username,res.keyword,res.id,res.state,res.job_id,res.keyid,res.mobile,res.sex")
                        ->where("t_id=" . $uid." and isshow=1")
                        ->order("id desc")
                        ->limit($limit)
                        ->select();

                //echo "<pre>";var_dump($return_data);echo"</pre>";
            
                //得到岗位名称信息
                foreach ($return_data as $k => $v) {

                        //得到 公司阶段 数据

                        $statedata = getCascData('zzstart', $return_data[$k]['state'], "信息不明");
                        $return_data[$k]['statedata'] = $statedata;

                }
                return $return_data;
        }

}

?>