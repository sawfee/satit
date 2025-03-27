<?php

//เชื่อชาติ
$GroupcourseAapi = 'https://api-eduservice.yru.ac.th/api-fee/satit/time/groupcourse.php'; 
        // ดึงข้อมูลจาก API
        $groupcoursedata = file_get_contents($GroupcourseAapi);
        // ตรวจสอบว่าการดึงข้อมูลสำเร็จหรือไม่
        if ($groupcoursedata === FALSE) {
            die('เกิดข้อผิดพลาดในการดึงข้อมูลจาก API');
        }
        // แปลงข้อมูล JSON ให้เป็น array
        $groupcourse = json_decode($groupcoursedata, true);

        //ตรวจสอบว่ามีข้อมูลหรือไม่
        if(empty($groupcourse)) {
            die('ไม่พบข้อมูลจาก APIa');
        }
$SlotAapi = 'https://api-eduservice.yru.ac.th/api-fee/satit/time/slot.php'; 
        // ดึงข้อมูลจาก API
        $slotdata = file_get_contents($SlotAapi);
        // ตรวจสอบว่าการดึงข้อมูลสำเร็จหรือไม่
        if ($slotdata === FALSE) {
            die('เกิดข้อผิดพลาดในการดึงข้อมูลจาก API');
        }
        // แปลงข้อมูล JSON ให้เป็น array
        $slots = json_decode($slotdata, true);

        //ตรวจสอบว่ามีข้อมูลหรือไม่
        if(empty($slots)) {
            die('ไม่พบข้อมูลจาก APIa');
        }


?>
