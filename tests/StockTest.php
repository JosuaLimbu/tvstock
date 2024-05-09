<?php
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase {
    public function testAPIResponse() {
        $api_response = $this->getRequest('https://tvstock.online/tvstock/admin/tvstock/apitvstock.php');
        
        $this->assertNotEmpty($api_response['body']);
        
        $this->assertJson($api_response['body']);
    }

    private function getRequest($url) {
        $result = file_get_contents($url);
        $headers = $http_response_header;
        return array('body' => $result, 'headers' => $headers);
    }
}
?>
