<div class="row">
    <div class="col-xl-12">
        <div class="filter cm-content-box box-primary">
            <div class="content-title SlideToolHeader">
                <div class="cpa">
                    <i class="fa-sharp fa-solid fa-filter me-2"></i>Filter
                </div>
                <div class="tools">
                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                </div>
            </div>
            <div class="cm-content-body form excerpt">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-sm-6">
                            <label class="form-label">เลือกระดับชั้น</label>
                            <select id="class" class="form-control default-select h-auto wide" aria-label="Default select example">
                                <option selected>เลือกระดับชั้น</option>
                                <?php
                                    for ($i=1; $i <=6;$i++){
                                ?>
                                <option value="<?php echo $i?>">ระดับประถมศึกษา <?php echo $i;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <label class="form-label">เลือกวิชา</label>
                            <select id="single1-select" class="form-control default-select h-auto wide" aria-label="Default select example">
                                <option selected disabled>เลือกวิชา</option>
                              
                            </select>
                        </div>
                        <div class="col-xl-1 col-sm-6">
                            <label class="form-label">จำนวน ชม.</label>
                            <input type="number" class="form-control" name="time" id="time">
                                
                            </select>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <label class="form-label">เลือกผู้สอน</label>
                            <select id="single-select" class="form-control default-select h-auto wide" aria-label="Default select example">
                                <option selected disabled>เลือกวิชา</option>
                                
                            </select>
                            <!-- <div class="input-hasicon mb-sm-0 mb-3">
                                <input name="datepicker" class="form-control bt-datepicker" placeholder="Select a date">
                                <div class="icon"><i class="far fa-calendar"></i></div>
                            </div> -->
                        </div>
                        <div class="col-xl-2 col-sm-6 align-self-end">
                            <div>
                                <button class="btn btn-primary me-2" title="Click here to Search" type="button"><i
                                        class="fa fa-filter me-1"></i>Filter</button>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="mb-4 pb-3">
            <a href="content-add.php" class="btn btn-primary btn-sm">Add Content</a>
        </div> -->
        <div class="filter cm-content-box box-primary">
            <div class="content-title SlideToolHeader">
                <div class="cpa">
                    <i class="fa-solid fa-file-lines me-1"></i>Contact List
                </div>
                <div class="tools">
                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                </div>
            </div>
            <div class="cm-content-body form excerpt">
                <div class="card-body pb-4">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Modified</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>About Us</td>
                                    <td>Published</td>
                                    <td>18 Feb, 2024</td>
                                    <td class="text-nowrap">
                                        <a href="javascript:void(0);" class="btn btn-warning btn-sm content-icon">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm content-icon">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>FAQ</td>
                                    <td>Published</td>
                                    <td>13 Jan, 2024</td>
                                    <td class="text-nowrap">

                                        <a href="javascript:void(0);" class="btn btn-warning btn-sm content-icon">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm content-icon">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Pricing</td>
                                    <td>Published</td>
                                    <td>13 Jan, 2024</td>
                                    <td class="text-nowrap">

                                        <a href="javascript:void(0);" class="btn btn-warning btn-sm content-icon">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm content-icon">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Schedule</td>
                                    <td>Published</td>
                                    <td>13 Jan, 2024</td>
                                    <td class="text-nowrap">

                                        <a href="javascript:void(0);" class="btn btn-warning btn-sm content-icon">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm content-icon">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Under Maintenance</td>
                                    <td>Published</td>
                                    <td>25 Jan, 2024</td>
                                    <td class="text-nowrap">

                                        <a href="javascript:void(0);" class="btn btn-warning btn-sm content-icon">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm content-icon">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src="api/script.js?v=<?php echo time(); ?>"></script> -->