<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\AesDecryptionServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        private readonly UserRepositoryInterface       $users,
        private readonly AesDecryptionServiceInterface $aes,
    ) {}

    public function list(int $take, int $skip, string $search = ''): array
    {
        return $this->users->paginate($take, $skip, $search);
    }

    public function findOrFail(int $id): User
    {
        return $this->users->findByIdOrFail($id);
    }

    public function create(array $validated): User
    {
        $roleIds = $validated['roles'] ?? [];
        unset($validated['roles']);

        $plainPassword    = $this->aes->decrypt($validated['password']);
        $validated['password'] = Hash::make($plainPassword);

        $user = $this->users->create($validated);

        if (!empty($roleIds)) {
            $user->syncRoles($roleIds);
        }

        $user->load(['roles:id,name', 'permissions:id,name']);
        return $user;
    }

    public function update(User $user, array $validated): User
    {
        $roleIds = isset($validated['roles']) ? $validated['roles'] : null;
        unset($validated['roles']);

        if (isset($validated['password']) && !empty($validated['password'])) {
            $plainPassword         = $this->aes->decrypt($validated['password']);
            $validated['password'] = Hash::make($plainPassword);
        } else {
            unset($validated['password']);
        }

        $this->users->update($user, $validated);
        $user->refresh();

        if ($roleIds !== null) {
            $user->syncRoles($roleIds);
        }

        $user->load(['roles:id,name', 'permissions:id,name']);
        return $user;
    }

    public function delete(User $user, int $authenticatedUserId): void
    {
        if ($user->id === $authenticatedUserId) {
            throw new \DomainException(__('messages.user.delete_own_forbidden'));
        }

        $this->users->delete($user);
    }

    public function setActive(User $user, bool $active): User
    {
        $this->users->update($user, ['active' => $active]);
        $user->refresh();
        return $user;
    }

    public function getPermissions(User $user): array
    {
        return $this->users->getPermissions($user);
    }

    public function syncPermissions(User $user, array $permissionNames): User
    {
        return $this->users->syncPermissions($user, $permissionNames);
    }

    public function syncRoles(User $user, array $roleIds): User
    {
        return $this->users->syncRoles($user, $roleIds);
    }

    public function getHistory(int $userId): array
    {
        return $this->users->getHistory($userId);
    }
}
