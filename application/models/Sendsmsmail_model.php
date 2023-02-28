<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sendsmsmail_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //custom omit
        $ci = & get_instance();
        
        if (is_superadmin_loggedin()) {
            $branchID = $ci->input->post('branch_id');
        } else {
            $branchID = get_loggedin_branch_id();
        }
        $bulksms = $ci->db->get_where('sms_credential', array('sms_api_id' => 4, 'branch_id' => $branchID))->row_array();

        $this->username = $bulksms['field_one'];
        $this->password = $bulksms['field_two'];
        //custom omit
    }

    public function getStaff($branch_id, $role_id = '', $staff_id = '')
    {
        $this->db->select('staff.id,staff.name,staff.mobileno,staff.email');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != "6" and login_credential.role != "7"', 'inner');
        $this->db->where('staff.branch_id', $branch_id);
        if (!empty($role_id)) {
            $method = 'result_array';
            $this->db->where('login_credential.role', $role_id);
            $this->db->order_by('staff.id', 'ASC');
        }
        if (!empty($staff_id)) {
            $this->db->where('staff.id', $staff_id);
            $method = 'row_array';
        }
        return $this->db->get()->$method();
    }

    public function getParent($branch_id, $parent_id = '')
    {
        $this->db->select('id,name,email,mobileno');
        $this->db->where('branch_id', $branch_id);
        if (empty($parent_id)) {
            $method = 'result_array';
        } else {
            $this->db->where('id', $parent_id);
            $method = 'row_array';
        }
        return $this->db->get('parent')->$method();
    }

    public function getStudent($branch_id, $student_id = '')
    {
        $this->db->select('e.student_id,CONCAT_WS(" ",s.first_name, s.last_name) as name,s.mobileno,s.email');
        $this->db->from('enroll as e');
        $this->db->join('student as s', 'e.student_id = s.id', 'inner');
        $this->db->where('e.branch_id', $branch_id);
        if (empty($student_id)) {
            $method = 'result_array';
            $this->db->where('e.session_id', get_session_id());
            $this->db->order_by('s.id', 'ASC');
        } else {
            $this->db->where('s.id', $student_id);
            $method = 'row_array';
        }
        return $this->db->get()->$method();
    }

    public function getStudentBySection($class_id, $section_id, $branch_id)
    {
        $this->db->select('e.student_id,CONCAT_WS(" ",s.first_name, s.last_name) as name,s.mobileno,s.email');
        $this->db->from('enroll as e');
        $this->db->join('student as s', 'e.student_id = s.id', 'inner');
        $this->db->where('e.class_id', $class_id);
        $this->db->where('e.section_id', $section_id);
        $this->db->where('e.branch_id', $branch_id);
        $this->db->where('e.session_id', get_session_id());
        $this->db->order_by('s.id', 'ASC');
        return $this->db->get()->result_array();
    }

    public function saveTemplate($data)
    {
        $insertData = array(
            'branch_id' => $this->application_model->get_branch_id(),
            'name' => $data['template_name'],
            'body' => $this->input->post('message', false),
            'type' => $data['type'],
        );

        if (!isset($data['template_id'])) {
            $this->db->insert('bulk_msg_category', $insertData);
        } else {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $data['template_id']);
            $this->db->update('bulk_msg_category', $insertData);
        }
    }

    public function sendEmail($sendTo, $message, $name, $mobileNo, $emailSubject)
    {
        $message = str_replace('{name}', $name, $message);
        $message = str_replace('{email}', $sendTo, $message);
        $message = str_replace('{mobile_no}', $mobileNo, $message);
        $branchID = $this->application_model->get_branch_id();
        $data = array(
            'branch_id' => $branchID, 
            'recipient' => $sendTo, 
            'subject' => $emailSubject, 
            'message' => $message, 
        );
        if ($this->mailer->send($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function sendSMS($sendTo, $message, $name, $eMail, $smsGateway)
    {
        //for msg
        define("SERVER", $this->username);
        define("API_KEY", $this->password);
        
        define("USE_SPECIFIED", 0);
        define("USE_ALL_DEVICES", 1);
        define("USE_ALL_SIMS", 1);
        //end msg

        $message = str_replace('{name}', $name, $message);
        $message = str_replace('{email}', $eMail, $message);
        $message = str_replace('{mobile_no}', $sendTo, $message);
        if ($smsGateway == 'twilio') {
            $this->load->library("twilio");
            $get = $this->twilio->get_twilio();
            $from = $get['number'];
            $response = $this->twilio->sms($from, $sendTo, $message);
            if ($response->IsError) {
                return false;
            } else {
                return true;
            }
        }
        if ($smsGateway == 'clickatell') {
            $this->load->library("clickatell");
            return $this->clickatell->send_message($sendTo, $message);
        }
        if ($smsGateway == 'msg91') {
            $this->load->library("msg91");
            return $this->msg91->send($sendTo, $message);
        }
        if ($smsGateway == 'mydokani') {
            $this->load->library("bulk");
            return $this->bulk->send($sendTo, $message);
            //start sms function
                // $msg = $this->sendSingleMessage($sendTo, $message);
            //end sms
        }
        if ($smsGateway == 'bulksmsbd') {
            $this->load->library("bulksmsbd");
            return $this->bulksmsbd->send($sendTo, $message);;
        }
        if ($smsGateway == 'textlocal') {
            $this->load->library("textlocal");
            return $this->textlocal->sendSms($sendTo, $message);
        }
    }
    function sendSingleMessage($number, $message, $device = 0, $schedule = null, $isMMS = false, $attachments = null, $prioritize = false)
    {
        $url = SERVER . "/services/send.php";
        $postData = array(
            'number' => $number,
            'message' => $message,
            'schedule' => $schedule,
            'key' => API_KEY,
            'devices' => $device,
            'type' => $isMMS ? "mms" : "sms",
            'attachments' => $attachments,
            'prioritize' => $prioritize ? 1 : 0
        );
        return $this->sendRequest($url, $postData)["messages"][0];
    }
    function sendRequest($url, $postData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        curl_close($ch);
        if ($httpCode == 200) {
            $json = json_decode($response, true);
            if ($json == false) {
                if (empty($response)) {
                    throw new Exception("Missing data in request. Please provide all the required information to send messages.");
                } else {
                    throw new Exception($response);
                }
            } else {
                if ($json["success"]) {
                    return $json["data"];
                } else {
                    throw new Exception($json["error"]["message"]);
                }
            }
        } else {
            throw new Exception("HTTP Error Code : {$httpCode}");
        }
    }

}
