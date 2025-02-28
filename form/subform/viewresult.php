<?php
session_start();
include('../../include/connectdb.php');
$id = @$_POST['id'];
$studentcode = '';
include "../../api/t.php";
$levelSQL = "SELECT
	AVSREG.A_STUDENTINFO_SATIT.STUDENTID, 
	AVSREG.A_STUDENTINFO_SATIT.STUDENTCODE, 
	AVSREG.A_STUDENTINFO_SATIT.NAME, 
	AVSREG.A_STUDENTINFO_SATIT.NAMEENG, 
	AVSREG.A_STUDENTINFO_SATIT.PROGRAMNAME, 
	AVSREG.A_STUDENTINFO_SATIT.STUDENTGROUPABB, 
	AVSREG.A_STUDENTINFO_SATIT.OFFICERNAME, 
	AVSREG.A_STUDENTINFO_SATIT.ADMITACADYEAR, 
	AVSREG.A_STUDENTINFO_SATIT.PREFIXNAME, 
	AVSREG.A_STUDENTINFO_SATIT.PREFIXNAMEENG, 
	AVSREG.A_STUDENTINFO_SATIT.STUDENTNAMEENG, 
	AVSREG.A_STUDENTINFO_SATIT.STUDENTNAME, 
	AVSREG.A_STUDENTINFO_SATIT.STUDENTSURNAME, 
	AVSREG.A_STUDENTINFO_SATIT.STUDENTSURNAMEENG, 
	AVSREG.A_STUDENTINFO_SATIT.LEVELCODE, 
	AVSREG.A_STUDENTINFO_SATIT.LEVELCODENAME, 
	AVSREG.A_STUDENTINFO_SATIT.STUDENTSEX, 
	AVSREG.A_STUDENTINFO_SATIT.GPA, 
    AVSREG.A_STUDENTINFO_SATIT.FINANCESTATUS,
    AVSREG.A_STUDENTINFO_SATIT.FN,
	AVSREG.A_STUDENTINFO_SATIT.CITIZENID, 
	AVSREG.A_STUDENTINFO_SATIT.PREFIXID, 
    TO_CHAR( AVSREG.A_STUDENTINFO_SATIT.BIRTHDATE, 'YYYY-MM-DD' ) AS BIRTHDATE,
    TO_CHAR( AVSREG.A_STUDENTINFO_SATIT.BIRTHDATE, 'DAY DD MONTH YYYY', 'NLS_CALENDAR=''THAI BUDDHA'' NLS_DATE_LANGUAGE=THAI' ) AS BD_THAI,
	AVSREG.A_STUDENTINFO_SATIT.ST,
    AVSREG.A_STUDENTINFO_SATIT.HOMEPHONENO
FROM
	AVSREG.A_STUDENTINFO_SATIT
WHERE
    AVSREG.A_STUDENTINFO_SATIT.STUDENTCODE = '$studentcode'
";	
$objParse_level = oci_parse($objConnect, $levelSQL);
oci_execute ($objParse_level,OCI_DEFAULT);
$objResulte = oci_fetch_array($objParse_level,OCI_BOTH);
$Numrow = oci_num_rows($objParse_level);

