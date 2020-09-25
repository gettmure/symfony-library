<?php


namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture {
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager) {
        $this->createMany(10, 'main_users', function ($i) {
            $user = new User();
            $user->setEmail($this->faker->email);
            $user->setUsername(sprintf('username%d', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setLastname($this->faker->lastName);
            $user->setEnabled(true);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'username'
            ));
            return $user;
        });
        $this->createMany(3, 'admin_users', function ($i) {
            $user = new User();
            $user->setEmail(sprintf($this->faker->email));
            $user->setUsername(sprintf('admin%d', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setLastname($this->faker->lastName);
            $user->addRole('ROLE_ADMIN');
            $user->setEnabled(true);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'admin'
            ));
            return $user;
        });
        $manager->flush();
    }
}