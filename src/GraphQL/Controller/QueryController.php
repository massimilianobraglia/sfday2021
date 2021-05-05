<?php

declare(strict_types=1);

namespace App\GraphQL\Controller;

use App\Entity\Webzine;
use App\Entity\Band;
use App\Entity\Album;
use App\Entity\RecordLabel;
use App\Entity\User;
use App\GraphQL\Type\WebzineType;
use App\GraphQL\Type\MyFirstType;
use App\Repository\WebzineRepository;
use App\Repository\AlbumRepository;
use App\Repository\BandRepository;
use App\Repository\RecordLabelRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use TheCodingMachine\GraphQLite\Annotations as GQL;

class QueryController
{
    private RecordLabelRepository $recordLabelRepository;

    private WebzineRepository $webzineRepository;

    private BandRepository $bandRepository;

    private AlbumRepository $albumRepository;

    private UserRepository $userRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->recordLabelRepository = $entityManager->getRepository(RecordLabel::class);
        $this->webzineRepository = $entityManager->getRepository(Webzine::class);
        $this->bandRepository = $entityManager->getRepository(Band::class);
        $this->albumRepository = $entityManager->getRepository(Album::class);
        $this->userRepository = $entityManager->getRepository(User::class);
    }

    #[GQL\Query]
    public function myFirstQuery(): MyFirstType
    {
        return new MyFirstType();
    }

    /** @return RecordLabel[] */
    #[GQL\Query(name: 'recordLabels')]
    public function getRecordLabels(): array
    {
        return $this->recordLabelRepository->findAll();
    }

    /** @return WebzineType[] */
    #[GQL\Query(name: 'webzines')]
    public function getWebzines(): array
    {
        return \array_map(fn (Webzine $webzine): WebzineType => new WebzineType($webzine), $this->webzineRepository->findAll());
    }

    /** @return Band[] */
    #[GQL\Query(name: 'bands')]
    public function getBands(?int $fromId): array
    {
        $queryBuilder = $this->bandRepository->createQueryBuilder('band');

        if (null !== $fromId) {
            $queryBuilder
                ->where('band.id >= :from_id')
                ->setParameter('from_id', $fromId)
            ;
        }

        return $queryBuilder->getQuery()->getResult();
    }

    /** @return Album[] */
    #[GQL\Query(name: 'albums')]
    public function getAlbums(): array
    {
        return $this->albumRepository->findAll();
    }

    /** @return UserInterface[] */
    #[GQL\Query(name: 'users')]
    #[GQL\Logged]
    public function getUsers(): array
    {
        return $this->userRepository->findAll();
    }

    /** @return string[] */
    #[GQL\Query]
    #[GQL\Security(expression: "is_granted('ROLE_ADMIN')")]
    public function nonAccessible(): array
    {
        return ['this is' => 'not accessible'];
    }
}