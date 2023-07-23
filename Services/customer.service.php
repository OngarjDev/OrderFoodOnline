<?php 
require_once dirname(__DIR__) .'/Includes/autoload.inc.php';
class customer{
    protected $service;
    public function __construct()
    {
        $this->service = new connect_database();
        if(session_status() === PHP_SESSION_NONE){
        session_start();
        }
    }
    public function Comment(){
        $this->service->InsertTable("review","IdUser,Comment,IdFood","'{$_SESSION['IdUser_Session']}','{$_REQUEST['Comment_Post']}','{$_REQUEST['IdFood_Get']}'",null);
        header("location: ../Views/Customer/fooddetail.php?IdFood_Get={$_REQUEST['IdFood_Get']}");
    }
    public function CheckItem(int $IdFood):bool{
        if(isset($_COOKIE['cart'])){
            $DeCart = unserialize($_COOKIE['cart']);
        }else{
            return false;
        }
        $cartItems = array_column($DeCart, 'IdFood');
        if(in_array($IdFood,$cartItems)){
            return true;
        }else{
            return false;
        }
    }
}
