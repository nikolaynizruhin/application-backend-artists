<?php

namespace App\Controller;

use App\Entity\Artist;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends ApiController
{
    /**
     * @Route("/artists", name="artist_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $artists = $this->getDoctrine()->getRepository(Artist::class)->findAll();

        return $this->json($this->serializer->normalize($artists, null, ['groups' => ['artist']]));
    }

    /**
     * @Route("/artists/{token}", name="artist_show")
     * @param Artist $artist
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Artist $artist)
    {
        return $this->json($this->serializer->normalize($artist, null, ['groups' => ['artist']]));
    }
}
