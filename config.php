
<?php
declare(strict_types=1);
session_start();

// Database configuration
$dbHost = getenv('DB_HOST') ?: 'localhost';
$dbName = getenv('DB_NAME') ?: 'office_management_db';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO(
        "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    error_log($e->getMessage());
    die('Database connection failed. Please contact the administrator.');
}

function h($v): string {
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

function go($p='dashboard.php') {
    header("Location: $p");
    exit;
}

function require_login() {
    if (empty($_SESSION['admin_id'])) go('login.php');
}

function flash($m, $type='ok') {
    $_SESSION['flash']=['m'=>$m,'t'=>$type];
}

function show_flash() {
    if (!empty($_SESSION['flash'])) {
        $f=$_SESSION['flash'];
        echo '<div class="alert '.($f['t']==='error'?'error':'').'">'.h($f['m']).'</div>';
        unset($_SESSION['flash']);
    }
}

function csrf() {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf']=bin2hex(random_bytes(24));
    }
    return $_SESSION['csrf'];
}

function check_csrf() {
    if (!hash_equals($_SESSION['csrf']??'', $_POST['csrf']??'')) {
        http_response_code(403);
        exit('Invalid request token. Please go back and try again.');
    }
}

function count_rows($pdo, $table) {
    $allowed=['employees','departments','attendance','tasks','salaries'];
    if (!in_array($table,$allowed,true)) return 0;
    return (int)$pdo->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
}
