<?php
/**
 * Created by PhpStorm.
 * User: Bartek
 * Date: 13.02.2019
 * Time: 16:35
 */

namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationService
{
    private $em;
    private $pe;

    public function __construct(EntityManager $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->em = $entityManager;
        $this->pe = $passwordEncoder;
    }

    public function register(User $user)
    {
        $password = $this->pe->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);

            $this->em->persist($user);
            $this->em->flush();
    }


}