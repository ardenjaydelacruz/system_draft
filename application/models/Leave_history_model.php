<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/12/2015
 * Time: 11:59 PM
 */
class Leave_history_model extends ActiveRecord\Model {
    static $table_name = 'tbl_leave_credits';
    static $primary_key = 'leave_history_id';

    public function addHistory($id,$leave,$days,$action,$leaveDays,$details,$added){
    	$data = array (
			'employee_id'   => $id,
			'leave_type'    => $leave,
			'leave_left'    => $days,
			'action'        => $action.' '.$added.' day/s Leave',
			'updated_leave' => $leaveDays,
			'details'       => $details
    		);

    	Leave_history_model::create($data);
    }

}