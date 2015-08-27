<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendar extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function calendar_index(){
		$data['dates'] = Calendar_model::getEventDates();
		$data['pageTitle'] = 'Calendar - MSInc.';
        $data['content'] = 'calendar/calendar_table';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function event_add(){
		$this->form_validation->set_rules('txtDayName', 'Tax Type', 'trim|required');
		$this->form_validation->set_rules('txtDescription', 'Amount', 'trim|required');
		$this->form_validation->set_rules('txtDate', 'Date Value', 'trim|required');
		$this->form_validation->set_rules('cboEventType', 'Percentage', 'trim|required');
		
		if ($this->form_validation->run()) {
			$post = $this->input->post();
			$allow_absence = 0;
			if($post['chkAllowAbsence']) $allow_absence = 1;
			$details = array (
				"day_name" => $post['txtDayName'],
				"description" => $post['txtDescription'],
				"date_value" => $post['txtDate'],
				"day_type_id" => $post['cboEventType'],
				"allow_absence" => $allow_absence);
			Calendar_model::create($details);
			$this->session->set_userdata('added', 1);
			redirect("calendar/calendar_index");
		}
		
		$data = array();
		$data['day_type'] = Calendar_model::getDayType();
		$data['pageTitle'] = 'Add Day Event - MSInc.';
        $data['content'] = 'calendar/calendar_add';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function event_edit(){
		$calendarID = $this->input->get('id');
		$this->form_validation->set_rules('txtDayName', 'Tax Type', 'trim|required');
		$this->form_validation->set_rules('txtDescription', 'Amount', 'trim|required');
		$this->form_validation->set_rules('txtDate', 'Date Value', 'trim|required');
		$this->form_validation->set_rules('cboEventType', 'Percentage', 'trim|required');
		
		if ($this->form_validation->run()) {
			$post = $this->input->post();
			$allow_absence = 0;
			if($post['chkStatus']) $allow_absence = 1;
			$details = array (
				"day_name" => $post['txtDayName'],
				"description" => $post['txtDescription'],
				"date_value" => $post['txtDate'],
				"day_type_id" => $post['cboEventType'],
				"allow_absence" => $allow_absence);
			$event = Calendar_model::find($post['txtCalendarID']);
			if ($event->update_attributes($details)){
				$this->session->set_userdata('edited', 1);
				redirect("calendar/calendar_index");
			}
		}
		
		$data['day_type'] = Calendar_model::getDayType();
		$data['calendar'] = Calendar_model::find($calendarID);
		//print_r($data['calendar']);
		$data['pageTitle'] = 'Edit Event - MSInc.';
        $data['content'] = 'calendar/calendar_edit';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	} 
	
	public function event_delete(){
		$get = $this->input->get();
		if($get){
			$this->calendar_model->delete_event($get['id']);
		}
		$this->session->set_userdata('deleted', 1);
		redirect('calendar/calendar_index');
	} 
	
}
?>