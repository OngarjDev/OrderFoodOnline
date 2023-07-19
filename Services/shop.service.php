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
    public function AddFood($request){
        $this->service->InsertTable("food","IdTypeFood,NameFood,PriceFood,ImageFood,IdShop","{$request['IdTypeFood_Post']},'{$request['NameFood_Post']}',{$request['PriceFood_Post']},'{$request['ImagePath_Post']}',{$_SESSION['IdUser_Session']}",null);
        header("location: ../Views/Shop/?Info_Get=เพิ่มข้อมูลอาหารสำเร็จ");
    }
    public function DeleteFood($request){
        $this->service->DeleteData("food","IdFood = ". $request['IdFood_Get']);
        header("location: ../Views/Shop/?Info_Get=ลบข้อมูลอาหารสำเร็จ");
    }
    public function EditFood($request){
        $data_old = $this->service->SelectTable(null, "food", "Where IdFood = " . $request['IdFood_Get'])->fetch_assoc();
        if(isset($request['ImagePath_Post'])){ $image_path = $request['ImagePath_Post'];}else{$image_path = $data_old['ImageFood'];}
        $this->service->UpdateTable("food",
        "NameFood = '".$request['NameFood_Post']
        ."',PriceFood = '".$request['PriceFood_Post']
        ."',ImageFood = '".$image_path
        ."',IdTypeFood = ".$request['IdTypeFood_Post']
        ,"IdFood = ".$request['IdFood_Get']
    );
    header("location: ../Views/Shop/?Info_Get=แก้ไขข้อมูลอาหารสำเร็จ");
    }
}
