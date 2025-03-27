<?php
include('../../include/connectdb.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Construct the SQL DELETE statement
    $strSQL = "DELETE FROM GROUPCOURE WHERE GROUPID = :id";
    $objParse = oci_parse($objConnect, $strSQL);

    // Bind the parameter to prevent SQL injection
    oci_bind_by_name($objParse, ":id", $id);

    // Execute the query
    $objExecute = oci_execute($objParse, OCI_DEFAULT);

    if ($objExecute) {
        oci_commit($objConnect); // Commit the transaction
        echo json_encode([
            'status' => 'success',
            'message' => 'ลบข้อมูลเรียบร้อยแล้ว'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'ไม่สามารถลบข้อมูลได้'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method!'
    ]);
}