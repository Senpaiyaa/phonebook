<?php
    require_once 'Database.php';

    class Contacts extends Database {
        
        protected static $table = "contact";

        public function get_all_contacts() {
            $query = "  SELECT * 
                        FROM " .static::$table. " WHERE is_deleted = FALSE";
            return parent::select($query);
        }

        public function insert_contacts($firstName, $lastName, $email, $contact_number, $path, $address, $notes) {
			$query = "INSERT INTO ".static::$table. " (`first_name`, `last_name`, `email`, `contact_number`, `path` , `address`, `notes_id`) VALUES ('$firstName', '$lastName', '$email', '$contact_number', '$path', '$address', '$notes')";
			return parent::query($query);
		}

		public function update_contacts($contact_id, $firstName, $lastName, $email, $contact_number, $notes, $address) {
			$query = "UPDATE ".static::$table. " SET `first_name`='$firstName',`last_name`='$lastName',`email`='$email',`contact_number`='$contact_number',`notes_id`='$notes',`address`='$address' WHERE contact_id = '$contact_id'";
			return parent::query($query);
        }
        
        public function view_contact($contact_id) {
            $query = "  SELECT *
                        FROM " .static::$table. " WHERE contact_id = '$contact_id'";
            $result = parent::select($query);
            if (count($result) === 0) { 
                return NULL; 
            } return $result[0];
        }

        public function remove_contact($id) {
            $query = "UPDATE ".static::$table." SET is_deleted = TRUE WHERE contact_id = '$id'";
            return parent::query($query);
        }

        public function restore_contact($id) {
            $query = "UPDATE ".static::$table." SET is_deleted = FALSE WHERE contact_id = '$id'";
            return parent::query($query);
        }

		public function get_deleted_accounts() {
			$query = "SELECT * FROM ".static::$table. " WHERE is_deleted = TRUE";
			return parent::select($query);
		}

		public function create_activity($activity) {
			date_default_timezone_set("Asia/Kuala_Lumpur");
			$date_logged = date('Y-m-d H:i:s');
			$query = "INSERT INTO `activity_log`(`user_activity`, `date_logged`) VALUES ('$activity', '$date_logged')";
			return parent::query($query);
		}

		public function get_logs() {
			$query = "SELECT * FROM `activity_log`";
			return parent::select($query);
		}
    }
?>