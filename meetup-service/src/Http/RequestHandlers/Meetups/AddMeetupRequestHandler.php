<?php
namespace Phpse\Meetups\Http\RequestHandlers\Meetups;

use Phpse\Meetups\Domain\Meetup;
use Phpse\Meetups\Domain\Uuid;
use Phpse\Meetups\Http\HttpRequestInterface;
use Phpse\Meetups\Http\JsonResponse;
use Phpse\Meetups\Http\RequestHandlers\RequestHandlerInterface;
use Phpse\Meetups\Http\ResponseInterface;
use Phpse\Meetups\Persistence\MeetupWriter;

class AddMeetupRequestHandler implements RequestHandlerInterface
{
    /**
     * @var MeetupWriter
     */
    private $meetupWriter;

    /**
     * @param MeetupWriter $meetupWriter
     */
    public function __construct(MeetupWriter $meetupWriter)
    {
        $this->meetupWriter = $meetupWriter;
    }

    /**
     * @param HttpRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(HttpRequestInterface $request)
    {
        $meetup = $this->mapInputToMeetup($request);
        $this->meetupWriter->save($meetup);
        return new JsonResponse(201, ['identifier' => $meetup->getIdentifier()->getValue()]);
    }

    /**
     * @param HttpRequestInterface $request
     *
     * @return Meetup
     */
    private function mapInputToMeetup(HttpRequestInterface $request)
    {
        return new Meetup(
            new Uuid(),
            $request->getParameter('title'),
            new \DateTime($request->getParameter('date')),
            (int)$request->getParameter('capacity')
        );
    }

}