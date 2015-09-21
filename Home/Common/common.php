<?php

function getCascData($datagroup, $datavalue, $tip) {

        if ($datavalue == "") {
                return $tip;
        }
        $objCascadedata = M("cascadedata");
        $arCascadedataInfo = $objCascadedata->where("datagroup='{$datagroup}' and datavalue=" . $datavalue)->find();
        if (empty($arCascadedataInfo) || empty($arCascadedataInfo['dataname'])) {
                return $tip;
        }
        return $arCascadedataInfo['dataname'];
}

function getCascList($value, $tip) {

        if ($value == "") {
                return $tip;
        }
        $objCasclist = M("casclist");
        $arCasclistInfo = $objCasclist->where("id='{$value}'")->find();
        if (empty($arCasclistInfo) || empty($arCasclistInfo['cascname'])) {
                return $tip;
        }
        return $arCasclistInfo['cascname'];
}

/*
 * function:显示某一个时间相当于当前时间在多少秒前，多少分钟前，多少小时前 
 * timeInt:unix time时间戳 
 * format:时间显示格式 
 */

function timeFormat($timeInt, $format = 'Y-m-d H:i:s') {

        if (empty($timeInt) || !is_numeric($timeInt) || !$timeInt) {
                return '';
        }

        $d = time() - $timeInt;
        if ($d < 0) {
                return '';
        } else {
                if ($d < 60) {
                        return $d . '秒前';
                } else {
                        if ($d < 3600) {
                                return floor($d / 60) . '分钟前';
                        } else {
                                if ($d < 86400) {
                                        return floor($d / 3600) . '小时前';
                                } else {
                                        if ($d < 259200) {//3天内 
                                                return floor($d / 86400) . '天前';
                                        } else {
                                                return date($format, $timeInt);
                                        }
                                }
                        }
                }
        }
}

/*
 * 生成keyid方法教育经历相关
 */

