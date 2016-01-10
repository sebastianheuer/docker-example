<?php
namespace Phpse\Meetups\Http\RequestHandlers;

use Phpse\Meetups\Factory;
use Phpse\Meetups\Http\Routing\RoutingException;

class RequestHandlerLocator
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param string $classname
     *
     * @return RequestHandlerInterface
     * @throws RoutingException
     */
    public function getRequestHandler($classname)
    {
        $shortClassname = (new \ReflectionClass($classname))->getShortName();
        $method = $this->classNameToFactoryMethod($shortClassname);
        if (null === (new \ReflectionClass($this->factory))->getMethod($method)) {
            throw new RoutingException('No Request Handler found');
        }
        return $this->factory->$method();
    }

    /**
     * @param string $classname
     *
     * @return string
     */
    private function classNameToFactoryMethod($classname)
    {
        return sprintf('get%s', $classname);
    }
}