<?php
require_once "../../vendor/autoload.php";
use Mpdf\Mpdf;

$mpdf = new Mpdf(['mode' => 'utf-8']);
$mpdf->autoScriptToLang = true;
$mpdf->autoLangToFont = true;
$mpdf->autoLangToFont = 'DejaVu Sans';
$header = 'สรุปรายงานการขาย '.date("d-m-Y");
$mpdf->SetHeader($header);

session_start();
require_once "../../Includes/autoload.inc.php";
// IncludeData ดึงข้อมูลร้านค้าจากฐานข้อมูลทั้งหมด
$service = new connect_database();
$ShopInfo = $service->SelectTable(null,"users","Where idAll = {$_SESSION['IdUser_Session']}")->fetch_assoc();

// IncludeData ดึงข้อมูลออเดอร์ที่เกี่ยวกับร้านค้าทั้งหมด
$OrderInfo = $service->SelectTable(null,"orders","Where IdShop = {$_SESSION['IdUser_Session']}")->fetch_assoc();

$DataOrder = '';
foreach ($OrderInfo as $Order){
$DataOrder .= <<<EOA
<tr>
            <td>{$order['OrderId']}</td>
            <td>{$order['FoodId']}</td>
            <td>{$order['FoodName']}</td>
            <td>{$order['FoodPrice']}</td>
            <td>{$order['Quantity']}</td>
        </tr>
EOA;
}
// HTML content of the receipt
$htmlorigin = <<<EOB
<!DOCTYPE html>
<html>
<head>
    <title>'.$header.'</title>
</head>
<body>
    <h1 style="margin: 0px;panding: 0px">ร้าน{$ShopInfo['NameAll']}</h1>
    <p style="margin: 0px;panding: 0px">ตั้งอยู่ที่: {$ShopInfo['AddressCustomer']}</p>
    <table border="1" style="border:solid;border-collapse: collapse;width:100%;text-align:center;">
    <thead >
        <tr>
        <td style="font-size: 20px;padding: 7px;">รหัสคำสั่งซื้อ</td>
        <td style="font-size: 20px;padding: 7px;">รหัสเมนูอาหาร</td>
        <td style="font-size: 20px;padding: 7px;">ชื่ออาหาร</td>
        <td style="font-size: 20px;padding: 7px;">ราคาอาหาร</td>
        <td style="font-size: 20px;padding: 7px;">จำนวนที่ซื้อ</td>
        </tr>
    </thead>
    <tbody>
        {$DataOrder}
    </tbody>
    </table>
</body>
</html>
EOB;

//ให้Mpdf เขียน นำHTML ไปวางใน PDF เลย
$mpdf->WriteHTML($htmlorigin);

//แสดงผลให้เปิด PDF ในหน้าดังกล่าว หากใส่ (ภายในต้องใส่ที่อยู่ที่จะเก็บPDF)
$mpdf->Output();