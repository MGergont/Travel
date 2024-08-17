<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

class FeedbackTest extends TestCase
{
    protected function setUp(): void
    {
        // Ustawienie sesji na początku każdego testu
        $_SESSION = [];
    }

    public function testFeedbackMessStoresMessageInSession()
    {
        // Wywołanie funkcji z nazwą i wiadomością
        $this->feedbackMess('testName', 'testMessage');

        // Sprawdzenie, czy wiadomość została zapisana w sesji
        $this->assertEquals('testMessage', $_SESSION['testName']);
    }

    public function testFeedbackMessDisplaysAndClearsMessageFromSession()
    {
        // Ustawienie wiadomości w sesji
        $_SESSION['testName'] = 'testMessage';

        // Złapanie wyjścia do bufora
        ob_start();
        $this->feedbackMess('testName');
        $output = ob_get_clean();

        // Sprawdzenie, czy wiadomość została wyświetlona
        $this->assertStringContainsString('<div>testMessage</div>', $output);

        // Sprawdzenie, czy wiadomość została usunięta z sesji
        $this->assertArrayNotHasKey('testName', $_SESSION);
    }

    public function testFeedbackMessDoesNothingWithEmptyName()
    {
        // Wywołanie funkcji z pustą nazwą
        $this->feedbackMess('', 'testMessage');

        // Sprawdzenie, czy sesja jest pusta
        $this->assertEmpty($_SESSION);
    }

    public function testFeedbackMessDoesNothingWithEmptyMessage()
    {
        // Wywołanie funkcji z pustą wiadomością i istniejącą nazwą w sesji
        $_SESSION['testName'] = 'testMessage';
        $this->feedbackMess('testName', 'testMessage');

        // Sprawdzenie, czy wiadomość w sesji pozostaje bez zmian
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