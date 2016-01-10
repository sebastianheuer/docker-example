<?php
namespace Phpse\Meetups\Domain;

class Meetup
{
    /**
     * @var Uuid
     */
    private $identifier;

    /**
     * @var string
     */
    private $title = '';

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var int
     */
    private $capacity = 0;

    /**
     * @var int
     */
    private $free = 0;

    /**
     * @param Uuid $identifier
     * @param string $title
     * @param \DateTime $date
     * @param int $capacity
     */
    public function __construct(Uuid $identifier, $title, \DateTime $date, $capacity, $free = null)
    {
        $this->identifier = $identifier;
        $this->title = $title;
        $this->date = $date;
        $this->capacity = $capacity;
        if (null === $free) {
            $free = $capacity;
        }
        $this->free = $free;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @return int
     */
    public function getFree()
    {
        return $this->free;
    }

}