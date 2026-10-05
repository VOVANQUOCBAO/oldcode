<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/menu.php'; ?>
<main class="container">
    <div class="header">
        <div><p class="eyebrow">NỘI DUNG</p><h1>Danh mục</h1><p class="subtitle">Tổ chức và quản lý các nhóm nội dung.</p></div>
        <a class="button primary" href="index.php?act=themDM"><span>＋</span> Thêm danh mục</a>
    </div>
    <form class="search" method="get" action="index.php">
        <input type="hidden" name="act" value="timdm">
        <input name="keyword" placeholder="Tìm danh mục..." value="<?= e((string) ($_GET['keyword'] ?? $_POST['keyword'] ?? '')) ?>">
        <button class="button" type="submit">Tìm kiếm</button>
    </form>
    <?php if (($_GET['act'] ?? '') === 'themDM'): ?>
        <section class="card form-card">
            <h2>Thêm danh mục</h2>
            <form method="post" action="index.php?act=xl_themDM">
                <label for="name">Ten danh muc</label>
                <input id="name" name="name" required maxlength="150">
                <button class="button primary" type="submit">save</button>
            </form>
        </section>
    <?php endif; ?>
    <section class="card">
        <?php if (empty($danhmuc)): ?>
            <p class="empty">Chưa có danh mục nào.</p>
        <?php else: ?>
            <table>
                <thead><tr><th>ID</th><th>Tên danh mục</th><th>Thao tác</th></tr></thead>
                <tbody>
                <?php foreach ($danhmuc as $dm): ?>
                    <tr>
                        <td><?= e((string) $dm['id']) ?></td>
                        <td><?= e((string) $dm['name']) ?></td>
                        <td><a class="danger" href="index.php?act=xoadm&id_dm=<?= e((string) $dm['id']) ?>" onclick="return confirm('Xóa danh mục này?')">Xóa</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
