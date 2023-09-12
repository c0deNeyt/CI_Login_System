<?php
	class Employee extends CI_Model{
		#this will insert a new employee to the database
		public function addEmp($data){
			$this->db->trans_start();
			// Query
			$people = array('first_name' => "Christian",
			'last_name' => "Arana",
			'age' => "25",
			'birth_date' => "1998-06-12",
			'email' => "chan@email.com",
			'password' => "test",
			'job_tittle' => "IT Specialist",
			'date_modified' => date('Y-m-d H:i:s'),
			'date_created' => date('Y-m-d H:i:s'));

			$this->db->insert('employees', $people);
			$last_insert_id = $this->db->insert_id();
			// Query
			$access = array('description' => "Admin",
			'employees_employee_id' => $last_insert_id, 
			'access_level' => 1, 
			'date_modified' => date('Y-m-d H:i:s'),
			'date_created' => date('Y-m-d H:i:s'));

			$this->db->insert('access_levels', $access);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE){
			   return "SOMETHING WENT WRONG";
			}else { return "TRANSACTION SUCCESSFULL"; }
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
