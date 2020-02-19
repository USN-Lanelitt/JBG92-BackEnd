<?php


namespace App\Controller;



use App\Entity\Individuals;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\DBAL\Driver\Connection;

header("Access-Control-Allow-Origin: *");

class RegisterUserController extends AbstractController{
    /*public function registerUser(Connection $connection/*, $name, $pass/){


        $connection->query('Insert into bruker VALUES("per", "123")');
    }*/
    public function registerUser(Request $request)
    {
        $content = json_decode($request->getContent());
        $sUsername = $content->username;
        $sPassword = $content->password;

        $user = new Individuals();
        $user->setFirstName($sUsername);
        $user->setLastName($sPassword);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse("Person lagd til");
    }
}