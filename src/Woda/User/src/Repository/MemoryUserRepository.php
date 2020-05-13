<?php

declare(strict_types=1);

namespace Woda\User\Repository;

use Closure;
use Woda\Core\ValueObject\Email;
use Woda\User\User;

use function array_filter;
use function array_map;
use function array_values;

final class MemoryUserRepository implements UserRepositoryInterface
{
    /**
     * @var array<string, string>
     */
    private array $users = [];

    public function save(User $user): void
    {
        $this->users[$user->getEmail()->toString()] = serialize($user);
    }

    public function findById(string $id): User
    {
        return $this->findOneUser(
            function (User $user) use ($id): bool {
                return $user->getId() === $id;
            }
        );
    }

    public function findByEmail(Email $email): ?User
    {
        return $this->findOneUser(
            function (User $user) use ($email): bool {
                return $user->getEmail()->equals($email);
            }
        );
    }

    private function findOneUser(Closure $callback): ?User
    {
        $found = $this->findUsers($callback);
        if ($found < 1) {
            return null;
        }
        return $found[0];
    }

    /**
     * @return User[]
     */
    private function findUsers(Closure $callback): array
    {
        return array_values(array_filter($this->unserializeUsers(), $callback));
    }

    private function unserializeUsers()
    {
        return array_map(
            function (string $serialized): User {
                return unserialize($serialized);
            },
            $this->users
        );
    }
}
