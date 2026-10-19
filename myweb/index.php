<?php
$query = $_SERVER['QUERY_STRING'] ?? '';
header('Location: controller/index.php' . ($query !== '' ? '?' . $query : ''));
exit;
