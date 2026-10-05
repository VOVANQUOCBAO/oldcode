<?php function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); } ?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Có lỗi xảy ra</title><link rel="stylesheet" href="../view/style.css"></head>
<body><main class="container narrow"><section class="card"><h1>Có lỗi xảy ra</h1><div class="alert error"><?= e($message) ?></div><a class="button primary" href="index.php">Về danh sách</a></section></main></body></html>
