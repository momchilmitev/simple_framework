<?php /** @var \App\Data\UserDTO[] $data */ ?>

<table border="1">
    <thead>
        <tr>
            <td>Id</td>
            <td>Username</td>
            <td>Fullname</td>
            <td>BornOn</td>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($data as $user): ?>

            <tr>
                <td><?= $user->getId(); ?></td>
                <td><?= $user->getUsername(); ?></td>
                <td><?= $user->getFirstName() . ' ' . $user->getLastName() ?></td>
                <td><?= $user->getBornOn(); ?></td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>

<br>
Go back to <a href="profile.php">your profile</a>