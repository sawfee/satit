<?php
include('../../include/connectdb.php');
header('Content-Type: application/json'); // Make sure to return JSON

$ac_tion = @$_POST["action"];
// echo 'ddddd'.$ac_tion;
if($ac_tion =='addmaster'){
    $stdcode = @$_POST["stdcode"];
    $prefix = @$_POST["prefix"];
    $fname = @$_POST["fname"];
    $lname = @$_POST["lname"];
    $fnamee = @$_POST["fnamee"];
    $lnamee = @$_POST["lnamee"];

    $strSQL = "UPDATE AVSREG.STUDENTMASTER 
    SET AVSREG.STUDENTMASTER.STUDENTNAME = '$fname',
        AVSREG.STUDENTMASTER.STUDENTSURNAME = '$lname',
        AVSREG.STUDENTMASTER.STUDENTNAMEENG = '$fnamee',
        AVSREG.STUDENTMASTER.STUDENTSURNAMEENG = '$lnamee' 
    WHERE
        AVSREG.STUDENTMASTER.STUDENTCODE = '$stdcode'";
    $objParse = oci_parse($objConnect, $strSQL); 
    $objExecute = oci_execute($objParse, OCI_DEFAULT); 
    if($objExecute) {
        oci_commit($objConnect);
        echo json_encode([
            'status' => 'success',
            'message' => 'บันทึกข้อมูลเรียบร้อยแล้ว' // Success message
        ]);

    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'ไม่สามารถบันทึกข้อมูลได้' // Error message
        ]); 
    }
}
if($ac_tion =='addbio'){
    echo json_encode([
        'status' => 'success',
        'message' => 'บันทึกข้อมูลเรียบร้อยแล้ว' // Success message
    ]);


}


?>