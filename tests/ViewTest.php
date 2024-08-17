<?php

declare(strict_types=1);

namespace Tests;

use App\Views\View;
use PHPUnit\Framework\TestCase;
use ReflectionClass;


class ViewTest extends TestCase{
    public function testEscapeConvertsSpecialCharacters()
    {
        $view = new View;
        
        $input = [
            'name' => '<script>alert("XSS")</script>',
            'age' => 30,
            'nested' => [
                'bio' => '<b>Bold Text</b>',
            ],
        ];

        $expected = [
            'name' => '&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;',
            'age' => 30,
            'nested' => [
                'bio' => '&lt;b&gt;Bold Text&lt;/b&gt;',
            ],
        ];

        $reflection = new ReflectionClass($view);
        $method = $reflection->getMethod('escape');
        $method->setAccessible(true);
        $result = $method->invokeArgs($view, [$input]);

        $this->assertEquals($expected, $result);
    }

    final public function testRenderRendersCorrectTemplate(){

        $view = $this->getMockBuilder(View::class)
                     ->onlyMethods(['escape'])
                     ->getMock();

        $view->expects($this->once())
             ->method('escape')
             ->willReturn(['name' => 'John Doe']);

        ob_start();
        $view->render('profile', ['name' => '<script>John Doe</script>']);
        $output = ob_get_clean();

        $this->assertStringContainsString('<h1>John Doe</h1>', $output);
    }
}
