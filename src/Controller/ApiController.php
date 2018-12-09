<?php

namespace App\Controller;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class ApiController extends AbstractController
{
    protected $serializer;
    protected $groups;

    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $this->serializer = new Serializer([new ObjectNormalizer($classMetadataFactory)], [new JsonEncoder]);
    }

    protected function jsonResponse($data)
    {
        return $this->json($this->serializer->normalize($data, null, ['groups' => $this->groups]));
    }
}
