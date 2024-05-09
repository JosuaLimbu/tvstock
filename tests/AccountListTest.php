<?php
use PHPUnit\Framework\TestCase;

class AccountListTest extends TestCase {
    public function testAPIResponse() {
        // Melakukan permintaan ke API
        $api_response = $this->getRequest('https://tvstock.online/tvstock/admin/accountlist/apiaccountlist.php');
        
        // Memeriksa apakah responsenya tidak kosong
        $this->assertNotEmpty($api_response['body']);
        
        // Memeriksa apakah responsenya adalah JSON yang valid
        $this->assertJson($api_response['body']);
    }

    private function getRequest($url) {
        $result = file_get_contents($url);
        $headers = $http_response_header;
        return array('body' => $result, 'headers' => $headers);
    }
}
?>
