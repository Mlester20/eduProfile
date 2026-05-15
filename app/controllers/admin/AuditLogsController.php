<?php
session_start();

require_once __DIR__ . '/../../models/admin/AuditLogsModel.php';
require_once __DIR__ . '/../../../database/config/config.php';

    class AuditLogsController{
        private $model;

        public function __construct($con){
            $this->model = new AuditLogsModel($con);
        }

        public function index(){
            return $this->model->index();
        }
    }

    try {
        $controller = new AuditLogsController($con);
        $logs = $controller->index();

        // Pagination
        $entries_per_page = 10;
        $total_entries = count($logs);
        $total_pages = ceil($total_entries / $entries_per_page);
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $current_page = max(1, min($current_page, $total_pages));

        // Slice logs for current page
        $offset = ($current_page - 1) * $entries_per_page;
        $paginated_logs = array_slice($logs, $offset, $entries_per_page);

    } catch (Exception $e) {
        echo $e->getMessage();
    }