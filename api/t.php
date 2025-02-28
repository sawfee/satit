<?php
 // กำหนด URL ของ API (แทนที่ด้วย URL ของ API ที่ต้องการ)
 //echo 'รหัสคือ'.$id;
        $apiUrl = 'https://api-eduservice.yru.ac.th/api-fee/satit/student.php?id='.$id; 
        // ดึงข้อมูลจาก API
        $data = file_get_contents($apiUrl);
        // ตรวจสอบว่าการดึงข้อมูลสำเร็จหรือไม่
        if ($data === FALSE) {
            die('เกิดข้อผิดพลาดในการดึงข้อมูลจาก API');
        }
        // แปลงข้อมูล JSON ให้เป็น array
        $users = json_decode($data, true);

        //ตรวจสอบว่ามีข้อมูลหรือไม่
        if(empty($users)) {
            die('<div class="alert alert-danger solid alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                </button>
                <strong>Error!</strong> ไม่พบรหัสนักเรียน.'.$id.'
            </div>');
        }

//เชื่อชาติ
$RaceAapi = 'https://api-eduservice.yru.ac.th/api-fee/satit/ref-data/ref_race.php'; 
        // ดึงข้อมูลจาก API
        $racesdata = file_get_contents($RaceAapi);
        // ตรวจสอบว่าการดึงข้อมูลสำเร็จหรือไม่
        if ($racesdata === FALSE) {
            die('เกิดข้อผิดพลาดในการดึงข้อมูลจาก API');
        }
        // แปลงข้อมูล JSON ให้เป็น array
        $races = json_decode($racesdata, true);

        //ตรวจสอบว่ามีข้อมูลหรือไม่
        if(empty($races)) {
            die('ไม่พบข้อมูลจาก APIa');
        }
//สัญชาติ
$NationAapi = 'https://api-eduservice.yru.ac.th/api-fee/satit/ref-data/ref_nation.php'; 
        // ดึงข้อมูลจาก API
        $nationsdata = file_get_contents($NationAapi);
        // ตรวจสอบว่าการดึงข้อมูลสำเร็จหรือไม่
        if ($nationsdata === FALSE) {
            die('เกิดข้อผิดพลาดในการดึงข้อมูลจาก API');
        }
        // แปลงข้อมูล JSON ให้เป็น array
        $nations = json_decode($nationsdata, true);

        //ตรวจสอบว่ามีข้อมูลหรือไม่
        if(empty($nations)) {
            die('ไม่พบข้อมูลจาก APIa');
        }
//จังหวัด
$ProvinceAapi = 'https://api-eduservice.yru.ac.th/api-fee/satit/ref-data/ref_province.php'; 
        // ดึงข้อมูลจาก API
        $provincedata = file_get_contents($ProvinceAapi);
        // ตรวจสอบว่าการดึงข้อมูลสำเร็จหรือไม่
        if ($provincedata === FALSE) {
            die('เกิดข้อผิดพลาดในการดึงข้อมูลจาก API');
        }
        // แปลงข้อมูล JSON ให้เป็น array
        $province = json_decode($provincedata, true);

        //ตรวจสอบว่ามีข้อมูลหรือไม่
        if(empty($province)) {
            die('ไม่พบข้อมูลจาก APIa');
        }
//จังหวัด
$DistrictAapi = 'https://api-eduservice.yru.ac.th/api-fee/satit/ref-data/ref_district.php'; 
        // ดึงข้อมูลจาก API
        $districtdata = file_get_contents($DistrictAapi);
        // ตรวจสอบว่าการดึงข้อมูลสำเร็จหรือไม่
        if ($districtdata === FALSE) {
            die('เกิดข้อผิดพลาดในการดึงข้อมูลจาก API');
        }
        // แปลงข้อมูล JSON ให้เป็น array
        $district = json_decode($districtdata, true);

        //ตรวจสอบว่ามีข้อมูลหรือไม่
        if(empty($district)) {
            die('ไม่พบข้อมูลจาก APIa');
        }
//จังหวัด
$SubDistrictAapi = 'https://api-eduservice.yru.ac.th/api-fee/satit/ref-data/ref_subdistrict.php'; 
        // ดึงข้อมูลจาก API
        $subdistrictdata = file_get_contents($SubDistrictAapi);
        // ตรวจสอบว่าการดึงข้อมูลสำเร็จหรือไม่
        if ($subdistrictdata === FALSE) {
            die('เกิดข้อผิดพลาดในการดึงข้อมูลจาก API');
        }
        // แปลงข้อมูล JSON ให้เป็น array
        $subdistrict = json_decode($subdistrictdata, true);

        //ตรวจสอบว่ามีข้อมูลหรือไม่
        if(empty($subdistrict)) {
            die('ไม่พบข้อมูลจาก APIa');
        }

$DegreeAapi = 'https://api-eduservice.yru.ac.th/api-fee/satit/ref-data/ref_degree.php'; 
        // ดึงข้อมูลจาก API
        $degreedata = file_get_contents($DegreeAapi);
        // ตรวจสอบว่าการดึงข้อมูลสำเร็จหรือไม่
        if ($degreedata === FALSE) {
            die('เกิดข้อผิดพลาดในการดึงข้อมูลจาก API');
        }
        // แปลงข้อมูล JSON ให้เป็น array
        $degree = json_decode($degreedata, true);

        //ตรวจสอบว่ามีข้อมูลหรือไม่
        if(empty($degree)) {
            die('ไม่พบข้อมูลจาก APIa');
        }
$OccupAapi = 'https://api-eduservice.yru.ac.th/api-fee/satit/ref-data/ref_occup.php'; 
        // ดึงข้อมูลจาก API
        $occupdata = file_get_contents($OccupAapi);
        // ตรวจสอบว่าการดึงข้อมูลสำเร็จหรือไม่
        if ($occupdata === FALSE) {
            die('เกิดข้อผิดพลาดในการดึงข้อมูลจาก API');
        }
        // แปลงข้อมูล JSON ให้เป็น array
        $occup = json_decode($occupdata, true);

        //ตรวจสอบว่ามีข้อมูลหรือไม่
        if(empty($occup)) {
            die('ไม่พบข้อมูลจาก APIa');
        }
?>
