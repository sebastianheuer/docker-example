<?php
namespace Phpse\Meetups\Domain;

class Uuid
{
    /**
     * @var string
     */
    private $_value = '';

    /**
     * @param null $value
     */
    public function __construct($value = null)
    {
        if (null !== $value) {
            $this->_value = $value;
        } else {
            $this->_setValue();
        }
    }

    /**
     *
     */
    private function _setValue()
    {
        $source = file_get_contents('/dev/urandom', false, null, null, 64);
        $source .= uniqid(uniqid(mt_rand(0, PHP_INT_MAX), true), true);
        for ($t = 0; $t < 64; $t++) {
            $source .= chr((mt_rand() ^ mt_rand()) % 256);
        }
        $this->_value = sha1(hash('sha512', $source, true));
    }

    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->_value;
    }

}