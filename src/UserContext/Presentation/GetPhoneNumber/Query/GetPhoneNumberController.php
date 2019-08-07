<?php
declare(strict_types = 1);

namespace App\UserContext\Presentation\GetPhoneNumber\Query;

use App\Shared\Domain\CQRS\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetPhoneNumberController extends AbstractController
{
    protected $queryAdapter;
    protected $queryBus;
    protected $responseHandler;

    /**
     * Base of any QueryController constructors.
     *
     * @param   $queryAdapter
     * @param   $queryBus
     * @param   $responseHandler
     */
    public function __construct(
        GetPhoneQueryAdapter $queryAdapter,
        QueryBus $queryBus,
        GetPhoneResponseHandler $responseHandler
    ) {
        $this->queryAdapter    = $queryAdapter;
        $this->queryBus    = $queryBus;
        $this->responseHandler = $responseHandler;
    }

    public function index(string $name)
    {
        // 1. Transform Request to Query.
        $query = $this->queryAdapter->getQueryFromRequest($name);

        // 2. Business work due to the Query and the query bus.
        $result = $this->queryBus->ask($query);

        // 3. Format using the business work and return the Response.
        return $this->responseHandler->success($result);
    }
}
