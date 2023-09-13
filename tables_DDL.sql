-- testdb.tbl_class definition

CREATE TABLE `tbl_class` (
  `class_id` varchar(100) NOT NULL,
  `max_students` int(11) DEFAULT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- testdb.tbl_role definition

CREATE TABLE `tbl_role` (
  `role_name` varchar(50) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `role_id` varchar(100) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- testdb.tbl_subject definition

CREATE TABLE `tbl_subject` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- testdb.tbl_student definition

CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `registration_number` varchar(100) NOT NULL,
  `class_id` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_student_UN` (`registration_number`,`class_id`),
  KEY `tbl_student_FK` (`class_id`),
  CONSTRAINT `tbl_student_FK` FOREIGN KEY (`class_id`) REFERENCES `tbl_class` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- testdb.tbl_student_subject definition

CREATE TABLE `tbl_student_subject` (
  `student_id` varchar(100) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  KEY `tbl_student_subject_FK` (`student_id`),
  KEY `tbl_student_subject_FK_1` (`subject_id`),
  CONSTRAINT `tbl_student_subject_FK_1` FOREIGN KEY (`subject_id`) REFERENCES `tbl_subject` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- testdb.tbl_teacher definition

CREATE TABLE `tbl_teacher` (
  `teacher_id` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `user_role` varchar(100) DEFAULT NULL,
  `registration_number` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`teacher_id`),
  KEY `tbl_teacher_FK` (`user_role`),
  CONSTRAINT `tbl_teacher_FK` FOREIGN KEY (`user_role`) REFERENCES `tbl_role` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- testdb.tbl_teacher_subject definition

CREATE TABLE `tbl_teacher_subject` (
  `teacher_id` varchar(100) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  KEY `tbl_teacher_subject_FK` (`teacher_id`),
  KEY `tbl_teacher_subject_FK_1` (`subject_id`),
  CONSTRAINT `tbl_teacher_subject_FK` FOREIGN KEY (`teacher_id`) REFERENCES `tbl_teacher` (`teacher_id`),
  CONSTRAINT `tbl_teacher_subject_FK_1` FOREIGN KEY (`subject_id`) REFERENCES `tbl_subject` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- testdb.tbl_class_teacher definition

CREATE TABLE `tbl_class_teacher` (
  `class_id` varchar(10) DEFAULT NULL,
  `teacher_id` varchar(100) NOT NULL,
  `is_class_teacher` tinyint(1) DEFAULT NULL,
  UNIQUE KEY `tbl_class_teacher_UN` (`class_id`,`teacher_id`,`is_class_teacher`),
  KEY `tbl_class_teacher_FK_1` (`teacher_id`),
  CONSTRAINT `tbl_class_teacher_FK` FOREIGN KEY (`class_id`) REFERENCES `tbl_class` (`class_id`),
  CONSTRAINT `tbl_class_teacher_FK_1` FOREIGN KEY (`teacher_id`) REFERENCES `tbl_teacher` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- testdb.tbl_class_subject definition

CREATE TABLE `tbl_class_subject` (
  `class_id` varchar(100) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `teach_by` varchar(100) NOT NULL,
  UNIQUE KEY `tbl_class_subject_UN` (`class_id`,`subject_id`,`teach_by`),
  KEY `tbl_class_subject_FK_1` (`subject_id`),
  KEY `tbl_class_subject_FK` (`class_id`),
  KEY `tbl_class_subject_FK_2` (`teach_by`),
  CONSTRAINT `tbl_class_subject_FK` FOREIGN KEY (`class_id`) REFERENCES `tbl_class` (`class_id`),
  CONSTRAINT `tbl_class_subject_FK_1` FOREIGN KEY (`subject_id`) REFERENCES `tbl_subject` (`id`),
  CONSTRAINT `tbl_class_subject_FK_2` FOREIGN KEY (`teach_by`) REFERENCES `tbl_teacher` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- testdb.tbl_marks definition

CREATE TABLE `tbl_marks` (
  `subject_id` varchar(100) NOT NULL,
  `student_id` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `marks` float DEFAULT NULL,
  KEY `tbl_marks_FK_1` (`subject_id`),
  KEY `tbl_marks_FK` (`student_id`),
  CONSTRAINT `tbl_marks_FK` FOREIGN KEY (`student_id`) REFERENCES `tbl_student` (`id`),
  CONSTRAINT `tbl_marks_FK_1` FOREIGN KEY (`subject_id`) REFERENCES `tbl_subject` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
