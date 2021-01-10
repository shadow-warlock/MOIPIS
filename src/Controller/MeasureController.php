<?php

namespace App\Controller;

use App\Entity\Measure;
use App\Service\Serializer;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeasureController extends AbstractController
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
     * @Route("/api/measure", methods={"GET"})
     *
     * @return Response
     */
    public function index(): Response
    {
        $measures = $this->getDoctrine()->getRepository(Measure::class)
            ->findAll();

        return new JsonResponse(
            $this->serializer->toJSON($measures),
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

    /**
     * @Route("/api/measure", methods={"POST"})
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $measure = new Measure();
        $measure->setName($data['name']);
        $measure->setSi($data['si']);
        $this->getDoctrine()->getManager()->persist($measure);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(
            $this->serializer->toJSON($measure),
            201,
            [],
            true
        );
    }

    /**
     * @Route("/api/measure/{id}", methods={"PUT"})
     * @param  Request  $request
     * @param  Measure  $measure
     *
     * @return Response
     */
    public function edit(Request $request, Measure $measure): Response
    {
        $data = json_decode($request->getContent(), true);
        $measure->setName($data['name']);
        $measure->setSi($data['si']);
        $this->getDoctrine()->getManager()->persist($measure);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(
            $this->serializer->toJSON($measure),
            200,
            [],
            true
        );
    }

    /**
     * @Route("/api/measure/{id}", methods={"DELETE"})
     * @param  Measure  $measure
     *
     * @return Response
     */
    public function delete(Measure $measure): Response
    {
        $this->getDoctrine()->getManager()->remove($measure);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(
            $this->serializer->toJSON($measure),
            200,
            [],
            true
        );
    }
}
