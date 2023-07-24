<?php
class data_input
{
    public $formInputs;

    public function __construct()
    {
        $this->formInputs = new stdClass();

        $this->formInputs->Shop = [
            (object) ['label' => 'ชื่อผู้ใช้*', 'name' => 'UserName_Post', 'type' => 'text', 'placeholder' => 'กรอกชื่อผู้ใช้ของคุณ', 'required' => true],
            (object) ['label' => 'รหัสผ่าน*', 'name' => 'Password_Post', 'type' => 'password', 'placeholder' => 'กรอกรหัสผ่านขั้นต่ำ 8ตัว', 'required' => true],
            (object) ['label' => 'รายละเอียดร้านค้า*', 'name' => 'Description_Post', 'type' => 'textarea', 'placeholder' => 'กรอกรายละเอียดเกี่ยวกับร้านค้าของคุณ', 'required' => true],
            (object) ['label' => 'ที่ตั้งร้านค้า*', 'name' => 'Address_Post', 'type' => 'textarea', 'placeholder' => 'กรอกที่ตั้งร้านค้า', 'required' => true],
            (object) ['label' => 'เลือกประเภทร้านอาหาร*', 'name' => 'IdTypeShop_Post', 'type' => 'select', 'required' => true],
            (object) ['label' => 'รูปภาพร้านค้า', 'name' => 'Image_Post', 'type' => 'file', 'required' => false],
        ];

        $this->formInputs->Customer = [
            (object) ['label' => 'ชื่อผู้ใช้*', 'name' => 'UserName_Post', 'type' => 'text', 'placeholder' => 'กรอกชื่อผู้ใช้ของคุณ', 'required' => true],
            (object) ['label' => 'รหัสผ่าน*', 'name' => 'Password_Post', 'type' => 'password', 'placeholder' => 'กรอกรหัสผ่านขั้นต่ำ 8ตัว', 'required' => true],
            (object) ['label' => 'ที่อยู่(ที่สามารถรับสินค้าได้)', 'name' => 'Address_Post', 'type' => 'textarea', 'placeholder' => 'กรอกที่อยู่ของคุณสำหรับจัดส่งสินค้า', 'required' => true],
            (object) ['label' => 'โปรไฟล์', 'name' => 'Image_Post', 'type' => 'file', 'required' => false],
        ];

        $this->formInputs->Rider = [
            (object) ['label' => 'ชื่อผู้ใช้*', 'name' => 'UserName_Post', 'type' => 'text', 'placeholder' => 'กรอกชื่อผู้ใช้ของคุณ', 'required' => true],
            (object) ['label' => 'รหัสผ่าน*', 'name' => 'Password_Post', 'type' => 'password', 'placeholder' => 'กรอกรหัสผ่านขั้นต่ำ 8ตัว', 'required' => true],
            (object) ['label' => 'โปรไฟล์', 'name' => 'Image_Post', 'type' => 'file', 'required' => false],
        ];
        $this->formInputs->Admin = [
            (object) ['label' => 'ชื่อผู้ใช้*', 'name' => 'UserName_Post', 'type' => 'text', 'placeholder' => 'กรอกชื่อผู้ใช้ของคุณ', 'required' => true],
            (object) ['label' => 'รหัสผ่าน*', 'name' => 'Password_Post', 'type' => 'password', 'placeholder' => 'กรอกรหัสผ่านขั้นต่ำ 8ตัว', 'required' => true],
            (object) ['label' => 'โปรไฟล์', 'name' => 'Image_Post', 'type' => 'file', 'required' => false],
        ];
    }
}
?>
