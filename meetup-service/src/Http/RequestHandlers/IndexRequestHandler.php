<?php
namespace Phpse\Meetups\Http\RequestHandlers;

use Phpse\Meetups\Http\HttpRequestInterface;
use Phpse\Meetups\Http\JsonResponse;

class IndexRequestHandler implements RequestHandlerInterface
{
    /**
     * @param HttpRequestInterface $request
     * @returns JsonResponse
     */
    public function handle(HttpRequestInterface $request)
    {
        return new JsonResponse(200, ['message' => 'Hello World']);
    }

}