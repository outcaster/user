<?php
declare(strict_types = 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        $a=5;

        if ($a!=5) {
            echo 'hola';
        }

        return $this->json(
            [
                'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/TestController.php',
            ]
        );
    }
}
