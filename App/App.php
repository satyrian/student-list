<?php

namespace App;

use App\Components\DIContainer;
use App\Components\Exceptions\ApplicationException;
use App\Components\Exceptions\ContainerException;
use App\Components\Response;

class App
{
    /**
     * @var DIContainer
     */
    private DIContainer $container;

    /**
     * App constructor.
     * @param DIContainer $container
     */
    public function __construct(DIContainer $container)
    {
        $this->container = $container;
    }

    /**
     * Start application
     * @throws ContainerException
     */
    public function run(): void
    {
        set_error_handler([$this, 'errorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
        $router = $this->container->get('router');
        $response = $router->route($this->container, $this->createResponse());

        $this->respond($response);
    }

    /**
     * Error handler
     * If error output is enabled, then we turn all errors into exceptions
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     * @return bool
     * @throws \ErrorException
     */
    public function errorHandler(int $errno, string $errstr, string $errfile, int $errline): bool
    {
        if (!error_reporting()) {
            return false;
        }

        throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
    }

    /**
     * Exception handler
     * We catch all uncaught exceptions, output the template with an error,
     * and write the errors to the log file
     * @param \Throwable $exception
     * @throws ContainerException
     */
    public function exceptionHandler(\Throwable $exception)
    {
        $statusCode = ($exception instanceof ApplicationException) ? $exception->getStatusCode() : 503;
        $response = $this->createResponse($statusCode);
        $body = $this->container->get('view')->render('error', [
            'response' => $response,
            'exception' => $exception
        ]);
        error_log($exception->__toString());

        $this->respond($response->withBody($body));
    }

    /**
     * Send response
     * @param Response $response
     */
    private function respond(Response $response): void
    {
        $body = $response->getBody();

        if (!headers_sent()) {
            header(sprintf(
                'HTTP/1.0 %s %s',
                $response->getStatusCode(),
                $response->getStatusPhrase()
            ));
            foreach ($response->getHeaders() as $name => $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }

            header('Content-Length: ' . strlen($body));
        }

        echo $body;
    }

    /**
     * Create new response
     * @param int $statusCode
     * @return Response
     */
    private function createResponse(int $statusCode = 200): Response
    {
        return new Response([], '', $statusCode);
    }
}
