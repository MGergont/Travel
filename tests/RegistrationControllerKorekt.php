<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\RegistrationController;
use App\Utils\Request;
use App\Utils;
use App\Models\RegistrationModel;


class RegistrationControllerTest extends TestCase
{
    public function testRegisterUserWithEmptyFields()
    {
        
        $requestMock = $this->createMock(Request::class);
        
        
        $requestMock->method('postParam')
                    ->willReturn('');

        
        $controller = $this->getMockBuilder(RegistrationController::class)
                           ->setConstructorArgs([$requestMock])
                           ->onlyMethods(['redirect'])
                           ->getMock();

        
        $controller->expects($this->once())
                   ->method('redirect')
                   ->with($this->equalTo('/register'));

        
        $controller->registration();
    }
}