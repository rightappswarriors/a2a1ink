<?php
date_default_timezone_set('Asia/Manila');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'] ?? 'NONE';
    echo 'JUAN DE LA CRUZ|'.date("m/d/Y").'|'.date('h:i:a');
} else {
    echo "POST ONLY";
}