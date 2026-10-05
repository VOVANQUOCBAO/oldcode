<?php
include __DIR__ . '/../model/xl_data.php';

class danhmuc
{
    private $id_dm = 0;
    private $Name = '';

    public function setId($id_dm): int
    {
        return $this->id_dm = (int) $id_dm;
    }

    public function getId(): int
    {
        return $this->id_dm;
    }

    public function setName($Name): string
    {
        return $this->Name = trim((string) $Name);
    }

    public function getName(): string
    {
        return $this->Name;
    }

    public function getDS_Danhmuc(): array
    {
        return (new xl_data())->readitem('SELECT * FROM `danhmuc` ORDER BY id DESC');
    }

    public function themDM(danhmuc $dm): void
    {
        if ($dm->getName() === '') {
            throw new InvalidArgumentException('Tên danh mục không được để trống.');
        }
        (new xl_data())->execute_item(
            'INSERT INTO `danhmuc` (`name`) VALUES (:name)',
            ['name' => $dm->getName()]
        );
    }

    public function xoadm(danhmuc $dm): void
    {
        (new xl_data())->execute_item(
            'DELETE FROM `danhmuc` WHERE `id` = :id',
            ['id' => $dm->getId()]
        );
    }
}
