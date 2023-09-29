<?php
	class Employee extends CI_Model{
		#this will insert a new employee to the database
		public function addEmp($data){
			$this->db->trans_start();
			// Query
			$tableOne = array('first_name' => $data['fname'],
			'last_name' => $data['lname'],
			'age' => $data['age'],
			'birth_date' => $data['birthdate'],
			'email' => $data['email'],
			'password' => $data['pw'],
			'job_tittle' => $data['jobtitle'],
			'date_modified' => date('Y-m-d H:i:s'),
			'date_created' => date('Y-m-d H:i:s'));

			$this->db->insert('employees', $tableOne);
			$last_insert_id = $this->db->insert_id();
			// Query
			$tableTwo = array('description' => "User",
			'employees_employee_id' => $last_insert_id, 
			'access_level' => 0, 
			'date_modified' => date('Y-m-d H:i:s'),
			'date_created' => date('Y-m-d H:i:s'));

			$this->db->insert('access_levels', $tableTwo);
			$this->db->trans_complete();
			# Validate if the Query sucessfuly commited
			if ($this->db->trans_status() == FALSE){
				# Something went wrong	
				return 1;
			}else { 
				# Transaction sucessfuly commited!
				return 0;
			}
			$this->db->trans_off();
		}
		# method to fetch user credentials from the database
		# PENDING ENCRYPTION =============================
        public function empCreds($email){
			$query ="SELECT `employees`.`email` AS email,
						`employees`.`password` AS password,
						`access_levels`.`access_level`
					FROM    `employees`
					LEFT JOIN `access_levels`
					ON `employees`.`employee_id` = `access_levels`.`employees_employee_id`
					WHERE   `employees`.`email` = '{$email['email']}'";
            return $this->db->query($query)->result_array();
        }
        # will find contacts bases base on the contacts id
        public function empList(){
            $query = "SELECT `access_levels`.`description` AS Role,
						CONCAT(`first_name`, ' ', `last_name`) AS 'Name',
						`access_levels`.`access_level`
                FROM `employees` 
                INNER JOIN `access_levels` 
			ON `employees`.`employee_id` = `access_levels`.`employees_employee_id`;";
            $result = $this->db->query($query)->result_array();
            return $result;
        }
    }