if($Numrow == 0) {

if(@$users["FN"]=='N'){
    $sp = 'class="text-success fs-16 font-w500 text-end d-block"';
} else {
    $sp = 'class="text-danger fs-16 font-w500 text-end d-block"';
}
?>

<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="clearfix">
            <div class="card  profile-card author-profile m-b30">
                <div class="card-body">
                    <div class="p-5">
                        <div class="author-profile">
                            <div class="author-media">
                                <img src="assets/images/tab/1.jpg" alt="">
                                <div class="upload-link" title="" data-toggle="tooltip" data-placement="right"
                                    data-original-title="update">
                                    <input type="file" class="update-flie">
                                    <i class="fa fa-camera"></i>
                                </div>
                            </div>
                            <div class="author-info">
                                <h6 class="title"><?=@$_POST['id']?></h6>
                                <span><?php echo @$users['NAME']?></span>
                            </div>
                        </div>
                    </div>
                    <div class="info-list">
                        <ul>
                            <li><a href="app-profile.php">ระดับ</a><span><?php echo $users['LEVELCODENAME'] ?></span>
                            </li>
                            <li><a href="uc-lightgallery.php">ชั้น</a><span><?php echo $users['PROGRAMNAME'] ?></span>
                            </li>
                            <li><a href="app-profile.php">สถานะ</a><span
                                    class="text-success fs-16 font-w500 text-end d-block"><?php echo $users['ST'] ?></span>
                            </li>
                            <li><a href="app-profile.php">GPA</a><span><?php echo $users['GPA'] ?></span></li>
                            <li><a href="app-profile.php">สถานะการเงิน</a><span
                                    <?php echo $sp;?>><?php echo $users['FINANCESTATUS'] ?></span></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="card-footer">
                    <div class="input-group mb-3">
                        <div class="form-control rounded text-center">Portfolio</div>
                    </div>
                    <div class="input-group">
                        <a href="https://www.dexignlab.com/" target="_blank"
                            class="form-control text-hover rounded ">https://www.dexignlab.com/</a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8">
        <div class="card profile-card m-b30">
            <div class="card-header">
                <h4 class="card-title">ระเบียนนักเรียน <?php //echo $objResulte['PREFIXID1']?></h4>
            </div>
            <form class="profile-form" id="formdata" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label">คำนำหน้า</label>
                                <select class="default-select form-control" id="prefix" name="prefix">
                                    <option data-display="Select">กรุณาเลือก</option>
                                    <option value="5" <?php if($users['STUDENTSEX']=='M'){ echo 'selected'; }?>>เด็กชาย
                                    </option>
                                    <option value="6" <?php if($users['STUDENTSEX']=='F'){ echo 'selected'; }?>>เด็กหญิง
                                    </option>
                                    <option value="O">อื่นๆ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="Name">ชิ่อ</label>
                                <input type="text" class="form-control" value="<?php echo $users['STUDENTNAME'] ?>"
                                    name="fname">
                                <input type="hidden" class="form-control" value="<?php echo $users['STUDENTCODE'] ?>"
                                    id="stdcode" name="stdcode">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="Surname">นามสกุล</label>
                                <input type="text" class="form-control" value="<?php echo @$users['STUDENTSURNAME'] ?>"
                                    name="lname">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <!-- <div class="mb-3">
                                <label class="form-label">PREFIX</label>
                                <select class="default-select form-control" id="validationCustom05" >
                                    <option data-display="Select">Please select</option>
                                    <option value="5" <?php if($objResulte['PREFIXID']=='5'){ echo 'selected'; }?>>Mstr.</option>
                                    <option value="6" <?php if($objResulte['PREFIXID']=='6'){ echo 'selected'; }?>>Miss</option>
                                    <option value="O">อื่นๆ</option>
                                </select>
                            </div> -->
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="Name">NAME</label>
                                <input type="text" class="form-control" value="<?php echo @$users['STUDENTNAMEENG'] ?>"
                                    name="fnamee" id="fnamee">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="Surname">SURNAME</label>
                                <input type="text" class="form-control"
                                    value="<?php echo @$users['STUDENTSURNAMEENG'] ?>" name="lnamee" id="lnamee">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="Specialty">เลขบัตรประขาขน</label>
                                <input type="number" class="form-control" value="<?php echo @$users['CITIZENID'];?>"
                                    id="citizenid" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="Skills">Skills</label>
                                <input type="text" class="form-control" value="HTML,  JavaScript,  PHP" id="Skills">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">เพศ</label>
                                <select class="default-select form-control" name="sex" disabled>
                                    <option value="">กรุณาเลือก</option>
                                    <option value="M" <?php if($users['STUDENTSEX']=='M'){ echo 'selected'; }?>>ชาย
                                    </option>
                                    <option value="F" <?php if($users['STUDENTSEX']=='F'){ echo 'selected'; }?>>
                                        หญิง</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="datepicker">วันเกิด
                                    <?php echo '  '.@$users['BD_THAI']?></label>
                                <div class="input-hasicon mb-xl-0 mb-3">
                                    <input type="date" class="form-control " name="birthdate" id="birthdate"
                                        value="<?php echo @$users["BIRTHDAY"]?>"
                                        title="กรุณาตรวจสอบข้อมูลให้ถูกต้อง (รูปแบบวันที่ เดือน/วัน/ปี ค.ศ.)"
                                        data-toggle="tooltip" data-placement="top" readonly />
                                    <!-- <input class="form-control mb-xl-0 mb-3 bt-datepicker" type="date" id="datepicker"> -->

                                    <div class="icon"><i class="far fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">โทรศัพท์</label>
                                <input type="number" readonly class="form-control" name="tel"
                                    value="<?php echo @$users["TEL1"];?>" placeholder="123456789"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="Email">Email address</label>
                                <input type="text" class="form-control"
                                    placeholder="<?php echo $users["STUDENTCODE"].'@yru.ac.th';?>" value="" name="name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-update ">UPDATE</button>
                    <button type="button" class="btn btn-primary btn-bio">ระเบียนนักเรียนเพิ่มเติม</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="alert alert-danger solid alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
    </button>
    <strong>Error!</strong> ไม่พบรหัสนักเรียน. <?php echo @$studentcode?>
</div>
<?php
}
?>

