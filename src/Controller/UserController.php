<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;

class UserController
{

    public function getUsers() {
        //sleep(1);
        return new JsonResponse(
            array(
                array(
                    "username" => "John",
                    "password" => "JohnEBest",
                    "fullName" => "John-Berge Grimaas"
                ),
                array(
                    "username" => "patrick",
                    "password" => "patrick12",
                    "fullName" => "Patrick Lorentzen"
                ),
                array(
                    "username" => "michael",
                    "password" => "michael12",
                    "fullName" => "Micael Ronnevik"
                )
            )
        );
    }
}