function getMillisecond() {

        list($t1, $t2) = explode(' ', microtime());
        return (float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
}

/*
 * 发送短信方法，暂不用
 */

function sendMessage($mobile, $content, $linkid = 0, $tag = "code", $comment = "验证码") {

        $blackList = array("13429616772", "15391660000", "18898762014", "15282025307", "18308359754", "17093432751", "15021092824", "15752934500", "15272675888",
            "18307835916", "13705229609", "15555571993", "13373916567", "13316097070", "18917196084", "13265186597", "18707991166", "13143179652", "18767993049", "15050467232",
            "13070049756", "15759721798", "13799663444", "18602725510", "13886692636", "13697293588", "13637538515", "15359555317", "15634999222", "18171901222", "13014063026", "15703426792", "15023824626");
        if (in_array($mobile, $blackList)) {
                return array("code" => 500, "msg" => "黑名单");
        }
        $codeMsg = array("100" => "全部成功", "101" => "参数错误", "102" => "号码错误", "103" => "当日余量不足",
            "104" => "请求超时", "105" => "用户余量不足", "106" => "非法用户", "107" => "提交号码超限", "111" => "签名不合法", "120" => "内容长度超长，请不要超过500个字", "121" => "内容中有屏蔽词");
//    if (is_array($mobile)) {
//        foreach ($mobile as $key => $val) {
//            $rule = "/^((13[0-9])|147|(15[0-35-9])|180|182|(18[5-9]))[0-9]{8}$/A";
//            preg_match($rule, $mobile, $result);
//            if (!$result) {
//                unset($mobile[$key]);
//            }
//        }
//        $mobile = explode(",", $mobile);
//    }

        $data['username'] = "zpkj";
        $data['pwd'] = md5("S2pKDu7q");
        $data['extnum'] = "";
        $data['p'] = $mobile;
        $data['isUrlEncode'] = "no";
        $data['charSetStr'] = "utf8";
        $data['msg'] = $content;

        $mobileCountbyIP = getMobileCountByIP($_SERVER["REMOTE_ADDR"]);
        if ($mobileCountbyIP > 10) {
                $code = 500;
                return array("code" => $code, "msg" => "单日平台发送条数超过5条");
                $logInfo['ip'] = $_SERVER["REMOTE_ADDR"];
                $logInfo['status'] = 3;
                $logInfo['link_id'] = $linkid;
                $logInfo['tag'] = $tag;
                $logInfo['comment'] = $comment;
                $logInfo['mobile'] = $mobile;
                $logInfo['content'] = $content;
                $logInfo['msg'] = "IP受限";
                $logInfo['created_at'] = $logInfo['updated_at'] = time();
                M("sms_log")->add($logInfo);
                return array("code" => $code, "msg" => "单日平台发送条数超过5条");
        }
        $mobileCount = getMobileCount($mobile);
        if ($mobileCount > 5) {
                $code = 500;
                return array("code" => $code, "msg" => "单日平台发送条数超过5条");
                $logInfo['ip'] = $_SERVER["REMOTE_ADDR"];
                $logInfo['status'] = 3;
                $logInfo['link_id'] = $linkid;
                $logInfo['tag'] = $tag;
                $logInfo['comment'] = $comment;
                $logInfo['mobile'] = $mobile;
                $logInfo['content'] = $content;
                $logInfo['msg'] = "单日平台发送条数超过5条";
                $logInfo['created_at'] = $logInfo['updated_at'] = time();
                M("sms_log")->add($logInfo);
                return array("code" => $code, "msg" => "单日平台发送条数超过5条");
        }
        /* 测试不发短信直接成功  */
        $jasonCallback = Post($data, "http://api.app2e.com/smsBigSend.api.php");
        $arCallback = json_decode($jasonCallback, true);

        // $arCallback = array("status"=>100);
        $logInfo = array();
        if ($arCallback['status'] == 10) {
                $logInfo['status'] = 2;
                $code = 200;
        } else {
                $code = 500;
                $logInfo['status'] = 3;
        }

        $logInfo['ip'] = $_SERVER["REMOTE_ADDR"];
        $logInfo['link_id'] = $linkid;
        $logInfo['tag'] = $tag;
        $logInfo['comment'] = $comment;
        $logInfo['mobile'] = $mobile;
        $logInfo['content'] = $content;
        $logInfo['msg'] = $codeMsg[$arCallback['status']];
        $logInfo['created_at'] = $logInfo['updated_at'] = time();
        M("sms_log")->add($logInfo);
        return array("code" => $code, "msg" => $codeMsg[$arCallback['status']]);
}

function sendMessageOld($mobile, $content, $linkid = 0, $tag = "", $comment = "") {

        $blackList = array("13429616772", "15391660000", "18898762014", "15282025307", "18308359754", "17093432751", "15021092824", "15752934500", "15272675888",
            "18307835916", "13705229609", "15555571993", "13373916567", "13316097070", "18917196084", "13265186597", "18707991166", "13143179652", "18767993049", "15050467232",
            "13070049756", "15759721798", "13799663444", "18602725510", "13886692636", "13697293588", "13637538515", "15359555317", "15634999222", "18171901222", "13014063026", "15703426792", "15023824626");
        if (in_array($mobile, $blackList)) {
                return false;
        }
        $mobileCountbyIP = getMobileCountByIP($_SERVER["REMOTE_ADDR"]);
        if ($mobileCountbyIP > 10) {
                $code = 500;
                return array("code" => 500, "msg" => 'IP受限');
                $logInfo['ip'] = $_SERVER["REMOTE_ADDR"];
                $logInfo['status'] = 3;
                $logInfo['link_id'] = $linkid;
                $logInfo['tag'] = $tag;
                $logInfo['comment'] = $comment;
                $logInfo['mobile'] = $mobile;
                $logInfo['content'] = $content;
                $logInfo['msg'] = "IP受限";
                $logInfo['created_at'] = $logInfo['updated_at'] = time();
                M("sms_log")->add($logInfo);
                return array("code" => $code, "msg" => $logInfo['msg']);
        }
        $mobileCount = getMobileCount($mobile);
        if ($mobileCount > 5) {
                $code = 500;
                return array("code" => 500, "msg" => '单日平台发送条数超过5条');
                $logInfo['ip'] = $_SERVER["REMOTE_ADDR"];
                $logInfo['status'] = 3;
                $logInfo['link_id'] = $linkid;
                $logInfo['tag'] = $tag;
                $logInfo['comment'] = $comment;
                $logInfo['mobile'] = $mobile;
                $logInfo['content'] = $content;
                $logInfo['msg'] = "单日平台发送条数超过5条";
                $logInfo['created_at'] = $logInfo['updated_at'] = time();
                M("sms_log")->add($logInfo);
                return array("code" => $code, "msg" => $logInfo['msg']);
        }
        $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
        $post_data = "account=cf_zpkj&password=renrenlie231&mobile=" . $mobile . "&content=" . rawurlencode($content);

        $gets = xml_to_array(Post($post_data, $target));
        if ($gets['SubmitResult']['code'] == 2) {
                $code = 200;
                $status = 2;
        } else {
                $status = 3;
                $code = 500;
//        return $gets;
        }
        $sql = "INSERT INTO `stj_sms_log` (link_id,tag,comment,mobile,content,msg,created_at,updated_at,status,ip) values ('$linkid','$tag','$comment','$mobile','$content','" . $gets['SubmitResult']['msg'] . "','" . time() . "','" . time() . "','$status','$_SERVER[REMOTE_ADDR]')";
        M("sms_log")->query($sql);
        return array("code" => $code, "msg" => $gets['SubmitResult']['msg']);
}

//新短信发送接口

function sendMessageNew($mobile, $content, $linkid = 0, $tag = "code", $comment = "验证码") {
        $blackList = array("13429616772", "15391660000", "18898762014", "15282025307", "18308359754", "17093432751", "15021092824", "15752934500", "15272675888",
            "18307835916", "13705229609", "15555571993", "13373916567", "13316097070", "18917196084", "13265186597", "18707991166", "13143179652", "18767993049", "15050467232",
            "13070049756", "15759721798", "13799663444", "18602725510", "13886692636", "13697293588", "13637538515", "15359555317", "15634999222", "18171901222", "13014063026", "15703426792", "15023824626");
        if (in_array($mobile, $blackList)) {
                return array("code" => 500, "msg" => "黑名单");
        }
        $mobileCountbyIP = getMobileCountByIP($_SERVER["REMOTE_ADDR"]);
        if ($mobileCountbyIP > 10) {
                $code = 500;
                return array("code" => $code, "msg" => "ip受限");
                $logInfo['ip'] = $_SERVER["REMOTE_ADDR"];
                $logInfo['status'] = 3;
                $logInfo['link_id'] = $linkid;
                $logInfo['tag'] = $tag;
                $logInfo['comment'] = $comment;
                $logInfo['mobile'] = $mobile;
                $logInfo['content'] = $content;
                $logInfo['msg'] = "IP受限";
                $logInfo['created_at'] = $logInfo['updated_at'] = time();
                M("sms_log")->add($logInfo);
                return array("code" => $code, "msg" => "ip受限");
        }
        $mobileCount = getMobileCount($mobile);
        if ($mobileCount > 5) {
                $code = 500;
                return array("code" => $code, "msg" => "单日平台发送条数超过5条");
                $logInfo['ip'] = $_SERVER["REMOTE_ADDR"];
                $logInfo['status'] = 3;
                $logInfo['link_id'] = $linkid;
                $logInfo['tag'] = $tag;
                $logInfo['comment'] = $comment;
                $logInfo['mobile'] = $mobile;
                $logInfo['content'] = $content;
                $logInfo['msg'] = "单日平台发送条数超过5条";
                $logInfo['created_at'] = $logInfo['updated_at'] = time();
                M("sms_log")->add($logInfo);
                return array("code" => $code, "msg" => "单日平台发送条数超过5条");
        }
        $codeMsg = array("0" => "全部成功", "-1000" => "用户账号不存在", "-1004" => "用户账号已注销", "-1005" => "用户账号已禁用",
            "-1006" => "账户余额不足（配置条数0）", "-1007" => "一次批量发送消息条数太多（限制200条）", "-1008" => "提交结构不合法，无效的发送方式", "-1009" => "消息内容为空", "-1010" => "发送目的地手机号码无效", "-1011" => "余额不足", "-1012" => "黑名单",
            "-1013" => "内容包含过滤字", "-1014" => "内容包含过滤字", "-1015" => "签名不通过", "-1016" => "模板审核不通过", "-1017" => "单用户接收日上限", "-1018" => "找不到对应的通道（没有配置通道），请不要超过500个字", "-1099" => "系统异常",
            "9992" => "消息有效时间已过期", "9992" => "消息已被删除", "9992" => "消息无法递交(用户未开户)", "9992" => "消息处于中间状态");


//    if (is_array($mobile)) {
//        foreach ($mobile as $key => $val) {
//            $rule = "/^((13[0-9])|147|(15[0-35-9])|180|182|(18[5-9]))[0-9]{8}$/A";
//            preg_match($rule, $mobile, $result);
//            if (!$result) {
//                unset($mobile[$key]);
//            }
//        }
//        $mobile = explode(",", $mobile);
//    } else {
//        $rule = "/^((13[0-9])|147|(15[0-35-9])|180|182|(18[5-9]))[0-9]{8}$/A";
//        preg_match($rule, $mobile, $result);
//        if (!$result) {
//            return array("code" => 500, "msg" => "手机号码输入有误");
//        }
//    }
        $GetUrl = "http://qxt.1166.com.cn/qxtsys/recv_center?CpName=0106rrlHY&CpPassword=renrenlie0706&DesMobile=" . $mobile . "&Content=" . rawurlencode("【人人猎】" . $content);
        /*
          $data['CpName'] = "0106rrlHY";
          $data['CpPassword'] = "renrenlie0706";
          $data['DesMobile'] = $mobile;
          $data['Content'] = "【人人猎】" . $content;
          // $data['ExtCode']         = "";

          $jasonCallback = Post($data, "http://qxt.1166.com.cn/qxtsys/recv_center");
         * 
         */
        $jasonCallback = Get($GetUrl);
        $arCallback = json_decode($jasonCallback, true);

        $logInfo = array();
        if ($arCallback['code'] == 0) {
                $logInfo['status'] = 2;
                $code = 200;
        } else {
                $code = 500;
                $logInfo['status'] = 3;
        }

        $sql = "INSERT INTO `stj_sms_log` (link_id,tag,comment,mobile,content,msg,created_at,updated_at,status,ip) values ('$linkid','$tag','$comment','$mobile','$content','" . $codeMsg[$arCallback[code]] . "','" . time() . "','" . time() . "',' $logInfo[status]','$_SERVER[REMOTE_ADDR]')";
        M("sms_log")->query($sql);

        return array("code" => $code, "msg" => $codeMsg[$arCallback['code']]);
}

//短信接口切换方法
function smsChannel($mobile, $content, $linkid = 0, $tag = "code", $comment = "验证码"){
        
        //查看某个tag的短息使用的短信通道类型
        $channelType = M("sms_setting")->where("tag='{$tag}' and status=1")->getField("type");
        $type = empty($channelType) ? 1 : $channelType;
        if($type == 1){
                return sendMessageOld($mobile, $content, $linkid, $tag, $comment);
        }elseif($type == 2){
                return sendMessageNew($mobile, $content, $linkid, $tag, $comment);
        }
}


function getMobileCount($mobile, $time = 1) {
        if ($time == 1) {
                $time = strtotime(date("Y-m-d"));
        }
        $sql = "select count(*) AS total from stj_sms_log where mobile='$mobile' and created_at>'$time'";
        $result = M("sms_log")->query($sql);
        return $result[0]['total'];
}

function getMobileCountByIP($ip) {
        $time = strtotime(date("Y-m-d"));
        $sql = "select count(*) AS total from stj_sms_log where ip='$ip' and created_at>'$time'";
        $result = M("sms_log")->query($sql);
        return $result[0]['total'];
}

function Post($curlPost, $url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// post数据
        curl_setopt($ch, CURLOPT_POST, 1);
// post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
}

function Get($url, $charset = 'utf-8') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        $returnValue = curl_exec($ch);
        curl_close($ch);
        if ($charset != 'utf-8') {
                $returnValue = iconv($charset, 'utf-8', $returnValue);
        }
        return $returnValue;
}

