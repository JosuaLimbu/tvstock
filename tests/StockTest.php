<?php
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase {
    public function testAPIResponse() {
        $api_response = $this->getRequest('https://tvstock.online/tvstock/admin/tvstock/apitvstock.php');
        
        $this->assertNotEmpty($api_response['body']);
        
        $this->assertJson($api_response['body']);

        // Menampilkan hasil output dari permintaan API
        $this->displayAPIResponse($api_response);
    }

    private function getRequest($url) {
        $result = file_get_contents($url);
        $headers = $http_response_header;
        return array('body' => $result, 'headers' => $headers);
    }

    private function displayAPIResponse($api_response) {
        // Menampilkan body dari respons API
        echo "API Response Body: \n";
        echo $api_response['body'] . "\n\n";

        // Menampilkan headers dari respons API
        echo "API Response Headers: \n";
        foreach ($api_response['headers'] as $header) {
            echo $header . "\n";
        }

        // Menampilkan body respons API sebagai JSON di shell
        $json_data = json_decode($api_response['body'], true);
        echo "\nJSON Data:\n";
        echo json_encode($json_data, JSON_PRETTY_PRINT);
    }
}
?>
