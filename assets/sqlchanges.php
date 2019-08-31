
10/7/2018
adding for create exam

	CREATE TABLE `exam_list` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `s_id` int(11) DEFAULT NULL,
	  `exam_type` varchar(250) DEFAULT NULL,
	  `class_id` varchar(45) DEFAULT NULL,
	  `subject` varchar(45) DEFAULT NULL,
	  `exam_date` varchar(250) DEFAULT NULL,
	  `start_time` varchar(250) DEFAULT NULL,
	  `to_time` varchar(250) DEFAULT NULL,
	  `room_no` varchar(45) DEFAULT NULL,
	  `teacher_id` varchar(45) DEFAULT NULL,
	  `status` int(11) DEFAULT NULL,
	  `create_at` datetime DEFAULT NULL,
	  `create_by` int(11) DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1

	ALTER TABLE `education`.`exam_list`   
  ADD COLUMN `update_at` DATETIME NULL AFTER `create_at`;

  
  
  11/7/2018
  
 for  syudent  marks  list  purpose 


CREATE TABLE `exam_marks_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1

-----

ALTER TABLE `education`.`student_fee`   
  ADD COLUMN `school_id` INT(11) NULL AFTER `p_id`;
  
  
  
  17/7/2018
  
 for  schools_announcements`  list  purpose 

  
CREATE TABLE `schools_announcements` (
  `int_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) DEFAULT NULL,
  `comment` text,
  `create_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `sent_by` int(11) DEFAULT NULL,
  `readcount` int(11) DEFAULT '0',
  PRIMARY KEY (`int_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1

    

 20/7/2018
for  announcements`  list  purpose 

CREATE TABLE `announcements` (
  `int_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `comment` text,
  `create_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `sent_by` int(11) DEFAULT NULL,
  `readcount` int(11) DEFAULT '0',
  PRIMARY KEY (`int_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1




/* librarian purpose */




CREATE TABLE `books_list` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL COMMENT 's_id=school id',
  `book_name` varchar(250) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1




CREATE TABLE `issued_book` (
  `i_b_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL COMMENT 'b_id=book id',
  `book_name` varchar(250) DEFAULT NULL,
  `no_of_books_taken` varchar(250) DEFAULT NULL,
  `issued_date` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`i_b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1


ALTER TABLE `education`.`books_list`   
  CHANGE `book_name` `book_number` VARCHAR(250) CHARSET latin1 COLLATE latin1_swedish_ci NULL;

  
  ALTER TABLE `education`.`schools`   
  ADD COLUMN `lib_book_due_time` VARCHAR(250) NULL AFTER `kyc_file3`;

  
  ALTER TABLE `education`.`issued_book`   
  ADD COLUMN `fine_if_any` VARCHAR(250) NULL AFTER `issued_date`;

  
  ALTER TABLE `education`.`issued_book`   
  ADD COLUMN `update_at` DATETIME NULL AFTER `create_by`;
  
ALTER TABLE `education`.`issued_book`   
  ADD COLUMN `return_renew_date` VARCHAR(250) NULL AFTER `issued_date`;

  
  
  /* book fine  purpose*/
  
CREATE TABLE `book_fine_list` (
  `b_f_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `fine_if_any` bigint(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`b_f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1


ALTER TABLE `education`.`book_fine_list`   
  ADD COLUMN `update_at` DATETIME NULL AFTER `create_by`;

  date 04-08-2018
  
  
Create Table


Create Table

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1



Create Table
/* route_numbers */
CREATE TABLE `route_numbers` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `route_no` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` datetime DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1


/* route_stops */
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1

/* vechil_details*/

CREATE TABLE `vehicle_details` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `route_number` varchar(250) DEFAULT NULL,
  `multiple_stops` varchar(250) DEFAULT NULL,
  `registration_no` varchar(250) DEFAULT NULL,
  `driver_name` varchar(250) DEFAULT NULL,
  `driver_no` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1

/* vehicle_stops */
Create Table

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1


/*  transport_fee  table   */
CREATE TABLE `transport_fee` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `route_id` varchar(250) DEFAULT NULL,
  `stops` varchar(250) DEFAULT NULL,
  `frequency` varchar(250) DEFAULT NULL,
  `amount` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

/* student_ transport */
CREATE TABLE `student_ transport` (
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
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`s_t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

  
  /* roles */ date-24/
  
Create Table

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1

  
  
Create Table

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1

  
  
  
Create Table

CREATE TABLE `room_details` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `room_name` varchar(250) DEFAULT NULL,
  `floor` varchar(250) DEFAULT NULL,
  `total_beds` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1

  
  /* hostel floors*/  created  By vasu
  
  
CREATE TABLE `hostel_floors` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `floor_name` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

  
  
  
CREATE TABLE `hostel_types` (
  `h_t_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `hostel_type` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `create_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`h_t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

 
 
Create Table/* siva */

CREATE TABLE `hostel_types` (
  `h_t_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `hostel_type` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`h_t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1

 
 
 
 
CREATE TABLE `hostel_rooms` (
  `h_r_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `hotel_type` int(45) DEFAULT NULL,
  `room_name` varchar(250) DEFAULT NULL,
  `floor_id` int(11) DEFAULT NULL,
  `total_beds` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`h_r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
 
 

ALTER TABLE `education`.`hostel_rooms`   
  ADD COLUMN `status` INT(11) DEFAULT 1  NULL AFTER `total_beds`;
  
  ALTER TABLE `education`.`hostel_rooms`   
  CHANGE `updated_by` `updated_at` DATETIME NULL;

  
  
  
CREATE TABLE `allocateroom` (
  `a_r_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL,
  `registration_type` varchar(250) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1

 