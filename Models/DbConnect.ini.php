<?php 
class Connect_Database
{
    public $ObjConnect;

    public function Connect_Database()
    {
        $this->ObjConnect =new mysqli("localhost:33886", "root", "root", "orderfoodonline");
        if (!$this->ObjConnect) {
            die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $this->ObjConnect->connect_error);
            exit();
        }
        exit();
    }
/**
 * @param string $colname สำหรับใส่ข้อมูล colnameให้ตรงกับฐานข้อมูล
 * @param string $TableName
 * @param string $Sort
 * @return 
 */
    public function SelectTable(string $colname = "" ?? "*", string $TableName = "", string $Sort = "" ?? "ASC"): object
    {
        if ($TableName != "") {
            $sql = "SELECT " . $colname . " FROM " . $TableName . " ORDER BY " . $Sort;
            return $this->ObjConnect->query($sql);
        }
        $this->ObjConnect->close();
        return false;
    }

    public function InsertTable(string $TableName, string $colname, $Data) : bool
    {
        $escapedData = intval($Data);
        if ($TableName != "") {
            $sql = "INSERT INTO " . $TableName . "(" . $colname . ") VALUES (" . $escapedData . ")";
            return mysqli_query($this->ObjConnect, $sql);
        }
        
        return false;
    }

    public function UpdateTable(string $TableName, string $colname_Data, string $Where) : bool
    {
        $sql = "UPDATE " . $TableName . " SET " . $colname_Data . " WHERE " . $Where;
        return mysqli_query($this->ObjConnect, $sql);
    }

    public function DeleteTable(string $TableName, string $Where) : bool
    {
        $sql = "DELETE FROM " . $TableName . " WHERE " . $Where;
        return mysqli_query($this->ObjConnect, $sql);
    }
    // public function InnerJoin(){
    //     $sql = "INNER JOIN"
    // }
}
?>