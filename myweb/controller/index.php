<?php
session_start();
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
