<?php

namespace App\Action\CashboxShift;

use App\Entity\Cashbox;
use App\Entity\CashboxShift;
use App\Dto\CashboxShift\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;
use App\Entity\User;
use App\Repository\CashboxShiftRepository;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CashboxShiftRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): CashboxShift
    {
        $cashboxShift = $this->create($dto);

        $this->em->flush();

        return $cashboxShift;
    }

    private function create(RequestDto $dto): CashboxShift
    {
        $cashbox = $this->getCashbox($dto);
        $user = $this->getUser($dto);

        $cashboxShift = (new CashboxShift())
            ->setShiftNumber($dto->getShiftNumber())
            ->setUser($user)
            ->setCashbox($cashbox);

        $this->em->persist($cashboxShift);

        return $cashboxShift;
    }

    private function getCashbox(RequestDto $dto): Cashbox
    {
        $cashbox = $this->em->find(Cashbox::class, $dto->getCashboxId());

        if (null === $cashbox) {
            throw new EntityNotFoundException('not found', 404);
        }

        return $cashbox;
    }

    private function getUser(RequestDto $dto): User
    {
        $user = $this->em->find(User::class, $dto->getUserId());

        if (null === $user) {
            throw new EntityNotFoundException('not found', 404);
        }

        return $user;
    }
}
