<?php
require_once '../Includes/autoload.inc.php';

class Customer_Controller
{
    public function handleRequest()
    {
        switch ($_REQUEST['action_Get']) {
            case 'AddCartFood':
                $this->AddCartFood();
                break;
            default:
                header("location: " . $_SERVER['HTTP_REFERER'] . "?Info=" . urlencode("ขออภัยเราไม่พบ Actionในระบบของคุณ"));
        }
    }
    private function AddCartFood()
    {
        if (isset($_COOKIE['cart'])) {
            // ถ้ามีให้ดึงข้อมูลจาก cookie และแปลงคืนเป็น array ด้วย unserialize
            $existingCartData = unserialize($_COOKIE['cart']);
        } else {
            // ถ้ายังไม่มีให้กำหนดให้เป็น array ว่าง
            $existingCartData = [];
        }

        // ตรวจสอบว่ามีรายการสินค้าที่ต้องการเพิ่มในตะกร้าหรือยัง
        $idFoodToAdd = $_REQUEST['IdFood']; // เช่น สมมติว่าต้องการเพิ่ม IdFood 4 ลงในตะกร้า
        $amountToAdd = $_REQUEST['Amount']; // เช่น สมมติว่าต้องการเพิ่ม 2 ชิ้น

        $foundIndex = -1; // ตัวแปรเก็บ index ของรายการสินค้าที่ต้องการเพิ่ม ถ้าไม่เจอให้เป็น -1

        // วน loop เพื่อตรวจสอบว่ามีรายการสินค้าที่ต้องการเพิ่มอยู่ในตะกร้าแล้วหรือยัง
        foreach ($existingCartData as $index => $item) {
            if ($item['IdFood'] == $idFoodToAdd) {
                $foundIndex = $index;
                break;
            }
        }

        // ถ้าเจอรายการสินค้าที่ต้องการเพิ่มแล้ว ให้อัปเดตจำนวนสินค้าในตะกร้า
        if ($foundIndex !== -1) {
            $existingCartData[$foundIndex]['amount'] += $amountToAdd;
        } else {
            // ถ้ายังไม่เจอให้เพิ่มรายการสินค้าใหม่ลงในตะกร้า
            $newItem = ['IdFood' => $idFoodToAdd, 'amount' => $amountToAdd];
            $existingCartData[] = $newItem ?? 0;
        }

        // ทำการ serialized ข้อมูลและเก็บใน cookie
        $serializedCartData = serialize($existingCartData);
        setcookie('cart', $serializedCartData);
        header('location: '.$_SERVER['HTTP_REFERER']);
    }
}

$controller = new Customer_Controller();
$controller->handleRequest();