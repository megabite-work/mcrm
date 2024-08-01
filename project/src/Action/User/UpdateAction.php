<?php

namespace App\Action\User;

use App\Dto\User\ResponseDto;
use App\Dto\User\UpdateRequestDto;
use App\Repository\AddressRepository;
use App\Repository\PhoneRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $repo,
        private AddressRepository $addressRepo,
        private PhoneRepository $phoneRepo
    ) {
    }

    public function __invoke(int $id, UpdateRequestDto $dto): ResponseDto
    {
        $user = $this->repo->find($id);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        if ($dto->getEmail()) {
            $user->setEmail($dto->getEmail());
        }

        $this->phoneRepo->checkPhoneExistsAndCreate($user, $dto->getPhones());

        $this->addressRepo->checkAddressExistsAndUpdateOrCreate($user, $dto);

        $this->em->flush();

        return new ResponseDto($user);
    }
}
