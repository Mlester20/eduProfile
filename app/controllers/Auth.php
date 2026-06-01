<?php
session_start();

require_once __DIR__ . '/../../app/models/AuthModel.php';
require_once __DIR__ . '/../../database/config/config.php';
require_once __DIR__ . '/../../app/helpers/auditLogs.php';
require_once __DIR__ . '/../../app/helpers/message.php';
require_once __DIR__ . '/../../app/models/Model.php';

class AuthController extends Model{
    private AuthModel $authModel;
    private AuditLogs $logger;

    public function __construct()
    {
        global $con; 

        parent::__construct($con);

        $this->authModel = new AuthModel($this->con);
        $this->logger    = new AuditLogs($this->con);
    }

    public function handle(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->login();
        }
    }

    private function login(): void
    {
        $email    = $_POST['email']    ?? '';
        $password = $_POST['password'] ?? '';

        $row = $this->authModel->getUserByEmail($email);

        if ($row && $this->authModel->verifyPassword($password, $row['password'])) {
            $this->startUserSession($row);

            $this->logger->log(
                $row['id'],
                $row['role'],
                'LOGIN',
                'AUTH',
                null,
                null,
                $row['full_name'] . ' logged in',
                'success'
            );

            $this->redirectByRole($row['role']);
        } else {
            $this->logger->log(
                null,
                'user',
                'LOGIN',
                'AUTH',
                null,
                null,
                'Failed login attempt: ' . $email,
                'failed'
            );

            setFlash('error', 'Invalid email or password');
            header('Location: ../../../index.php');
            exit();
        }
    }

    private function startUserSession(array $row): void
    {
        $_SESSION['id']              = $row['id'];
        $_SESSION['full_name']       = $row['full_name'];
        $_SESSION['email']           = $row['email'];
        $_SESSION['role']            = $row['role'];
        $_SESSION['profile_picture'] = $row['profile_picture'];
    }

    private function redirectByRole(string $role): void
    {
        $routes = [
            'admin'          => '../../resources/views/admin/dashboard.php',
            'administrative' => '../../resources/views/administrative/home.php',
            'registrar'      => '../../resources/views/registrar/home.php',
            'teacher'        => '../../resources/views/teacher/home.php',
        ];

        $location = $routes[$role] ?? '../../../index.php';

        header('Location: ' . $location);
        exit();
    }
}

// ------------------------------------------------------------------ //
//  Bootstrap                                                          //
// ------------------------------------------------------------------ //
(new AuthController())->handle();