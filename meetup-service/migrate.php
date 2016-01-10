<?php
require __DIR__ . '/vendor/autoload.php';

try {
    (new \Phpse\Meetups\Factory())->getMigrator()->run(file_get_contents(__DIR__ . '/db/migration/schema.sql'));
    echo "Migration finished. \n";
} catch (PDOException $e) {
    echo sprintf("Migration failed: %s\n", $e->getMessage());
    exit(1);
}
