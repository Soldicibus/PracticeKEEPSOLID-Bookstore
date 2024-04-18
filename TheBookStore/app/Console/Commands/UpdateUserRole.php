<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateUserRole extends Command
{
    protected $signature = 'user:update-role {email} {role}';

    protected $description = 'Update user role';

    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email $email not found.");
            return;
        }

        DB::table('users')->where('id', $user->id)->update(['role_id' => $role]);

        $this->info("Role updated for user $email.");
    }
}
