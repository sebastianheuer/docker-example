<?php
namespace Phpse\Meetups;

use Phpse\Meetups\Http\RequestHandlers\IndexRequestHandler;
use Phpse\Meetups\Http\RequestHandlers\Meetups\AddMeetupRequestHandler;
use Phpse\Meetups\Http\RequestHandlers\Meetups\ListMeetupsRequestHandler;
use Phpse\Meetups\Http\RequestHandlers\Meetups\SetRsvpRequestHandler;
use Phpse\Meetups\Http\RequestHandlers\Members\AddMemberRequestHandler;
use Phpse\Meetups\Http\RequestHandlers\Members\ListMembersRequestHandler;
use Phpse\Meetups\Http\RequestHandlers\RequestHandlerLocator;
use Phpse\Meetups\Http\Routing\Router;
use Phpse\Meetups\Persistence\MeetupReader;
use Phpse\Meetups\Persistence\MeetupWriter;
use Phpse\Meetups\Persistence\MemberReader;
use Phpse\Meetups\Persistence\MemberWriter;
use Phpse\Meetups\Persistence\Migrator;
use Phpse\Meetups\Persistence\RsvpWriter;

class Factory
{
    /**
     * @return IndexRequestHandler
     */
    public function getIndexRequestHandler()
    {
        return new IndexRequestHandler();
    }

    /**
     * @return AddMeetupRequestHandler
     */
    public function getAddMeetupRequestHandler()
    {
        return new AddMeetupRequestHandler($this->getMeetupWriter());
    }

    /**
     * @return ListMeetupsRequestHandler
     */
    public function getListMeetupsRequestHandler()
    {
        return new ListMeetupsRequestHandler($this->getMeetupReader());
    }

    /**
     * @return AddMemberRequestHandler
     */
    public function getAddMemberRequestHandler()
    {
        return new AddMemberRequestHandler($this->getMemberWriter());
    }

    /**
     * @return ListMembersRequestHandler
     */
    public function getListMembersRequestHandler()
    {
        return new ListMembersRequestHandler($this->getMemberReader());
    }

    /**
     * @return SetRsvpRequestHandler
     */
    public function getSetRsvpRequestHandler()
    {
        return new SetRsvpRequestHandler(
            $this->getMeetupReader(),
            $this->getMemberReader(),
            $this->getRsvpWriter()
        );
    }

    /**
     * @return Router
     */
    public function getRouter()
    {
        return new Router($this->getRequestHandlerLocator());
    }

    /**
     * @return RequestHandlerLocator
     */
    public function getRequestHandlerLocator()
    {
        return new RequestHandlerLocator($this);
    }

    /**
     * @return Migrator
     */
    public function getMigrator()
    {
        return new Migrator($this->getPdo());
    }

    /**
     * @return MeetupReader
     */
    private function getMeetupReader()
    {
        return new MeetupReader($this->getPdo());
    }

    /**
     * @return MeetupWriter
     */
    private function getMeetupWriter()
    {
        return new MeetupWriter($this->getPdo());
    }

    /**
     * @return MemberReader
     */
    private function getMemberReader()
    {
        return new MemberReader($this->getPdo());
    }

    /**
     * @return MemberWriter
     */
    private function getMemberWriter()
    {
        return new MemberWriter($this->getPdo());
    }

    /**
     * @return RsvpWriter
     */
    private function getRsvpWriter()
    {
        return new RsvpWriter($this->getPdo());
    }

    /**
     * @return \PDO
     */
    private function getPdo()
    {
        $host = getenv('MYSQL_HOST');
        $database = getenv('MYSQL_DATABASE');
        $username = getenv('MYSQL_USER');
        $password = getenv('MYSQL_PASSWORD');
        return new \PDO(
            sprintf('mysql:host=%s;dbname=%s', $host, $database), $username, $password
        );
    }
}