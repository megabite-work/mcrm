<?php

namespace App\Action\Permission;

use App\Dto\Permission\AssignDto;
use App\Entity\Permission;
use App\Entity\User;
use App\Exception\ErrorException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class AssignAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(array $dtos): void
    {
        $user = $this->em->find(User::class, $dtos[0]->getUserId());
        $oldPermissions = array_map(fn($id) => $this->em->find(Permission::class, $id), array_diff(
            array_map(fn($dto) => $dto->permissionId, $dtos),
            array_map(fn($permission) => $permission->getId(), $user->getPermissions()->toArray())
        ));

        try {
            $this->em->beginTransaction();
            foreach ($dtos as $dto) {
                $this->assign($dto, $user);
            }
            foreach ($oldPermissions as $permission) {
                $user->removePermission($permission);
            }

            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new ErrorException('Permission', $th->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    private function assign(AssignDto $dto, User $user): void
    {
        $permission = $this->em->getReference(Permission::class, $dto->permissionId);
        $user->addPermission($permission);
    }
}
