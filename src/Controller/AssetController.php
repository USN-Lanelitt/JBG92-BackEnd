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
        $ut="heisan og hoppsan og fallerallera**************************************************************************\n";

        $content = json_decode($request->getContent());

        $iIndividId = $content->individId;
        $iCategoryId = $content->categoryId;
        $sAssetName = $content->assetName;
        $tDescription = $content->description;
        $sAssetCondition = $content->assetCondition;

        $this->logger->info($ut);
        $individual=$this->getDoctrine()->getRepository(Individuals::class)->find($iIndividId);
        $this->logger->info($ut);
        $assetCategory=$this->getDoctrine()->getRepository(AssetCategories::class)->find($iCategoryId);

        $this->logger->info($ut);
        $asset=new Assets();
        $asset->setIndivid($individual);
        $asset->setCategory($assetCategory);
        $asset->setAssetname($sAssetName);
        $asset->setDescription($tDescription);
        $asset->setAssetCondition($sAssetCondition);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($asset);
        $entityManager->flush();

        //$conn = $this->getDoctrine()->getConnection();

       // $sql='INSERT INTO assets(individ_id, category_id, assettype_id, assetname, description, asset_condition) VALUES(:individId, :categoryId, :assetTypeId, :assetName, :description, :assetCondition)';


        $this->logger->info($ut);
        //$this->logger->info($sql);
        //$stmt=$conn->prepare($sql);
        //$stmt->execute(['individId'=>$sIndividId, 'category'=>$sCategoryId, 'assetTypeId'=>$sAssetTypeId, 'assetName'=>$sAssetName, 'description'=>$sDescription, 'assetCondition'=>$sAssetCondition]);


        $this->logger->info($ut);

        //$this->logger->info($sql);

        return new JsonResponse("Eiendel lagd til");
    }

    public function getPersonsAssets(Request $request){
        $content = json_decode($request->getContent());

        $iIndividId = $content->individId;
        $individual=$this->getDoctrine()->getRepository(Individuals::class)->find($iIndividId);

        
    }
    public function edditAsset(){

    }
    public function removeAsset(){

    }
}