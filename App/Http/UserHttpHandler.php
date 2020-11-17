<?php


namespace App\Http;


use App\Data\UserDTO;
use App\Services\UserServiceInterface;

class UserHttpHandler extends UserHttpHandlerAbstract
{
    public function register(UserServiceInterface $userService, array $formData = [])
    {
        if (isset($formData['register'])) {
            $this->handleRegisterProcess($userService, $formData);
        } else {
            $this->render("users/register");
        }
    }

    private function handleRegisterProcess(UserServiceInterface $userService, array $formData)
    {
        $user = UserDTO::create(
            $formData['username'],
            $formData['password'],
            $formData['first_name'],
            $formData['last_name'],
            $formData['born_on'],
        );

        if ($userService->register($user, $formData['confirm_password'])) {
            $this->redirect("login.php");
        } else {

        }
    }

    public function login(UserServiceInterface $userService, array $data = [])
    {
        if (isset($formData['login'])) {
            $this->handleLoginProcess($userService, $formData);
        } else {
            $this->render("users/login");
        }
    }

    private function handleLoginProcess(UserServiceInterface $userService, $formData)
    {
        $user = $userService->login($formData['username'], $formData['password']);

        if (null !== $user) {
            $_SESSION['id'] = $user->getId();
            $this->redirect("profile.php");
        } else {
            echo "<h1>Wrong credentials!</h1>";
        }
    }
}