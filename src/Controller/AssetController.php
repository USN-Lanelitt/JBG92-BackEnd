<?php

namespace App\Controller;

use App\Entity\AssetCategories;
use App\Entity\Individuals;
use App\Entity\Users;
use Psr\Log\LoggerInterface;
use App\Entity\Assets;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

header("Access-Control-Allow-Origin: *");

class AssetController extends AbstractController{

    private $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger=$logger;
    }
    public function addAsset(Request $request){
        $ut="\n\n**************************************************************************\n\n";
        $this->logger->info($ut);
        $content = json_decode($request->getContent());

        $iIndividId = $content->individId;
        $iCategoryId = $content->categoryId;
        $sAssetName = $content->assetName;
        $tDescription = $content->description;

        $individual=$this->getDoctrine()->getRepository(Individuals::class)->find($iIndividId);
        $assetCategory=$this->getDoctrine()->getRepository(AssetCategories::class)->find($iCategoryId);

        $asset=new Assets();
        $asset->setIndivid($individual);
        $asset->setCategory($assetCategory);
        $asset->setAssetname($sAssetName);
        $asset->setDescription($tDescription);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($asset);
        $entityManager->flush();


        $this->logger->info($ut);

        $this->logger->info($ut);

        return new JsonResponse("Eiendel lagd til");
    }

    public function getAllAssets(){

    }
    public function getPersonsAssets(Request $request){
        $content = json_decode($request->getContent());

        $iIndividId = $content->individId;
        $individual=$this->getDoctrine()->getRepository(Individuals::class)->find($iIndividId);
    }
    public function getAsset(Request $request){

    }
    public function edditAsset(){

    }
    public function removeAsset(){

    }
}