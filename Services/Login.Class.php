<?php
if($_REQUEST['action_get'] == "Login"){
    $this->Login();
}else if($_REQUEST['action_get'] == "Verify"){
    $this->VerifyAndSyncData();
}
Class Login{
    public $DataBase;
    public function __construct()
    {
        require("../Models/DbConnect.ini.php");
        $DataBase = new Connect_Database();
        session_start();
    }
    public function Login(){
        $UserName = $_REQUEST['UserName_Post'];
        $Password = $_REQUEST['Password_Post'];
        $result = $this->DataBase->SelectTable("IdAll,NameAll,RoleAll,WaitPermision_SCR,Suspension_SCR","users","Where NameAll = '$UserName' AND PasswordAll = '$Password'")->fetch_assoc();
        if($result->num_rows == 1){

        }else{
            
        }
    }
    public function VerifyAndSyncData(){
        $_REQUEST['id_user_session'];
    }
    public function Logout(){
        session_destroy();
    }
}
?>