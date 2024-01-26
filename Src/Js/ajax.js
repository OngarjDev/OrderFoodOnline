function ajax(method,url) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = xhr.responseText;
            console.log(response);
        }
    };

    // เปิดการเชื่อมต่อ request ไปยังเซิร์ฟเวอร์
    xhr.open(method, url, true);

    // กำหนด header ให้กับ request (สำหรับการใช้ method POST)
    xhr.setRequestHeader("Content-Type", "application/json");

    // ส่ง request ไปยังเซิร์ฟเวอร์ (สำหรับ method POST ให้ส่งข้อมูลผ่านค่า body)
    xhr.send();
}