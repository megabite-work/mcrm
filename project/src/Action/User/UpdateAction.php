<?php

namespace App\Action\User;

use App\Dto\User\ShowResponseDto;
use App\Dto\User\UpdateRequestDto;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $userRepo
    ) {
    }

    public function __invoke(int $id, UpdateRequestDto $dto): ShowResponseDto
    {
        $user = $this->userRepo->find($id);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        if ($dto->getEmail()) {
            $user->setEmail($dto->getemail());
        } else if ($dto->getphone()) {
            $user->setPhone($dto->getPhone());
        }

        $this->em->flush();

        return new ShowResponseDto($user);
    }
}
