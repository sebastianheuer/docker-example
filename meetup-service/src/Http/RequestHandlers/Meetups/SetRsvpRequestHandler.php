<?php
namespace Phpse\Meetups\Http\RequestHandlers\Meetups;

use Phpse\Meetups\Domain\Rsvp;
use Phpse\Meetups\Domain\Uuid;
use Phpse\Meetups\Http\HttpRequestInterface;
use Phpse\Meetups\Http\JsonResponse;
use Phpse\Meetups\Http\RequestHandlers\RequestHandlerInterface;
use Phpse\Meetups\Persistence\MeetupReader;
use Phpse\Meetups\Persistence\MemberReader;
use Phpse\Meetups\Persistence\RsvpWriter;

class SetRsvpRequestHandler implements RequestHandlerInterface
{
    /**
     * @var MeetupReader
     */
    private $meetupReader;

    /**
     * @var MemberReader
     */
    private $memberReader;

    /**
     * @var RsvpWriter
     */
    private $rsvpWriter;

    /**
     * SetRsvpRequestHandler constructor.
     *
     * @param MeetupReader $meetupReader
     * @param MemberReader $memberReader
     * @param RsvpWriter $rsvpWriter
     */
    public function __construct(MeetupReader $meetupReader, MemberReader $memberReader, RsvpWriter $rsvpWriter)
    {
        $this->meetupReader = $meetupReader;
        $this->memberReader = $memberReader;
        $this->rsvpWriter = $rsvpWriter;
    }

    /**
     * @param HttpRequestInterface $request
     *
     * @return JsonResponse
     */
    public function handle(HttpRequestInterface $request)
    {
        $this->rsvpWriter->save($this->mapInputToRsvp($request));
        return new JsonResponse(200, []);
    }

    /**
     * @param HttpRequestInterface $request
     *
     * @return Rsvp
     */
    private function mapInputToRsvp(HttpRequestInterface $request)
    {
        return new Rsvp(
            $this->memberReader->getMember(new Uuid($request->getParameter('member'))),
            $this->meetupReader->getMeetup(new Uuid($request->getParameter('meetup'))),
            $request->getParameter('rsvp')
        );
    }

}