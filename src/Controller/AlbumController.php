<?php

namespace App\Controller;

use App\Entity\Album;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends ApiController
{
    protected $groups = ['album'];

    /**
     * @Route("/albums/{token}", name="album_show")
     * @param Album $album
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Album $album)
    {
        return $this->jsonResponse($album);
    }
}
