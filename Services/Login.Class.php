<?php
Class Login{
    public $DataBase;
    public function __construct()
    {
        require("../Models/DbConnect.ini.php");
        $DataBase = new Connect_Database();
        session_start();
        if($_REQUEST['action_get'] == "Login"){

        }else if($_REQUEST['action_get'] == "Verify"){
            $this->DataBase->SelectTable("IdAll,NameAll,RoleAll,WaitPermision_SCR,Suspension_SCR,")
        }
    }
    public function Login(string $UserName,string $Password){

    }
    public function VerifyAndSyncData(){
        $_REQUEST['id_user_session'];
    }
}
?>