<?php
    foreach ($record as $row) {
        $id = $row->emp_id;
        $firstName = $row->first_name;
        $middleName = $row->middle_name;
        $lastName = $row->last_name;
        $position = $row->position;
        $status = $row->status;
        $department = $row->department;
        $leaves = $row->leaves;
        $birthday = $row->birthday;
        $gender = $row->gender;
        $marital_status = $row->marital_status;
        $street = $row->street;
        $barangay = $row->barangay;
        $city = $row->city;
        $zip = $row->zip;
        $state = $row->state;
        $country = $row->country;
        $mobile_number = $row->mobile_number;
        $tel_number = $row->tel_number;
        $contact_person = $row->contact_person;
        $contact_rel = $row->contact_rel;
        $contact_num = $row->contact_num;
        $email = $row->email_address;
        if (!empty($row->image)){
            $image = $row->image;
        } else {
            $image = 'default.jpg';
        }
        $date_added = $row->date_added;
    }
?>
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url();?>ems/employees" class="btn btn-default"><i class="fa fa-user"></i> Employee</a></li>
            <li class="active"><i class="fa fa-search"></i> View Employee </li>
        </ol>
        <div class="container-fluid">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title big">Employee Details</h3>
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"><?php echo $firstName.' '.$middleName.' '.$lastName; ?></h3>
                                    </div>

                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="text-center"><img src="<?php echo base_url().'assets/images/profile/'.$image; ?>" alt="" class="img-responsive emp_image" /></div>
                                            <div id="upload">
                                                <?php
                                                echo form_open_multipart('ems/upload_image?emp_id='.$id);
                                                echo form_upload('userfile');
                                                echo form_submit('btnUpload','Upload');
                                                    echo form_close();
                                             ?>
                                            </div>
                                        </div>
                                        <form action="<?php echo base_url();?>ems/update_employee?emp_id=<?php echo $id; ?>" method="post">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>Emp ID:</th>
                                                        <td>
                                                            <?php echo $id;?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Position:</th>
                                                        <td>
                                                            <input type="text" disabled class="form-control" value="<?php echo $position;?>" name="txtPosition" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status:</th>
                                                        <td>
                                                            <input type="text" disabled class="form-control" value="<?php echo $status;?>" name="txtStatus" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Dept.:</th>
                                                        <td>
                                                            <input type="text" disabled class="form-control" value="<?php echo $department;?>" name="txtDepartment" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Leaves Left:</th>
                                                        <td>
                                                            <input type="text" disabled class="form-control" value="<?php echo $leaves;?>" name="txtLeaves" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a id="btnEnable" class="btn btn-primary btn-block"><i class="fa fa-edit"></i>Edit</a>
                                                        </td>
                                                        <td>
                                                            <input type="submit" id="btnSaveEdit" class="btn btn-success btn-block disabled" value="Save">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <a href="<?php echo base_url();?>ems/request_leave?emp_id=<?php echo $id; ?>" class="btn btn-warning btn-block">
                                                    Add Leave
                                                </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                                <!-- Side Panel-->
                            </div>
                            <!-- col-4-->

                            <div class="col-md-8">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#tab_1" data-toggle="tab">Personal Details</a></li>
                                                <li><a href="#tab_2" data-toggle="tab">Contact Detail</a></li>
                                                <li><a href="#tab_3" data-toggle="tab">Contact Person</a></li>
                                                <li><a href="#tab_4" data-toggle="tab">User Account</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1">
                                                    <div class="form-horizontal">
                                                        <h3>Personal Details</h3>
                                                        <hr>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">First Name</label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled placeholder="first name" class="form-control" value="<?php echo $firstName; ?>" name="txtFirstName" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Middle Name</label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled placeholder="middle name" class="form-control" value="<?php echo $middleName; ?>" name="txtMiddleName" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Last Name</label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled placeholder="last name" class="form-control" value="<?php echo $lastName; ?>" name="txtLastName" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Gender</label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <div class="radio">
                                                                            <label class="radio-inline">
                                                                                <input type="radio" value="male" name="txtGender" <?php if($gender=='male' ) echo "checked='checked'"; ?> disabled/>Male
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" value="female" name="txtGender" <?php if($gender=='female' ) echo "checked='checked'"; ?> disabled/>Female
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Birthday</label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="date" type="text" disabled class="form-control" value="<?php echo $birthday; ?>" name="txtBirthday" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Marital Status</label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <select class="form-control" name="txtMaritalStatus" disabled>
                                                                            <option <?php if($marital_status=='single' ) echo "selected='selected'"; ?>>Single</option>
                                                                            <option <?php if($marital_status=='married' ) echo "selected='selected'"; ?>>Married</option>
                                                                            <option <?php if($marital_status=='widowed' ) echo "selected='selected'"; ?>>Widowed</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.tab-pane1 -->

                                                <div class="tab-pane" id="tab_2">
                                                    <div class="form-horizontal">
                                                        <h3>Contact Details</h3>
                                                        <hr>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">Street: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled class="form-control" value="<?php echo $street; ?>" name="txtStreet" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">Barangay: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled class="form-control" value="<?php echo $barangay; ?>" name="txtBarangay" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">City / Town: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled class="form-control" value="<?php echo $city; ?>" name="txtCity" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">State / Province: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled placeholder="State" class="form-control" value="<?php echo $state; ?>" name="txtState" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">Zip / Postal Code: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled placeholder="Zip" class="form-control" value="<?php echo $zip; ?>" name="txtZip" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">Country: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled placeholder="Country." class="form-control" value="<?php echo $country; ?>" name="txtCountry" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">Mobile Number: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled class="form-control" value="<?php echo $mobile_number; ?>" name="txtMobile" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">Telephone Number: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled class="form-control" value="<?php echo $tel_number; ?>" name="txtTelephone" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">Email: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled class="form-control" value="<?php echo $email; ?>" name="txtEmail" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.tab-pane2 -->

                                                <div class="tab-pane" id="tab_3">
                                                    <div class="form-horizontal">
                                                        <h3>Contact Person</h3>
                                                        <hr>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">Contact Person: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled class="form-control" value="<?php echo $contact_person; ?>" name="txtContactPerson" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">Contact Number: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled class="form-control" value="<?php echo $contact_num; ?>" name="txtContactNum" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" col-sm-3 control-label">Relationship: </label>
                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-9">
                                                                        <input type="text" disabled class="form-control" value="<?php echo $contact_rel; ?>" name="txtContactRel" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.tab-pane3 -->

                                                <div class="tab-pane" id="tab_4">
                                                    <div class="form-horizontal">
                                                        <h3>User Account</h3>
                                                        <hr>
                                                        <?php foreach ($account as $row) { ?>
                                                            <div class="form-group">
                                                                <label class=" col-sm-3 control-label">User ID: </label>
                                                                <div class="col-sm-9 controls">
                                                                    <div class="row">
                                                                        <div class="col-xs-9">
                                                                            <input type="text" disabled class="form-control" value="<?php echo $row->user_id; ?>" name="txtUserId" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class=" col-sm-3 control-label">Username: </label>
                                                                <div class="col-sm-9 controls">
                                                                    <div class="row">
                                                                        <div class="col-xs-9">
                                                                            <input type="text" disabled class="form-control" value="<?php echo $row->username; ?>" name="txtUsername" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class=" col-sm-3 control-label">Password: </label>
                                                                <div class="col-sm-9 controls">
                                                                    <div class="row">
                                                                        <div class="col-xs-9">
                                                                            <input type="password" disabled class="form-control" value="<?php echo md5($row->password); ?>" name="txtPassword" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class=" col-sm-3 control-label">Email: </label>
                                                                <div class="col-sm-9 controls">
                                                                    <div class="row">
                                                                        <div class="col-xs-9">
                                                                            <input type="text" disabled class="form-control" value="<?php echo $row->email; ?>" name="txtEmail" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class=" col-sm-3 control-label">Secret Question: </label>
                                                                <div class="col-sm-9 controls">
                                                                    <div class="row">
                                                                        <div class="col-xs-9">
                                                                            <input type="text" disabled class="form-control" value="<?php echo $row->secret_question; ?>" name="txtSecretQuestion" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class=" col-sm-3 control-label">Secret Answer: </label>
                                                                <div class="col-sm-9 controls">
                                                                    <div class="row">
                                                                        <div class="col-xs-9">
                                                                            <input type="text" disabled class="form-control" value="<?php echo $row->secret_answer; ?>" name="txtSecretAnswer" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                    <label class=" col-sm-3 control-label">Employee ID: </label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-9"><p><?php echo $row->employee_id; ?></p></div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                            <?php } ?>
                                                    </div>
                                                </div>
                                                <!-- /.tab-content4 -->
                                            </div>
                                            <!-- nav-tabs-custom -->
                                        </div>
                                        <!-- Main Details -->
                                    </div>
                                    <!--Main Panel -->
                                </div>
                                <!-- col-9-->
                            </div>
                        </div>
                        <!-- col-12-->
                        </form>
                    </div>
                    <!--Main Content Panel-body -->
                </div>
                <!--Main Content Panel -->
            </div>
        </div>
