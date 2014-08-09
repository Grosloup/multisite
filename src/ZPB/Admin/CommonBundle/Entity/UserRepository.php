<?php

namespace ZPB\Admin\CommonBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository implements UserProviderInterface
{
    public function countUsers()
    {
        return $this->createQueryBuilder('u')->select('COUNT(u)')->getQuery()->getSingleScalarResult();
    }

    public function findAllAlphaOrdered()
    {
        $qb = $this->createQueryBuilder("u")->orderBy("u.lastname", "ASC");
        return $qb->getQuery()->getResult();
    }

    public function findOneByUsernameOrEmail($field = "")
    {
        $qb = $this->createQueryBuilder('u')->andWhere('u.username=:username OR u.primaryEmail=:email')
            ->setParameter('username', $field)
            ->setParameter('email', $field);
        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @see UsernameNotFoundException
     *
     * @throws UsernameNotFoundException if the user is not found
     *
     */
    public function loadUserByUsername($username)
    {
        $user = $this->findOneByUsernameOrEmail($username);

        if(!$user){
            throw new UsernameNotFoundException();
        }

        return $user;
    }

    /**
     * Refreshes the user for the account interface.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the account is not supported
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if(!$this->supportsClass($class)){
            throw new UnsupportedUserException();
        }
        if(null === $user = $this->find($user->getId())){
            throw new UsernameNotFoundException();
        }
        return $user;
    }

    /**
     * Whether this provider supports the given user class
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
    }


}