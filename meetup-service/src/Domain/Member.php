<?php
namespace Phpse\Meetups\Domain;

class Member
{
    /**
     * @var Uuid
     */
    private $identifier;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $email = '';

    /**
     * @param Uuid $identifier
     * @param string $name
     * @param string $email
     */
    public function __construct(Uuid $identifier, $name, $email)
    {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return Uuid
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

}