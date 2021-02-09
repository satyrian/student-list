<?php

namespace App\Controllers;

use App\Components\ReflectionClassHelper;
use App\Components\Request;

class FrontController
{
    private static FrontController $instance;
    private Request $request;
    private string $body;

    /**
     * @return FrontController
     */
    public static function getInstance(): FrontController
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * The initialization of the controller and call the desired action
     */
    public function route(): void
    {
        $controller = $this->getCurrentNamespace($this->request->getController());
        $action = $this->request->getAction();
        $rc = new ReflectionClassHelper($controller);
        $rc->invoke($action);

    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    private function __construct()
    {
        $this->request = new Request();
    }

    private function __clone()
    {
    }


    /**
     * @param string|null $string
     * @return string
     */
    private function getCurrentNamespace(string $string = null): string
    {
        return (is_null($string)) ? __NAMESPACE__ . '\\' : __NAMESPACE__ . "\\$string";
    }

}