<?php
declare(strict_types=1);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);
if (session_status() !== PHP_SESSION_ACTIVE) {
    $sessionDirectory = dirname(__DIR__) . '/storage/sessions';
    if (!is_dir($sessionDirectory)) @mkdir($sessionDirectory, 0700, true);
    if (is_dir($sessionDirectory) && is_writable($sessionDirectory)) session_save_path($sessionDirectory);
    session_set_cookie_params(['httponly'=>true, 'secure'=>isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off', 'samesite'=>'Lax']);
    session_start();
}
date_default_timezone_set('Asia/Colombo');
$config = require dirname(__DIR__) . '/config.php';
function db(): PDO {
    static $pdo = null;
    global $config;
    if ($pdo instanceof PDO) return $pdo;
    $pdo = new PDO('mysql:host='.$config['db_host'].';dbname='.$config['db_name'].';charset=utf8mb4', $config['db_user'], $config['db_pass'], [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES=>false]);
    return $pdo;
}
function e(?string $value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function url(string $path=''): string { global $config; $base=trim((string)$config['site_url']); if($base===''){ $scheme=(!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off')?'https':'http'; $host=$_SERVER['HTTP_HOST']??'localhost'; $script=str_replace('\\','/',$_SERVER['SCRIPT_NAME']??'/index.php'); $folder=trim(str_replace('\\','/',dirname($script)),'/'); if($folder==='.')$folder=''; $base=$scheme.'://'.$host.($folder!==''?'/'.$folder:''); } return rtrim($base, '/') . '/' . ltrim($path, '/'); }
function setting(string $key, string $default=''): string {
    try { $stmt=db()->prepare('SELECT setting_value FROM settings WHERE setting_key=?'); $stmt->execute([$key]); return (string)($stmt->fetchColumn() ?: $default); }
    catch (Throwable $exception) { return $default; }
}
function csrf(): string { if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function verify_csrf(): void { if(!hash_equals(csrf(), (string)($_POST['csrf'] ?? ''))) { http_response_code(419); exit('Your session expired. Please go back and try again.'); } }
function flash(string $message, string $kind='success'): void { $_SESSION['flash']=['message'=>$message,'kind'=>$kind]; }
function go(string $path): never { header('Location: '.url($path)); exit; }
function admin_required(): void { if(empty($_SESSION['admin_id'])) go('control-room/login'); }
function excerpt(string $text, int $length=150): string { $plain=trim(strip_tags($text)); return mb_strlen($plain)>$length ? mb_substr($plain,0,$length).'…' : $plain; }
