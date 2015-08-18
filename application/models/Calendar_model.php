<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendar_model extends ActiveRecord\Model {
    static $table_name = 'tbl_calendar';
    static $primary_key = 'calendar_id';
	
	public function getDayType(){
		$result = $this->db->get("tbl_day_type");
		return $result->result();
	}
	
	public function getEventDates(){
		$result = $this->db->get("view_calendar");
		return $result->result();
	}
	
	public function delete_event($calendar_id){
		$this->db->where('calendar_id', $calendar_id);
		$this->db->delete('tbl_calendar');
	}
}