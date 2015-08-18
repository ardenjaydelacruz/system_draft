  <?php
if (!empty($account->profile_image)){
      $image = $account->profile_image;
  } else {
      $image = 'default.jpg';
  }
?>
<form action="<?php echo base_url();?>ems/update_employee?emp_id=<?php echo $info->emp_id; ?>" method="post">
<div class="content-wrapper">
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active"><i class="fa fa-user"></i> View Profile </li>
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
                  <h3 class="panel-title text-center"><?php echo $info->first_name.' '.$info->middle_name.' '.$info->last_name; ?></h3>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <div class="text-center"><img src="<?php echo base_url().'assets/images/profile/'.$image; ?>" alt="" class="img-responsive emp_image" /></div>
                    <div id="upload">
                      <?php
                      echo form_open_multipart('ems/upload_image?emp_id='.$info->emp_id);
                      echo form_upload('userfile');
                      echo form_submit('btnUpload','Upload');
                      echo form_close();
                      ?>
                    </div>
                  </div>
                  <table class="table table-striped table-hover">
                    <tbody>
                      <tr>
                        <th>Emp ID:</th>
                        <td><?php echo $emp->emp_id; ?></td>
                      </tr>
                      <tr>
                        <th>Job Title:</th>
                        <td><?php echo $emp->job_title_name; ?></td>
                       </tr>
                      <tr>
                        <th>Emp Type:</th>
                         <td><?php echo $emp->employment_type; ?></td>
                      </tr>
                      <tr>
                        <th>Department:</th>
                        <td><?php echo $emp->department_name; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div><!-- Side Panel-->
              <center>
                <a id="btnEnable" class="button btn btn-primary MainButtons"><i class="fa fa-edit"></i><br>Edit</a>
                <a href="<?php echo base_url();?>ems/request_leave?emp_id=<?php echo $info->emp_id; ?>" class="button btn btn-warning MainButtons">
                  <i class="fa fa-calendar"></i><br>Add Leave
                </a>
                <button class="btn btn-success MainButtons button disabled" id="btnSaveEdit"><i class="fa fa-floppy-o"></i><br>Save</button>
              </center>
            </div><!-- col-4-->
            <div class="col-md-8">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="nav-tabs-custom ">
                    <ul class="nav nav-tabs ">
                      <li class="active" data-toggle="tooltip" data-placement="top" title="Personal Details">
                        <a href="#tab_1" data-toggle="tab" ><i class="fa fa-user fa-lg"></i></a>
                      </li>
                      <li data-toggle="tooltip" data-placement="top" title="Contact Info">
                        <a href="#tab_2" data-toggle="tab"><i class="fa fa-phone"></i></a>
                      </li>
                      <li data-toggle="tooltip" data-placement="top" title="Other Info">
                        <a href="#tab_3" data-toggle="tab"><i class="fa fa-institution"></i></a>
                      </li>
                      <li data-toggle="tooltip" data-placement="top" title="Educational Background">
                        <a href="#tab_4" data-toggle="tab"><i class="fa fa-graduation-cap"></i></a>
                      </li>
                      <li data-toggle="tooltip" data-placement="top" title="Past Employment">
                        <a href="#tab_5" data-toggle="tab"><i class="fa fa-briefcase"></i></a>
                      </li>
                      <li data-toggle="tooltip" data-placement="top" title="Employment Information">
                        <a href="#tab_6" data-toggle="tab"><i class="fa fa-info-circle"></i></a>
                      </li>
                      <li data-toggle="tooltip" data-placement="top" title="Leave Information">
                        <a href="#tab_7" data-toggle="tab"><i class="fa fa-calendar"></i></a>
                      </li>
                      <li data-toggle="tooltip" data-placement="top" title="Assigned Assets">
                        <a href="#tab_8" data-toggle="tab"><i class="fa fa-desktop"></i></a>
                      </li>
                      <li data-toggle="tooltip" data-placement="top" title="Assigned Projects">
                        <a href="#tab_9" data-toggle="tab"><i class="fa fa-wrench"></i></a>
                      </li>
                      <li data-toggle="tooltip" data-placement="top" title="User Account">
                        <a href="#tab_10" data-toggle="tab"><i class="fa fa-users"></i></a>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <section class="tab-pane active" id="tab_1">
                        <div class="form-horizontal">
                          <h3>Personal Details</h3>
                          <hr>
                          <article class="form-group">
                            <label class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled placeholder="first name" class="form-control" value="<?php echo $info->first_name; ?>" name="txtFirstName" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class="col-sm-3 control-label">Middle Name</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled placeholder="middle name" class="form-control" value="<?php echo $info->middle_name; ?>" name="txtMiddleName" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled placeholder="last name" class="form-control" value="<?php echo $info->last_name; ?>" name="txtLastName" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class="col-sm-3 control-label">Gender</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <div class="radio">
                                            <label class="radio-inline">
                                                <input type="radio" value="male" name="txtGender" <?php if($info->gender=='male' ) echo "checked='checked'"; ?> disabled/>Male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" value="female" name="txtGender" <?php if($info->gender=='female' ) echo "checked='checked'"; ?> disabled/>Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class="col-sm-3 control-label">Birthday</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text"  disabled class="form-control" value="<?php echo date_format($info->birthday,'M d, Y'); ?>" name="txtBirthday" disabled/>
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class="col-sm-3 control-label">Marital Status</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <select class="form-control" name="txtMaritalStatus" disabled>
                                            <option <?php if($info->marital_status=='Single' ) echo "selected='selected'"; ?>>Single</option>
                                            <option <?php if($info->marital_status=='Married' ) echo "selected='selected'"; ?>>Married</option>
                                            <option <?php if($info->marital_status=='Widowed' ) echo "selected='selected'"; ?>>Widowed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                          </article>
                        </div>
                      </section><!-- Personal -->
                      
                      <section class="tab-pane" id="tab_2">
                        <div class="form-horizontal">
                          <h3>Contact Details</h3>
                          <hr>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Street: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $address->street; ?>" name="txtStreet" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Barangay: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $address->barangay; ?>" name="txtBarangay" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">City / Town: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $address->city; ?>" name="txtCity" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">State / Province: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $address->state; ?>" name="txtState" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Zip / Postal Code: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled  class="form-control" value="<?php echo $address->zip; ?>" name="txtZip" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Country: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                      <select name="txtCountry" class="form-control" disabled>
                                        <option value="<?php echo $address->country_code; ?>"><?php echo $address->country_name; ?></option>
                                          <?php foreach ($countryy as $row){ 
                                              echo "<option value='$row->country_code'>$row->country_name </option>";
                                          } ?>
                                      </select>
                                    </div>
                                </div>
                            </div>
                          </article>
                          <hr>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Mobile Number: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $contact->mobile_number; ?>" name="txtMobile" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Telephone Number: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $contact->tel_number; ?>" name="txtTelephone" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Email: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $contact->email_address; ?>" name="txtEmailAd" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <br>
                          <h3>Contact Person</h3>
                          <hr>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Contact Person: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $contactP->contact_person; ?>" name="txtContactPerson" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Contact Number: </label>
                            <div class="col-sm-9 controls">
                               <div class="row">
                                  <div class="col-xs-9">
                                     <input type="text" disabled class="form-control" value="<?php echo $contactP->contact_num; ?>" name="txtContactNum" />
                                  </div>
                               </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Relationship: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $contactP->contact_rel; ?>" name="txtContactRel" />
                                    </div>
                                </div>
                            </div>
                          </article>
                        </div>
                      </section><!-- Contact -->

                      <section class="tab-pane" id="tab_3">
                        <div class="form-horizontal">
                          <h3>Government Issued ID:</h3>
                          <hr>
                          <article class="form-group">
                              <label class=" col-sm-3 control-label">Social Security No.: </label>
                              <div class="col-sm-9 controls">
                                  <div class="row">
                                      <div class="col-xs-9">
                                          <input type="text" disabled class="form-control" value="<?php echo $gov_id->sss_no; ?>" name="txtSSS" />
                                      </div>
                                  </div>
                              </div>
                          </article>
                          <article class="form-group">
                              <label class=" col-sm-3 control-label">Pag-ibig No.: </label>
                              <div class="col-sm-9 controls">
                                  <div class="row">
                                      <div class="col-xs-9">
                                          <input type="text" disabled class="form-control" value="<?php echo $gov_id->pagibig_no; ?>" name="txtPagibig" />
                                      </div>
                                  </div>
                              </div>
                          </article>
                          <article class="form-group">
                              <label class=" col-sm-3 control-label">Philhealth No.: </label>
                              <div class="col-sm-9 controls">
                                  <div class="row">
                                      <div class="col-xs-9">
                                          <input type="text" disabled class="form-control" value="<?php echo $gov_id->philhealth_no; ?>" name="txtPhilhealth" />
                                      </div>
                                  </div>
                              </div>
                          </article>
                          <article class="form-group">
                              <label class=" col-sm-3 control-label">Tax Identification No.: </label>
                              <div class="col-sm-9 controls">
                                  <div class="row">
                                      <div class="col-xs-9">
                                          <input type="text" disabled class="form-control" value="<?php echo $gov_id->tin; ?>" name="txtTIN" />
                                      </div>
                                  </div>
                              </div>
                          </article><br>
                        </div>
                          
                        <div class="form-horizontal">
                          <h3>Dependent/s</h3><hr>
                          <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addDependents"><i class="fa fa-plus"></i> Add</a><br><br>
                          <table class="table table-hovered table-striped table-bordered">
                             <thead>
                                <th class="text-center">Dependent Name</th>
                                <th class="text-center">Relationship</th>
                             </thead>
                             <?php foreach ($record as $row) { ?>
                             <tr>
                                <th class="text-center"><?php echo $row->dependent_fname.' '.$row->dependent_lname; ?></th>
                                <td class="text-center"><?php echo $row->relationship; ?></td>
                             </tr>
                             <?php } ?>
                          </table>
                        </div>
                      </section><!-- Other Info -->
                      <form action="<?php echo base_url();?>ems/update_employee?emp_id=<?php echo $info->emp_id; ?>" method="post">
                        <div class="modal fade" id="addDependents" tabindex="-1" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Add New Dependents</h4>
                              </div>
                              <div class="modal-body">
                                <label for="">First Name:</label>
                                <input type="text" class="form-control" name="txtDFirstName" required><br>
                                <label for="">Last Name:</label>
                                <input type="text" class="form-control" name="txtDLastName" required><br>
                                <label for="">Relationship:</label>
                                <input type="text" class="form-control" name="txtRelationship" required><br>
                              </div>
                              <div class="modal-footer">
                                <input type="submit" class="btn btn-success" value="Add" name="btnAddDependents">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                      </form>

                      <section class="tab-pane" id="tab_4">
                        <div class="form-horizontal">
                          <h3>Tertiary</h3>
                          <hr>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">School Name: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $school->tertiary_name; ?>" name="txtSchoolName3" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">School Address: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $school->tertiary_address; ?>" name="txtSchoolAddress3" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Year Graduated: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $school->tertiary_year; ?>" name="txtSchoolYear3" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <br>
                          <h3>Secondary </h3>
                          <hr>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">School Name: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $school->secondary_name; ?>" name="txtSchoolName2" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">School Address: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $school->secondary_address; ?>" name="txtSchoolAddress2" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Year Graduated: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $school->secondary_year; ?>" name="txtSchoolYear2" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <br>
                          <h3>Primary </h3>
                          <hr>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">School Name: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $school->primary_name; ?>" name="txtSchoolName1" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">School Address: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $school->primary_address; ?>" name="txtSchoolAddress1" />
                                    </div>
                                </div>
                            </div>
                          </article>
                          <article class="form-group">
                            <label class=" col-sm-3 control-label">Year Graduated: </label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" disabled class="form-control" value="<?php echo $school->primary_year; ?>" name="txtSchoolYear1" />
                                    </div>
                                </div>
                            </div>
                          </article>
                        </div>
                      </section><!-- Education -->

                      <section class="tab-pane" id="tab_5">
                        <div class="form-horizontal">
                            <h3>Job History</h3>
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addJob"><i class="fa fa-plus"></i> Add</a><br><br>
                            <table class="table table-hovered table-striped table-bordered">
                               <thead>
                                  <th class="text-center">Company Name</th>
                                  <th class="text-center">Company Address</th>
                                  <th class="text-center">Years of Service</th>
                                  <th class="text-center">Job Title</th>
                               </thead>
                               <?php foreach ($job_hist as $job) { ?>
                               <tr>
                                  <th class="text-center"><?php echo $job->company_name; ?></th>
                                  <td><?php echo $job->company_address; ?></td>
                                  <td><?php echo $job->years_stayed; ?></td>
                                  <td><?php echo $job->job_title; ?></td>
                               </tr>
                               <?php } ?>
                            </table>
                          </div>
                      </section><!-- Job History -->
                      <form action="<?php echo base_url();?>ems/update_employee?emp_id=<?php echo $info->emp_id; ?>" method="post">
                        <div class="modal fade" id="addJob" tabindex="-1" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Add New Job History</h4>
                              </div>
                              <div class="modal-body">
                                <label for="">Company Name:</label>
                                <input type="text" class="form-control" name="txtCompanyName" required><br>
                                <label for="">Company Address:</label>
                                <input type="text" class="form-control" name="txtCompanyAddress" required><br>
                                <label for="">Years Worked:</label>
                                <input type="text" class="form-control" name="txtJobHistYears" required><br>
                                <label for="">Job Title:</label>
                                <input type="text" class="form-control" name="txtJobHistTitle" required><br>
                              </div>
                              <div class="modal-footer">
                                <input type="submit" class="btn btn-success" value="Add" name="btnAddJob">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                      </form>

                      <section class="tab-pane" id="tab_6">
                        <div class="form-horizontal">
                           <h3>Employment Details</h3><hr>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Status: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                       <div class="col-xs-9">
                                          <label class="control-label"><?php echo $emp->status; ?></label>
                                          <input type="hidden" name="txtStatus" value="<?php echo $emp->status; ?>">
                                       </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Job title: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                       <div class="col-xs-9">
                                          <label class="control-label"><?php echo $emp->job_title_name; ?></label>
                                          <input type="hidden" name="txtJobTitle" value="<?php echo $emp->job_title_id; ?>">
                                        </select>
                                       </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Employment Type: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                       <div class="col-xs-9">
                                          <label class="control-label"><?php echo $emp->employment_type; ?></label>
                                          <input type="hidden" name="txtEmploymentType" value="<?php echo $emp->employment_type_id; ?>">
                                       </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Department: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                       <div class="col-xs-9">
                                          <label class="control-label"><?php echo $emp->department_name; ?></label>
                                          <input type="hidden" name="txtDepartment" value="<?php echo $emp->department_id; ?>">
                                       </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Start Date: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                      <div class="col-xs-9">
                                        <label class="control-label"><?php echo date_format($emp->start_date,'M d, Y'); ?></label>  
                                        <input type="hidden" name="txtStartDate" value="<?php echo $emp->start_date; ?>">
                                      </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">End Date: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                      <div class="col-xs-9">
                                        <label class="control-label"><?php echo date_format($emp->end_date,'M d, Y'); ?></label>
                                        <input type="hidden" name="txtEndDate" value="<?php echo $emp->end_date; ?>">
                                      </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Probationary Date: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                      <div class="col-xs-9">
                                        <label class="control-label"><?php echo date_format($emp->probationary_date,'M d, Y'); ?></label>
                                        <input type="hidden" name="txtProbationaryDate" value="<?php echo $emp->probationary_date; ?>">
                                      </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Permanency Date: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                       <div class="col-xs-9">
                                          <label class="control-label"><?php echo date_format($emp->permanency_date,'M d, Y'); ?></label>
                                          <input type="hidden" name="txtPermanencyDate" value="<?php echo $emp->permanency_date; ?>">
                                       </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Pay Grade: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                       <div class="col-xs-9">
                                          <label class="control-label"><?php echo $emp->pay_grade; ?></label>
                                          <input type="hidden" name="txtPayGrade" value="<?php echo $emp->pay_grade; ?>">
                                       </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Salary: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                      <div class="col-xs-9">
                                        <label class="control-label"><?php echo number_format($emp->salary,2); ?></label>
                                        <input type="hidden" name="txtSalary" value="<?php echo $emp->salary; ?>">
                                      </div>
                                   </div>
                               </div>
                           </article>
                        </div>
                      </section><!-- Employment Details -->

                      <section class="tab-pane" id="tab_7">
                        <div class="form-horizontal">
                          <h3>Leave Details</h3><hr>
                          <table class="table table-hovered table-striped table-bordered">
                            <thead>
                                 <th class="text-center">Birthday Leave</th>
                                 <th class="text-center">Mandatory Leave</th>
                                 <th class="text-center">Maternity Leave</th>
                                 <th class="text-center">Paternity Leave</th>
                                 <th class="text-center">Sick Leave</th>
                                 <th class="text-center">Vacation Leave</th>
                                 <th class="text-center">Total Leaves Left</th>
                            </thead>
                            <?php foreach ($leaves as $row) { ?>
                                <tr>
                                    <td class="text-center <?php if ($row->birthday_leave==0) echo 'bgRed'; ?>"><?php echo $row->birthday_leave; ?></td>
                                    <td class="text-center <?php if ($row->mandatory_leave==0) echo 'bgRed'; ?>"><?php echo $row->mandatory_leave; ?></td>
                                    <td class="text-center <?php if ($row->maternity_leave==0) echo 'bgRed'; ?>"><?php echo $row->maternity_leave; ?></td>
                                    <td class="text-center <?php if ($row->paternity_leave==0) echo 'bgRed'; ?>"><?php echo $row->paternity_leave; ?></td>
                                    <td class="text-center <?php if ($row->sick_leave==0) echo 'bgRed'; ?>"><?php echo $row->sick_leave; ?></td>
                                    <td class="text-center <?php if ($row->vacation_leave==0) echo 'bgRed'; ?>"><?php echo $row->vacation_leave; ?></td>
                                    <th class="text-center success <?php if ($row->total_leave==0) echo 'bgRed'; ?>"><?php echo $row->total_leave; ?></th>
                                </tr>
                            <?php } ?>
                           </table>
                        </div>
                      </section><!-- Leaves -->

                      <section class="tab-pane" id="tab_8">
                        <div class="form-horizontal">
                           <h3>Assigned Assets</h3><hr>
                           <table class="table table-hovered table-striped table-bordered">
                               <thead>
                                  <th class="text-center">Asset ID</th>
                                  <th class="text-center">Asset Name</th>
                                  <th class="text-center">Asset Status</th>
                                  <th class="text-center">Assigned Date</th>
                               </thead>
                               <?php foreach ($asset as $eq) { ?>
                               <tr>
                                  <th class="text-center"><?php echo $eq->asset_id; ?></th>
                                  <td><?php echo $eq->asset_name; ?></td>
                                  <td><?php echo $eq->asset_status;?></td>
                                  <td><?php echo date_format($eq->assigned_date,'M d, Y'); ?></td>
                               </tr>
                               <?php } ?>
                           </table>
                        </div>
                      </section><!-- Asset -->

                      <section class="tab-pane" id="tab_9">
                        <div class="form-horizontal">
                           <h3>Active Projects</h3><hr>
                           <table class="table table-hovered table-striped table-bordered">
                               <thead>
                                  <th class="text-center">Project ID</th>
                                  <th class="text-center">Project Name</th>
                                  <th class="text-center">Assigned Date</th>
                               </thead>
                               <?php foreach ($project as $proj) { ?>
                               <tr>
                                  <th class="text-center"><?php echo $proj->project_id; ?></th>
                                  <td><?php echo $proj->project_name; ?></td>
                                  <td><?php echo date_format($proj->assigned_date,'M d, Y'); ?></td>
                               </tr>
                               <?php } ?>
                           </table>
                        </div>
                      </section><!-- Projects -->

                      <section class="tab-pane" id="tab_10">
                        <div class="form-horizontal">
                           <h3>User Account</h3><hr>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Username: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                       <div class="col-xs-9">
                                          <input type="text" disabled class="form-control" value="<?php echo $account->username; ?>" name="txtUsername" />
                                          <input type="hidden" disabled class="form-control" value="<?php echo $account->user_level_id; ?>" name="txtUserLevel" />
                                       </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Password: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                       <div class="col-xs-9">
                                           <input type="password" disabled class="form-control" value="<?php echo $account->password; ?>" name="txtPassword" />
                                       </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Secret Question: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                       <div class="col-xs-9">
                                           <input type="text" disabled class="form-control" value="<?php echo $account->secret_question; ?>" name="txtSecretQuestion" />
                                       </div>
                                   </div>
                               </div>
                           </article>
                           <article class="form-group">
                               <label class=" col-sm-3 control-label">Secret Answer: </label>
                               <div class="col-sm-9 controls">
                                   <div class="row">
                                       <div class="col-xs-9">
                                           <input type="text" disabled class="form-control" value="<?php echo $account->secret_answer; ?>" name="txtSecretAnswer" />
                                       </div>
                                   </div>
                               </div>
                           </article>
                        </div>
                      </section><!-- Account -->
                    </div><!-- Tab-content -->
                  </div><!-- Navs -->
                </div><!--Panel Body-->
              </div><!--Panel Default-->
            </div><!-- col-8-->
          </div><!-- row -->
        </div><!-- col-12-->
      </div><!--Main Content Panel-body -->
    </div><!--Main Content Panel -->
  </div> <!-- container-fluid-->
</div><!-- content-wrapper-->
</form>