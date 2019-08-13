<?php
declare(strict_types = 1);

namespace App\UserContext\Presentation\GetPhoneNumber\Query;

use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneNumberQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetPhoneNumberController extends AbstractController
{
    /** @var GetPhoneQueryAdapter */
    protected $queryAdapter;

    /** @var GetPhoneNumberQueryHandler */
    protected $handler;

    /** @var GetPhoneResponseHandler */
    protected $responseHandler;

    /**
     * Base of any QueryController constructors.
     *
     * @param GetPhoneQueryAdapter $queryAdapter
     * @param GetPhoneNumberQueryHandler $handler
     * @param GetPhoneResponseHandler $responseHandler
     */
    public function __construct(
        GetPhoneQueryAdapter $queryAdapter,
        GetPhoneNumberQueryHandler $handler,
        GetPhoneResponseHandler $responseHandler
    ) {
        $this->queryAdapter    = $queryAdapter;
        $this->handler    = $handler;
        $this->responseHandler = $responseHandler;
    }

    public function index(string $name)
    {
        // 1. Transform Request to Query.
        $query = $this->queryAdapter->getQueryFromRequest($name);

        // 2. Business work due to the Query handler.
        $handler = $this->handler;
        $result = $handler($query);

        // 3. Format using the business work and return the Response.
        return $this->responseHandler->success($result);
    }
}
