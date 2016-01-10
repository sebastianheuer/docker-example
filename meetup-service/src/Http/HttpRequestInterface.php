<?php
namespace Phpse\Meetups\Http;

interface HttpRequestInterface
{
    /**
     * @return string
     */
    public function getPath();

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @param string $name
     *
     * @return string
     */
    public function getParameter($name);

    /**
     * @param string $name
     * @param string $value
     */
    public function addPathParameter($name, $value);
}