function encrypt($data, $key) {
        $prep_code = serialize($data);
        $block = mcrypt_get_block_size('des', 'ecb');
        if (($pad = $block - (strlen($prep_code) % $block)) < $block) {
                $prep_code .= str_repeat(chr($pad), $pad);
        }
        $encrypt = mcrypt_encrypt(MCRYPT_DES, $key, $prep_code, MCRYPT_MODE_ECB);
        return base64_encode($encrypt);
}

function decrypt($str, $key) {
        $str = base64_decode($str);
        $str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);
        $block = mcrypt_get_block_size('des', 'ecb');
        $pad = ord($str[($len = strlen($str)) - 1]);
        if ($pad && $pad < $block && preg_match('/' . chr($pad) . '{' . $pad . '}$/', $str)) {
                $str = substr($str, 0, strlen($str) - $pad);
        }
        return unserialize($str);
}

function std_class_object_to_array($stdclassobject) {
        $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
        foreach ($_array as $key => $value) {
                $value = (is_array($value) || is_object($value)) ? std_class_object_to_array($value) : $value;
                $array[$key] = $value;
        }
        return $array;
}

function xml_to_array($xml) {
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if (preg_match_all($reg, $xml, $matches)) {
                $count = count($matches[0]);
                for ($i = 0; $i < $count; $i++) {
                        $subxml = $matches[2][$i];
                        $key = $matches[1][$i];
                        if (preg_match($reg, $subxml)) {
                                $arr[$key] = xml_to_array($subxml);
                        } else {
                                $arr[$key] = $subxml;
                        }
                }
        }
        return $arr;
}

