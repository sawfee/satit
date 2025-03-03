<?php
session_start();
include('../../include/connectdb.php');
//$studentcode = @$_POST['id'];
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
	AVSREG.A_STUDENTINFO_SATIT.CITIZENID, 
	AVSREG.A_STUDENTINFO_SATIT.PREFIXID, 
    TO_CHAR( AVSREG.A_STUDENTINFO_SATIT.BIRTHDATE, 'YYYY-MM-DD' ) AS BIRTHDATE,
    TO_CHAR( AVSREG.A_STUDENTINFO_SATIT.BIRTHDATE, 'DAY DD MONTH YYYY', 'NLS_CALENDAR=''THAI BUDDHA'' NLS_DATE_LANGUAGE=THAI' ) AS BD_THAI,
	AVSREG.A_STUDENTINFO_SATIT.ST,
    AVSREG.A_STUDENTINFO_SATIT.HOMEPHONENO,
    AVSREG.A_STUDENTINFO_SATIT.HOMEADDRESS1,
    AVSREG.A_STUDENTINFO_SATIT.HOMEADDRESS2,
    AVSREG.A_STUDENTINFO_SATIT.HOMEDISTRICT,
	AVSREG.A_STUDENTINFO_SATIT.MOO,
	AVSREG.A_STUDENTINFO_SATIT.TROK,
	AVSREG.A_STUDENTINFO_SATIT.SOI,
	AVSREG.A_STUDENTINFO_SATIT.THANON,
	AVSREG.A_STUDENTINFO_SATIT.TT,
	AVSREG.A_STUDENTINFO_SATIT.AA,
	AVSREG.A_STUDENTINFO_SATIT.CC,
    AVSREG.A_STUDENTINFO_SATIT.HOMEPROVINCEID,
	AVSREG.A_STUDENTINFO_SATIT.HOMEZIPCODE
FROM
	AVSREG.A_STUDENTINFO_SATIT
WHERE
AVSREG.A_STUDENTINFO_SATIT.STUDENTCODE = '@$studentcode'
";	

$objParse_level = oci_parse($objConnect, $levelSQL);
oci_execute ($objParse_level,OCI_DEFAULT);
$objResulte = oci_fetch_array($objParse_level,OCI_BOTH);
$Numrow = oci_num_rows($objParse_level);

$dob = $users["BIRTHDAY"];

// แปลงวันเกิดเป็น DateTime object
$dob = new DateTime($dob);

// วันปัจจุบัน
$today = new DateTime();

