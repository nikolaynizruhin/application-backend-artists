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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($token)
    {
        $artist = $this->getDoctrine()->getRepository(Artist::class)->find($token);

        if (!$artist) {
            return $this->json(['message' => 'Artist not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($this->serializer->normalize($artist, null, ['groups' => ['artist']]));
    }
}
