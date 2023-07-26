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
            $DeCart = json_decode($_COOKIE['cart']);
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
    public function AddOrder($request){
        $DeCart = json_decode($_COOKIE['cart'], true);
        $sumprice = []; //Array เก็บค่า ผลรวมราคาทั้งหมด
        $existingCartData = [];
        foreach ($DeCart as $FoodCart) {
            $FoodInfo = $this->service->SelectTable(null, "food", "Where IdFood = " . $FoodCart['IdFood'])->fetch_assoc();
            $promotion = $this->service->SelectTable(null, "promotion", "Where IdShop = {$FoodInfo['IdShop']}")->fetch_assoc()['PersenPromotion'] ?? 0;
            $persen = $FoodInfo['PriceFood'] * $promotion / 100;
            $priceorigin = ($FoodInfo['PriceFood'] - $persen) * $FoodCart['amount'];
            array_push($sumprice, $priceorigin);
            $newItem = ['IdFood' => $FoodInfo['IdFood'],'NameFood'=>$FoodInfo['NameFood'], 'amount' => $FoodCart['amount'] ?? 1,'PriceFood' => $priceorigin];
            array_push($existingCartData,$newItem);
        }
        $sum = array_sum($sumprice);
        $currentDate = date('Y-m-d');
        // ทำการ serialized ข้อมูลและเก็บใน cookie
        $jsonCartData = json_encode($existingCartData, JSON_UNESCAPED_UNICODE);
        $this->service->InsertTable("orders","IdCustomer,FoodOrder,PriceOrder,StatusOrder,DateOrder","'{$_SESSION['IdUser_Session']}','$jsonCartData',$sum,0,'$currentDate'",null);
        setcookie('cart', '', 0, '/');
        header('location: ../Views/Customer/order.php?Info_Get=รายการสินค้าของคุณกำลังจัดส่ง');
    }
}
