<?php

declare(strict_types=1);

namespace Woda\MezzioModule\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Woda\Core\ValueObject\Email;
use Woda\MezzioModule\User\Exception\UserNotFoundException;
use Woda\User\Repository\UserRepositoryInterface;
use Woda\User\User;

final class DoctrineOrmUserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }

    public function findById(string $id): User
    {
        $user = $this->repository->find($id);
        if (!$user instanceof User) {
            throw UserNotFoundException::fromId($id);
        }
        return $user;
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findByEmail(Email $email): ?User
    {
        $user = $this->repository->findOneBy(['email' => $email]);
        if (!$user instanceof User) {
            return null;
        }
        return $user;
    }
}
