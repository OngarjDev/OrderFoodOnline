<?php
require_once '../Includes/autoload.inc.php';
Class login{
    public $DataBase;
    public function __construct()
    {
        $this->DataBase = new connect_database();
        session_start();
    }
    public function Login($request){
        $UserName = $request['UserName_Post'];
        $Password = $request['Password_Post'];
        $result = $this->DataBase->SelectTable(
        "IdAll,NameAll,RoleAll,WaitPermisionSCR,SuspensionSCR",
        "users",
        "Where NameAll = '$UserName' AND PasswordAll = '$Password'");
        if($result->num_rows > 0){
            $result = $result->fetch_assoc();
            $_SESSION['IdUser_Session'] = $result['IdAll'];
            $_SESSION['Name_Session'] = $result['NameAll'];
            $_SESSION['Role_Session'] = $result['RoleAll'];
            switch ($_SESSION['Role_Session']){
            case "Admin": $path = "Admin"; break;
            case "Customer" : $path = "Customer"; break;
            case "Shop" : $path = "Shop"; break;
            case "Rider" : $path = "Rider"; break;
            }
            header("location: ../Views/$path/");
        }else{
            header("location: ../Views/login.php?Info_Get=ไม่พบผู้ใช้ในระบบ"); 
        }
    }
    public function VerifyPermisionAndSyncData():bool{
        $IdUser = $_SESSION['IdUser_Session'];
        $result = $this->DataBase->SelectTable("IdAll,NameAll,,RoleAll,WaitPermisionSCR,SuspensionSCR","users","Where IdAll = '$IdUser'");
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    public function Logout(){
        session_destroy();
        header('localtion: ../Views/index.php?Info=ออกระบบเรียบร้อย');
    }
}
?>