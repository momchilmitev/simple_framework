<?php


namespace App\Http;


use App\Data\ErrorDTO;
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
        $user = $this->dataBinder->bind($formData, UserDTO::class);

        if ($userService->register($user, $formData['confirm_password'])) {
            $this->redirect("login.php");
        } else {

        }
    }

    public function login(UserServiceInterface $userService, array $formData = [])
    {
        if (isset($formData['login'])) {
            $this->handleLoginProcess($userService, $formData);
        } else {
            $this->render("users/login");
        }
    }

    private function handleLoginProcess($userService, $formData)
    {
        $user = $userService->login($formData['username'], $formData['password']);

        if (null !== $user) {
            $_SESSION['id'] = $user->getId();
            $this->redirect("profile.php");
        } else {
            $this->render("app/error", new ErrorDTO("Wrong credentials sorry!"));
        }
    }

    public function edit(UserServiceInterface $userService, array $formData = [])
    {
        if (!$userService->isLogged()) {
            $this->redirect("login.php");
        }

        $currentUser = $userService->currentUser();

        if (isset($formData['edit'])) {
            $this->handleEditProcess($userService, $formData);
        } else {
            $this->render("users/profile", $currentUser);
        }
    }

    private function handleEditProcess(UserServiceInterface $userService, array $formData)
    {
        $user = $userService->currentUser();

        $user->setUsername($formData['username']);
        $user->setUsername($formData['password']);
        $user->setUsername($formData['first_name']);
        $user->setUsername($formData['last_name']);
        $user->setUsername($formData['born_on']);

        if ($userService->edit($user)) {
            $this->redirect("profile.php");
        } else {

        }
    }

    public function all(UserServiceInterface $userService)
    {
        $this->render("users/all", $userService->getAll());
    }
}