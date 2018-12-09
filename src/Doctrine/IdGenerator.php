<?php

namespace App\Doctrine;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\ORM\EntityManager;
use App\Utils\TokenGenerator;

class IdGenerator extends AbstractIdGenerator
{
    const LENGTH = 6;

    public function generate(EntityManager $em, $entity)
    {
        do {
            $token = TokenGenerator::generate(self::LENGTH);
        } while ($em->getRepository(get_class($entity))->find($token));

        return $token;
    }
}
