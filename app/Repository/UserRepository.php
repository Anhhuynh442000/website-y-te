<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\User;

class UserRepository
{
    public function getAllUsers($offset): array
    {
        $user = new User();
        $users = $user->getAllUsers($offset);
        return $this->convertUser($users);
    }

    public function getUser(string $id): array
    {
        $user = new User();
        $user = $user->getUser($id);
        return $this->convertUser($user)[0] ?? [];
    }

    public function isExistEmail(string $user_id, string $email): bool
    {
        $user = new User();
        $nums = $user->getEmailExceptUserId($user_id, $email);
        return $nums > 0;
    }

    private function convertUser(array $users): array
    {
        $data = [];
        foreach ($users as $user) {
            $temp = [];
            $temp['id'] = $user['id'] ?? '';
            $temp['full_name'] = ($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '');
            $temp['first_name'] = $user['first_name'] ?? '';
            $temp['last_name'] = $user['last_name'] ?? '';
            $temp['address'] = $user['address'] ?? '';
            $temp['email'] = $user['email'] ?? '';
            $temp['birthday'] = $user['birthday'] ?? '';
            $temp['role'] = $this->getRole($user['role']) ?? '';
            $temp['phone'] = $user['phone'] ?? '';
            $temp['gender'] = $user['gender'] ?? '';
            $temp['qr_image'] = $user['qr_image'] ?? '';
            $temp['status'] = $this->getStatus($user['status']) ?? '';
            $temp['avatar'] = $user['avatar'] ?? '';
            $data[] = $temp;
        }

        return $data;
    }

    private function getRole(string $role): array
    {
        if ($role === '1') {
            return ['code' => $role, 'name' => 'Administrator'];
        }
        if ($role === '2') {
            return ['code' => $role, 'name' => 'Doctor'];
        } else {
            return ['code' => '3', 'name' => 'User'];
        }
    }

    private function getStatus($status): array
    {
        if ($status == '1') {
            return ['code' => '1', 'name' => 'Active'];
        }
        return ['code' => '0', 'name' => 'Inactive'];
    }
}
