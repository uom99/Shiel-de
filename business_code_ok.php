<!-- <?php 
// $_api_url2 = 'https://api.odcloud.kr/api/nts-businessman/v1/validate?serviceKey=eNBva%2Bfz8Wkxtg6SR6fLq4MaVn1YniMn2ht%2FeJlpZYDDCKzkYxEDc0ToG8aPlA5aRMWHoG3btu5D1U0UXXvMpw%3D%3D';
// $_param['b_no'] = $_POST['business_code'];
// $_param['start_dt'] = "20080101"; //개업일
// $_param['p_nm'] = "대표자명";
// $_param['p_nm2'] = "";
// $_param['b_nm'] = "회사명";
// $_param['b_sector'] = "";
// $_param['b_type'] = "";

// $_param2['businesses'][]= $_param;

// $data_string = json_encode($_param2);

// $_curl = curl_init();
// curl_setopt($_curl, CURLOPT_URL, $_api_url);
// curl_setopt($_curl, CURLOPT_POST, true);
// curl_setopt($_curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
// curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($_curl, CURLOPT_POSTFIELDS, $data_string);
// $_result = curl_exec($_curl);
// curl_close($_curl);

// $_result = json_decode($_result, true);

// print_r($_result)
?> -->
<?php 
$_api_url = 'https://api.odcloud.kr/api/nts-businessman/v1/status?serviceKey=eNBva%2Bfz8Wkxtg6SR6fLq4MaVn1YniMn2ht%2FeJlpZYDDCKzkYxEDc0ToG8aPlA5aRMWHoG3btu5D1U0UXXvMpw%3D%3D';

$_param['b_no'][] = $_POST['bcode'];
$data_string = json_encode($_param);


$_curl = curl_init();
curl_setopt($_curl, CURLOPT_URL, $_api_url);
curl_setopt($_curl, CURLOPT_POST, true);
curl_setopt($_curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($_curl, CURLOPT_POSTFIELDS, $data_string);
$_result = curl_exec($_curl);
curl_close($_curl);

$_result = json_decode($_result, true);

print_r($_result);
​
?>