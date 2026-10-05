<?php
include __DIR__ . '/danhmuc.php';

class controller
{
    public function hienthiDM(): array
    {
        return (new danhmuc())->getDS_Danhmuc();
    }

    public function themDM(danhmuc $dm): void
    {
        $dm->themDM($dm);
    }

    public function xoadm(danhmuc $dm): void
    {
        $dm->xoadm($dm);
    }
}
