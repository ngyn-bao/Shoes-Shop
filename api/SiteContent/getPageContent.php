<?php
require_once __DIR__ . '/../../models/SiteContent.php';

$page = $_GET['page'] ?? 'home';

echo json_encode(SiteContent::getPage($page));
