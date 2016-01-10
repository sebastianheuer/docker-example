<?php
namespace Phpse\Meetups\Http\Routing;

use Phpse\Meetups\Http\HttpRequestInterface;
use Phpse\Meetups\Http\RequestHandlers\RequestHandlerInterface;
use Phpse\Meetups\Http\RequestHandlers\RequestHandlerLocator;

class Router
{
    /**
     * @var Route[]
     */
    private $routes = [];

    /**
     * @var RequestHandlerLocator
     */
    private $locator;

    /**
     * @param RequestHandlerLocator $locator
     */
    public function __construct(RequestHandlerLocator $locator)
    {
        $this->locator = $locator;
    }

    /**
     * @param Route $route
     */
    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * @param HttpRequestInterface $request
     *
     * @return RequestHandlerInterface
     * @throws RoutingException
     */
    public function route(HttpRequestInterface $request)
    {
        foreach ($this->routes as $route) {
            if (!$route->matches($request)) {
                continue;
            }
            return $this->locator->getRequestHandler($route->getRequestHandlerClass());
        }
        throw new RoutingException(
            sprintf('No route for %s %s', strtoupper($request->getMethod()), $request->getPath())
        );
    }

}