<script src="assets/js/fee.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.btn-bio').click(function () {
            var user = document.getElementById('stdcode').value;
            $.ajax({
                url: "./form/subform/studentbio.php",
                method: "post",
                data: {
                    id: user
                },
                success: function (data) {
                    $('#v_result').html(data);
                    document.getElementById("studentid").value = "";
                    $('.view').attr('disabled', true);
                }
            })
        })
        $('.btn-update').click(function () {
            var fnamee = document.getElementById('fnamee').value;
            var lnamee = document.getElementById('lnamee').value;
            if (fnamee === '') {
                $('#fnamee').addClass('border-danger');
            } else if (lnamee === '') {
                $('#lnamee').addClass('border-danger');
            } else {

                $('#fnamee').removeClass('border-danger');
                //$('#fnamee').addClass('border-success');
                Swal.fire({
                    title: 'ยืนยันบันทึกข้อมูล?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่, บันทึกข้อมูล!',
                    showLoaderOnConfirm: true,
                    preConfirm: function () {
                        return new Promise(function (resolve, reject) {
                            var formData = $('#formdata').serialize();
                            $.ajax({
                                url: "./form/subform/t.php",
                                type: 'POST',
                                data: formData + '&action=addmaster',
                                // data: {
                                //     id: formData
                                // },
                                dataType: 'json',
                                success: function (response) {
                                    // You can handle the response from the server here

                                    if (response.status === 'success') {
                                        //resolve(); // Proceed with closing the SweetAlert
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 2000,
                                            timerProgressBar: true,
                                            didOpen: (
                                            toast) => {
                                                toast
                                                    .onmouseenter =
                                                    Swal
                                                    .stopTimer;
                                                toast
                                                    .onmouseleave =
                                                    Swal
                                                    .resumeTimer;
                                            }
                                        });
                                        // Swal.fire({
                                        //     title: 'สำเร็จ!',
                                        //     text: response.message, // Display message from server
                                        //     icon: 'success',
                                        // })
                                        Toast.fire({
                                            icon: "success",
                                            title: response
                                                .message
                                        }).then(function () {
                                            // Optionally reload or take other action after success
                                            //location.reload();
                                            // $('.btn-bio').attr('disabled',false);
                                        });
                                    } else {
                                        reject
                                    (); // Reject the promise if the request wasn't successful
                                        Swal.fire({
                                            title: 'เกิดข้อผิดพลาด',
                                            text: 'ไม่สามารถบันทึกข้อมูลได้',
                                            icon: 'error',
                                        });
                                    }
                                },
                                error: function (xhr, status, error) {
                                    reject
                                (); // Reject the promise if there is an error in the AJAX request
                                    Swal.fire({
                                        title: 'ข้อผิดพลาดในการเชื่อมต่อ',
                                        text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้',
                                        icon: 'error',
                                    });
                                }
                            });
                        })
                    }
                });


            }

            // Swal.fire({
            //         title: 'ยืนยันบันทึกวันเวลามสอบ?',
            //         icon: 'warning',
            //         //text: "It will be Delete permanently!",
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'ใช่, บันทึกข้อมูล!',
            //         showLoaderOnConfirm: true,
            //         preConfirm: function() {
            //             return new Promise(function(resolve) {
            //                 $.ajax({
            //                     url:"./form/subform/viewresult.php",
            //                     type: 'POST',

            //                     data:{id:12},

            //                 })
            //                     .done(function() {
            //                         const Toast = Swal.mixin({
            //                             toast: true,
            //                             position: "top-end",
            //                             showConfirmButton: false,
            //                             timer: 2000,
            //                             timerProgressBar: true,
            //                             didOpen: (toast) => {
            //                                 toast.onmouseenter = Swal.stopTimer;
            //                                 toast.onmouseleave = Swal.resumeTimer;
            //                             }
            //                         });
            //                         Toast.fire({
            //                             icon: "success",
            //                             title: "เปลี่ยนสถานะสำเร็จ"
            //                         })
            //                     })
            //                     .fail(function() {
            //                         Swal.fire('Oops...', 'ไม่สามารถลบรายการนี้ได้ !', 'error')
            //                         $.ajax({
            //                             url:"./setting/subform/viewexam.php",
            //                             method:"post",
            //                             data:{id:1},
            //                             success:function(data){
            //                                 $('#view_exam').html(data);
            //                             }
            //                         });

            //                     });
            //             });
            //         },
            // });           
        })


    })
</script>