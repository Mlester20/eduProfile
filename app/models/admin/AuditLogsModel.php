<?php
require_once __DIR__ . '/../Model.php';

    class AuditLogsModel extends Model{
        protected $table = 'audit_logs';

        public function index(){
            try{
                $query = "SELECT audit_logs.*, users.full_name as user_fullName FROM audit_logs JOIN users ON audit_logs.user_id = users.id ORDER BY audit_logs.created_at DESC";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                return $e->getMessage();
            }
        }
        
    }

?>