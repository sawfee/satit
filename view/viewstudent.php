<?php
@session_start();
@$id=$_GET['id'];
include "../api/t.php";
?>
<!-- <link href="../assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/style.css" rel="stylesheet" type="text/css" /> -->
<div class="row">
    <form class="profile-form" id="formdata">
        <div class="col-xl-12 col-lg-12">
            <div class="card profile-card m-b30">
                <div class="card-header">
                    <h4 class="card-title">ระเบียนนักเรียนเพิ่มเติม </h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="mb-3">
                                <label class="form-label" for="Name">รหัสนักเรียน</label>
                                <input type="number" readonly class="form-control"
                                    value="<?php echo @$users['STUDENTCODE'] ?>" name="stdcode" id="stdcode">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mb-3">
                                <label class="form-label">คำนำหน้า</label>
                                <select class="default-select form-control" disabled id="prefix" name="prefix" >
                                    <option data-display="Select">กรุณาเลือก</option>
                                    <option value="5" <?php if(@$users['PREFIXID'] =='5'){ echo 'selected'; }?>>
                                        เด็กชาย</option>
                                    <option value="6" <?php if(@$users['PREFIXID'] =='6'){ echo 'selected'; }?>>
                                        เด็กหญิง</option>
                                    <option value="O">อื่นๆ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="Name">ชิ่อ</label>
                                <input type="text" readonly class="form-control"
                                    value="<?php echo @$users['STUDENTNAME'] ?>" name="fname" >
                                <input type="hidden" class="form-control"
                                    value="<?php echo $users['STUDENTCODE'] ?>" name="stdcode" id="stdcode">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="Surname">นามสกุล</label>
                                <input type="text" readonly class="form-control"
                                    value="<?php echo @$users['STUDENTSURNAME'] ?>" name="lname">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mb-3">
                                <label class="form-label" for="Specialty">เลขบัตรประขาขน</label>
                                <input type="number" class="form-control"
                                    value="<?php echo @$users['CITIZENID'];?>" id="citizenid">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mb-3">
                                <label class="form-label" for="datepicker">วันเกิด
                                    <?php echo '  '.@$users['BD_THAI']?></label>
                                <div class="input-hasicon mb-xl-0 mb-3">
                                    <input type="date" class="form-control " name="birthdate" id="birthdate"
                                        value="<?php echo @$users["BIRTHDAY"]?>"
                                        title="กรุณาตรวจสอบข้อมูลให้ถูกต้อง (รูปแบบวันที่ เดือน/วัน/ปี ค.ศ.)"
                                        data-toggle="tooltip" data-placement="top"  />
                                    <!-- <input class="form-control mb-xl-0 mb-3 bt-datepicker" type="date" id="datepicker"> -->

                                    <div class="icon"><i class="far fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mb-3">
                                <label class="form-label">เพศ</label>
                                <select class="default-select form-control" name="sex" >
                                    <option value="">กรุณาเลือก</option>
                                    <option value="M" <?php if($users['STUDENTSEX']=='M'){ echo 'selected'; }?>>ชาย
                                    </option>
                                    <option value="F" <?php if($users['STUDENTSEX']=='F'){ echo 'selected'; }?>>
                                        หญิง</option>
                                    <option value="O">อื่นๆ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mb-3">
                                <label class="form-label">เชิ้อชาติ</label>
                                <select class="default-select form-control" name="sex" >
                                    <option value="" disabled selected>กรุณาเลือก</option>
                                <?php
                                     foreach ($nations as $nation) 
                                     {
                                ?>
                                    <option value="<?php echo $nation['NATION_ID'];?>"><?php echo $nation['NATION_NAME_ENG'];?></option>
                                <?php
                                     }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mb-3">
                                <label class="form-label">สัญชาติ</label>
                                <select class="default-select form-control" name="sex" >
                                    <option value="">กรุณาเลือก</option>
                                    <option value="M" <?php if($users['STUDENTSEX']=='M'){ echo 'selected'; }?>>ชาย
                                    </option>
                                    <option value="F" <?php if($users['STUDENTSEX']=='F'){ echo 'selected'; }?>>
                                        หญิง</option>
                                    <option value="O">อื่นๆ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mb-3">
                                <label class="form-label">ศาสนา</label>
                                <select class="default-select form-control" name="sex" >
                                    <option value="">กรุณาเลือก</option>
                                    <option value="1" <?php if($users['STUDENTSEX']=='M'){ echo 'selected'; }?>>พุทธ</option>
                                    <option value="2" <?php if($users['STUDENTSEX']=='F'){ echo 'selected'; }?>>อิสลาม</option>
                                    <option value="3">คริสต์</option>
                                    <option value="4">ซิกข์</option>
                                    <option value="6">ฮินดู</option>
                                    <option value="5">อื่นๆ</option>
                                    <option value="99">ไม่ระบุ</option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="datepicker">วันเกิด
                                    <?php echo '  '.@$users['BD_THAI']?></label>
                                <div class="input-hasicon mb-xl-0 mb-3">
                                    <input type="date" class="form-control " name="birthdate" id="birthdate"
                                        value="<?php echo @$users["BIRTHDATE"]?>"
                                        title="กรุณาตรวจสอบข้อมูลให้ถูกต้อง (รูปแบบวันที่ เดือน/วัน/ปี ค.ศ.)"
                                        data-toggle="tooltip" data-placement="top"  />
                                    <!-- <input class="form-control mb-xl-0 mb-3 bt-datepicker" type="date" id="datepicker"> -->

                                    <div class="icon"><i class="far fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label">โทรศัพท์</label>
                                <input type="number" class="form-control" name="tel"
                                    value="<?php echo @$users["HOMEPHONENO"];?>" placeholder="123456789"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="Email">Email address</label>
                                <input type="text" class="form-control"
                                    placeholder="<?php echo $users["STUDENTCODE"].'@yru.ac.th';?>" value=""
                                    name="name" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <h4 class="card-title">ข้อมูลที่อยู่ <?php //echo $users['PREFIXID1']?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="Name">ที่อยู่เลขที่</label>
                                <input type="text" class="form-control"
                                    value="<?php echo @$users['HOMEADDRESS1'] ?>" name="stdcode" id="stdcode">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="Name">หมู่</label>
                                <input type="text" class="form-control"
                                    value="<?php echo @$users['MOO'] ?>" name="stdcode" id="stdcode">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="Name">ซอย</label>
                                <input type="text" class="form-control"
                                    value="<?php echo @$users['SOI'] ?>" name="stdcode" id="stdcode">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="Name">ถนน</label>
                                <input type="text" class="form-control"
                                    value="<?php echo @$users['THANON'] ?>" name="stdcode" id="stdcode">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">จังหวัด</label>
                                <!-- <select id="single-select"> -->
                                <select class="minimum-search-length">
                                    <option value="">กรุณาเลือก</option>

									<option value="<?php echo @$objResult["PROVINCE_ID"];?>"<?php if(@$objResult["PROVINCE_ID"]==@$users["HOMEPROVINCEID"]) { echo "selected";} ?>><?php echo @$objResult["PROVINCE_NAME_TH"];?></option>
							</select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">อำเภอ</label>
                                <!-- <select id="single-select"> -->
                                <select class="minimum-search-length">
                                    <option value="">กรุณาเลือก</option>

									<option value="<?php echo @$objResulta["DISTRICT_ID"];?>"<?php if(@$objResulta["DISTRICT_ID"]==@$users["HOMEDISTRICT"]) { echo "selected";} ?>><?php echo @$objResulta["DISTRICT_NAME_TH"].'  '.@$objResulta["PROVINCE_NAME_TH"];?></option>
                                    
								</select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">ตำบล</label>
                                <!-- <select id="single-select"> -->
                                <select class="minimum-search-length">
                                    <option value="">กรุณาเลือก</option>
                                    
									<option value="<?php echo @$objResultt["SUB_DISTRICT_ID"];?>"<?php if(@$objResultt["SUB_DISTRICT_ID"]==@$users["HOMEADDRESS2"]) { echo "selected";} ?>><?php echo $subdistrictname;?></option>
                                                                      
								</select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="Name">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control"
                                    value="<?php echo @$users['HOMEZIPCODE'] ?>" name="stdcode" id="stdcode">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-update ">UPDATE</button>
                    <button type="button" class="btn btn-primary btn-back">ย้อนกลับ</button>
                    
                </div>
            </div>
        </div>
    </form>
</div>




