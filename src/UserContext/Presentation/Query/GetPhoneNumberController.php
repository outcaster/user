<?php

namespace App\UserContext\Presentation\Query;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GetPhoneNumberController extends AbstractController
{
    /**
     * @Route("/get/phone/number", name="get_phone_number")
     */
    public function index()
    {
        // get request information with the query adapter

        // call to the query handler

        // return the query response

        die("im alive");

        /*return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/GetPhoneNumberController.php',
        ]);*/
    }
}
