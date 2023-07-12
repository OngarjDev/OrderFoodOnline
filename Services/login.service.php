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
            header("location: ../Views/Shares/login.php?Info_Get=ไม่พบผู้ใช้ในระบบ"); 
        }
    }

    // public function PermisionAccount():bool{
    //     $result = $this->DataBase->SelectTable("RoleAll,WaitPermisionSCR,SuspensionSCR","users","Where IdAll = '{$_SESSION['IdUser_Session']}'")->fetch_assoc();
    //     $if($result['RoleAll'] != 'Admin'){
    //         if($result['WaitPermisionSCR'] == 0){
    //             
    //         }else{
    //             if($result['WaitPermisionSCR'] == 1){

    //             }
    //         }
    //     }else{
    //         return true;
    //     }
    // }
    
    /**
     * มีไว้ UpdateSession
     * @return คือค่าที่Client ถือสิทธิ Role นั้น หากโดนระงับหรือยังไม่อนุมัติจะส่งค่า WaitPermisionSCR(รออนุมัติ),SuspensionSCR(โดนระงับ)
     */
    public function SyncSession(){
        $result = $this->DataBase->SelectTable("IdAll,NameAll,RoleAll","users","Where IdAll = '{$_SESSION['IdUser_Session']}'")->fetch_assoc();
        $_SESSION['IdUser_Session'] = $result['IdAll'];
        $_SESSION['Name_Session'] = $result['NameAll'];
        $_SESSION['Role_Session'] = $result['RoleAll'];
    }
    public function Logout(){
        session_destroy();
        header('localtion: ../Views/Customer/index.php?Info=ออกระบบเรียบร้อย');
    }
    public function Register($request){
        $this->DataBase->InsertTable('users','NameAll,PasswordAll,DescriptionShop,AddressCustomer,ImageAll,RoleAll,IdTypeShop',
        "'{$request['UserName_Post']}','{$request['Password_Post']}','{$request['Description_Post']}','{$request['Address_Post']}','{$request['ImagePath_Post']}','{$request['type_account']}','{$request['IdTypeShop_Post']}'",
        null);
        $this->Login($request);
    }
}
