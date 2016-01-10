<?php
namespace Phpse\Meetups;

use Phpse\Meetups\Http\HttpRequestInterface;
use Phpse\Meetups\Http\JsonResponse;
use Phpse\Meetups\Http\Routing\Router;

class Application
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param HttpRequestInterface $request
     *
     * @return JsonResponse
     */
    public function run(HttpRequestInterface $request)
    {
        $requestHandler = $this->router->route($request);
        $response = $requestHandler->handle($request);
        return $response;
    }

}