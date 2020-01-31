<?php


namespace App\Controller;


use App\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

$request = Request::createFromGlobals();

header("Access-Control-Allow-Origin: *");

class LogginController extends AbstractController{

    private $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger=$logger;
    }
    public function login(Request $request) {


        $content = json_decode($request->getContent());
        $sUsername = $content->username;
        $sPassword = $content->password;

        $conn = $this->getDoctrine()->getConnection();

        $sql='select * from user where name= :username';
        $stmt=$conn->prepare($sql);
        $stmt->execute(['username'=>$sUsername]);

        $return = $stmt->fetchAll();

        $db_iId       = "";
        $db_sUsername = "";
        $db_sPassword = "";

        if (count($return) > 0)
        {
            $db_iId       = $return[0]['id'];
            $db_sUsername = $return[0]['name'];
            $db_sPassword = $return[0]['password'];
        }
        $this->logger->info($sPassword);
        $this->logger->info($db_sPassword);

        if ($sPassword == $db_sPassword)
        {
            $sFeedback = "Bruker ". $db_sUsername ." er logget inn. ID: ".$db_iId;
        }
        else
        {
            $sFeedback = "Brukernavn eller passord finnes ikke";
        }

        return new JsonResponse( $sFeedback);
    }
}