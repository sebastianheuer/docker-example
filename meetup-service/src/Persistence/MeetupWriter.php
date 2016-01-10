<?php
namespace Phpse\Meetups\Persistence;

use Phpse\Meetups\Domain\Meetup;

class MeetupWriter
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param Meetup $meetup
     */
    public function save(Meetup $meetup)
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO meetups (identifier, title, date, capacity) VALUES (:identifier, :title, :date, :capacity)'
        );
        $statement->bindValue('identifier', $meetup->getIdentifier()->getValue());
        $statement->bindValue('title', $meetup->getTitle());
        $statement->bindValue('date', $meetup->getDate()->format('Y-m-d H:i:s'));
        $statement->bindValue('capacity', $meetup->getCapacity(), \PDO::PARAM_INT);
        $statement->execute();
    }
}