<?php

namespace App\Policies;

use App\Models\File;
use App\Models\Installer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
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
     * @param File $file
     * @return bool
     */
    public function delete(User $user, File $file): bool
    {
        if ($file->fileable_type === \App\Models\Installer::class) return true;

        if ($file->fileable_type === \App\Models\Product::class) return true;

        if ($file->fileable_type === \App\Models\Boiler::class) return true;

        if ($file->fileable_type === \App\Models\Radiator::class) return true;

        if ($file->fileable_type === \App\Models\Post::class) return true;

        return false;
    }

    public function create(User $user): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param File $file
     * @return bool
     */
    public function update(User $user, File $file): bool
    {
        if ($file->fileable_type === \App\Models\Installer::class) return false;

        if ($file->fileable_type === \App\Models\Product::class) return true;

        if ($file->fileable_type === \App\Models\Boiler::class) return true;

        if ($file->fileable_type === \App\Models\Radiator::class) return true;

        if ($file->fileable_type === \App\Models\Post::class) return true;

        return false;
    }
}
