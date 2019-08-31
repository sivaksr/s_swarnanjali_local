/*
SQLyog Community v11.52 (64 bit)
MySQL - 10.1.32-MariaDB : Database - swarnanjali_local_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`swarnanjali_local_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `swarnanjali_local_db`;

/*Table structure for table `allocateroom` */

DROP TABLE IF EXISTS `allocateroom`;

CREATE TABLE `allocateroom` (
  `a_r_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `class_id` int(12) DEFAULT NULL,
  `registration_type` varchar(250) DEFAULT NULL,
  `staff_name` varchar(250) DEFAULT NULL,
  `hostel_type` varchar(45) DEFAULT NULL,
  `floor_name` varchar(45) DEFAULT NULL,
  `room_numebr` varchar(250) DEFAULT NULL,
  `student_name` varchar(250) DEFAULT NULL,
  `gender` varchar(250) DEFAULT NULL,
  `contact_number` varchar(250) DEFAULT NULL,
  `dob` varchar(250) DEFAULT NULL,
  `joining_date` varchar(250) DEFAULT NULL,
  `till_date` varchar(250) DEFAULT NULL,
  `allot_bed` varchar(250) DEFAULT NULL,
  `charge_per_month` varchar(250) DEFAULT NULL,
  `no_of_months` varchar(250) DEFAULT NULL,
  `paid_amount` varchar(250) DEFAULT NULL,
  `guardian_name` varchar(250) DEFAULT NULL,
  `g_contact_number` varchar(45) DEFAULT NULL,
  `relation` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `address` text,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`a_r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `allocateroom` */

/*Table structure for table `announcements` */

DROP TABLE IF EXISTS `announcements`;

CREATE TABLE `announcements` (
  `int_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `comment` text,
  `create_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `sent_by` int(11) DEFAULT NULL,
  `readcount` int(11) DEFAULT '0',
  PRIMARY KEY (`int_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `announcements` */

/*Table structure for table `bonfi_cer` */

DROP TABLE IF EXISTS `bonfi_cer`;

CREATE TABLE `bonfi_cer` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `title` text,
  `adminssion_number` varchar(250) DEFAULT NULL,
  `paragraph` longtext,
  `status` int(11) DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bonfi_cer` */

/*Table structure for table `book_damage` */

DROP TABLE IF EXISTS `book_damage`;

CREATE TABLE `book_damage` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `i_b_id` int(11) DEFAULT NULL,
  `class_id` varchar(250) DEFAULT NULL,
  `student_id` varchar(250) DEFAULT NULL,
  `book_number` varchar(250) DEFAULT NULL,
  `return_type` varchar(250) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `book_damage` */

/*Table structure for table `book_fine_list` */

DROP TABLE IF EXISTS `book_fine_list`;

CREATE TABLE `book_fine_list` (
  `b_f_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `fine_if_any` bigint(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`b_f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `book_fine_list` */

/*Table structure for table `books_list` */

DROP TABLE IF EXISTS `books_list`;

CREATE TABLE `books_list` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL COMMENT 's_id=school id',
  `book_number` varchar(250) DEFAULT NULL,
  `book_title` varbinary(250) DEFAULT NULL,
  `author_name` varchar(250) DEFAULT NULL,
  `publisher` varchar(250) DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  `isbn` varchar(250) DEFAULT NULL,
  `date` varchar(250) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `shelf_no` varchar(250) DEFAULT NULL,
  `department` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1=active;0=deactive',
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `books_list` */

/*Table structure for table `calendar_events` */

DROP TABLE IF EXISTS `calendar_events`;

CREATE TABLE `calendar_events` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT '0',
  `event_id` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL,
  `event_date` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `calendar_events` */

/*Table structure for table `class_books` */

DROP TABLE IF EXISTS `class_books`;

CREATE TABLE `class_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `class_id` varchar(45) DEFAULT NULL,
  `books` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `class_books` */

/*Table structure for table `class_list` */

DROP TABLE IF EXISTS `class_list`;

CREATE TABLE `class_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `teacher_module` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `section` varchar(45) DEFAULT NULL,
  `capacity` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `class_list` */

/*Table structure for table `class_subjects` */

DROP TABLE IF EXISTS `class_subjects`;

CREATE TABLE `class_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `class_id` varchar(45) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Data for the table `class_subjects` */

/*Table structure for table `class_teachers` */

DROP TABLE IF EXISTS `class_teachers`;

CREATE TABLE `class_teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `class_teachers` */

/*Table structure for table `class_times` */

DROP TABLE IF EXISTS `class_times`;

CREATE TABLE `class_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `form_time` varchar(250) DEFAULT NULL,
  `to_time` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `class_times` */

/*Table structure for table `events` */

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT '0',
  `event` varchar(250) DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `events` */

/*Table structure for table `exam_instructions` */

DROP TABLE IF EXISTS `exam_instructions`;

CREATE TABLE `exam_instructions` (
  `e_i_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `instructions` text,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`e_i_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `exam_instructions` */

/*Table structure for table `exam_list` */

DROP TABLE IF EXISTS `exam_list`;

CREATE TABLE `exam_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `exam_type` varchar(250) DEFAULT NULL,
  `class_id` varchar(250) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `student_id` varchar(250) DEFAULT NULL,
  `exam_date` varchar(250) DEFAULT NULL,
  `start_time` varchar(250) DEFAULT NULL,
  `to_time` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `exam_list` */

/*Table structure for table `exam_list_data` */

DROP TABLE IF EXISTS `exam_list_data`;

CREATE TABLE `exam_list_data` (
  `e_l_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  `class_id` int(15) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `exam_date` varchar(250) DEFAULT NULL,
  `start_time` varchar(250) DEFAULT NULL,
  `to_time` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`e_l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `exam_list_data` */

/*Table structure for table `exam_marks_list` */

DROP TABLE IF EXISTS `exam_marks_list`;

CREATE TABLE `exam_marks_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `exam_id` varchar(45) DEFAULT NULL,
  `subject_id` varchar(45) DEFAULT NULL,
  `class_id` varchar(45) DEFAULT NULL,
  `marks_obtained` varchar(45) DEFAULT NULL,
  `max_marks` varchar(45) DEFAULT NULL,
  `remarks` text,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `exam_marks_list` */

/*Table structure for table `exam_syllabus` */

DROP TABLE IF EXISTS `exam_syllabus`;

CREATE TABLE `exam_syllabus` (
  `e_s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `class_id` int(12) DEFAULT NULL,
  `document` varchar(250) DEFAULT NULL,
  `org_document` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`e_s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `exam_syllabus` */

/*Table structure for table `gate_pass` */

DROP TABLE IF EXISTS `gate_pass`;

CREATE TABLE `gate_pass` (
  `g_p_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `date` varchar(250) DEFAULT NULL,
  `gate_pass_number` varchar(250) DEFAULT NULL,
  `student_name` int(12) DEFAULT NULL,
  `class_id` varchar(250) DEFAULT NULL,
  `gate_pass_hours` varchar(250) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`g_p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gate_pass` */

/*Table structure for table `home_work` */

DROP TABLE IF EXISTS `home_work`;

CREATE TABLE `home_work` (
  `h_w_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `class_id` varchar(250) DEFAULT NULL,
  `subjects` varchar(250) DEFAULT NULL,
  `work_date` varchar(250) DEFAULT NULL,
  `work_sub_date` varchar(250) DEFAULT NULL,
  `work` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `upate_at` datetime DEFAULT NULL,
  `create_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`h_w_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `home_work` */

/*Table structure for table `hostel_details` */

DROP TABLE IF EXISTS `hostel_details`;

CREATE TABLE `hostel_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `hostel_name` varchar(250) DEFAULT NULL,
  `hostel_type` varchar(250) DEFAULT NULL,
  `warden_name` varchar(250) DEFAULT NULL,
  `contact_number` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `facilities` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `hostel_details` */

/*Table structure for table `hostel_floors` */

DROP TABLE IF EXISTS `hostel_floors`;

CREATE TABLE `hostel_floors` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `floor_name` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `hostel_floors` */

/*Table structure for table `hostel_rooms` */

DROP TABLE IF EXISTS `hostel_rooms`;

CREATE TABLE `hostel_rooms` (
  `h_r_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `hotel_type` varchar(45) DEFAULT NULL,
  `room_name` varchar(250) DEFAULT NULL,
  `floor_id` int(11) DEFAULT NULL,
  `total_beds` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`h_r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `hostel_rooms` */

/*Table structure for table `hostel_types` */

DROP TABLE IF EXISTS `hostel_types`;

CREATE TABLE `hostel_types` (
  `h_t_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `hostel_type` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`h_t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `hostel_types` */

/*Table structure for table `issued_book` */

DROP TABLE IF EXISTS `issued_book`;

CREATE TABLE `issued_book` (
  `i_b_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `barcode_id` varchar(250) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL COMMENT 'b_id=book id',
  `no_of_books_taken` varchar(250) DEFAULT NULL,
  `issued_date` varchar(250) DEFAULT NULL,
  `return_renew_date` varchar(250) DEFAULT NULL,
  `return_date` varchar(250) DEFAULT NULL,
  `fine_if_any` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`i_b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `issued_book` */

/*Table structure for table `principal_assign_instractions` */

DROP TABLE IF EXISTS `principal_assign_instractions`;

CREATE TABLE `principal_assign_instractions` (
  `p_a_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(12) DEFAULT NULL,
  `teacher_modules` varchar(250) DEFAULT NULL,
  `instractions` varchar(250) DEFAULT NULL,
  `otp` longtext,
  `opt_created_at` datetime DEFAULT NULL,
  `status` int(12) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`p_a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `principal_assign_instractions` */

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `role` */

insert  into `role`(`id`,`name`,`status`,`create_at`) values (1,'Admin',1,'2018-06-18 14:32:40'),(2,'School Admin',1,'2018-06-18 14:33:00'),(3,'Administrator',1,'2018-06-18 14:33:40'),(4,'Fee management ',0,'2018-06-18 14:34:30'),(5,'Transportation',1,'2018-06-18 14:34:28'),(6,'Teacher',1,'2018-06-18 14:34:28'),(7,'Student',1,'2018-06-18 14:34:28'),(8,'Academic Mangement',1,'2018-06-18 14:34:28'),(9,'Examination ',1,'2018-07-09 12:59:06'),(10,'Librarian',1,'2019-11-08 15:41:14'),(11,'Hostel',0,'2019-06-18 15:41:29'),(12,'Principal ',1,'2019-07-29 13:49:05');

/*Table structure for table `route_numbers` */

DROP TABLE IF EXISTS `route_numbers`;

CREATE TABLE `route_numbers` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `route_no` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `route_numbers` */

/*Table structure for table `route_stops` */

DROP TABLE IF EXISTS `route_stops`;

CREATE TABLE `route_stops` (
  `stop_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_id` int(11) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  `stop_name` varchar(250) DEFAULT NULL,
  `s_status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`stop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `route_stops` */

/*Table structure for table `schools` */

DROP TABLE IF EXISTS `schools`;

CREATE TABLE `schools` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `scl_email_id` varchar(250) DEFAULT NULL,
  `scl_con_number` varchar(45) DEFAULT NULL,
  `scl_representative` varchar(250) DEFAULT NULL,
  `scl_rep_contact` varchar(45) DEFAULT NULL,
  `mob_country_code` varchar(25) DEFAULT NULL,
  `scl_rep_mobile` varchar(45) DEFAULT NULL,
  `scl_rep_email` varchar(250) DEFAULT NULL,
  `scl_rep_nationali_id` varchar(45) DEFAULT NULL,
  `scl_rep_add1` varchar(250) DEFAULT NULL,
  `scl_rep_add2` varchar(250) DEFAULT NULL,
  `scl_rep_zipcode` varchar(25) DEFAULT NULL,
  `scl_rep_city` varchar(45) DEFAULT NULL,
  `scl_rep_state` varchar(45) DEFAULT NULL,
  `scl_rep_country` varchar(45) DEFAULT NULL,
  `scl_bas_name` varchar(250) DEFAULT NULL,
  `scl_bas_contact` varchar(45) DEFAULT NULL,
  `scl_bas_email` varchar(250) DEFAULT NULL,
  `scl_bas_nationali_id` varchar(250) DEFAULT NULL,
  `scl_bas_add1` varchar(250) DEFAULT NULL,
  `scl_bas_add2` varchar(250) DEFAULT NULL,
  `scl_bas_zipcode` varchar(25) DEFAULT NULL,
  `scl_bas_city` varchar(25) DEFAULT NULL,
  `scl_bas_state` varchar(25) DEFAULT NULL,
  `scl_bas_country` varchar(25) DEFAULT NULL,
  `scl_bas_document` varchar(250) DEFAULT NULL,
  `scl_bas_logo` varchar(250) DEFAULT NULL,
  `working_month` varchar(250) DEFAULT NULL,
  `bank_holder_name` varchar(250) DEFAULT NULL,
  `bank_acc_no` varchar(25) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `bank_ifsc` varchar(25) DEFAULT NULL,
  `bank_document` varchar(250) DEFAULT NULL,
  `kyc_doc1` varchar(250) DEFAULT NULL,
  `kyc_doc2` varchar(250) DEFAULT NULL,
  `kyc_doc3` varchar(250) DEFAULT NULL,
  `kyc_file1` varchar(250) DEFAULT NULL,
  `kyc_file2` varchar(250) DEFAULT NULL,
  `kyc_file3` varchar(250) DEFAULT NULL,
  `lib_book_due_time` varchar(250) DEFAULT NULL,
  `fine_charge_amt` varchar(250) DEFAULT NULL,
  `completed` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `schools` */

insert  into `schools`(`s_id`,`u_id`,`scl_email_id`,`scl_con_number`,`scl_representative`,`scl_rep_contact`,`mob_country_code`,`scl_rep_mobile`,`scl_rep_email`,`scl_rep_nationali_id`,`scl_rep_add1`,`scl_rep_add2`,`scl_rep_zipcode`,`scl_rep_city`,`scl_rep_state`,`scl_rep_country`,`scl_bas_name`,`scl_bas_contact`,`scl_bas_email`,`scl_bas_nationali_id`,`scl_bas_add1`,`scl_bas_add2`,`scl_bas_zipcode`,`scl_bas_city`,`scl_bas_state`,`scl_bas_country`,`scl_bas_document`,`scl_bas_logo`,`working_month`,`bank_holder_name`,`bank_acc_no`,`bank_name`,`bank_ifsc`,`bank_document`,`kyc_doc1`,`kyc_doc2`,`kyc_doc3`,`kyc_file1`,`kyc_file2`,`kyc_file3`,`lib_book_due_time`,`fine_charge_amt`,`completed`,`status`,`create_at`,`update_at`,`create_by`) values (2,16,'swaranjali@gmail.com','0987456321','swarnajali','12352545555','+91','09874563211','admin11@gmail.com','1233333333','hyderabad','aszfdf','515001','hyd','Andhra Pradesh','india','sdfsdf','0987456321','school@gmail.com','','hyd','aszfdf','515001','hyd','Andhra Pradesh','India',NULL,NULL,'7 Months','sdfsdf','1234566666','vbvvb','SBIN0000844','','vbdf','','','1567069275.xlsx',NULL,NULL,NULL,NULL,1,1,'2019-08-28 18:37:17','2019-08-30 12:03:31',1);

/*Table structure for table `schools_announcements` */

DROP TABLE IF EXISTS `schools_announcements`;

CREATE TABLE `schools_announcements` (
  `int_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) DEFAULT NULL,
  `comment` text,
  `create_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `sent_by` int(11) DEFAULT NULL,
  `readcount` int(11) DEFAULT '0',
  PRIMARY KEY (`int_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `schools_announcements` */

/*Table structure for table `send_student_sms` */

DROP TABLE IF EXISTS `send_student_sms`;

CREATE TABLE `send_student_sms` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_id` int(12) DEFAULT NULL,
  `s_id` int(12) DEFAULT NULL,
  `student_name` varchar(250) DEFAULT NULL,
  `status` int(12) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `send_student_sms` */

/*Table structure for table `sms` */

DROP TABLE IF EXISTS `sms`;

CREATE TABLE `sms` (
  `sms_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(12) DEFAULT NULL,
  `sms` varchar(250) DEFAULT NULL,
  `class_id` varchar(250) DEFAULT NULL,
  `msg` longtext,
  `otp` longtext,
  `opt_created_at` datetime DEFAULT NULL,
  `status` int(12) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`sms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `sms` */

/*Table structure for table `student_attendenc_reports` */

DROP TABLE IF EXISTS `student_attendenc_reports`;

CREATE TABLE `student_attendenc_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` varchar(250) DEFAULT NULL,
  `student_id` varchar(250) DEFAULT NULL,
  `class_id` varchar(250) DEFAULT NULL,
  `subject_id` varchar(250) DEFAULT NULL,
  `time` varchar(250) DEFAULT NULL,
  `attendence` varchar(250) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `student_attendenc_reports` */

/*Table structure for table `student_bus_payment` */

DROP TABLE IF EXISTS `student_bus_payment`;

CREATE TABLE `student_bus_payment` (
  `b_p_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_t_id` int(12) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  `student_id` varchar(250) DEFAULT NULL,
  `class_name` varchar(250) DEFAULT NULL,
  `roll_number` varchar(250) DEFAULT NULL,
  `total_amount` varchar(250) DEFAULT NULL,
  `fee_terms` varchar(250) DEFAULT NULL,
  `pay_amount` varchar(250) DEFAULT NULL,
  `razorpay_payment_id` varchar(250) DEFAULT NULL,
  `razorpay_order_id` varchar(250) DEFAULT NULL,
  `razorpay_signature` varchar(250) DEFAULT NULL,
  `invoice` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`b_p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `student_bus_payment` */

/*Table structure for table `student_fee` */

DROP TABLE IF EXISTS `student_fee`;

CREATE TABLE `student_fee` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  `class_name` varchar(250) DEFAULT NULL,
  `roll_number` varchar(250) DEFAULT NULL,
  `fee_amount` varchar(250) DEFAULT NULL,
  `fee_terms` varchar(250) DEFAULT NULL,
  `pay_amount` varchar(250) DEFAULT NULL,
  `razorpay_payment_id` varchar(250) DEFAULT NULL,
  `razorpay_order_id` varchar(250) DEFAULT NULL,
  `razorpay_signature` varchar(250) DEFAULT NULL,
  `invoice` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` timestamp NULL DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `student_fee` */

/*Table structure for table `student_transport` */

DROP TABLE IF EXISTS `student_transport`;

CREATE TABLE `student_transport` (
  `s_t_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `class_id` varchar(250) DEFAULT NULL,
  `student_id` varchar(250) DEFAULT NULL,
  `route` varchar(250) DEFAULT NULL,
  `stop` varchar(250) DEFAULT NULL,
  `vechical_number` varchar(250) DEFAULT NULL,
  `pickup_point` varchar(250) DEFAULT NULL,
  `distance` varchar(250) DEFAULT NULL,
  `amount` varchar(250) DEFAULT NULL,
  `stop_strat` varchar(250) DEFAULT NULL,
  `stop_end` varchar(250) DEFAULT NULL,
  `total_amount` varchar(250) DEFAULT NULL,
  `pay_amount` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`s_t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `student_transport` */

/*Table structure for table `subject_list` */

DROP TABLE IF EXISTS `subject_list`;

CREATE TABLE `subject_list` (
  `s_l_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`s_l_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `subject_list` */

/*Table structure for table `teacher_module_wise_class` */

DROP TABLE IF EXISTS `teacher_module_wise_class`;

CREATE TABLE `teacher_module_wise_class` (
  `t_m_c_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(12) DEFAULT NULL,
  `modules_name` varchar(250) DEFAULT NULL,
  `class` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`t_m_c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `teacher_module_wise_class` */

/*Table structure for table `teacher_modules` */

DROP TABLE IF EXISTS `teacher_modules`;

CREATE TABLE `teacher_modules` (
  `t_m_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(12) DEFAULT NULL,
  `modules` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`t_m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `teacher_modules` */

/*Table structure for table `teachers` */

DROP TABLE IF EXISTS `teachers`;

CREATE TABLE `teachers` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_a_id` int(12) DEFAULT NULL,
  `s_id` int(12) DEFAULT NULL,
  `teacher_ids` varchar(250) DEFAULT NULL,
  `status` int(12) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `teachers` */

/*Table structure for table `teachers_list` */

DROP TABLE IF EXISTS `teachers_list`;

CREATE TABLE `teachers_list` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(12) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `class_name` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_by` int(12) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `teachers_list` */

/*Table structure for table `time_slot` */

DROP TABLE IF EXISTS `time_slot`;

CREATE TABLE `time_slot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `day` varchar(250) DEFAULT NULL,
  `time` text,
  `teacher_module` varchar(250) DEFAULT NULL,
  `class_id` varchar(250) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `teacher` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `time_slot` */

/*Table structure for table `transport_fee` */

DROP TABLE IF EXISTS `transport_fee`;

CREATE TABLE `transport_fee` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `route_id` varchar(250) DEFAULT NULL,
  `stops` varchar(250) DEFAULT NULL,
  `frequency` varchar(250) DEFAULT NULL,
  `amount` varchar(250) DEFAULT NULL,
  `to_stops` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `transport_fee` */

/*Table structure for table `types` */

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `types` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `types` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(250) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `dob` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `org_password` varchar(250) DEFAULT NULL,
  `mobile` varchar(250) DEFAULT NULL,
  `qalification` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `current_city` varchar(45) DEFAULT NULL,
  `current_state` varchar(45) DEFAULT NULL,
  `current_country` varchar(45) DEFAULT NULL,
  `current_pincode` varchar(15) DEFAULT NULL,
  `per_address` varchar(250) DEFAULT NULL,
  `per_city` varchar(45) DEFAULT NULL,
  `per_state` varchar(45) DEFAULT NULL,
  `per_country` varchar(45) DEFAULT NULL,
  `per_pincode` varchar(15) DEFAULT NULL,
  `blodd_group` varchar(15) DEFAULT NULL,
  `doj` varchar(45) DEFAULT NULL,
  `class_name` varchar(45) DEFAULT NULL,
  `roll_number` varchar(250) DEFAULT NULL,
  `fee_amount` varchar(250) DEFAULT NULL,
  `fee_terms` varchar(250) DEFAULT NULL,
  `pay_amount` varchar(250) DEFAULT NULL,
  `parent_name` varchar(250) DEFAULT NULL,
  `parent_gender` varchar(15) DEFAULT NULL,
  `parent_email` varchar(250) DEFAULT NULL,
  `parent_password` varchar(250) DEFAULT NULL,
  `parent_org_password` varchar(250) DEFAULT NULL,
  `education` varchar(250) DEFAULT NULL,
  `profession` varchar(250) DEFAULT NULL,
  `notes` varchar(250) DEFAULT NULL,
  `bus_transport` varchar(250) DEFAULT NULL,
  `profile_pic` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`u_id`,`role_id`,`s_id`,`name`,`email`,`gender`,`dob`,`password`,`org_password`,`mobile`,`qalification`,`address`,`current_city`,`current_state`,`current_country`,`current_pincode`,`per_address`,`per_city`,`per_state`,`per_country`,`per_pincode`,`blodd_group`,`doj`,`class_name`,`roll_number`,`fee_amount`,`fee_terms`,`pay_amount`,`parent_name`,`parent_gender`,`parent_email`,`parent_password`,`parent_org_password`,`education`,`profession`,`notes`,`bus_transport`,`profile_pic`,`status`,`create_at`,`update_at`,`create_by`) values (1,'1',NULL,'admin','admin@gmail.com',NULL,NULL,'e10adc3949ba59abbe56e057f20f883e','123456',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL),(16,'2',NULL,NULL,'swaranjali@gmail.com',NULL,NULL,'e10adc3949ba59abbe56e057f20f883e','123456','0987456321',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2019-08-28 18:37:17','2019-08-30 12:03:31',1);

/*Table structure for table `vehicle_details` */

DROP TABLE IF EXISTS `vehicle_details`;

CREATE TABLE `vehicle_details` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `route_number` varchar(250) DEFAULT NULL,
  `registration_no` varchar(250) DEFAULT NULL,
  `driver_name` varchar(250) DEFAULT NULL,
  `driver_no` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `vehicle_details` */

/*Table structure for table `vehicle_stops` */

DROP TABLE IF EXISTS `vehicle_stops`;

CREATE TABLE `vehicle_stops` (
  `v_s_id` int(11) NOT NULL AUTO_INCREMENT,
  `v_id` int(11) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  `multiple_stops` varchar(250) DEFAULT NULL,
  `s_status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`v_s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `vehicle_stops` */

/*Table structure for table `visitor_pass` */

DROP TABLE IF EXISTS `visitor_pass`;

CREATE TABLE `visitor_pass` (
  `v_p_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `visitor_type` varchar(250) DEFAULT NULL,
  `visitor_name` varchar(250) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `contact_number` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `visit_time` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(12) DEFAULT NULL,
  PRIMARY KEY (`v_p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `visitor_pass` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
