<?php
namespace Phpse\Meetups\Http\RequestHandlers\Members;

use Phpse\Meetups\Http\HttpRequestInterface;
use Phpse\Meetups\Http\JsonResponse;
use Phpse\Meetups\Http\RequestHandlers\RequestHandlerInterface;
use Phpse\Meetups\Persistence\MemberReader;

class ListMembersRequestHandler implements RequestHandlerInterface
{
    /**
     * @var MemberReader
     */
    private $memberReader;

    /**
     * ListMembersRequestHandler constructor.
     *
     * @param MemberReader $memberReader
     */
    public function __construct(MemberReader $memberReader)
    {
        $this->memberReader = $memberReader;
    }

    /**
     * @param HttpRequestInterface $request
     *
     * @return JsonResponse
     */
    public function handle(HttpRequestInterface $request)
    {
        $result = [];
        foreach ($this->memberReader->getMembers() as $member) {
            $result[] = [
                'identifier' => $member->getIdentifier()->getValue(),
                'name' => $member->getName(),
                'email' => $member->getEmail()
            ];
        }
        return new JsonResponse(200, $result);
    }

}