<?php

namespace App\Infra\User\Repository;

use Doctrine\ORM\EntityRepository;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\UserId;

/**
 * Class UserRepository
 * 
 * @package App\Infra\User\Repository
 */
class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    public function findOneByUsername(string $username): ?User
    {
        return $this->createQueryBuilder('user')
            ->where('user.auth.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
//            ->useResultCache(true, null, 'user.findByUsername'.$username)
            ->getOneOrNullResult()
        ;
    }

    public function findOneByUuid(UserId $userId): ?User
    {
        return $this->createQueryBuilder('user')
            ->where('user.uuid = :id')
            ->setParameter('id', $userId->bytes())
            ->getQuery()
//            ->useResultCache(true, null, 'user.findOneById'.$username)
            ->getOneOrNullResult()
        ;
    }

    public function getOneByUuid(UserId $userId): User
    {
        $user = $this->findOneByUuid($userId);

        if (!$user) {

            throw new UserNotFoundException();
        }

        return $user;
    }

    public function save(User $user): void
    {
        $this->_em->persist($user);
    }
}
