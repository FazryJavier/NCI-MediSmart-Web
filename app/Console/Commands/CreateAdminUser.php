<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create
        {username : Login username (letters, numbers, dash, underscore)}
        {--level=Admin : Admin or Editor}
        {--password= : Password (prompted securely when omitted; avoid passing it on a shared shell)}';

    protected $description = 'Create a CMS account (use this for the first admin, e.g. on production)';

    public function handle(): int
    {
        $password = $this->option('password');

        if ($password === null) {
            $password = $this->secret('Password (min 8 characters)');
            $confirmation = $this->secret('Confirm password');
        } else {
            $confirmation = $password;
        }

        $validator = Validator::make([
            'username' => $this->argument('username'),
            'level' => $this->option('level'),
            'password' => $password,
            'password_confirmation' => $confirmation,
        ], [
            'username' => ['required', 'string', 'alpha_dash', 'max:50', 'unique:users,username'],
            'level' => ['required', Rule::in(['Admin', 'Editor'])],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $data = $validator->validated();
        unset($data['password_confirmation']);
        User::create($data);

        $this->info("Account {$data['username']} ({$data['level']}) created.");

        return self::SUCCESS;
    }
}
