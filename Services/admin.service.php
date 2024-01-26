<?php

use Mpdf\Tag\HGroup;

require_once dirname(__DIR__) .'/Includes/autoload.inc.php';
class admin{
    protected $service;
    public function __construct()
    {
        $this->service = new connect_database();
    }
    public function AddTypeShop($request){
        $this->service->InsertTable("typeshop","NameTypeShop","'{$request['NameTypeShop_Post']}'",null);
        header("location: ../Views/Admin/typeshop.php?Info=เพิ่มข้อมูลเสร็จเรียบร้อย");
    }
    public function PermisionUser($request){
        $result = $this->service->SelectTable("AccessStatusSCR","users","Where idAll = ".$request['IdUser_Get'])->fetch_assoc()['AccessStatusSCR'];
        if($result == 1){ $row = 0;}else{$row = 1;}
        $this->service->UpdateTable("users","AccessStatusSCR = ".$row,"idAll = ".$request['IdUser_Get']);
        header("location: ../Views/Admin/index.php?Info=แก้ไขสิทธิการใช้งานUserไอดี".$request['IdUser_Get']."เสร็จสิ้น");
    }
}
?>