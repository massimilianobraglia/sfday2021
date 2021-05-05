<?php

declare(strict_types=1);

namespace App\GraphQL\Controller;

use App\Entity\Band;
use App\Entity\RecordLabel;
use App\Entity\User;
use App\GraphQL\Type\InputType\CreateBandInput;
use App\GraphQL\Type\InputType\UpdateBandInput;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use TheCodingMachine\GraphQLite\Annotations as GQL;
use TheCodingMachine\GraphQLite\Exceptions\GraphQLException;
use TheCodingMachine\Graphqlite\Validator\Annotations\Assertion;
use TheCodingMachine\Graphqlite\Validator\ValidationFailedException;

class MutationController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator,
        private UserPasswordEncoderInterface $userPasswordEncoder
    ) {
    }

    #[GQL\Mutation]
    public function createRecordLabel(string $name): RecordLabel
    {
        $recordLabel = new RecordLabel($name);
        $this->entityManager->persist($recordLabel);
        $this->entityManager->flush();

        return $recordLabel;
    }

    #[GQL\Mutation]
    public function createBand(CreateBandInput $input): Band
    {
        ValidationFailedException::throwException($this->validator->validate($input));

        $band = new Band($input->name, $input->foundationDate, $input->genre);
        $this->entityManager->persist($band);
        $this->entityManager->flush();

        return $band;
    }

    /**
     * @Assertion(for="$input", constraint={@Assert\Valid})
     */
    #[GQL\Mutation]
    public function updateBand(UpdateBandInput $input): Band
    {
        $band = $this->entityManager->find(Band::class, $input->id);
        if (null === $band) {
            throw new GraphQLException('Could not find Band with id '.$input->id, Response::HTTP_NOT_FOUND);
        }

        if (null !== $input->name) {
            $band->updateName($input->name);
        }

        if (null !== $input->foundationDate) {
            $band->updateFoundationDate($input->foundationDate);
        }

        if (null !== $input->genre) {
            $band->updateGenre($input->genre);
        }

        $this->entityManager->flush();

        return $band;
    }

    #[GQL\Mutation]
    public function signup(string $username, string $password): UserInterface
    {
        $user = new User($username);
        $user->setPassword($password, $this->userPasswordEncoder);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}