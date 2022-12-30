<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom Diagnostic Management System
 * @version : 2.0
 * @developed by : techtune
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/techtune
 * @filename : Install.php
 */

class Install extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('install_model', '_install');
        if ($this->config->item('installed')) {
            redirect(site_url('authentication'));
        }
    }
	
}
