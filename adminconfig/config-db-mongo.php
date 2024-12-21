<?php
require 'vendor/autoload.php';

class MongoConnection {
    private $client;
    private $db;

    public function __construct() {
        $uri = "mongodb+srv://hoanguyenlexuan:2bwnC0SF9C0Ut5Hm@cluster0.216ds.mongodb.net/?retryWrites=true&w=majority";

        try {
            // Tạo kết nối
            $this->client = new MongoDB\Client($uri);

            // Chọn cơ sở dữ liệu (thay "sportshop" bằng tên cơ sở dữ liệu của bạn)
            $this->db = $this->client->sportshop;
        } catch (Exception $e) {
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
