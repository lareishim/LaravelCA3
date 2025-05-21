<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignRolesSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure roles exist
        $roles = ['admin', 'editor', 'fan'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Assign role based on email domain if user has no role yet
        $users = User::all();

        foreach ($users as $user) {
            if ($user->hasAnyRole($roles)) {
                continue; // Skip if already has a role
            }

            if (str_ends_with($user->email, '@admin.com')) {
                $user->assignRole('admin');
            } elseif (str_ends_with($user->email, '@editor.com')) {
                $user->assignRole('editor');
            } else {
                $user->assignRole('fan');
            }
        }
    }
}
