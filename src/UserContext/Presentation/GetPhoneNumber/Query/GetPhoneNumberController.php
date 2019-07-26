<?php
declare(strict_types = 1);

namespace App\UserContext\Presentation\GetPhoneNumber\Query;

use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneNumberHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetPhoneNumberController extends AbstractController
{
    protected $queryAdapter;
    protected $queryHandler;
    protected $responseHandler;

    /**
     * Base of any QueryController constructors.
     *
     * @param   $queryAdapter
     * @param   $queryHandler
     * @param   $responseHandler
     */
    public function __construct(
        GetPhoneQueryAdapter $queryAdapter,
        GetPhoneNumberHandler $queryHandler,
        GetPhoneResponseHandler $responseHandler
    ) {
        $this->queryAdapter    = $queryAdapter;
        $this->queryHandler    = $queryHandler;
        $this->responseHandler = $responseHandler;
    }

    public function index(string $name)
    {
        // 1. Transform Request to Query.
        $query = $this->queryAdapter->getQueryFromRequest($name);

        // 2. Business work thanks to the Query.
        $result = $this->queryHandler->process($query);

        // 3. Format using the business work and return the Response.
        return $this->responseHandler->success($result);
    }
}
