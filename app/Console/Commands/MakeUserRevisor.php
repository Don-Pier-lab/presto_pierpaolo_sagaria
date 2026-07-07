<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserRevisor extends Command
{
    protected $signature = 'app:make-user-revisor {email}';

    protected $description = 'Rende un utente revisore';

    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (!$user) {
            $this->error('Utente non trovato');
            return;
        }

        $user->is_revisor = true;
        $user->save();

        $this->info('Utente ' . $user->email . ' è ora revisore');
    }
}