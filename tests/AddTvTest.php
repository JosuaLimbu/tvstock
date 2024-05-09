<?php
use PHPUnit\Framework\TestCase;

class AddTvTest extends TestCase
{
    public function testAddTvSuccess()
    {
        // Include the index file (assuming it includes addtv.php)
        include '../index.php';

        // Create a mock database connection
        $mockConnection = $this->getMockBuilder(mysqli::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Set up any necessary expectations or stubs for the database connection

        // Simulate POST data
        $_POST["merk"] = "Example Brand";
        $_POST["price"] = 1000;
        $_POST["available"] = 5;

        // Simulate the execution of addtv.php
        ob_start();
        include 'addtv.php';
        $output = ob_get_clean();

        // Assert the expected output
        $this->assertEquals('{"status":"success"}', $output);
    }
}
?>
