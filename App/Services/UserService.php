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
        $userFromDb = $this->userRepository->findOneByUsername($username);

        if (null === $userFromDb) {
            return null;
        }

        if (false === $this->encryptionService->verify($password, $userFromDb->getPassword())) {
            return null;
        }

        return $userFromDb;
    }

    public function currentUser(): ?UserDTO
    {
        if (!$_SESSION['id']) {
            return null;
        }

        return $this->userRepository->findOneById(intval($_SESSION['id']));
    }

    public function isLogged(): bool
    {
        if (!$this->currentUser()) {
            return false;
        }

        return true;
    }

    public function edit(UserDTO $userDTO): bool
    {

        if (null !== $this->userRepository->findOneByUsername($userDTO->getUsername())) {
            return false;
        }

        $this->encryptPassword($userDTO);

        return $this->userRepository->update(intval($_SESSION['id']), $userDTO);

    }

    public function getAll(): \Generator
    {
        return $this->userRepository->findAll();
    }

    private function encryptPassword($userDTO)
    {
        $plainPassword = $userDTO->getPassword();
        $passwordHash = $this->encryptionService->hash($plainPassword);
        $userDTO->setPassword($passwordHash);
    }
}