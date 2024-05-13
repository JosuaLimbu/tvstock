<?php
use PHPUnit\Framework\TestCase;

class AccountListTest extends TestCase
{
    public function testAPIResponse()
    {
        $api_response = $this->getRequest('https://tvstock.online/tvstock/admin/accountlist/apiaccountlist.php');
        $this->assertNotEmpty($api_response['body']);
        $this->assertJson($api_response['body']);

        $this->displayAPIResponse($api_response);
    }

    private function getRequest($url)
    {
        $result = file_get_contents($url);
        $headers = $http_response_header;
        return array('body' => $result, 'headers' => $headers);
    }

    private function displayAPIResponse($api_response)
    {
        echo "API Response Body: \n";
        echo $api_response['body'] . "\n\n";

        echo "API Response Headers: \n";
        foreach ($api_response['headers'] as $header) {
            echo $header . "\n";
        }

        $json_data = json_decode($api_response['body'], true);
        echo "\nJSON Data:\n";
        echo json_encode($json_data, JSON_PRETTY_PRINT);
    }
}
?>