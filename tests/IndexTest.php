<?php

use PHPUnit\Framework\TestCase;

require_once 'index.php';

class IndexTest extends TestCase
{
    public function testProcessLoginWithCorrectCredentials()
    {
        $mockCon = $this->createMock(mysqli::class);
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockResult = $this->createMock(mysqli_result::class);

        // Mock the execute() method to return true
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);

        // Mock the get_result() method to return a non-empty result set
        $mockResult->expects($this->once())
                   ->method('num_rows')
                   ->willReturn(1);

        // Set up the mock prepare() method to return the mock statement
        $mockCon->expects($this->once())
                ->method('prepare')
                ->willReturn($mockStmt);

        // Call the function and check if session variables are set
        processLogin('admin', 'username', 'password', $mockCon);

        $this->assertEquals('username', $_SESSION['username']);
        $this->assertEquals('admin', $_SESSION['role']);
    }

    public function testProcessLoginWithIncorrectCredentials()
    {
        $mockCon = $this->createMock(mysqli::class);
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockResult = $this->createMock(mysqli_result::class);

        // Mock the execute() method to return true
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);

        // Mock the get_result() method to return an empty result set
        $mockResult->expects($this->once())
                   ->method('num_rows')
                   ->willReturn(0);

        // Set up the mock prepare() method to return the mock statement
        $mockCon->expects($this->once())
                ->method('prepare')
                ->willReturn($mockStmt);

        // Call the function and check if error message is returned
        $errorMessage = processLogin('admin', 'wrong_username', 'wrong_password', $mockCon);

        $this->assertEquals('Incorrect username or password.', $errorMessage);
    }
}
