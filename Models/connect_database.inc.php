<?php 
class connect_database
{
    public $ObjConnect;

    public function __construct()
    {
        $this->ObjConnect =new mysqli("localhost:3306", "root", "", "orderfoodonline");
        if (!$this->ObjConnect) {
            die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $this->ObjConnect->connect_error);
        }
    }
/**
 * @param ?string $colname สำหรับใส่ข้อมูล colnameให้ตรงกับฐานข้อมูล
 * @param string $TableName สำหรับใส่ชื่อ Table เพื่อนหาค้
 * @param ?string $Sort สำหรับการจัดเรียง default คือ ASC
 * @param ?string $sqlcustom สำหรับคำสั่งSql เพิ่มกรณีที่อยากจัดเรียง หรือ ค้นหา(Where)
 * @return ส่งค่าเป็น Sql Query
 */
public function SelectTable(?string $colname = null, string $TableName = "",?string $sqlcustom = null): object
{
    $colname = $colname ?? "*";
    $Sort = $Sort ?? "ASC";
    if ($TableName != "") {
        $sql = "SELECT " . $colname . " FROM " . $TableName." ".$sqlcustom;
        return $this->ObjConnect->query($sql);
    }
    $this->ObjConnect->close();
    return false;
}
/**
 * สำหรับการเพิ่มข้อมูล
 * @param string $TableName สำหรับตำแหน่งที่ต้องการเพิ่ม;
 * @param string $colname สำหรับ col ที่ต้องการเพิ่มข้อมูล  
 * ตัวอย่างการส่ง "NameAll,PasswordAll,RoleAll"
 * @param string $Data สำหรับ ข้อมูลที่ต้องการเพิ่ม
 * ตัวอย่างการส่ง "'phai','phaipass','RolePhai'"
 * @param string $sqlcustom สำหรับกรณีอยากใส่ค่าเพิ่ม
 * ตัวอย่าง ใส่คำสั่ง Sql อะไรก็ได้
 * return หากtrue ข้อมูลถูกเพิ่ม หากเป็นfalse เพิ่มไม่สำเร็จ
 */
    public function InsertTable(string $TableName, string $colname,string $Data,?string $sqlcustom) : bool
    {
        if ($TableName != "") {
            $sql = "INSERT INTO " . $TableName . "(" . $colname . ") VALUES (" . $Data . " )".$sqlcustom;
            return mysqli_query($this->ObjConnect, $sql);
        }
        $this->ObjConnect->close();
        return false;
    }
/**
 * สำหรับแก้ไขข้อมูล
 * @param $colname_Data สำหรับข้อมูลที่ต้องการแก้ไข
 * ตัวอย่างการส่ง NameAll = 'Kleng',PasswordAll = 'KlengPass'
 * @param $Where สำหรับ Row ของข้อมูลที่ต้องการแก้ไข
 * ตัวอย่างการส่ง "iduser = 5"
 * @return หากtrue ข้อมูลถูกแก้ไข หากเป็นfalse แก้ไขไม่สำเร็จ
 */
    public function UpdateTable(string $TableName, string $colname_Data, string $Where) : bool
    {
        $sql = "UPDATE " . $TableName . " SET " . $colname_Data . " WHERE " . $Where;
        return $this->ObjConnect->query($sql);
    }
/**
 * สำหรับข้อมูลที่ต้องการลบ
 * @param $Where สำหรับข้อมูลที่ต้องการลบ
 * ตัวอย่างการส่ง "iduser = 5"
 * @return หากtrue ข้อมูลถูกลบ หากเป็นfalse ลบไม่สำเร็จ
 */
    public function DeleteData(string $TableName, string $Where) : bool
    {
        $sql = "DELETE FROM " . $TableName . " WHERE " . $Where;
        return $this->ObjConnect->query($sql);
    }
    /**
     * เชื่อม หลายๆ Table เข้าด้วยกัน ในครั้งเดียว
     * @param $TableName1 ข้อมูลTable ชุดแรก
     * @param $TableName2 ข้อมูลTable ชุดสอง
     * @param $likeJoin สิ่งที่ทั้ง 2 Table มีเหมือนกัน เพื่อให้รับรู้ถึงเจ้าของข้อมูลนั้นๆ
     * @param $sqlcustom เพิ่มคำสั่ง Sql เพิ่มเติม
     * ตัวอย่างการส่ง Table1.IdUser = Table2.IdUser
     */
    public function InnerJoin(string $TableName1,string $TableName2,string $likeJoin,string $sqlcustom){
        $sql = "SELECT * FROM  $TableName1 INNER JOIN $TableName2 ON $likeJoin $sqlcustom";
        return $this->ObjConnect->query($sql);
    }
}
?>