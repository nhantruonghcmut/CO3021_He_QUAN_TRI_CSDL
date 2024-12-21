<?php
require_once './../../vendor/autoload.php';

class MongoConnection {
    private $client;
    private $db;

    public function __construct() {
        $uri = "mongodb://hoanguyenlexuan:2bwnC0SF9C0Ut5Hm@cluster0.216ds.mongodb.net";

        try {
            // Tạo kết nối
            $this->client = new MongoDB\Client($uri);

            // Chọn cơ sở dữ liệu (thay "sportshop" bằng tên cơ sở dữ liệu của bạn)
            $this->db = $this->client->sportshop;
            echo "kết nối thành công";
        } catch (Exception $e) {
            echo "kết nối thất bại". $e->getMessage();

            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    public function getDatabase() {
        return $this->db;
    }

    public function closeConnection() {
        $this->client = null; // MongoDB PHP Driver tự động quản lý kết nối
    }
}
?>
