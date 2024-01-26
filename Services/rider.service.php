<?php 
require_once '../Includes/autoload.inc.php';
class rider{
    public $service;
    public function __construct(){
        $this->service = new connect_database();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function ReceiveOrder($request){
        $this->service->UpdateTable("orders","IdRider = {$_SESSION['IdUser_Session']},StatusOrder = 2","IdOrder = {$request['IdOrder_Get']}");
        header('location: ../Views/Rider/orderrider.php?Info=รับออเดอร์เรียบร้อยแล้ว');
    }
    public function ConfrimOrder($request){
        $this->service->UpdateTable("orders","StatusOrder = 3","IdOrder = {$request['IdOrder_Get']}");
        header("location: " . $_SERVER['HTTP_REFERER'] . "?Info=" . urlencode("ยืนยันการชำระเงินเรียบร้อยแล้ว"));
    }
}
?>