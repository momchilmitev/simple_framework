<?php


namespace App\Services;


use App\Data\UserDTO;
use App\Repositories\UserRepositoryInterface;
use App\Services\Encryption\EncryptionServiceInterface;

class UserService implements UserServiceInterface
{

    private UserRepositoryInterface $userRepository;
    private EncryptionServiceInterface $encryptionService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EncryptionServiceInterface $encryptionService
    )
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
    }

    public function register(UserDTO $userDTO, string $confirmPassword): bool
    {
        if ($userDTO->getPassword() !== $confirmPassword) {
            return false;
        }

        if (null !== $this->userRepository->findOneByUsername($userDTO->getUsername())) {
            return false;
        }

        $this->encryptPassword($userDTO);
        return  $this->userRepository->insert($userDTO);
    }

    public function login(string $username, string $password): ?UserDTO
    {
        // TODO: Implement login() method.
    }

    public function currentUser(): ?UserDTO
    {
        // TODO: Implement currentUser() method.
    }

    public function isLogged(): bool
    {
        // TODO: Implement isLogged() method.
    }

    public function edit(UserDTO $userDTO): bool
    {
        // TODO: Implement edit() method.
    }

    public function getAll(): \Generator
    {
        // TODO: Implement getAll() method.
    }

    private function encryptPassword($userDTO)
    {
        $plainPassword = $userDTO->getPassword();
        $passwordHash = $this->encryptionService->hash($plainPassword);
        $userDTO->setPassword($passwordHash);
    }
}