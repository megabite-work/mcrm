<?php

namespace App\Action\User;

use App\Dto\ForgotPassword\RequestDto;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class ForgotPasswordAction
{
    public function __construct(
        private UserRepository $repo,
        private EntityManagerInterface $em,
        private MailerInterface $mailer
    ) {}

    public function __invoke(RequestDto $dto): array
    {
        $user = $this->repo->findOneBy(['email' => $dto->email])
            ?? throw new UserNotFoundException();

        if (!$user->getExpiresAt() || $user->isTokenExpired()) {
            $resetToken = bin2hex(random_bytes(32));
            $user->setToken($resetToken);
            $user->setExpiresAt(new \DateTime());
            $this->em->flush();

            $email = (new Email())
                ->to($user->getEmail())
                ->subject('Password Reset Request')
                ->html('<p>Чтобы сбросить пароль, нажмите ссылку: <a href="https://react.mcrm.uz/reset-password/' . $resetToken . '">Сбросить пароль</a></p>');
            $this->mailer->send($email);
        }

        return [];
    }
}
