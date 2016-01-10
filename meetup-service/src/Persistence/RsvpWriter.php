<?php
namespace Phpse\Meetups\Persistence;

use Phpse\Meetups\Domain\Rsvp;

class RsvpWriter
{

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * RsvpWriter constructor.
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param Rsvp $rsvp
     */
    public function save(Rsvp $rsvp)
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO rsvps (member_identifier, meetup_identifier, rsvp)
             VALUES (:member_identifier, :meetup_identifier, :rsvp)
             ON DUPLICATE KEY UPDATE rsvp = :rsvp'
        );
        $statement->bindValue('member_identifier', $rsvp->getMember()->getIdentifier()->getValue());
        $statement->bindValue('meetup_identifier', $rsvp->getMeetup()->getIdentifier()->getValue());
        $statement->bindValue('rsvp', $rsvp->getDecision());
        $statement->execute();
    }

}