<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo $head;?></a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?php echo $title;?></a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="filter cm-content-box box-primary">
                <div class="content-title SlideToolHeader">
                    <div class="cpa">
                        <i class="fa-sharp fa-solid fa-filter me-2"></i>ค้นหา
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                                <label class="form-label">เลือกประเภทการรับสมัตร</label>
                                <select class="form-control default-select h-auto wide"
                                    aria-label="Default select example" name="apptype" id="apptype">
                                    <option value="">เลือกประเภท</option>
                                    <?php
                                        $strSQL = "SELECT
                                            AVSREG.APPLICANTTYPE.APPLICANTTYPEID, 
                                            AVSREG.APPLICANTTYPE.APPLICANTTYPENAME, 
                                            AVSREG.APPLICANTTYPE.STUDENTCARDTYPE
                                        FROM
                                            AVSREG.APPLICANTTYPE  
                                        WHERE
                                            AVSREG.APPLICANTTYPE.STUDENTCARDTYPE = 9";
                                        $objParse = oci_parse( $objConnect, $strSQL );
                                        oci_execute( $objParse, OCI_DEFAULT );   
                                        while ( $objResult = oci_fetch_array( $objParse, OCI_BOTH ) ) {                               
                                    ?>
                                    <option value="<?php echo @$objResult["APPLICANTTYPEID"];?>">
                                        <?php echo @$objResult["APPLICANTTYPENAME"];?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-xl-3 col-sm-6 align-self-end">
                                <div>
                                    <button class="btn btn-primary me-2 view-ent" title="Click here to Search" type="button"
                                        disabled><i class="fa fa-filter me-1"></i>แสดง</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div id="v_result">

    </div>
</div>