<?php
namespace Phpse\Meetups\Http\RequestHandlers\Meetups;

use Phpse\Meetups\Http\HttpRequestInterface;
use Phpse\Meetups\Http\JsonResponse;
use Phpse\Meetups\Http\RequestHandlers\RequestHandlerInterface;
use Phpse\Meetups\Persistence\MeetupReader;

class ListMeetupsRequestHandler implements RequestHandlerInterface
{
    /**
     * @var MeetupReader
     */
    private $meetupReader;

    /**
     * @param MeetupReader $meetupReader
     */
    public function __construct(MeetupReader $meetupReader)
    {
        $this->meetupReader = $meetupReader;
    }

    /**
     * @param HttpRequestInterface $request
     *
     * @return JsonResponse
     */
    public function handle(HttpRequestInterface $request)
    {
        $result = [];
        foreach ($this->meetupReader->getMeetups() as $meetup) {
            $result[] = [
                'identifier' => $meetup->getIdentifier()->getValue(),
                'title' => $meetup->getTitle(),
                'date' => $meetup->getDate()->format('Y-m-d H:i:s'),
                'capacity' => $meetup->getCapacity(),
                'free' => $meetup->getFree()
            ];
        }
        return new JsonResponse(200, $result);
    }

}