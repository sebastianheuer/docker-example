<?php
namespace Phpse\Meetups\Http\Routing;

use Phpse\Meetups\Http\HttpRequestInterface;

class Route
{
    /**
     * @var string
     */
    private $method = 'get';

    /**
     * @var string
     */
    private $path = '';

    /**
     * @var string
     */
    private $requestHandlerClass = '';

    /**
     * @param string $method
     * @param string $path
     * @param string $handlerClass
     */
    public function __construct($method, $path, $handlerClass)
    {
        $this->method = $method;
        $this->path = $path;
        $this->requestHandlerClass = $handlerClass;
    }

    /**
     * @return string
     */
    public function getRequestHandlerClass()
    {
        return $this->requestHandlerClass;
    }

    /**
     * @param HttpRequestInterface $request
     *
     * @return bool
     */
    public function matches(HttpRequestInterface $request)
    {
        if ($this->method != $request->getMethod()) {
            return false;
        }

        $requestPathSegments = explode('/', $request->getPath());
        $routePathSegments = explode('/', $this->path);
        if (count($requestPathSegments) != count($routePathSegments)) {
            return false;
        }

        $pathParameters = [];

        foreach ($routePathSegments as $index => $pathSegment) {
            if (preg_match('/\{(.*)\}/', $pathSegment, $matches)) {
                $pathParameters[$matches[1]] = $requestPathSegments[$index];
                continue;
            }
            if ($pathSegment != $requestPathSegments[$index]) {
                return false;
            }
        }

        foreach ($pathParameters as $name => $value) {
            $request->addPathParameter($name, $value);
        }

        return true;
    }

}