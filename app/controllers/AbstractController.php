<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Request;

abstract class AbstractController
{

    protected array $configuration = [];
    protected Request $request;
    protected array $paramsView = [];

    public function __construct(Request $request)
    {
        $config = require_once("./app/Config/dbConfig.php");
        $this->configuration = $config['db'];
        $this->request = $request;
    }
    
    public function redirect(string $url): void{
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $url, true, 303);
        exit;
    }
}
