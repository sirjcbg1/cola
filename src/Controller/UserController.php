<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController  extends AbstractController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/api/user", name="add_user", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $nombre = $data['nombre'];
        if (empty($nombre)) {
            throw new NotFoundHttpException('Agregue todos los parametros obligatorios!');
        }
        $id  =$this->userRepository->saveUser($nombre);

        return new JsonResponse(['status' => 'Usuario Creado!',"id"=>$id], Response::HTTP_OK);
    }


    /**
     * @Route("user/form", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.php');

    }

    
}
