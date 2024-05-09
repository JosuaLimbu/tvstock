<?php
use PHPUnit\Framework\TestCase;

class AddUserTest extends TestCase
{
    public function testAddUserSuccess()
    {
        // Mock $_POST data for the test
        $_POST = [
            'username' => 'testuser',
            'password' => 'testpassword',
            'role' => 'admin'
        ];

        // Include the script to be tested
        include '../admin/accountlist/addUser.php';

        // Assert that the output is JSON with status "success"
        $this->expectOutputString(json_encode(["status" => "success"]));
    }

    public function testAddUserAlreadyExists()
    {
        // Mock $_POST data for the test
        $_POST = [
            'username' => 'existinguser',
            'password' => 'testpassword',
            'role' => 'admin'
        ];

        // Include the script to be tested
        include '../admin/accountlist/addUser.php';

        // Assert that the output is JSON with status "error"
        $this->expectOutputString(json_encode(["status" => "error", "message" => "Username sudah ada di database!"]));
    }
}
?>
