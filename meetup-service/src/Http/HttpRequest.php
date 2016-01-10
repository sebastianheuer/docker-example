<?php
namespace Phpse\Meetups\Http;

class HttpRequest implements HttpRequestInterface
{
    /**
     * @var array
     */
    private $server = [];

    /**
     * @var array
     */
    private $post = [];

    /**
     * @var array
     */
    private $pathParameters = [];

    /**
     * @param array $server
     * @param array $post
     */
    public function __construct(array $server, array $post)
    {
        $this->server = $server;
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return parse_url($this->server['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return strtolower($this->server['REQUEST_METHOD']);
    }

    /**
     * @param string $name
     *
     * @return string
     * @throws RestException
     */
    public function getParameter($name)
    {
        if (isset($this->pathParameters[$name])) {
            return $this->pathParameters[$name];
        }
        if (!isset($this->post[$name])) {
            throw new RestException(sprintf('POST Parameter %s is missing.', $name));
        }
        return $this->post[$name];
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addPathParameter($name, $value)
    {
        $this->pathParameters[$name] = $value;
    }



}