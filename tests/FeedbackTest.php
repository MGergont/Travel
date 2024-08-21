<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

class FeedbackTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION = [];
    }

    public function testFeedbackMessStoresMessageInSession()
    {
    
        $this->feedbackMess('testName', 'testMessage');
        
        $this->assertEquals('testMessage', $_SESSION['testName']);
    }

    public function testFeedbackMessDisplaysAndClearsMessageFromSession()
    {
        
        $_SESSION['testName'] = 'testMessage';

        ob_start();
        $this->feedbackMess('testName');
        $output = ob_get_clean();

        $this->assertStringContainsString('<div>testMessage</div>', $output);

        
        $this->assertArrayNotHasKey('testName', $_SESSION);
    }

    public function testFeedbackMessDoesNothingWithEmptyName()
    {
        $this->feedbackMess('', 'testMessage');

        $this->assertEmpty($_SESSION);
    }

    public function testFeedbackMessDoesNothingWithEmptyMessage()
    {
        $_SESSION['testName'] = 'testMessage';
        $this->feedbackMess('testName', 'testMessage');

        $this->assertEquals('testMessage', $_SESSION['testName']);
    }

    protected function feedbackMess(string $name = '', string $message = ''): void
    {
        if (!empty($name)) {
            if (!empty($message) && empty($_SESSION[$name])) {
                $_SESSION[$name] = $message;
            } else if (empty($message) && !empty($_SESSION[$name])) {
                echo '<div>' . $_SESSION[$name] . '</div>';
                unset($_SESSION[$name]);
            }
        }
    }
}