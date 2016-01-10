<?php
namespace Phpse\Meetups;

use Phpse\Meetups\Http\RequestHandlers\IndexRequestHandler;
use Phpse\Meetups\Http\RequestHandlers\Meetups\AddMeetupRequestHandler;
use Phpse\Meetups\Http\RequestHandlers\Meetups\ListMeetupsRequestHandler;
use Phpse\Meetups\Http\RequestHandlers\Meetups\SetRsvpRequestHandler;
use Phpse\Meetups\Http\RequestHandlers\Members\AddMemberRequestHandler;
use Phpse\Meetups\Http\RequestHandlers\Members\ListMembersRequestHandler;
use Phpse\Meetups\Http\Routing\Route;

class ApplicationBuilder
{
    /**
     * @return Application
     */
    public function build()
    {
        $factory = new Factory();

        (new ErrorHandler())->register();

        $router = $factory->getRouter();
        $router->addRoute(new Route('get', '/', IndexRequestHandler::class));
        $router->addRoute(new Route('get', '/meetups', ListMeetupsRequestHandler::class));
        $router->addRoute(new Route('post', '/meetups', AddMeetupRequestHandler::class));
        $router->addRoute(new Route('get', '/members', ListMembersRequestHandler::class));
        $router->addRoute(new Route('post', '/members', AddMemberRequestHandler::class));
        $router->addRoute(new Route('post', '/meetups/{meetup}/rsvps/{member}', SetRsvpRequestHandler::class));
        return new Application($router);
    }
}