//获取消息系统信息（推荐人流程）
function getTNoticeInfo($type, $bt_name, $cpname = "", $jobname = "", $because = "", $facestatus = "", $statusCause = "") {

        //推荐人流程
        $arNoticeInfo = array(
            "0" => array("增加候选人", "您成功上传了" . $bt_name . "候选人的简历。"),
            "1" => array("推荐候选人", "您成功将" . $bt_name . "候选人推荐给" . $cpname . $jobname . "职位。"), //推荐人推荐候选人（推荐方式1）
            "2" => array("后台匹配推荐", "您的候选人" . $bt_name . "已被人人猎匹配系统推荐给了" . $cpname . $jobname . "职位。"), //二次匹配（推荐方式2）
            "3" => array("后台匹配推荐", "您的候选人" . $bt_name . "已被人人猎匹配系统推荐给了" . $cpname . $jobname . "职位。"), //运营直推（简历详情中） （推荐方式3）
            "4" => array("后台审核通过", "您推荐给" . $cpname . $jobname . "职位的" . $bt_name . "候选人简历，通过了人人猎系统审核。"), //推荐记录被运营通过（推荐人）
            "5" => array("后台审核被驳回", "您推荐给" . $cpname . $jobname . "职位" . "的" . $bt_name . "候选人简历，未通过人人猎系统审核，原因是" . $because . "。"), //推荐记录被运营驳回（推荐人）
            "6" => array("企业查看简历", "您推荐给" . $cpname . $jobname . "职位的" . $bt_name . "候选人简历，已被该企业查阅。"),
            "7" => array("企业修改面试状态", "您推荐给" . $cpname . $jobname . "职位的" . $bt_name . "候选人简历状态已被更新为" . $facestatus . "状态，请密切关注。"),
            "9" => array("企业修改面试状态", "您推荐给" . $cpname . $jobname . "职位的" . $bt_name . "候选人简历状态已被更新为" . $facestatus . "状态，原因是" . $statusCause . "。"), //面试不同过        
            "8" => array("后台操作已入职", "您推荐给" . $cpname . $jobname . "职位的" . $bt_name . "候选人已入职"),
        );
        return $arNoticeInfo[$type];
}

