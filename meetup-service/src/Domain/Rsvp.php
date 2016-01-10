<?php
namespace Phpse\Meetups\Domain;

class Rsvp
{
    const RSVP_YES = 'yes';

    const RSVP_NO = 'no';

    /**
     * @var Member
     */
    private $member;

    /**
     * @var Meetup
     */
    private $meetup;

    /**
     * @var string
     */
    private $decision = self::RSVP_YES;

    /**
     * @param Member $member
     * @param Meetup $meetup
     * @param string $decision
     */
    public function __construct(Member $member, Meetup $meetup, $decision)
    {
        $this->member = $member;
        $this->meetup = $meetup;
        $this->decision = $decision;
    }

    /**
     * @return Member
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * @return Meetup
     */
    public function getMeetup()
    {
        return $this->meetup;
    }

    /**
     * @return string
     */
    public function getDecision()
    {
        return $this->decision;
    }

}