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
        $technician = $this->auth->createRole(User::ROLE_TECHNICIAN);
        $this->auth->add($technician);
        $this->auth->addChild($technician, $advisor);

        //Kho
        $repository = $this->auth->createRole(User::ROLE_REPOSITORY);
        $this->auth->add($repository);
        $this->auth->addChild($repository, $technician);

        //Kế toán
        $accounting = $this->auth->createRole(User::ROLE_ACCOUNTING);
        $this->auth->add($accounting);
        $this->auth->addChild($accounting, $repository);

        /*$manager = $this->auth->createRole(User::ROLE_MANAGER);
        $this->auth->add($manager);
        $this->auth->addChild($manager, $user);*/

        $admin = $this->auth->createRole(User::ROLE_ADMINISTRATOR);
        $this->auth->add($admin);
        $this->auth->addChild($admin, $accounting);

        $this->auth->assign($admin, 1);
        $this->auth->assign($accounting, 2);
        $this->auth->assign($repository, 3);
        $this->auth->assign($technician, 4);
        $this->auth->assign($advisor, 5);
    }

    public function down()
    {
        $this->auth->remove($this->auth->getRole(User::ROLE_ADMINISTRATOR));
        $this->auth->remove($this->auth->getRole(User::ROLE_ACCOUNTING));
        $this->auth->remove($this->auth->getRole(User::ROLE_REPOSITORY));
        $this->auth->remove($this->auth->getRole(User::ROLE_TECHNICIAN));
        $this->auth->remove($this->auth->getRole(User::ROLE_ADVISOR));
        $this->auth->remove($this->auth->getRole(User::ROLE_USER));
    }
}
