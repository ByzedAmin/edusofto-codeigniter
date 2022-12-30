<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_500 extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up()
    {
		$this->db->query("ALTER TABLE `online_admission` MODIFY `last_name` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `gender` varchar(25) NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `birthday` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `online_admission` ADD `religion` varchar(100) DEFAULT NULL AFTER `birthday`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `caste` varchar(100) DEFAULT NULL AFTER `religion`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `blood_group` varchar(100) DEFAULT NULL AFTER `caste`;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `mobile_no` varchar(50) NULL;");
		$this->db->query("ALTER TABLE `online_admission` ADD `mother_tongue` varchar(100) DEFAULT NULL AFTER `mobile_no`;");
		$this->db->query("ALTER TABLE `online_admission` CHANGE `address` `present_address` text DEFAULT NULL;");
		$this->db->query("ALTER TABLE `online_admission` ADD `permanent_address` text DEFAULT NULL AFTER `present_address`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `admission_date` varchar(100) DEFAULT NULL AFTER `permanent_address`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `city` varchar(255) DEFAULT NULL AFTER `admission_date`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `state` varchar(255) DEFAULT NULL AFTER `city`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `student_photo` varchar(255) DEFAULT NULL AFTER `state`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `category_id` varchar(255) DEFAULT NULL AFTER `student_photo`;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `email` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `online_admission` ADD `previous_school_details` text DEFAULT NULL AFTER `email`;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `guardian_name` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `guardian_relation` varchar(50) NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `father_name` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `mother_name` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `grd_occupation` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `grd_income` varchar(25) NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `grd_education` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `grd_email` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `grd_mobile_no` varchar(50) NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `grd_address` text NULL;");
		$this->db->query("ALTER TABLE `online_admission` MODIFY `section_id` int(11) NULL;");

		$this->db->query("ALTER TABLE `online_admission` ADD `grd_city` varchar(255) DEFAULT NULL AFTER `grd_address`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `grd_state` varchar(255) DEFAULT NULL AFTER `grd_city`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `grd_photo` varchar(255) DEFAULT NULL AFTER `grd_state`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `doc` varchar(255) DEFAULT NULL AFTER `apply_date`;");

		$this->db->query("ALTER TABLE `global_settings` ADD `image_extension` text DEFAULT NULL AFTER `cms_default_branch`;");
		$this->db->query("ALTER TABLE `global_settings` ADD `image_size` float NOT NULL DEFAULT '1024' AFTER `image_extension`;");
		$this->db->query("ALTER TABLE `global_settings` ADD `file_extension` text DEFAULT NULL AFTER `image_size`;");
		$this->db->query("ALTER TABLE `global_settings` ADD `file_size` float NOT NULL DEFAULT '1024' AFTER `file_extension`;");
		$this->db->query("UPDATE `global_settings` SET `image_extension` = 'jpeg, jpg, bmp, png' WHERE `global_settings`.`id` = 1;");
		$this->db->query("UPDATE `global_settings` SET `file_extension` = 'txt, pdf, doc, xls, docx, xlsx, jpg, jpeg, png, gif, bmp, zip, mp4, 7z, wmv, rar' WHERE `global_settings`.`id` = 1;");

		$this->db->query("ALTER TABLE `parent` MODIFY `name` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `relation` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `father_name` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `mother_name` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `occupation` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `income` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `education` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `email` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `mobileno` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `address` text NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `city` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `state` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `parent` MODIFY `photo` varchar(255) NULL;");

		$this->db->query("ALTER TABLE `student` MODIFY `register_no` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `admission_date` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `first_name` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `last_name` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `gender` varchar(20) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `birthday` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `religion` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `caste` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `blood_group` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `mother_tongue` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `current_address` text NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `permanent_address` text NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `city` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `state` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `state` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `mobileno` varchar(255) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `email` varchar(100) NULL;");
		$this->db->query("ALTER TABLE `student` MODIFY `previous_details` text NULL;");
		$this->db->query("INSERT INTO `permission` (`module_id`, `name`, `prefix`, `show_view`, `show_add`, `show_edit`, `show_delete`) VALUES ('18', 'Whatsapp Config', 'whatsapp_config', '1', '1', '1', '1'), ('18', 'System Student Field', 'system_student_field', '1', '0', '1', '0');");

		$this->db->query("ALTER TABLE `branch` ADD `due_days` float NOT NULL DEFAULT '30' AFTER `teacher_restricted`;");
		$this->db->query("ALTER TABLE `branch` ADD `due_with_fine` tinyint(4) NOT NULL DEFAULT '1' AFTER `due_days`;");
		$this->db->query("ALTER TABLE `branch` ADD `unique_roll` tinyint(4) NOT NULL DEFAULT '1' AFTER `due_with_fine`;");

		$this->db->query("ALTER TABLE `payment_config` ADD `flutterwave_public_key` varchar(255) DEFAULT NULL AFTER `midtrans_status`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `flutterwave_secret_key` varchar(255) DEFAULT NULL AFTER `flutterwave_public_key`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `flutterwave_sandbox` tinyint(4) NOT NULL DEFAULT '0' AFTER `flutterwave_secret_key`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `flutterwave_status` tinyint(4) NOT NULL DEFAULT '0' AFTER `flutterwave_sandbox`;");

		$this->db->query("INSERT INTO `payment_types` (`name`, `branch_id`) VALUES ('Flutter Wave', '0');");
		$this->db->query("CREATE TABLE IF NOT EXISTS `whatsapp_agent` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`agent_name` varchar(255) NOT NULL,
						`agent_image` varchar(255) NOT NULL,
						`agent_designation` varchar(255) NOT NULL,
						`whataspp_number` varchar(255) NOT NULL,
						`start_time` time NOT NULL,
						`end_time` time NOT NULL,
						`weekend` varchar(20) DEFAULT NULL,
						`enable` tinyint(1) NOT NULL DEFAULT '1',
						`branch_id` int(11) NOT NULL,
						`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
						PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `whatsapp_chat` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `header_title` varchar(255) NOT NULL,
		  `subtitle` varchar(355) DEFAULT NULL,
		  `footer_text` varchar(255) DEFAULT NULL,
		  `popup_message` varchar(255) DEFAULT NULL,
		  `frontend_enable_chat` tinyint(1) NOT NULL DEFAULT '0',
		  `backend_enable_chat` tinyint(1) NOT NULL DEFAULT '0',
		  `branch_id` int(11) NOT NULL,
		  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

		$this->db->query("INSERT INTO `whatsapp_chat` (`id`, `header_title`, `subtitle`, `footer_text`, `popup_message`, `frontend_enable_chat`, `backend_enable_chat`, `branch_id`, `created_at`) VALUES
		(1, 'Start a Conversation', 'Start a Conversation', 'Use this feature to chat with our agent.', NULL, 1, 1, 1, '2022-02-16 13:49:13');");

		$this->db->query("CREATE TABLE IF NOT EXISTS `online_admission_fields` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `fields_id` int(11) NOT NULL,
		  `status` tinyint(4) NOT NULL DEFAULT '1',
		  `required` tinyint(4) NOT NULL DEFAULT '0',
		  `system` tinyint(1) NOT NULL DEFAULT '1',
		  `branch_id` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `student_admission_fields` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `fields_id` int(11) NOT NULL,
		  `status` tinyint(4) NOT NULL DEFAULT '1',
		  `required` tinyint(4) NOT NULL DEFAULT '0',
		  `branch_id` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `student_fields` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `prefix` varchar(255) NOT NULL,
		  `default_status` tinyint(1) NOT NULL DEFAULT '1',
		  `default_required` tinyint(4) NOT NULL DEFAULT '1',
		  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

		$this->db->query("INSERT INTO `student_fields` (`id`, `prefix`, `default_status`, `default_required`, `created_at`) VALUES
		(1, 'roll', 1, 0, '2022-04-25 20:27:04'),
		(2, 'last_name', 1, 1, '2022-04-25 20:27:04'),
		(3, 'gender', 1, 0, '2022-04-25 20:27:04'),
		(4, 'birthday', 1, 0, '2022-04-25 20:27:04'),
		(5, 'admission_date', 1, 1, '2022-04-25 20:27:04'),
		(6, 'category', 1, 1, '2022-04-25 20:27:04'),
		(7, 'section', 1, 1, '2022-04-25 20:27:04'),
		(8, 'religion', 1, 0, '2022-04-25 20:27:04'),
		(9, 'caste', 1, 0, '2022-04-25 20:27:04'),
		(10, 'blood_group', 1, 0, '2022-04-25 20:27:04'),
		(11, 'mother_tongue', 1, 0, '2022-04-25 20:27:04'),
		(12, 'present_address', 1, 0, '2022-04-25 20:27:04'),
		(13, 'permanent_address', 1, 0, '2022-04-25 20:27:04'),
		(14, 'city', 1, 0, '2022-04-25 20:27:04'),
		(15, 'state', 1, 0, '2022-04-25 20:27:04'),
		(16, 'student_email', 1, 0, '2022-04-25 20:27:04'),
		(17, 'student_mobile_no', 1, 0, '2022-04-25 20:27:04'),
		(18, 'student_photo', 1, 0, '2022-04-25 20:27:04'),
		(19, 'previous_school_details', 1, 0, '2022-04-25 20:27:04'),
		(20, 'guardian_name', 1, 1, '2022-04-25 20:27:04'),
		(21, 'guardian_relation', 1, 1, '2022-04-25 20:27:04'),
		(22, 'father_name', 1, 0, '2022-04-25 20:27:04'),
		(23, 'mother_name', 1, 0, '2022-04-25 20:27:04'),
		(24, 'guardian_occupation', 1, 1, '2022-04-25 20:27:04'),
		(25, 'guardian_income', 1, 1, '2022-04-25 20:27:04'),
		(26, 'guardian_education', 1, 1, '2022-04-25 20:27:04'),
		(27, 'guardian_email', 1, 1, '2022-04-25 20:27:04'),
		(28, 'guardian_mobile_no', 1, 1, '2022-04-25 20:27:04'),
		(29, 'guardian_address', 1, 1, '2022-04-25 20:27:04'),
		(30, 'guardian_photo', 1, 0, '2022-04-25 20:27:04'),
		(31, 'upload_documents', 1, 1, '2022-04-25 20:27:04'),
		(32, 'guardian_city', 1, 0, '2022-04-25 20:27:04'),
		(33, 'guardian_state', 1, 0, '2022-04-25 20:27:04');");

		$this->db->query("ALTER TABLE `fee_groups` ADD `system` tinyint(4) NOT NULL DEFAULT '0' AFTER `session_id`;");
		$this->db->query("ALTER TABLE `fees_type` ADD `system` tinyint(4) NOT NULL DEFAULT '0' AFTER `branch_id`;");
		$this->db->query("ALTER TABLE `fee_allocation` ADD `prev_due` decimal(18,2) NOT NULL DEFAULT '0.00' AFTER `session_id`;");
		$this->db->query("CREATE TABLE IF NOT EXISTS `custom_fields_online_values` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `relid` int(11) NOT NULL,
		  `field_id` int(11) NOT NULL,
		  `value` text NOT NULL,
		  PRIMARY KEY (`id`),
		  KEY `relid` (`relid`),
		  KEY `fieldid` (`field_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		
		$this->db->query("CREATE TABLE IF NOT EXISTS `homework_submit` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `homework_id` int(11) NOT NULL,
		  `student_id` int(11) NOT NULL,
		  `message` varchar(355) NOT NULL,
		  `enc_name` varchar(355) DEFAULT NULL,
		  `file_name` varchar(355) DEFAULT NULL,
		  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
    }
}
