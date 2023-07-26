<?php
require_once "../../vendor/autoload.php";

use Mpdf\Mpdf;

$mpdf = new Mpdf(['mode' => 'utf-8']);
$mpdf->autoScriptToLang = true;
$mpdf->autoLangToFont = true;
$mpdf->autoLangToFont = 'DejaVu Sans';

session_start();
require_once "../../Includes/autoload.inc.php";
// IncludeData ดึงข้อมูลร้านค้าจากฐานข้อมูลทั้งหมด
$service = new connect_database();
$ShopInfo = $service->SelectTable(null, "users", "Where idAll = {$_SESSION['IdUser_Session']}")->fetch_assoc();

// IncludeData ดึงข้อมูลออเดอร์ที่เกี่ยวกับประวัติการสั่งซื้อทั้งหมด
if($_REQUEST['Type_Get'] == "Date"){
$OrderInfo = $service->SelectTable(null, "orders", "Where IdShop = {$_SESSION['IdUser_Session']} AND DATE(DateOrder) = CURDATE() AND StatusOrder = 3");
$header = 'สรุปรายงานการขายรายวัน ข้อมูลวันที่' . date("d-m-Y");
$Type = "วัน";
}else if($_REQUEST['Type_Get'] == "Month"){
    $OrderInfo = $service->SelectTable(null, "orders", "Where IdShop = {$_SESSION['IdUser_Session']} AND  MONTH(DateOrder) = MONTH(CURDATE()) AND StatusOrder = 3");
    $header = 'สรุปรายงานการขายรายเดือน ข้อมูลวันที่' . date("d-m-Y");
    $Type = "เดือน";
}else if($_REQUEST['Type_Get'] == "Year"){
    $OrderInfo = $service->SelectTable(null, "orders", "Where IdShop = {$_SESSION['IdUser_Session']} AND  YEAR(DateOrder) = YEAR(CURDATE()) AND StatusOrder = 3");
    $header = 'สรุปรายงานการขายรายปี ข้อมูลวันที่' . date("d-m-Y");
    $Type = "ปี";
}
$mpdf->SetHeader($header);

$DataOrder = '';
$Sumprice = [];
foreach ($OrderInfo as $Order) {
    $Decodejson = json_decode($Order['FoodOrder'], true);
    foreach ($Decodejson as $Food) {
        array_push($Sumprice, $Food['PriceFood']);
        $DataOrder .= <<<EOA
<tr>
            <td style="padding: 5px;">{$Order['IdOrder']}</td>
            <td style="padding: 5px;">{$Food['IdFood']}</td>
            <td style="padding: 5px;">{$Food['NameFood']}</td>
            <td style="padding: 5px;">{$Food['amount']}</td>
            <td style="padding: 5px;">{$Food['PriceFood']}</td>
        </tr>
EOA;
    }
}
// โครงสร้างPDF ทั้งหมด
$Total = array_sum($Sumprice);
$htmlorigin = <<<EOB
<!DOCTYPE html>
<html>
<head>
    <title>'.$header.'</title>
</head>
<body>
    <h1 style="margin: 0px;panding: 0px">ร้าน{$ShopInfo['NameAll']}</h1>
    <p style="margin: 0px;panding: 0px">ตั้งอยู่ที่: {$ShopInfo['AddressCustomer']}</p>
    <p style="margin: 0px;panding: 0px">สรุปการขายต่อ: $Type</p>
    <table border="1" style="border:solid;border-collapse: collapse;width:100%;text-align:center;">
    <thead >
        <tr>
        <td style="font-size: 20px;padding: 7px;">รหัสคำสั่งซื้อ</td>
        <td style="font-size: 20px;padding: 7px;">รหัสเมนูอาหาร</td>
        <td style="font-size: 20px;padding: 7px;">ชื่ออาหาร</td>
        <td style="font-size: 20px;padding: 7px;">จำนวนที่ซื้อ</td>
        <td style="font-size: 20px;padding: 7px;">ราคารวม</td>
        </tr>
    </thead>
    <tbody>
        {$DataOrder}
        <tr>
            <td colspan="2" style="padding: 7px">รวมทั้งหมด</td>
            <td colspan="4" style="padding: 7px">$Total บาท</td>
        </tr>
    </tbody>
    </table>
    <p style="text-align:center;">*** หมายเหตุ: ราคารวมคือ รวมจำนวนที่ซื้อและส่วนลดแล้ว ***</p>
</body>
</html>
EOB;

//ให้Mpdf เขียน นำHTML ไปวางใน PDF เลย
$mpdf->WriteHTML($htmlorigin);

//แสดงผลให้เปิด PDF ในหน้าดังกล่าว หากใส่ (ภายในต้องใส่ที่อยู่ที่จะเก็บPDF)
$mpdf->Output();
