<?php

namespace App\Controller;

use App\Entity\Album;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends ApiController
{
    /**
     * @Route("/albums/{token}", name="album_show")
     * @param Album $album
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Album $album)
    {
        return $this->json($this->serializer->normalize($album, null, ['groups' => ['album']]));
    }
}
