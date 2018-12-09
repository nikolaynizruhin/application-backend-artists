<?php

namespace App\Controller;

use App\Entity\Album;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends ApiController
{
    /**
     * @Route("/albums/{token}", name="album_show")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($token)
    {
        $album = $this->getDoctrine()->getRepository(Album::class)->find($token);

        if (!$album) {
            return $this->json(['message' => 'Album not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($this->serializer->normalize($album, null, ['groups' => ['album']]));
    }
}
