<?php

namespace App\Policies;

use App\Models\File;
use App\Models\Installer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstallerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    /**
     * @param User $user
     * @param Installer $installer
     * @return bool
     */
    public function view(User $user, Installer $installer): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Installer $installer
     * @return bool
     */
    public function delete(User $user, Installer $installer): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Installer $installer
     * @return bool
     */
    public function addFile(User $user, Installer $installer): bool
    {
        return false;
    }
}
