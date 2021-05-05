<?php

declare(strict_types=1);

namespace App\GraphQL\Type;

use App\Entity\Band;
use App\Entity\Album;
use App\Repository\BandRepository;
use Doctrine\ORM\EntityManagerInterface;
use TheCodingMachine\GraphQLite\Annotations as GQL;

#[GQL\Type(class: Album::class)]
#[GQL\SourceField(name: 'id', outputType: 'ID')]
#[GQL\SourceField(name: 'name')]
class AlbumType
{
    private BandRepository $bandRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->bandRepository = $entityManager->getRepository(Band::class);
    }

    /** @param Band[] $prefetchedBands */
    #[GQL\Field(prefetchMethod: 'prefetchBands')]
    public function getBand(Album $album, ?array $prefetchedBands = null): Band
    {
        return $prefetchedBands[$album->getBand()->getId()];
    }

    #[GQL\Field]
    public function getBandBadPerformance(Album $album): Band
    {
        return $album->getBand();
    }

    /**
     * @param Album[] $albums
     *
     * @return Band[]
     */
    public function prefetchBands(array $albums): array
    {
        $bandIds = \array_values(\array_unique(\array_map(fn (Album $album): int => $album->getBand()->getId(), $albums)));

        return $this->bandRepository->createQueryBuilder('band', 'band.id')
            ->where('band IN (:band_ids)')
            ->setParameter('band_ids', $bandIds)
            ->getQuery()
            ->getResult()
        ;
    }
}