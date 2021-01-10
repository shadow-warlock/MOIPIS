<?php

namespace App\Controller;

use App\Entity\Measure;
use App\Entity\ProductClass;
use App\Service\Serializer;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductClassController extends AbstractController
{
    private Serializer $serializer;

    /**
     * MeasureController constructor.
     *
     * @param  Serializer  $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }


    /**
     * @Route("/api/product_class", methods={"GET"})
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $root = $request->get('onlyRoot', false);
        if($root === ""){
            $classes = $this->getDoctrine()->getRepository(ProductClass::class)
                ->findBy(['parent'=>null]);
        }else{
            $classes = $this->getDoctrine()->getRepository(ProductClass::class)
                ->findAll();
        }
        return new JsonResponse(
            $this->serializer->toJSON($classes),
            200,
            [],
            true
        );
    }

    /**
     * @Route("/api/measure/{id}", methods={"GET"})
     * @param  Measure  $measure
     *
     * @return Response
     */
    public function one(Measure $measure): Response
    {
        return new JsonResponse(
            $this->serializer->toJSON($measure),
            200,
            [],
            true
        );
    }

}
