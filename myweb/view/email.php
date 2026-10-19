<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/menu.php'; ?>
<main class="container">
    <div class="header">
        <div>
            <p class="eyebrow">EMAIL</p>
            <h1>Gửi email</h1>
            <p class="subtitle">Dùng PHPMailer để gửi thư trực tiếp từ website.</p>
        </div>
    </div>

    <?php if (!empty($success)): ?>
        <div class="alert"><?= e((string) $success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert error"><?= e((string) $error) ?></div>
    <?php endif; ?>

    <section class="card form-card">
        <h2>Form gửi mail</h2>
        <form method="post" action="index.php?act=gui_email">
            <label for="name">Tên người nhận</label>
            <input id="name" name="name" type="text" placeholder="Ví dụ: Nguyễn Văn A">

            <label for="to">Email nhận</label>
            <input id="to" name="to" type="email" placeholder="example@gmail.com" required>

            <label for="subject">Tiêu đề</label>
            <input id="subject" name="subject" type="text" value="Thông báo từ MyWeb" required>

            <label for="content">Nội dung</label>
            <textarea id="content" name="content" rows="8" placeholder="Nhập nội dung email..." required></textarea>

            <button class="button primary" type="submit">Gửi email</button>
        </form>
    </section>
</main>
</body>
</html>
