<?php
// ประกาศ API Key ของ VirusTotal
$api_key = '9394bc2a6a8c62c9a7368f1d0cb15761629a2e7babb9f1bd5eb853030bc2c1ca';

// ตรวจสอบว่ามีไฟล์อัปโหลดหรือไม่
if(isset($_FILES['file'])) {

  // กำหนด URL สำหรับการเรียกใช้งาน VirusTotal API
  $url = 'https://www.virustotal.com/vtapi/v2/file/scan';
  
  // อ่านข้อมูลไฟล์ที่อัปโหลดมา
  $file = $_FILES['file']['tmp_name'];

  // ส่งไฟล์ไปตรวจสอบกับ VirusTotal API
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'apikey' => $api_key,
    'file' => curl_file_create($file),
  ]);
  $result = curl_exec($ch);

  // ปิดการเชื่อมต่อ
  curl_close($ch);

  // แปลงผลลัพธ์เป็น JSON และแสดงผลลัพธ์
  $result_json = json_decode($result);
  if(!$result_json){
    echo "ติดไวรัส";
  }else{
    move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $_FILES["file"]["name"]);
    echo "ไม่ติดไวรัส";
  }
  echo '<pre>';
  print_r($result_json);
  echo '</pre>';

  // ตรวจสอบว่าไฟล์ติดไวรัสหรือไม่
//  if($result_json->response_code == 1 && $result_json->positives > 0) {
    // ถ้าไฟล์ติดไวรัส ให้ลบไฟล์ออก
    // unlink($file);
 //   echo "ติดไวรััส";
//  }else {
 //   echo "ไม่ติดไวรัส";
 // }
  
}else{
  echo "erorr";
}
?>
