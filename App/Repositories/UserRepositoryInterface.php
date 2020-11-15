<?php


namespace App\Repositories;


use App\Data\UserDTO;

interface UserRepositoryInterface
{
    public function insert(UserDTO $userDTO): bool;

    public function findOneByUsername(string $username): ?UserDTO;

    public function findOneById(int $id): ?UserDTO;

    /**
     * @return \Generator|UserDTO[]
     */
    public function findAll(): \Generator;

    public function update(int $id, UserDTO  $userDTO): bool;

    public function delete(int $id): bool;
}