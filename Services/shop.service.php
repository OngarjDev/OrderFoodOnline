<?php
require_once dirname(__DIR__) . '/Includes/autoload.inc.php';
class shop
{
    public $service;
    public function __construct()
    {
        $this->service = new connect_database();
        session_start();
    }
    public function AddTypeFood($request)
    {
        $this->service->InsertTable("typefood", "NameTypeFood,IdShop", "'{$request['NameTypeFood_Post']}','{$_SESSION['IdUser_Session']}'", null);
        header("location: ../Views/Shop/categoryfood.php?Info_Get=สร้างหมวดหมู่ใหม่เรียบร้อยแล้ว");
    }
}
