<?php
use PHPUnit\Framework\TestCase;

class DeleteUserTest extends TestCase
{
    public function testDeleteUserSuccess()
    {
        // Mock $_POST data for the test
        $_POST = [
            'action' => 'delete',
            'id' => 123 // Id of user to delete
        ];

        // Mock database connection
        include '../../databaseconnect/connect.php';

        // Include the script to be tested
        include '../accountlist/deleteUser.php';

        // Assert that the output is '1' indicating successful deletion
        $this->expectOutputString('1');
    }

    public function testDeleteUserFailure()
    {
        // Mock $_POST data for the test
        $_POST = [
            'action' => 'delete',
            'id' => 999 // Id of non-existent user
        ];

        // Mock database connection
        include '../../databaseconnect/connect.php';

        // Include the script to be tested
        include '../accountlist/deleteUser.php';

        // Assert that the output is 'ada yang salah' indicating failure
        $this->expectOutputString('ada yang salah');
    }
}
?>
