<?php
namespace Phpse\Meetups;
use Phpse\Meetups\Http\HttpRequest;

require __DIR__  .'/vendor/autoload.php';

(new ApplicationBuilder())->build()->run(new HttpRequest($_SERVER, $_POST))->flush();

