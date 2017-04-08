<?php

use common\rbac\Migration;
use common\models\User;

class m150625_214101_roles extends Migration
{
    public function up()
    {
        $this->auth->removeAll();

        /*
         * Bộ phận tiếp nhận xe Receive
         * Tư vấn viên  Advisor
         * Bộ phận kỹ thuật Technician
         * Kho Repository
         * Kế toán viên. Accounting
         *  Quản trị viên Administrator
        */

        $user = $this->auth->createRole(User::ROLE_USER);
        $this->auth->add($user);

        //Tư vấn
        $advisor = $this->auth->createRole(User::ROLE_ADVISOR);
        $this->auth->add($advisor);
        $this->auth->addChild($advisor, $user);

        //Kỹ thuật
        $sales = $this->auth->createRole(User::ROLE_SALES);
        $this->auth->add($sales);
        $this->auth->addChild($sales, $advisor);

        //Kho
        $marketing = $this->auth->createRole(User::ROLE_MARKETING);
        $this->auth->add($marketing);
        $this->auth->addChild($marketing, $sales);


        /*$manager = $this->auth->createRole(User::ROLE_MANAGER);
        $this->auth->add($manager);
        $this->auth->addChild($manager, $user);*/

        $admin = $this->auth->createRole(User::ROLE_ADMINISTRATOR);
        $this->auth->add($admin);
        $this->auth->addChild($admin, $advisor);

        $this->auth->assign($admin, 1);
        $this->auth->assign($marketing, 3);
        $this->auth->assign($sales, 4);
        $this->auth->assign($advisor, 5);
    }

    public function down()
    {
        $this->auth->remove($this->auth->getRole(User::ROLE_ADMINISTRATOR));
        $this->auth->remove($this->auth->getRole(User::ROLE_MARKETING));
        $this->auth->remove($this->auth->getRole(User::ROLE_SALES));
        $this->auth->remove($this->auth->getRole(User::ROLE_ADVISOR));
        $this->auth->remove($this->auth->getRole(User::ROLE_USER));
    }
}
