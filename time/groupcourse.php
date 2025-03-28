
<?php
require ("api/t.php")
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

<div class="col-12" id="content">
    <div class="card">
        <div class="card-header">
            <h2 class="text-black font-w600 mb-0 me-auto mb-2 mb-xl-0 pe-3">กลุ่มวิชา</h2>
            <!-- <button id="view_data" class="btn btn-primary view_data">Refresh Content</button> -->
            <a href="javascript:void(0)" class="btn btn-primary btn-rounded me-3 " data-bs-toggle="modal"
                data-bs-target="#groupCourse">
                <i class="fa fa-plus scale5 me-3"></i>
                เพิ่มรายการใหม่</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-responsive-md">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                foreach ($groupcourse as $group) 
                                {
                            ?>
                        <tr>
                            <td></td>
                            <td><?=$group['GROUPID']?></td>
                            <td><?=$group['GROUPNAME']?></td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"
                                        onclick="showUser(<?=$group['GROUPID']?>)" data-bs-toggle="modal"
                                        data-bs-target="#myModal"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="javascript:void(0)"
                                        class="btn btn-danger shadow btn-xs sharp delete-timeslot"
                                        data-id="<?=$group['GROUPID']?>"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php
                                }
                                $n = $group['GROUPID'];
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Handle delete button click

        $('.view_data').click(function () {

            $.ajax({
                url: "./time/groupcourse.php",
                method: "post",
                //	data:{id:uid},
                success: function (data) {
                    $('#content').html(data);
                }
            });
        });

        $('.delete-timeslot').click(function () {
            var timeslotId = $(this).data('id'); // Get the TIMESLOTID from the data-id attribute
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการลบรายการนี้หรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete the timeslot
                    $.ajax({
                        url: './time/module/delete_timeslot.php', // Replace with your delete endpoint
                        type: 'POST',
                        data: {
                            id: timeslotId
                        },
                        success: function (response) {
                            var res = JSON.parse(response);
                            if (res.status === 'success') {
                                Swal.fire(
                                    'ลบสำเร็จ!',
                                    res.message,
                                    'success'
                                ).then(() => {
                                  //  location.reload(); // Reload the page to reflect changes
                                  $.ajax({
                                        url: "./time/groupcourse.php",
                                        method: "post",
                                            //	data:{id:uid},
                                        success: function (data) {
                                            $('#content').html(data);
                                        }
                                    });
                                });
                            } else {
                                Swal.fire(
                                    'เกิดข้อผิดพลาด!',
                                    res.message,
                                    'error'
                                );
                            }
                        },
                        error: function () {
                            Swal.fire(
                                'เกิดข้อผิดพลาด!',
                                'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>