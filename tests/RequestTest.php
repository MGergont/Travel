<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Utils\Request;

class RequestTest extends TestCase
{
    public function testIsPostReturnsTrueWhenRequestMethodIsPost()
    {
        $request = new Request([], [], ['REQUEST_METHOD' => 'POST']);
        $this->assertTrue($request->isPost());
    }

    public function testIsPostReturnsFalseWhenRequestMethodIsNotPost()
    {
        $request = new Request([], [], ['REQUEST_METHOD' => 'GET']);
        $this->assertFalse($request->isPost());
    }

    public function testIsGetReturnsTrueWhenRequestMethodIsGet()
    {
        $request = new Request([], [], ['REQUEST_METHOD' => 'GET']);
        $this->assertTrue($request->isGet());
    }

    public function testIsGetReturnsFalseWhenRequestMethodIsNotGet()
    {
        $request = new Request([], [], ['REQUEST_METHOD' => 'POST']);
        $this->assertFalse($request->isGet());
    }

    public function testHasPostReturnsTrueWhenPostIsNotEmpty()
    {
        $request = new Request([], ['param' => 'value'], []);
        $this->assertTrue($request->hasPost());
    }

    public function testHasPostReturnsFalseWhenPostIsEmpty()
    {
        $request = new Request([], [], []);
        $this->assertFalse($request->hasPost());
    }

    public function testGetParamReturnsCorrectValueWhenParamExists()
    {
        $request = new Request(['param' => 'value'], [], []);
        $this->assertEquals('value', $request->getParam('param'));
    }

    public function testGetParamReturnsDefaultValueWhenParamDoesNotExist()
    {
        $request = new Request([], [], []);
        $this->assertEquals('default', $request->getParam('param', 'default'));
    }

    public function testGetParamReturnsNullWhenParamDoesNotExistAndNoDefaultProvided()
    {
        $request = new Request([], [], []);
        $this->assertNull($request->getParam('param'));
    }

    public function testPostParamReturnsCorrectValueWhenParamExists()
    {
        $request = new Request([], ['param' => 'value'], []);
        $this->assertEquals('value', $request->postParam('param'));
    }

    public function testPostParamReturnsDefaultValueWhenParamDoesNotExist()
    {
        $request = new Request([], [], []);
        $this->assertEquals('default', $request->postParam('param', 'default'));
    }

    public function testPostParamReturnsNullWhenParamDoesNotExistAndNoDefaultProvided()
    {
        $request = new Request([], [], []);
        $this->assertNull($request->postParam('param'));
    }
}