<?php


namespace App\Repositories;


use App\Data\UserDTO;
use Database\DatabaseInterface;

class UserRepository implements UserRepositoryInterface
{
    private DatabaseInterface $db;

    public function __construct(DatabaseInterface $database)
    {
        $this->db = $database;
    }

    public function insert(UserDTO $userDTO): bool
    {
        $this->db->query(
            "INSERT INTO users(username, password, first_name, last_name, born_on)
                    VALUES (?, ?, ?, ?, ?)
        ")->execute([
            $userDTO->getUsername(),
            $userDTO->getPassword(),
            $userDTO->getFirstName(),
            $userDTO->getLastName(),
            $userDTO->getBornOn(),
        ]);

        return true;
    }

    public function findOneByUsername(string $username): ?UserDTO
    {
        return $this->db->query("
            SELECT username, password, first_name, last_name, born_on
            FROM users
            WHERE username = ?
        ")
            ->execute([$username])
            ->fetch(UserDTO::class)
            ->current();
    }

    public function findOneById(int $id): ?UserDTO
    {
        return $this->db->query("
            SELECT username, password, first_name, last_name, born_on
            FROM users
            WHERE id = ?
        ")
            ->execute([$id])
            ->fetch(UserDTO::class)
            ->current();
    }

    public function findAll(): \Generator
    {
        return $this->db->query("
            SELECT username, password, first_name, last_name, born_on
            FROM users
        ")
            ->execute()
            ->fetch(UserDTO::class);
    }

    public function update(int $id, UserDTO $userDTO): bool
    {
        $this->db->query("
            UPDATE users
            SET
                username = ?,
                password = ?,
                first_name = ?,
                last_name = ?,
                born_on = ?
            WHERE id = ? 
        "
        )->execute([
            $userDTO->getUsername(),
            $userDTO->getPassword(),
            $userDTO->getFirstName(),
            $userDTO->getLastName(),
            $userDTO->getBornOn(),
            $id
        ]);

        return true;
    }

    public function delete(int $id): bool
    {
        $this->db->query("DELETE FROM users WHERE id = ?")->execute([$id]);

        return true;
    }
}