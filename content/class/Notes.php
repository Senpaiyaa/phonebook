<?php
    require_once 'Database.php';

    class Notes extends Database {
        
        protected static $table = "notes";

        public function get_all_notes() {
            $query = "  SELECT * 
                        FROM " .static::$table;
            return parent::select($query);
        }

        public function insert_notes($contact_notes) {
			$query = "INSERT INTO ".static::$table. " (`contact_notes`) VALUES ('$contact_notes')";
			return parent::query($query);
        }
        
		public function option_notes() {
			$query = "
				SELECT *
				FROM `notes`";
			return parent::select($query);
        }
        
		public function get_notes($notes_id) {
			$query = "SELECT * FROM ".static::$table." WHERE notes_id = '$notes_id'";
			$result = parent::select($query);
			if (count($result)===0) {
				return NULL;
			}
			return $result[0]; 
			// return parent::select($query);
		}

    }
?>