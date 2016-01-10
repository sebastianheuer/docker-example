<?php
namespace Phpse\Meetups\Persistence;

use Phpse\Meetups\Domain\Member;

class MemberWriter
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
     * @param Member $member
     */
    public function save(Member $member)
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO members (identifier, name, email) VALUES (:identifier, :name, :email)'
        );
        $statement->bindValue('identifier', $member->getIdentifier()->getValue());
        $statement->bindValue('name', $member->getName());
        $statement->bindValue('email', $member->getEmail());
        $statement->execute();
    }
}