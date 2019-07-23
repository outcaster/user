<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GetPhoneNumberController extends AbstractController
{
    /**
     * @Route("/get/phone/number", name="get_phone_number")
     */
    public function index()
    {

        die("im alive");

        /*return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/GetPhoneNumberController.php',
        ]);*/
    }
}
