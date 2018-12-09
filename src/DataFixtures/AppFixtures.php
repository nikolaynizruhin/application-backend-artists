<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Song;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const URL = 'https://gist.githubusercontent.com/fightbulc/9b8df4e22c2da963cf8ccf96422437fe/raw/8d61579f7d0b32ba128ffbf1481e03f4f6722e17/artist-albums.json';

    public function load(ObjectManager $manager)
    {
        $artistsData = json_decode(file_get_contents(self::URL), true);

        foreach ($artistsData as $artistData) {
            $artist = $this->persistArtist($artistData, $manager);

            foreach ($artistData['albums'] as $albumData) {
                $albumData['artist'] = $artist;
                $album = $this->persistAlbum($albumData, $manager);

                foreach ($albumData['songs'] as $songData) {
                    $songData['album'] = $album;
                    $this->persistSong($songData, $manager);
                }
            }
        }

        $manager->flush();
    }

    private function persistArtist(array $data, ObjectManager $manager)
    {
        $artist = new Artist();
        $artist->setName($data['name']);

        $manager->persist($artist);

        return $artist;
    }

    private function persistAlbum(array $data, ObjectManager $manager)
    {
        $album = new Album();
        $album->setTitle($data['title']);
        $album->setCover($data['cover']);
        $album->setDescription($data['description']);
        $album->setArtist($data['artist']);

        $manager->persist($album);

        return $album;
    }

    private function persistSong(array $data, ObjectManager $manager)
    {
        $song = new Song();
        $song->setTitle($data['title']);
        $song->setLength($this->lengthToSeconds($data['length']));
        $song->setAlbum($data['album']);

        $manager->persist($song);

        return $song;
    }

    private function lengthToSeconds($length)
    {
        sscanf($length, "%d:%d", $minutes, $seconds);

        return $minutes * 60 + $seconds;
    }
}
