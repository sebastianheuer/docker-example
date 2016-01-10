<?php
namespace Phpse\Meetups\Http;

interface ResponseInterface
{
    /**
     * @return string
     */
    public function flush();
}