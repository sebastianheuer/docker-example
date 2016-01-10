<?php
namespace Phpse\Meetups\Http\RequestHandlers\Members;

use Phpse\Meetups\Domain\Member;
use Phpse\Meetups\Domain\Uuid;
use Phpse\Meetups\Http\HttpRequestInterface;
use Phpse\Meetups\Http\JsonResponse;
use Phpse\Meetups\Http\RequestHandlers\RequestHandlerInterface;
use Phpse\Meetups\Persistence\MemberWriter;

class AddMemberRequestHandler implements RequestHandlerInterface
{
    /**
     * @var MemberWriter
     */
    private $memberWriter;

    /**
     * @param MemberWriter $memberWriter
     */
    public function __construct(MemberWriter $memberWriter)
    {
        $this->memberWriter = $memberWriter;
    }

    /**
     * @param HttpRequestInterface $request
     *
     * @return JsonResponse
     */
    public function handle(HttpRequestInterface $request)
    {
        $member = $this->mapInputToMember($request);
        $this->memberWriter->save($member);
        return new JsonResponse(201, ['identifier' => $member->getIdentifier()->getValue()]);
    }

    /**
     * @param HttpRequestInterface $request
     *
     * @return Member
     */
    private function mapInputToMember(HttpRequestInterface $request)
    {
        return new Member(
            new Uuid(),
            $request->getParameter('name'),
            $request->getParameter('email')
        );
    }

}