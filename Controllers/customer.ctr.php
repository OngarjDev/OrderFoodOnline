<?php
require_once '../Includes/autoload.inc.php';

class Customer_Controller
{
    protected $customer;
    protected $service;
    public function __construct()
    {
        $this->customer = new customer();
        $this->service = new connect_database();
    }

    public function handleRequest()
    {
        switch ($_REQUEST['action_Get']) {
            case 'AddCartFood':
                $this->AddCartFood();
                break;
            case 'Comment':
                $this->Comment();
                break;
            case 'UpdateAmountCart':
                $this->UpdateAmountCart();
                break;
            case 'AddOrder':
                $this->customer->AddOrder($_REQUEST);
                break;
            default:
                header("location: " . $_SERVER['HTTP_REFERER'] . "?Info=" . urlencode("ขออภัยเราไม่พบ Actionในระบบของคุณ"));
        }
    }
    private function UpdateAmountCart()
    {
        $existingCartData = json_decode($_COOKIE['cart'], true);
        $foundIndex = array_search($_REQUEST['IdFood_Get'], array_column($existingCartData, 'IdFood'));

        $existingCartData[$foundIndex]['amount'] = $_REQUEST['Amount'] ?? 1;
        $jsonCartData = json_encode($existingCartData);
        setcookie('cart', $jsonCartData, time() + 90000, '/');
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
    private function Comment()
    {
        $this->customer->Comment($_REQUEST);
    }
    private function AddCartFood()
    {
        if (isset($_COOKIE['cart'])) {
            // ถ้ามีให้ดึงข้อมูลจาก cookie และแปลงคืนเป็น array ด้วย unserialize
            $existingCartData = json_decode($_COOKIE['cart'], true);
        } else {
            // ถ้ายังไม่มีให้กำหนดให้เป็น array ว่าง
            $existingCartData = [];
        }

        // ตรวจสอบว่ามีรายการสินค้าที่ต้องการเพิ่มในตะกร้าหรือยัง
        $idFoodToAdd = $_REQUEST['IdFood_Get']; // เช่น สมมติว่าต้องการเพิ่ม IdFood 4 ลงในตะกร้า
        $amountToAdd = $_REQUEST['Amount_Get']; // เช่น สมมติว่าต้องการเพิ่ม 2 ชิ้น

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
            $newItem = ['IdFood' => $idFoodToAdd, 'amount' => $amountToAdd ?? 1];
            $existingCartData[] = $newItem;
        }

        // ทำการ serialized ข้อมูลและเก็บใน cookie
        $jsonCartData = json_encode($existingCartData);
        setcookie('cart', $jsonCartData, time() + 10000, '/');
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
}

$controller = new Customer_Controller();
$controller->handleRequest();
