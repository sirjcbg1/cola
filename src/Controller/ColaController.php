<?php

namespace App\Controller;

use App\Entity\Cola;
use App\Form\ColaType;
use App\Repository\ColaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\Exception;


class ColaController extends AbstractController
{


    private $colaRepository;

    public function __construct(colaRepository $colaRepository)
    {
        $this->colaRepository = $colaRepository;
    }

    /**
     * @Route("/api/cola", name="add_cola", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $userId = $data['id'];
        if (empty($userId)) {
            throw new NotFoundHttpException('Agregue todos los parametros obligatorios!');
        }
        $result=$this->colaRepository->getMejorTiempo();
        if(isset($result[0])){
            $idCola=$result[0]["id"];
        }else{
            $idCola=1;
        }
        $this->colaRepository->saveUser($userId,$idCola);
        return new JsonResponse(['status' => 'Cola Creada!'], Response::HTTP_OK);
    }

    /**
     * @Route("/api/cola/{id}", name="respuestas_result", methods={"GET"})
     */
    public function getCola($id): JsonResponse
    {
        try {
            $data = $this->getDoctrine()
            ->getRepository(Cola::class)
            ->getColaById($id);    
            return new JsonResponse($data,200);  
        } catch (Exception $e) {
            return new JsonResponse(['error'=>'Error del Servidor'],500);
        }
    }
    

}
