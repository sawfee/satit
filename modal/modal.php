<!-- Full Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="data">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal คาบเรียน-->
<div class="modal fade" id="timeSlot">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">คาบเรียน <?php echo $part ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 col-xxl-6 mb-3">
                            <label class="form-label">เวลามเริ่ม</label>
                            <div class="input-group clockpicker">
                                <input type="text" class="form-control" value="09:30"><span
                                    class="input-group-text search_icon"><i class="far fa-clock"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 col-xxl-6 mb-3">
                            <label class="form-label">เวลาถึง</label>
                            <div class="input-group clockpicker">
                                <input type="text" class="form-control" value="09:30"><span
                                    class="input-group-text search_icon"><i class="far fa-clock"></i></span>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal กลุ่มวิชา-->
<div class="modal fade" id="groupCourse" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มกลุ่มวิชา</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"> -->
                </button>
            </div>
            <div class="modal-body">
                <form id='groupcourse-form'>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label required">ลำดับ</label>
                                <input type="number" class="form-control" id="cid" name='cid'
                                    placeholder="Example input placeholder" readonly value = '<?php echo $n+1;?>'>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label required">ชื่อกลุ่มวิชา</label>
                                <input type="text" class="form-control" id="cname" name="cname" placeholder="ป้อนชื่อกลุ่มวิชา">
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary save-groupcourse">บันทึกข้อมูล</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.save-groupcourse').click(function () {
            var cid = document.getElementById('cid').value;
            var cname = document.getElementById('cname').value;
            if (cname === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'ข้อผิดพลาด',
                    text: 'กรุณากรอกชื่อกลุ่มวิชา (CNAME)',
                });
                $('#cname').addClass('border-danger'); // Highlight the input field
                return; // Stop further execution
            }
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
                        var formData = $('#groupcourse-form').serialize();
                        $.ajax({
                            url: "./time/module/core.php",
                            type: 'POST',
                            data: formData + '&action=addmaster',
                            dataType: 'json',
                            success: function (response) {
                                if (response.status === 'success') {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 1000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal.stopTimer;
                                            toast.onmouseleave = Swal.resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: response.message
                                    }).then(function () {
                                        $('#groupCourse').modal('toggle');
                                        $.ajax({
                                            url: "./time/groupcourse.php",
                                            method: "post",
                                            //	data:{id:uid},
                                            success: function (data) {
                                                $('#content').html(data);
                                            }
                                        });
                                      //  location.reload();
                                    });
                                } else {
                                    reject();
                                    Swal.fire({
                                        title: 'เกิดข้อผิดพลาด',
                                        text: 'ไม่สามารถบันทึกข้อมูลได้',
                                        icon: 'error',
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                reject();
                                Swal.fire({
                                    title: 'ข้อผิดพลาดในการเชื่อมต่อ',
                                    text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้',
                                    icon: 'error',
                                });
                            }
                        });
                    });
                }
            });
        });

        $('#groupCourse').on('hidden.bs.modal', function () {
            $('#groupcourse-form')[0].reset(); // Reset the form
            $('#cname').removeClass('border-danger'); // Remove validation styles
        });

        $('#cname').keyup(function () {
            $('#cname').removeClass('border-danger');
        });
    });
</script>