<?php
include('../../include/connectdb.php');
$type = @$_POST['id'];
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Recent Payments Queue</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width:80px;">#</th>
                                <th>รหัสผู้สมัคร</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>สถานะชำระเงิน</th>
                                <th>ใบแสดงผลการเรียน</th>
                                <th>บิลชำระเงิน</th>
                                <th>รายงานตัว</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $strSQL = "SELECT
                                WEBALUMNI.APPLICANTLIST.*
                            FROM
                                WEBALUMNI.APPLICANTLIST
                            WHERE
                                WEBALUMNI.APPLICANTLIST.APPLICANTTYPE = $type
                            ORDER BY
                                 WEBALUMNI.APPLICANTLIST.APPLICANTCODE"
                            ;
                            $objParse = oci_parse( $objConnect, $strSQL );
                            oci_execute( $objParse, OCI_DEFAULT );   
                            while ( $objResult = oci_fetch_array( $objParse, OCI_BOTH ) ) {
                                $num = @$num+1;
                                $appid = @$objResult["APPLICANTID"];
                                $stdid = @$objResult["STUDENTID"];
                                $date_now = date("dmy-hmi");
                                //$file_app = file_app($appid,"transcript");
                                //$filepath = '/../main/documents/2568/transcript/'.$file_app;
                                //$file_pay = file_app($appid,"payment");
                                //$path_pay = '/../main/documents/2568/payment/'.$file_pay;
                                $citizen = @$objResult["CITIZENID"];
                                //$facebook = app_social($citizen,"FACEBOOK");
                                //$lineid = app_social($citizen,"LINE_ID");   
                            ?>
                            <tr>
                                <td><strong><?php echo $num;?></strong></td>
                                <td><?=$objResult["APPLICANTCODE"]?></td>
                                <td><?=$objResult["FULLNAME"]?></td>
                                <td>
                                    <?php 
                                        if($objResult["FINANCESTATUS"] == "N")
                                        {
                                            $mn_txt = "fa-money-bill w3-text-green";
                                            $tit_txt = "ชำระเงินค่าสมัครเรียบร้อยแล้ว";
                                        }
                                        else if($objResult["FINANCESTATUS"] == "D")
                                        {
                                            $mn_txt = "fa-minus w3-text-red";
                                            $tit_txt = "ยังไม่ได้ชำระเงินค่าสมัคร";
                                        }
                                    ?>
                                    <i class="fa <?=$mn_txt?>" title="<?=$tit_txt?>"></i>
                                </td>
                                <td><h3><i class="fa-solid fa-clipboard-list"></i></h3>
                                    <!-- <?php 
                                        if(@$file_app != ""){ 
                                    ?>
                                        <a href="<?=@$filepath?>" class="w3-hover-text-red" target="_blank"><i class="fa fa-file-pdf"></i></a>
                                    <?php 
                                        } else { 
                                            echo '<i class="fa fa-minus"></i>';
                                        } 
                                    ?> -->
                                </td>
                                <td>
                                    <h3><i class="fa-solid fa-file-invoice-dollar"></i></h3>
                                    <!-- <?php 
                                    if(@$file_pay != "")
                                    { ?>
			                        <a href="<?=$path_pay?>" class="w3-hover-text-green" target="_blank"><i class="fa fa-file-invoice-dollar"></i></a>
			                        <?php }else{ echo '<i class="fa fa-minus"></i>';} ?> -->
                                </td>
                                <td>
                                    <!-- <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp"
                                            data-bs-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <circle fill="#000000" cx="5" cy="12" r="2" />
                                                    <circle fill="#000000" cx="12" cy="12" r="2" />
                                                    <circle fill="#000000" cx="19" cy="12" r="2" />
                                                </g>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div> -->
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