// คำนวณความแตกต่าง
$age = $today->diff($dob);
//echo "อายุ: " . $age->y . " ปี";
if($Numrow == 0) {
?>

<div class="filter cm-content-box box-primary">
    <div class="content-title SlideToolHeader1">
        <div class="cpa">
            ข้อมูลส่วนตัว
        </div>
        <div class="tools">
            <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
        </div>
    </div>
    <div class="cm-content-body form excerpt">
        <div class="card-body">
            <!-- <h6 class="mb-4 font-w500">Add New Custom Field:</h6> -->
            <div class="row">
                <div class="col-sm-2">
                    <div class="mb-3">
                        <label class="form-label" for="Name">รหัสนักเรียน</label>
                        <input type="number" readonly class="form-control" value="<?php echo $users['STUDENTCODE'] ?>"
                            name="stdcode" id="stdcode">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="mb-3">
                        <label class="form-label">คำนำหน้า</label>
                        <select class="default-select form-control" disabled id="prefix" name="prefix">
                            <option data-display="Select">กรุณาเลือก</option>
                            <option value="5" <?php if($users['PREFIXID']=='5'){ echo 'selected'; }?>>
                                เด็กชาย</option>
                            <option value="6" <?php if($users['PREFIXID']=='6'){ echo 'selected'; }?>>
                                เด็กหญิง</option>
                            <option value="O">อื่นๆ</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" for="Name">ชิ่อ</label>
                        <input type="text" readonly class="form-control"
                            value="<?php echo $users['STUDENTNAME'].' ('.$users['STUDENTNAMEENG'].')' ?>" name="fname">
                        <input type="hidden" class="form-control" value="<?php echo $users['STUDENTCODE'] ?>"
                            name="stdcode" id="stdcode">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" for="Surname">นามสกุล</label>
                        <input type="text" readonly class="form-control"
                            value="<?php echo $users['STUDENTSURNAME'].' ('.$users['STUDENTSURNAMEENG'].')' ?>"
                            name="lname">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="mb-3">
                        <label class="form-label" for="Specialty">เลขบัตรประขาขน</label>
                        <input type="number" class="form-control" value="<?php echo @$users['CITIZENID'];?>"
                            id="citizenid">
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
                                data-toggle="tooltip" data-placement="top" />
                            <!-- <input class="form-control mb-xl-0 mb-3 bt-datepicker" type="date" id="datepicker"> -->

                            <div class="icon"><i class="far fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="mb-3">
                        <label class="form-label">เพศ</label>
                        <select class="default-select form-control" name="sex">
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
                        <select id="single-select">
                            <option value="" disabled selected>กรุณาเลือก</option>
                            <?php
                                     foreach ($races as $race) 
                                     {
                                ?>
                            <option value="<?php echo $race['RACE_ID'];?>"
                                <?php if($race['RACE_ID']==$users['RACE']){ echo 'selected'; }?>>
                                <?php echo $race['RACE_NAME'];?></option>
                            <?php
                                     }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="mb-3">
                        <label class="form-label">สัญชาติ</label>
                        <select id="single1-select">
                            <!-- <select class="default-select form-control" name="sex" > -->
                            <option value="" disabled selected>กรุณาเลือก</option>
                            <?php
                                     foreach ($nations as $nation) 
                                     {
                                ?>
                            <option value="<?php echo $nation['NATION_ID'];?>"
                                <?php if($nation['NATION_ID']==$users['NATION']){ echo 'selected'; }?>>
                                <?php echo $nation['NATION_NAME_ENG'];?></option>
                            <?php
                                     }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="mb-3">
                        <label class="form-label">ศาสนา</label>
                        <select class="default-select form-control" name="sex">
                            <option value="">กรุณาเลือก</option>
                            <option value="1" <?php if($users['RELEGION']=='1'){ echo 'selected'; }?>>พุทธ
                            </option>
                            <option value="2" <?php if($users['RELEGION']=='2'){ echo 'selected'; }?>>อิสลาม
                            </option>
                            <option value="3" <?php if($users['RELEGION']=='3'){ echo 'selected'; }?>>คริสต์
                            </option>
                            <option value="4" <?php if($users['RELEGION']=='4'){ echo 'selected'; }?>>ซิกข์
                            </option>
                            <option value="6" <?php if($users['RELEGION']=='6'){ echo 'selected'; }?>>ฮินดู
                            </option>
                            <option value="5" <?php if($users['RELEGION']=='5'){ echo 'selected'; }?>>อื่นๆ
                            </option>
                            <option value="99" <?php if($users['RELEGION']=='99'){ echo 'selected'; }?>>ไม่ระบุ
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">ชื่อโรงพยาบาลที่เกิด</label>
                        <input type="text" class="form-control" value="<?php echo $users['HOSPITAL'] ?>" name="lname">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">จังหวัด</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                     foreach ($province as $provinces) 
                                     {                                
                                    ?>
                            <option value="<?php echo @$provinces["PROVINCE_ID"];?>"
                                <?php if(@$provinces["PROVINCE_ID"]==@$users["PROVINCE_ID_B"]) { echo "selected";} ?>>
                                <?php echo @$provinces["PROVINCE_NAME_TH"];?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">อำเภอ</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($district as $districts) 
                                        {                                
                                    ?>
                            <option value="<?php echo @$districts["DISTRICT_ID"];?>"
                                <?php if(@$districts["DISTRICT_ID"]==@$users["DISTRICT_ID_B"]) { echo "selected";} ?>>
                                <?php echo @$districts["DISTRICT_NAME_TH"].'  '.@$districts["PROVINCE_NAME_TH"];?>
                            </option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">ตำบล</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($subdistrict as $subdistricts) 
                                        {
                                        $subdistrictname = @$subdistricts["SUB_DISTRICT_NAME_TH"].'  '.@$subdistricts["DISTRICT_NAME_TH"].'   '.@$objResultt["PROVINCE_NAME_TH"];                         
                                    ?>
                            <option value="<?php echo @$subdistricts["SUB_DISTRICT_ID"];?>"
                                <?php if(@$subdistricts["SUB_DISTRICT_ID"]==@$users["SUB_DISTRICT_ID_B"]) { echo "selected";} ?>>
                                <?php echo $subdistrictname;?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>


                <div class="col-sm-2">
                    <div class="mb-3">
                        <label class="form-label">กลุ่มเลือด</label>
                        <select class="default-select form-control" name="sex">
                            <option value="" selected disabled>- เลือกหมู่เลือด -</option>
                            <option value="A" <?php if($users['BLOOD'] == 'A'){echo "SELECTED";}?>>A</option>
                            <option value="B" <?php if($users['BLOOD'] == 'B'){echo "SELECTED";}?>>B</option>
                            <option value="AB" <?php if($users['BLOOD'] == 'AB'){echo "SELECTED";}?>>AB</option>
                            <option value="AB+" <?php if($users['BLOOD'] == 'AB+'){echo "SELECTED";}?>>AB+
                            </option>
                            <option value="O" <?php if($users['BLOOD'] == 'O'){echo "SELECTED";}?>>O</option>
                            <option value="RH+" <?php if($users['BLOOD'] == 'RH+'){echo "SELECTED";}?>>RH+
                            </option>
                            <option value="RH-" <?php if($users['BLOOD'] == 'RH-'){echo "SELECTED";}?>>RH-
                            </option>
                            <option value="99" <?php if($users['BLOOD'] == '99'){echo "SELECTED";}?>>ไม่ระบุ
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="mb-3">
                        <label class="form-label">อายุ</label>
                        <input type="number" class="form-control" name="tel" value="<?php echo $age->y?>"
                            placeholder="123456789" data-bs-toggle="tooltip" data-bs-placement="top" title="อายุ"
                            readonly>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label class="form-label">โทรศัพท์</label>
                        <input type="number" class="form-control" name="tel" value="<?php echo @$users["TEL1"];?>"
                            placeholder="123456789" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Tooltip on top">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" for="Email">Email address</label>
                        <input type="text" class="form-control"
                            placeholder="<?php echo $users["STUDENTCODE"].'@yru.ac.th';?>"
                            value="<?php echo $users["STUDENTCODE"].'@yru.ac.th';?>" name="name">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="filter cm-content-box box-primary">
    <div class="content-title SlideToolHeader1">
        <div class="cpa">
            ข้อมูลการศึกษาเดิม
        </div>
        <div class="tools">
            <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
        </div>
    </div>
    <div class="cm-content-body form excerpt">
        <div class="card-body">
            <!-- <h6 class="mb-4 font-w500">Add New Custom Field:</h6> -->
            <div class="row">
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">ชื่อโรงเรียนเดิม (ถ้ามี)</label>
                        <input type="text" class="form-control" value="<?php echo $users['SCHOOL'] ?>" name="lname">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">จังหวัด</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                     foreach ($province as $provinces) 
                                     {                                
                                    ?>
                            <option value="<?php echo @$provinces["PROVINCE_ID"];?>"
                                <?php if(@$provinces["PROVINCE_ID"]==@$users["PROVINCE_SC"]) { echo "selected";} ?>>
                                <?php echo @$provinces["PROVINCE_NAME_TH"];?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">อำเภอ</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($district as $districts) 
                                        {                                
                                    ?>
                            <option value="<?php echo @$districts["DISTRICT_ID"];?>"
                                <?php if(@$districts["DISTRICT_ID"]==@$users["AMPOR_SC"]) { echo "selected";} ?>>
                                <?php echo @$districts["DISTRICT_NAME_TH"].'  '.@$districts["PROVINCE_NAME_TH"];?>
                            </option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">ตำบล</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($subdistrict as $subdistricts) 
                                        {
                                        $subdistrictname = @$subdistricts["SUB_DISTRICT_NAME_TH"].'  '.@$subdistricts["DISTRICT_NAME_TH"].'   '.@$objResultt["PROVINCE_NAME_TH"];                         
                                    ?>
                            <option value="<?php echo @$subdistricts["SUB_DISTRICT_ID"];?>"
                                <?php if(@$subdistricts["SUB_DISTRICT_ID"]==@$users["TUMBON_SC"]) { echo "selected";} ?>>
                                <?php echo $subdistrictname;?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="filter cm-content-box box-primary">
    <div class="content-title SlideToolHeader1">
        <div class="cpa">
            ข้อมูลการติดต่อ
        </div>
        <div class="tools">
            <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
        </div>
    </div>
    <div class="cm-content-body form excerpt">
        <div class="card-body">
            <h4 class="mb-4 font-w500">ที่อยู่ตามทะเบียนบ้าน</h4>
            <div class="row">
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label" for="Name">ที่อยู่เลขที่</label>
                        <input type="text" class="form-control" value="<?php echo @$users['NOADD1'] ?>" name="stdcode"
                            id="stdcode">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label" for="Name">หมู่</label>
                        <input type="text" class="form-control" value="<?php echo @$users['MOO1'] ?>" name="stdcode"
                            id="stdcode">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label" for="Name">ซอย</label>
                        <input type="text" class="form-control" value="<?php echo @$users['SOI1'] ?>" name="stdcode"
                            id="stdcode">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label" for="Name">ถนน</label>
                        <input type="text" class="form-control" value="<?php echo @$users['STREET1'] ?>" name="stdcode"
                            id="stdcode">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">จังหวัด</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                     foreach ($province as $provinces) 
                                     {                                
                                    ?>
                            <option value="<?php echo @$provinces["PROVINCE_ID"];?>"
                                <?php if(@$provinces["PROVINCE_ID"]==@$users["PROVINCE1"]) { echo "selected";} ?>>
                                <?php echo @$provinces["PROVINCE_NAME_TH"];?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">อำเภอ</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($district as $districts) 
                                        {                                
                                    ?>
                            <option value="<?php echo @$districts["DISTRICT_ID"];?>"
                                <?php if(@$districts["DISTRICT_ID"]==@$users["AMPOR1"]) { echo "selected";} ?>>
                                <?php echo @$districts["DISTRICT_NAME_TH"].'  '.@$districts["PROVINCE_NAME_TH"];?>
                            </option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">ตำบล</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($subdistrict as $subdistricts) 
                                        {
                                        $subdistrictname = @$subdistricts["SUB_DISTRICT_NAME_TH"].'  '.@$subdistricts["DISTRICT_NAME_TH"].'   '.@$objResultt["PROVINCE_NAME_TH"];                         
                                    ?>
                            <option value="<?php echo @$subdistricts["SUB_DISTRICT_ID"];?>"
                                <?php if(@$subdistricts["SUB_DISTRICT_ID"]==@$users["TUMBON1"]) { echo "selected";} ?>>
                                <?php echo $subdistrictname;?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label" for="Name">รหัสไปรษณีย์</label>
                        <input type="text" class="form-control" value="<?php echo @$users['ZIPCODE1'] ?>" name="stdcode"
                            id="stdcode">
                    </div>
                </div>
            </div>
            <h4 class="mb-4 font-w500">ที่อยู่ปัจจุบัน</h4>
            <div class="row">
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label" for="Name">ที่อยู่เลขที่</label>
                        <input type="text" class="form-control" value="<?php echo @$users['NOADD1'] ?>" name="stdcode"
                            id="stdcode">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label" for="Name">หมู่</label>
                        <input type="text" class="form-control" value="<?php echo @$users['MOO1'] ?>" name="stdcode"
                            id="stdcode">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label" for="Name">ซอย</label>
                        <input type="text" class="form-control" value="<?php echo @$users['SOI1'] ?>" name="stdcode"
                            id="stdcode">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label" for="Name">ถนน</label>
                        <input type="text" class="form-control" value="<?php echo @$users['STREET1'] ?>" name="stdcode"
                            id="stdcode">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">จังหวัด</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                     foreach ($province as $provinces) 
                                     {                                
                                    ?>
                            <option value="<?php echo @$provinces["PROVINCE_ID"];?>"
                                <?php if(@$provinces["PROVINCE_ID"]==@$users["PROVINCE1"]) { echo "selected";} ?>>
                                <?php echo @$provinces["PROVINCE_NAME_TH"];?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">อำเภอ</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($district as $districts) 
                                        {                                
                                    ?>
                            <option value="<?php echo @$districts["DISTRICT_ID"];?>"
                                <?php if(@$districts["DISTRICT_ID"]==@$users["AMPOR1"]) { echo "selected";} ?>>
                                <?php echo @$districts["DISTRICT_NAME_TH"].'  '.@$districts["PROVINCE_NAME_TH"];?>
                            </option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">ตำบล</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($subdistrict as $subdistricts) 
                                        {
                                        $subdistrictname = @$subdistricts["SUB_DISTRICT_NAME_TH"].'  '.@$subdistricts["DISTRICT_NAME_TH"].'   '.@$objResultt["PROVINCE_NAME_TH"];                         
                                    ?>
                            <option value="<?php echo @$subdistricts["SUB_DISTRICT_ID"];?>"
                                <?php if(@$subdistricts["SUB_DISTRICT_ID"]==@$users["TUMBON1"]) { echo "selected";} ?>>
                                <?php echo $subdistrictname;?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label" for="Name">รหัสไปรษณีย์</label>
                        <input type="text" class="form-control" value="<?php echo @$users['ZIPCODE1'] ?>" name="stdcode"
                            id="stdcode">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="filter cm-content-box box-primary">
    <div class="content-title SlideToolHeader1">
        <div class="cpa">
            ข้อมูลบิดา-มารดา
        </div>
        <div class="tools">
            <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
        </div>
    </div>
    <div class="cm-content-body form excerpt">
        <div class="card-body">
            <h4 class="mb-4 font-w500">ข้อมูลบิดา</h4>
            <div class="row">
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">ชื่อบิดา</label>
                        <input type="text" class="form-control" value="<?php echo $users['FIRSTNAME_F'] ?>"
                            name="lname">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">นามสกุลบิดา</label>
                        <input type="text" class="form-control" value="<?php echo $users['SCHOOL'] ?>"
                            name="LASTNAME_F">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">สถานภาพบิดา</label>
                        <!-- <select id="single-select"> -->
                        <select class="default-select form-control">
                            <option value="" disabled selected>กรุณาเลือก</option>
                            <option value="1" <?php if(@$users["F_STATUS"] == 1) { echo "selected";} ?>>มีชีวิต</option>
                            <option value="0" <?php if(@$users["F_STATUS"] == 0) { echo "selected";} ?>>ถึงแก่กรรม
                            </option>
                            <option value="9" <?php if(@$users["F_STATUS"] == 9) { echo "selected";} ?>>ไม่ระบุ</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">การศึกษาบิดา</label>
                        <!-- <select id="single-select"> -->
                        <select class="default-select form-control">
                            <option value="" disabled selected>กรุณาเลือก</option>
                            <?php
                                foreach ($degree as $degrees) 
                                    {     
                            ?>
                            <option value="<?php echo @$degrees["ENTRYDEGREECODE"];?>"
                                <?php if(@$degrees["ENTRYDEGREECODE"]==@$users["STADY_F"]) { echo "selected";} ?>>
                                <?php echo $degrees["ENTRYDEGREENAME"];?></option>
                            <?php
                                    }
                                ?>

                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">อาชีพของบิดา</label>
                        <!-- <select id="single-select"> -->
                        <select class="default-select form-control">
                            <option value="" disabled selected>กรุณาเลือก</option>
                            <?php
                                foreach ($occup as $occups) 
                                    {     
                            ?>
                            <option value="<?php echo @$occups["OCCUP_ID"];?>"
                                <?php if(@$occups["OCCUP_ID"]==@$users["JOB_F"]) { echo "selected";} ?>>
                                <?php echo $occups["OCCUP_NAME"];?></option>
                            <?php
                                    }
                                ?>

                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">สถานที่ทำงาน</label>
                        <input type="text" class="form-control" value="<?php echo $users['JOBNAME_F'] ?>" name="lname">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">จังหวัด</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                     foreach ($province as $provinces) 
                                     {                                
                                    ?>
                            <option value="<?php echo @$provinces["PROVINCE_ID"];?>"
                                <?php if(@$provinces["PROVINCE_ID"]==@$users["PROVINCE_F"]) { echo "selected";} ?>>
                                <?php echo @$provinces["PROVINCE_NAME_TH"];?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">อำเภอ</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($district as $districts) 
                                        {                                
                                    ?>
                            <option value="<?php echo @$districts["DISTRICT_ID"];?>"
                                <?php if(@$districts["DISTRICT_ID"]==@$users["DISTRICT_F"]) { echo "selected";} ?>>
                                <?php echo @$districts["DISTRICT_NAME_TH"].'  '.@$districts["PROVINCE_NAME_TH"];?>
                            </option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">ตำบล</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($subdistrict as $subdistricts) 
                                        {
                                        $subdistrictname = @$subdistricts["SUB_DISTRICT_NAME_TH"].'  '.@$subdistricts["DISTRICT_NAME_TH"].'   '.@$objResultt["PROVINCE_NAME_TH"];                         
                                    ?>
                            <option value="<?php echo @$subdistricts["SUB_DISTRICT_ID"];?>"
                                <?php if(@$subdistricts["SUB_DISTRICT_ID"]==@$users["SUB_DISTRICT_F"]) { echo "selected";} ?>>
                                <?php echo $subdistrictname;?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">รายได้บิดา</label>
                        <!-- <select id="single-select"> -->
                        <select class="default-select form-control">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($revenu as $revenus) 
                                        {
                                        
                                    ?>
                            <option value="<?php echo @$revenu["REVENUE_ID"];?>"
                                <?php if(@$revenus["REVENUE_ID"]==@$users["SALARYFM"]) { echo "selected";} ?>>
                                <?php echo @$revenus["REVENUE_NAME2"];?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>

            </div>
            <h4 class="mb-4 font-w500">ข้อมูลมารดา</h4>
            <div class="row">
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">ชื่อมารดา</label>
                        <input type="text" class="form-control" value="<?php echo $users['FIRSTNAME_F'] ?>"
                            name="lname">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">นามสกุลมารดา</label>
                        <input type="text" class="form-control" value="<?php echo $users['SCHOOL'] ?>"
                            name="LASTNAME_F">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">สถานภาพมารดา</label>
                        <!-- <select id="single-select"> -->
                        <select class="default-select form-control">
                            <option value="" disabled selected>กรุณาเลือก</option>
                            <option value="1" <?php if(@$users["F_STATUS"] == 1) { echo "selected";} ?>>มีชีวิต</option>
                            <option value="0" <?php if(@$users["F_STATUS"] == 0) { echo "selected";} ?>>ถึงแก่กรรม
                            </option>
                            <option value="9" <?php if(@$users["F_STATUS"] == 9) { echo "selected";} ?>>ไม่ระบุ</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">การศึกษามารดา</label>
                        <!-- <select id="single-select"> -->
                        <select class="default-select form-control">
                            <option value="" disabled selected>กรุณาเลือก</option>
                            <?php
                                foreach ($degree as $degrees) 
                                    {     
                            ?>
                            <option value="<?php echo @$degrees["ENTRYDEGREECODE"];?>"
                                <?php if(@$degrees["ENTRYDEGREECODE"]==@$users["STADY_F"]) { echo "selected";} ?>>
                                <?php echo $degrees["ENTRYDEGREENAME"];?></option>
                            <?php
                                    }
                                ?>

                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">อาชีพของมารดา</label>
                        <!-- <select id="single-select"> -->
                        <select class="default-select form-control">
                            <option value="" disabled selected>กรุณาเลือก</option>
                            <?php
                                foreach ($occup as $occups) 
                                    {     
                            ?>
                            <option value="<?php echo @$occups["OCCUP_ID"];?>"
                                <?php if(@$occups["OCCUP_ID"]==@$users["JOB_F"]) { echo "selected";} ?>>
                                <?php echo $occups["OCCUP_NAME"];?></option>
                            <?php
                                    }
                                ?>

                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">สถานที่ทำงาน</label>
                        <input type="text" class="form-control" value="<?php echo $users['JOBNAME_F'] ?>" name="lname">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">จังหวัด</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                     foreach ($province as $provinces) 
                                     {                                
                                    ?>
                            <option value="<?php echo @$provinces["PROVINCE_ID"];?>"
                                <?php if(@$provinces["PROVINCE_ID"]==@$users["PROVINCE_F"]) { echo "selected";} ?>>
                                <?php echo @$provinces["PROVINCE_NAME_TH"];?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">อำเภอ</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($district as $districts) 
                                        {                                
                                    ?>
                            <option value="<?php echo @$districts["DISTRICT_ID"];?>"
                                <?php if(@$districts["DISTRICT_ID"]==@$users["DISTRICT_F"]) { echo "selected";} ?>>
                                <?php echo @$districts["DISTRICT_NAME_TH"].'  '.@$districts["PROVINCE_NAME_TH"];?>
                            </option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">ตำบล</label>
                        <!-- <select id="single-select"> -->
                        <select class="minimum-search-length">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($subdistrict as $subdistricts) 
                                        {
                                        $subdistrictname = @$subdistricts["SUB_DISTRICT_NAME_TH"].'  '.@$subdistricts["DISTRICT_NAME_TH"].'   '.@$objResultt["PROVINCE_NAME_TH"];                         
                                    ?>
                            <option value="<?php echo @$subdistricts["SUB_DISTRICT_ID"];?>"
                                <?php if(@$subdistricts["SUB_DISTRICT_ID"]==@$users["SUB_DISTRICT_F"]) { echo "selected";} ?>>
                                <?php echo $subdistrictname;?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">รายได้มารดา</label>
                        <!-- <select id="single-select"> -->
                        <select class="default-select form-control">
                            <option value="">กรุณาเลือก</option>
                            <?php
                                        foreach ($revenu as $revenus) 
                                        {
                                        
                                    ?>
                            <option value="<?php echo @$revenu["REVENUE_ID"];?>"
                                <?php if(@$revenus["REVENUE_ID"]==@$users["SALARYFM"]) { echo "selected";} ?>>
                                <?php echo @$revenus["REVENUE_NAME2"];?></option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div align="center">
    <button type="button" class="btn btn-primary btn-update ">ปรับปรุงข้อมูล</button>
    <button type="button" class="btn btn-primary btn-back">ย้อนกลับ</button>
</div>

<form class="profile-form" id="formdata">
    <!-- <div class="col-xl-12 col-lg-12">
        <div class="card profile-card m-b30">
            <div class="card-footer">
                <button type="button" class="btn btn-primary btn-update ">UPDATE</button>
                <button type="button" class="btn btn-primary btn-back">ย้อนกลับ</button>
            </div>
        </div>
    </div> -->
</form>

<?php } else { ?>
<div class="alert alert-danger solid alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
    </button>
    <strong>Error!</strong> ไม่พบรหัสนักเรียน. <?php echo $studentcode?>
</div>
<?php
}
?>

<script src="assets/js/dashboard/cms1.js?v=<?php echo date("Y-m-d h:i:sa");?>" type="text/javascript"></script>
<script src="assets/js/fee.js" type="text/javascript"></script>
<script src="assets/vendor/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="assets/js/plugins-init/select2-init.js?v=<?php echo date("Y-m-d h:i:sa");?>" type="text/javascript">

</script>
<script>
    $(document).ready(function () {
        $('.btn-back').click(function () {
            var user = document.getElementById('stdcode').value;
            $.ajax({
                url: "./form/subform/viewresult.php",
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
                            data: formData + '&action=addbio',
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
                                        didOpen: (toast) => {
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
                                        title: response.message
                                    }).then(function () {
                                        // Optionally reload or take other action after success
                                        //location.reload();
                                        // $('.btn-back').attr('disabled',false);
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