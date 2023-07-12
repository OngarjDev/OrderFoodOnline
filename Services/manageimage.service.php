<?php
class manageimage
{
    /**
     * สำหรับการย้ายไฟล์ไปยัง Data 
     * @return คืนค่า path ไฟล์ ที่เก็บอยู่ใน โฟล์เดอร์Data 
     */
    public function MoveFile($fileName, $fileTmpName):string
    {
        $uploadDirectory = '../Data/Images/';
        $targetFilePath = $uploadDirectory . $fileName;
        move_uploaded_file($fileTmpName, $targetFilePath);
        return "../".$targetFilePath;
    }
}
