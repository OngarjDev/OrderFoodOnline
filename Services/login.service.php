<?php
require_once dirname(__DIR__) . '/Includes/autoload.inc.php';
class login
{
    public $DataBase;
    public $login;
    public function __construct()
    {
        $this->DataBase = new connect_database();
        session_start();
    }
    public function Login($request)
    {
        $UserName = $request['UserName_Post'];
        $Password = $request['Password_Post'];
        $result = $this->DataBase->SelectTable(
            "IdAll,NameAll,RoleAll,AccessStatusSCR",
            "users",
            "Where NameAll = '$UserName' AND PasswordAll = '$Password'"
        );
        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            $_SESSION['IdUser_Session'] = $result['IdAll'];
            $_SESSION['Name_Session'] = $result['NameAll'];
            $_SESSION['Role_Session'] = $result['RoleAll'];
            switch ($_SESSION['Role_Session']) {
                case "Admin":
                    $path = "Admin";
                    break;
                case "Customer":
                    $path = "Customer";
                    break;
                case "Shop":
                    $path = "Shop";
                    break;
                case "Rider":
                    $path = "Rider";
                    break;
            }
            header("location: ../Views/$path/");
        } else {
            header("location: ../Views/Shares/login.php?Info_Get=ไม่พบผู้ใช้ในระบบ");
        }
    }

    public function CheckAuthorization(){
        $result = $this->DataBase->SelectTable("RoleAll,AccessStatusSCR","users","Where IdAll = '{$_SESSION['IdUser_Session']}'")->fetch_assoc();
        if($result['AccessStatusSCR'] == 1 || $result['RoleAll'] == "Admin"){
                $this->SyncSession();
                $lastPosition = basename($_SERVER['REQUEST_URI']);
                if($lastPosition != $result['RoleAll']){
                    header("location: ../../Views/Shares/login.php?Info_Get=คุณไม่มีสิทธิเข้าถึงหน้าดังกล่าว");
                }            
        }else{
            header("location: ../../Views/Shares/permision.php");
        }
    }

    /**
     * มีไว้ UpdateSession
     * @return มีหน้าที่อัพเดต Session ให้ตรงกันกับปัจจุบัน
     */
    public function SyncSession()
    {
        $result = $this->DataBase->SelectTable("IdAll,NameAll,RoleAll", "users", "Where IdAll = '{$_SESSION['IdUser_Session']}'")->fetch_assoc();
        $_SESSION['IdUser_Session'] = $result['IdAll'];
        $_SESSION['Name_Session'] = $result['NameAll'];
        $_SESSION['Role_Session'] = $result['RoleAll'];
    }
    public function Logout()
    {
        session_destroy();
        header('location: ../Views/Shares/Login.php?Info_Get=ออกระบบเรียบร้อย');
    }
    public function Register($request)
    {
        $this->DataBase->InsertTable(
            'users',
            'NameAll,PasswordAll,DescriptionShop,AddressCustomer,ImageAll,RoleAll,IdTypeShop',
            "'{$request['UserName_Post']}','{$request['Password_Post']}','{$request['Description_Post']}','{$request['Address_Post']}','{$request['ImagePath_Post']}','{$request['type_account']}','{$request['IdTypeShop_Post']}'",
            null
        );
        $this->Login($request);
    }
    public function EditAccount($request)
    {
        $data_old = $this->DataBase->SelectTable(null, "users", "Where idAll = " . $request['IdUser_Get'])->fetch_assoc();
        $UserName = $request['UserName_Post'] !== "" ? $request['UserName_Post'] : $data_old['NameAll'];
        $Password = $request['Password_Post'] !== "" ? $request['Password_Post'] : $data_old['PasswordAll'];
        $Description = $request['Description_Post'] !== "" ?  $request['Description_Post'] : $data_old['DescriptionShop'];
        $Address =  $request['Address_Post'] !== "" ?  $request['Address_Post'] : $data_old['Address_Post'];
        $Image =  $request['ImagePath_Post'] !== "" ?  $request['ImagePath_Post'] : $data_old['ImageAll'];
        $IdTypeShop =  $request['IdTypeShop_Post'] !== "" ?  $request['IdTypeShop_Post'] : $data_old['IdTypeShop'];
        if($IdTypeShop == ""){ $IdTypeShop = "null";}
        $this->DataBase->UpdateTable(
            "users",
            "NameAll = '" . $UserName
                . "',PasswordAll = '" . $Password
                . "',DescriptionShop = '" . $Description
                . "',AddressCustomer = '" . $Address
                . "',ImageAll = '" . $Image
                . "',IdTypeShop = " . $IdTypeShop,
            "idAll = " . $request['IdUser_Get']
        );
        $this->SyncSession();
    }
}
