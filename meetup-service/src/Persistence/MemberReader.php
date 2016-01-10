<?php
namespace Phpse\Meetups\Persistence;

use Phpse\Meetups\Domain\Member;
use Phpse\Meetups\Domain\Uuid;

class MemberReader
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
     * @return Member
     */
    public function getMember(Uuid $identifier)
    {
        $statement = $this->pdo->prepare('SELECT * FROM members WHERE identifier = :identifier');
        $statement->bindValue('identifier', $identifier->getValue());
        $statement->execute();
        if ($statement->rowCount() === 0) {
            throw new \PDOException('Member not found');
        }
        return $this->rowToMember($statement->fetchObject());
    }

    /**
     * @return Member[]
     */
    public function getMembers()
    {
        $statement = $this->pdo->query('SELECT * FROM members');
        if (false === $statement) {
            throw new \PDOException(join("\n", $this->pdo->errorInfo()), $this->pdo->errorCode());
        }
        $members = [];
        while ($row = $statement->fetch(\PDO::FETCH_OBJ)) {
            $members[] = $this->rowToMember($row);
        }
        return $members;
    }

    /**
     * @param \StdClass $row
     *
     * @return Member
     */
    private function rowToMember(\StdClass $row)
    {
        return new Member(
            new Uuid($row->identifier),
            $row->name,
            $row->email
        );
    }

}