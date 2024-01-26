<?php
require_once "../../vendor/autoload.php";

use Mpdf\Mpdf;

$mpdf = new Mpdf([
    'mode' => 'utf-8',
    'format' => 'A6',
]);
$mpdf->autoScriptToLang = true;
$mpdf->autoLangToFont = true;
$mpdf->autoLangToFont = 'DejaVu Sans';

session_start();
require_once "../../Includes/autoload.inc.php";
// IncludeData ดึงข้อมูลร้านค้าจากฐานข้อมูลทั้งหมด
$service = new connect_database();
$ShopInfo = $service->SelectTable(null, "users", "Where idAll = {$_SESSION['IdUser_Session']}")->fetch_assoc();

// IncludeData ดึงข้อมูลออเดอร์ที่เกี่ยวกับประวัติการสั่งซื้อตามIdOrder
$OrderInfo = $service->SelectTable(null, "orders", "Where IdOrder = {$_REQUEST['IdOrder_Get']}");
$header = "ใบเสร็จหมายเลขคำสั่งซื้อ: {$_REQUEST['IdOrder_Get']}";

$DataOrder = '';
$Sumprice = [];
foreach ($OrderInfo as $Order) {
    $Decodejson = json_decode($Order['FoodOrder'], true);
    foreach ($Decodejson as $Food) {
        array_push($Sumprice, $Food['PriceFood']);
        $DataOrder .= <<<EOA
<tr>
    <td style="padding: 3px;padding-top:10px">{$Food['NameFood']}({$Food['amount']})</td>
    <td style="padding: 3px;padding-top:10px;text-align:center;">{$Food['PriceFood']}</td>
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
    <h3 style="margin: 0px;panding: 0px;text-align:center;">ร้าน{$ShopInfo['NameAll']}</h3>
    <p style="font-size:15px;margin: 0px;panding: 0px;">รหัสคำสั่งซื้อ: {$_REQUEST['IdOrder_Get']} ( {$Order['DateOrder']} )</p>
    <table  style="width:100%;">
    <thead >
        <tr>
        <td style="font-size: 18px;">รายการ</td>
        <td style="font-size: 18px;text-align:center;">ราคา</td>
        </tr>
    </thead>
    <tbody>
        {$DataOrder}
        <tr>
            <td colspan="2"><hr></td>
        </tr>
        <tr>
            <td style="font-size:20px">รวมทั้งหมด</td>
            <td>$Total บาท</td>
        </tr>
    </tbody>
    </table>
</body>
</html>
EOB;

//ให้Mpdf เขียน นำHTML ไปวางใน PDF เลย
$mpdf->WriteHTML($htmlorigin);

//แสดงผลให้เปิด PDF ในหน้าดังกล่าว หากใส่ (ภายในต้องใส่ที่อยู่ที่จะเก็บPDF)
$mpdf->Output();
