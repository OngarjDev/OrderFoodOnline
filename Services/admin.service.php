<?php 
require_once '../Includes/autoload.inc.php';
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
}
?>