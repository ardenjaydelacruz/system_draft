<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/hr_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>ems/employees" class="btn btn-default"><i class="fa fa-user"></i> Employees</a></li>
        <li class="active">Add Employee</li>
    </ol>
    <div class="container-fluid">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title big">Add Employee</h3>
            </div>
            <div class="box-body">
                <label>
                    <small>Fields with * asterisk are required.</small>
                </label>
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Employee Information</h3>
                    </div>
                    <div class="box-body">
                        <?php echo form_open('ems/add_employee'); ?>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Employee ID: * </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control input-sm" name="txtEmpID">
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtEmpID'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Job Title: * </label>
                                    <div class="col-sm-3">
                                        <select name="txtJobTitle"  class="form-control">
                                            <option value="">---</option>
                                            <?php foreach ($job_titles as $row){ 
                                                echo "<option value='$row->job_title_id'>$row->job_title_name</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtJobTitle'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Employment Type: * </label>
                                    <div class="col-sm-3">
                                        <select name="txtEmploymentType"  class="form-control">
                                            <option value="">---</option>
                                            <?php foreach ($employment_type as $row){ 
                                                echo "<option value='$row->employment_type_id'>$row->employment_type </option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtEmploymentType'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Employee Department: * </label>
                                    <div class="col-sm-3">
                                        <select name="txtEmpDepartment" class="form-control">
                                            <option value="">---</option>
                                            <?php foreach ($departments as $row){ 
                                                echo "<option value='$row->department_id'>$row->department_name</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtEmpDepartment'); ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Employee Personal Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class=" col-sm-2 control-label">Full Name: * </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm" name="txtFirstName">
                                    <?php echo form_error('txtFirstName','<div class="error">','</div>'); ?>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm" placeholder="(Optional)" name="txtMiddleName">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm" name="txtLastName">
                                    <?php echo form_error('txtLastName','<div class="error">','</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-2 control-label">Date of Birth: * </label>
                                <div class="col-sm-3">
                                    <input type="text" data-provide="datepicker" class="form-control input-sm" name="txtBday">
                                    <?php echo form_error('txtBday','<div class="error">','</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-2 control-label">Gender: * </label>
                                <div class="col-sm-3">
                                    <select class="form-control input-sm" name="txtGender">
                                        <option value=""> --- </option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <?php echo form_error('txtGender','<div class="error">','</div>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-2 control-label">Marital Status: * </label>
                                <div class="col-sm-3">
                                    <select class="form-control input-sm" name="txtStatus">
                                        <option value=""> --- </option>
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="widowed">Widowed</option>
                                    </select>
                                    <?php echo form_error('txtStatus','<div class="error">','</div>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 2nd panel Body -->
                </div>
                <!-- End of Secondary Panel -->
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Employee Address</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Street: * </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm"  name="txtStreet">
                                </div>
                                <?php echo form_error('txtStreet','<div class="error col-sm-5">','</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Barangay: * </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm"  name="txtBarangay">
                                </div>
                                <?php echo form_error('txtBarangay','<div class="error col-sm-5">','</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">City / Town: * </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm"  name="txtCity">
                                </div>
                                <?php echo form_error('txtCity','<div class="error col-sm-5">','</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">State / Province: * </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm" name="txtState">
                                </div>
                                <?php echo form_error('txtState','<div class="error col-sm-5">','</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Zip / Postal Code: * </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm"  name="txtZip">
                                </div>
                                <?php echo form_error('txtZip','<div class="error col-sm-5">','</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Country: * </label>
                                <div class="col-sm-3">
                                    <select name="txtCountry" class="form-control">
                                        <option value=" "> --- </option>
                                          <?php foreach ($countryy as $row){ 
                                              echo "<option value='$row->country_code'>$row->country_name </option>";
                                          } ?>
                                      </select>
                                </div>
                                <?php echo form_error('txtCountry','<div class="error col-sm-5">','</div>'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Employee Contact Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form">
                            <div class="form-group col-sm-4">
                                <label class="control-label">Mobile Number:</label>
                                <input type="text" class="form-control input-sm" name="txtMobile">
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="control-label">Telephone Number:</label>
                                <div class="">
                                    <input type="text" class="form-control input-sm"  name="txtTelephone">
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" control-label">Email:</label>
                                <div class="">
                                    <input type="email" class="form-control input-sm" name="txtEmail">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="signupButtons">
                    <center>
                        <input type="submit" class="btn btn-success" name="btnSubmit" value="Submit">
                        <input type="reset" class="btn btn-danger" value="Clear">
                    </center>
                </div>
                <?php echo form_close(); ?>
            </div>
            <!-- Main Panel Body-->
        </div>
        <!-- End of Main Panel -->
    </div>
</div>
<!-- End of Wrapper -->
