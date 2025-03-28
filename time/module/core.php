<?php
//include($part); // Ensure $part includes the database connection
include('../../include/connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cid = @$_POST['cid'];
    $cname = @$_POST['cname'];
    $action = @$_POST['action'];

    if ($action === 'addmaster') {
        // Construct the SQL INSERT statement
        $strSQL = "INSERT INTO GROUPCOURE (GROUPID, GROUPNAME) VALUES (:cid, :cname)";
        $objParse = oci_parse($objConnect, $strSQL);

        // Bind parameters to prevent SQL injection
        oci_bind_by_name($objParse, ":cid", $cid);
        oci_bind_by_name($objParse, ":cname", $cname);

        // Execute the query
        $objExecute = oci_execute($objParse, OCI_DEFAULT);

        if ($objExecute) {
            oci_commit($objConnect); // Commit the transaction
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
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action!']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method!']);
}