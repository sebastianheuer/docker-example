<?php
namespace Phpse\Meetups\Persistence;

class Migrator
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
     * @param string $script
     */
    public function run($script)
    {
        try {
            $this->pdo->beginTransaction();
            $this->pdo->query($script);
            $this->pdo->commit();
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
        }
    }

}