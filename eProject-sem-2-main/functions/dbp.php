<?php 
$servername = "localhost"; // Địa chỉ máy chủ
$username = "root";        // Tên đăng nhập của MySQL
$password = "root";            // Mật khẩu của MySQL
$dbname = "bronx luggage"; // Tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// connect file app_setting.json den
function connect(){
    $config = file_get_contents("app_settingp.json");// string
    $config = json_decode($config);
    $host = $config->host;
    $user = $config->user;
    $pass = $config->password;
    $db = $config->database;
    $conn = new mysqli($host,$user,$pass,$db);
    if($conn->error){
        die("Connect refused!");
    }
    return $conn;
}
// lenh query
function select($sql){
    $conn = connect();
    $result = $conn->query($sql);
    //convert data to array
    $data = [];
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
    return $data;
}
function findById($sql) {
    $data = select($sql); // [] : 1 hoặc 0 element
    if(count($data)>0){
        return $data[0];
    }
    return null;
}
function insert($sql){
    $conn = connect();
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        return $last_id;
    }
    return null;
}

function update($sql) {
    $conn = connect();
    $conn->query($sql);
}


