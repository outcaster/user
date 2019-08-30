<?php
declare(strict_types = 1);

namespace App\UserContext\Presentation\GetPhoneNumber\Query;

use App\UserContext\Application\GetPhoneNumber\Query\PhoneQueryResponse;
use App\UserContext\Infrastructure\Serialization\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

class GetPhoneResponseHandler
{
    /** @var SerializerInterface */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param PhoneQueryResponse $result
     * @return Response
     */
    public function success(PhoneQueryResponse $result): Response
    {
        $items = $result->getPersonPhones();

        return new Response(
            $this->serializer->serialize($items),
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
        );
    }
}
