<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$post_data = [
  'store_id' => 'strea6886921f293b8',
  'store_passwd' => 'strea6886921f293b8@ssl',
  'total_amount' => $data['amount'],
  'currency' => $data['currency'],
  'tran_id' => uniqid('INV_'),
  'success_url' => 'https://streamflex.xyz/success.php',
  'fail_url' => 'https://streamflex.xyz/fail.php',
  'cancel_url' => 'https://streamflex.xyz/cancel.php',
  'cus_name' => $data['cus_name'],
  'cus_email' => $data['cus_email'],
  'cus_add1' => $data['cus_add1'],
  'cus_phone' => $data['cus_phone']
];

$ch = curl_init('https://sandbox.sslcommerz.com/gwprocess/v3/api.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
