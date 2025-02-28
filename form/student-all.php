<?php
//include("include/connectdb.php");
// กำหนด URL ของ API (แทนที่ด้วย URL ของ API ที่ต้องการ)
$apiUrl = 'https://api-eduservice.yru.ac.th/api-fee/satit/studentall.php'; 

// ดึงข้อมูลจาก API
$data = file_get_contents($apiUrl);

// ตรวจสอบว่าการดึงข้อมูลสำเร็จหรือไม่
if ($data === FALSE) {
    die('เกิดข้อผิดพลาดในการดึงข้อมูลจาก API');
}

// แปลงข้อมูล JSON ให้เป็น array
$users = json_decode($data, true);

// ตรวจสอบว่ามีข้อมูลหรือไม่
if (empty($users)) {
    die('ไม่พบข้อมูลจาก API');
}
?>

<script>
    function showUser(str) {
        if (str == "") {
            document.getElementById("view_student").innerHTML = "";
            return;
        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("data").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","view/viewstudent.php?id="+str,true);
            xmlhttp.send();
        }
    }
</script>

<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo $head;?></a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?php echo $title;?></a></li>
        </ol>
    </div>
    <div class="row" id="v_result">
        <div class="col-xl-12">
            <div class="filter cm-content-box box-primary">
                <div class="content-title SlideToolHeader">
                    <div class="cpa">
                        <i class="fa-sharp fa-solid fa-filter me-2"></i>ค้นหา
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                                <label class="form-label">Status</label>
                                <select class="form-control default-select h-auto wide"
                                    aria-label="Default select example">
                                    <option selected>เลือกระดับ</option>
                                    <option value="1">ระดับปฐมวัย</option>
                                    <option value="2">ระดับประถมศึกษา</option>
                                    <option value="3">ระดับมัธยม</option>
                                </select>
                            </div>

                            <div class="col-xl-3 col-sm-6 align-self-end">
                                <div>
                                    <button class="btn btn-primary me-2" title="Click here to Search" type="button"><i
                                            class="fa fa-filter me-1"></i>ตกลง</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profile Datatable</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display min-w850">
                        <thead>
                            <tr>
                                <th>รหัสนักเรียน</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>ระดับ</th>
                                <th>เบอร์โทรบิดา</th>
                                <th>เบอร์โทรมารดา</th>
                                <th>ที่ปรึกษา</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
		                    foreach ($users as $user) 
                            {
                         ?>

                            <tr>
                                <td><?=$user['STUDENTCODE']?></td>
                                <td><?=$user['NAME']?></td>
                                <td><?=$user['PROGRAMNAME']?></td>

                                <td><a href="javascript:void(0);"><strong><?=@$user['TEL_F']?></strong></a></td>
                                <td><a href="javascript:void(0);"><strong><?=@$user['TEL_M']?></strong></a>
                                </td>
                                <td>2011/04/25</td>
                                <td>
                                    <div class="d-flex">
                                        <!-- <p class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-trash-alt view_student" id=<?=$user['APPLICANTID']?> data-bs-toggle="modal" data-bs-target="#myModal"></i></p> -->
                                        
                                        <a href="#" class="btn btn-primary shadow btn-xs sharp" onclick="showUser(<?=$user['APPLICANTID']?>)" data-bs-toggle="modal" data-bs-target="#myModal"><i
                                                class="fas fa-pencil-alt"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>