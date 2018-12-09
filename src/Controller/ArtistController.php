<?php

namespace App\Controller;

use App\Entity\Artist;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends ApiController
{
    protected $groups = ['artist'];

    /**
     * @Route("/artists", name="artist_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $artists = $this->getDoctrine()->getRepository(Artist::class)->findAll();

        return $this->jsonResponse($artists);
    }

    /**
     * @Route("/artists/{token}", name="artist_show")
     * @param Artist $artist
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Artist $artist)
    {
        return $this->jsonResponse($artist);
    }
}
