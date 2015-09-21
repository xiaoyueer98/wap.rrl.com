<?php
class ActiveAction extends Action {
        
        /*
         * 
         */

        public function active_redpackage() {
                
                $this->display("./Active/activities1");
        }
        
        /*
         * 
         */

        public function active_share() {
                
                $this->display("./Active/activities2");
        }

        /*
         * 
         */

        public function active_recommend() {
                
                $this->display("./Active/activities3");
        }
        /*
         *扫码进入到的注册页面 
         */
        public function active_reg(){
                $userinfo = $_SESSION['userinfo'];

                if (!empty($userinfo))
                {
                        header("location:/index.php?s=/Index/index");
                        exit;
                }
                else
                {
                        $this->display("/Active/reg");
                }
        }


        

}