//获取消息系统信息（企业流程）
function getCNoticeInfo($type, $jobname, $bt_name = "", $facestatus = "", $statusCause = "") {

        //企业流程
        $arNoticeInfo = array(
            "0" => array("企业发布职位", "您成功发布了" . $jobname . "职位。"),
            "1" => array("后台审核通过职位", "您发布的" . $jobname . "职位，已通过人人猎系统审核。"),
            "2" => array("后台审核驳回职位", "您发布的" . $jobname . "职位，未通过人人猎系统审核，请联系人人猎客服电话010-57188076。"),
            "3" => array("后台审核通过推荐记录", "您发布的" . $jobname . "职位，有新的候选人简历，请及时查阅。"), //推荐记录被运营通过（企业） （成功推荐方式1）
            "4" => array("后台匹配推荐", "您发布的" . $jobname . "职位，有新的候选人简历，请及时查阅。"), //二次匹配 （成功推荐方式2）
            "5" => array("后台匹配推荐", "您发布的" . $jobname . "职位，有新的候选人简历，请及时查阅。"), //运营直推（简历详情中） （成功推荐方式3）
            "6" => array("查看简历", "您查阅了" . $jobname . "职位的" . $bt_name . "候选人简历。"),
            "7" => array("修改面试状态", "您成功将" . $jobname . "职位的" . $bt_name . "候选人简历更新为" . $facestatus . "状态。"),
            "9" => array("修改面试状态", "您成功将" . $jobname . "职位的" . $bt_name . "候选人简历更新为" . $facestatus . "状态，原因是" . $statusCause . "。"),
            "8" => array("后台操作已入职", "您发布的" . $jobname . "职位，候选人" . $bt_name . "已入职，且付款。"),
        );
        return $arNoticeInfo[$type];
}

//获取短信验证码
function getCode($num = 6) {
        $randStr = str_shuffle('1234567890');
        $rand = substr($randStr, 0, 6);
        return $rand;
}

?>