<?php
namespace Phpse\Meetups\Persistence;

use Phpse\Meetups\Domain\Meetup;
use Phpse\Meetups\Domain\Uuid;

class MeetupReader
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
     * @param Uuid $identifier
     *
     * @return Meetup
     */
    public function getMeetup(Uuid $identifier)
    {
        $statement = $this->pdo->prepare(
            'SELECT m.*, count(r.member_identifier) as taken
             FROM meetups m
             LEFT JOIN rsvps r ON (r.meetup_identifier = m.identifier AND r.rsvp = "yes")
             WHERE m.identifier = :identifier
             GROUP BY m.identifier'
        );
        $statement->bindValue('identifier', $identifier->getValue());
        $statement->execute();
        if ($statement->rowCount() === 0) {
            throw new \PDOException('Meetup not found');
        }
        return $this->rowToMeetup($statement->fetchObject());
    }

    /**
     * @return Meetup[]
     */
    public function getMeetups()
    {
        $statement = $this->pdo->query(
            'SELECT m.*, count(r.member_identifier) as taken
             FROM meetups m
             LEFT JOIN rsvps r ON (r.meetup_identifier = m.identifier AND r.rsvp = "yes")
             GROUP BY m.identifier
             ORDER BY m.date ASC'
        );
        if (false === $statement) {
            throw new \PDOException(join("\n", $this->pdo->errorInfo()), $this->pdo->errorCode());
        }
        $meetups = [];
        while ($row = $statement->fetch(\PDO::FETCH_OBJ)) {
            $meetups[] = $this->rowToMeetup($row);
        }
        return $meetups;
    }

    /**
     * @param \StdClass $row
     *
     * @return Meetup
     */
    private function rowToMeetup(\StdClass $row)
    {
        return new Meetup(
            new Uuid($row->identifier),
            $row->title,
            new \DateTime($row->date),
            (int)$row->capacity,
            (int)$row->capacity - $row->taken
        );
    }

}