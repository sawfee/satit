<?php
require ("time/api/t.php")
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
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("data").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "view/viewstudent.php?id=" + str, true);
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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="text-black font-w600 mb-0 me-auto mb-2 mb-xl-0 pe-3"><?php echo $title;?></h2>
                <a href="javascript:void(0)" class="btn btn-primary btn-rounded me-3 " data-bs-toggle="modal"
                    data-bs-target="#timeSlot">
                    <i class="fa fa-plus scale5 me-3"></i>
                    เพิ่มรายการใหม่</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display min-w850">
                        <thead>
                            <tr>
                                <th></th>
                                <th>คาบ</th>
                                <th>เวลามเริ่ม</th>
                                <th>เวลาถึง</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($slots as $slot) 
                                {
                            ?>
                            <tr>
                                <td><img class="rounded-circle" width="35" src="assets/images/profile/small/pic1.jpg"
                                        alt=""></td>
                                <td><?=$slot['TIMESLOTID']?></td>
                                <td><?=$slot['SLOTFORM']?></td>
                                <td><?=$slot['TIMWSLOTTO']?></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"
                                            onclick="showUser(<?=$slot['TIMESLOTID']?>)" data-bs-toggle="modal"
                                            data-bs-target="#myModal"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp delete-timeslot" 
                                            data-id="<?=$slot['TIMESLOTID']?>"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
