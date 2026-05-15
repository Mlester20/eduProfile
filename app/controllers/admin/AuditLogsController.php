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