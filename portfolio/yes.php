<?php
// Alias: redirect yes.php → skills.php
require_once __DIR__ . '/auth_check.php';
header('Location: skills.php');
exit;
