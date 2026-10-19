<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__DIR__, 2) . '/PHPMailer/src/Exception.php';
require_once dirname(__DIR__, 2) . '/PHPMailer/src/PHPMailer.php';
require_once dirname(__DIR__, 2) . '/PHPMailer/src/SMTP.php';

include __DIR__ . '/controller.php';

$act = $_REQUEST['act'] ?? 'trangchu';

try {
    switch ($act) {
        case 'danhmuc':
            $controller = new controller();
            $danhmuc = $controller->hienthiDM();
            include __DIR__ . '/../view/danhmuc.php';
            break;

        case 'xl_themDM':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new RuntimeException('fail.');
            }
            $dm = new danhmuc();
            $dm->setName($_POST['name'] ?? '');
            (new controller())->themDM($dm);
            header('Location: index.php?act=danhmuc');
            exit;

        case 'themDM':
            $danhmuc = (new controller())->hienthiDM();
            include __DIR__ . '/../view/danhmuc.php';
            break;

        case 'xoadm':
            $id_dm = filter_input(INPUT_GET, 'id_dm', FILTER_VALIDATE_INT);
            if (!$id_dm) {
                throw new RuntimeException('fail.');
            }
            $dm = new danhmuc();
            $dm->setId($id_dm);
            (new controller())->xoadm($dm);
            header('Location: index.php?act=danhmuc');
            exit;

        case 'timdm':
            $keyword = trim((string) ($_POST['keyword'] ?? $_GET['keyword'] ?? ''));
            $danhmuc = (new xl_data())->readitem(
                'SELECT * FROM `danhmuc` WHERE `name` LIKE :keyword ORDER BY id DESC',
                ['keyword' => '%' . $keyword . '%']
            );
            include __DIR__ . '/../view/danhmuc.php';
            break;

        case 'email':
            include __DIR__ . '/../view/email.php';
            break;

        case 'gui_email':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new RuntimeException('Không thể gửi email bằng phương thức này.');
            }

            $to = trim((string) ($_POST['to'] ?? ''));
            $name = trim((string) ($_POST['name'] ?? 'Khách hàng'));
            $subject = trim((string) ($_POST['subject'] ?? 'Thông báo từ MyWeb'));
            $message = trim((string) ($_POST['content'] ?? ''));

            if ($to === '' || $message === '') {
                throw new RuntimeException('Vui lòng nhập email người nhận và nội dung email.');
            }

            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your_email@gmail.com';
            $mail->Password = 'your_app_password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('your_email@gmail.com', 'MyWeb Admin');
            $mail->addAddress($to, $name);
            $mail->isHTML(true);
            $mail->Subject = $subject === '' ? 'Thông báo từ MyWeb' : $subject;
            $mail->Body = nl2br($message);
            $mail->AltBody = strip_tags($message);

            $mail->send();
            $success = 'Gửi email thành công!';
            include __DIR__ . '/../view/email.php';
            break;

        case 'trangchu':
        default:
            include __DIR__ . '/../view/header.php';
            include __DIR__ . '/../view/menu.php';
            include __DIR__ . '/../view/trangchu.php';
            break;
    }
} catch (Throwable $exception) {
    http_response_code(400);
    $error = $exception->getMessage();
    include __DIR__ . '/../view/header.php';
    include __DIR__ . '/../view/menu.php';
    include __DIR__ . '/../view/jax.php';
}
