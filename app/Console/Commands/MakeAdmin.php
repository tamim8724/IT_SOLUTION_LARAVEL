<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{
    protected $signature = 'etrust:admin {email} {--name=Admin}';

    protected $description = 'Create or reset an admin login for /admin';

    public function handle(): int
    {
        $password = $this->secret('Password (min 10 characters)');
        if (strlen((string) $password) < 10) {
            $this->error('Password must be at least 10 characters.');

            return self::FAILURE;
        }
        $user = User::updateOrCreate(
            ['email' => $this->argument('email')],
            ['name' => $this->option('name'), 'password' => Hash::make($password)]
        );
        $this->info("Admin ready: {$user->email}");

        return self::SUCCESS;
    }
}
