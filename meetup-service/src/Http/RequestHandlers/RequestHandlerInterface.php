<?php
namespace Phpse\Meetups\Http\RequestHandlers;

use Phpse\Meetups\Http\HttpRequestInterface;
use Phpse\Meetups\Http\ResponseInterface;

interface RequestHandlerInterface
{

    /**
     * @param HttpRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(HttpRequestInterface $request);

}