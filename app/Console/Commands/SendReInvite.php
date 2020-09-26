<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Notifications\InviteUser;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Admin\Users\UserRepository;

class SendReInvite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:reinvite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $userRepo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = DB::table('users')
            ->where('invited_at' > Carbon::now()->subDays(3))
            ->where('last_login_at', null)
            ->get();
        
        foreach ($users as $user) {
            $randomPassword = str_random(8);

            // Если это третье оповещение,
            // отправляем оповещение администратору
            if ($user->invite_attempts == 3) {

                // send admin error
                
            } else {
                // send invite
                $inviteData = [
                    'login'    => $user->email,
                    'password' => $randomPassword,
                ];
                $user->notify(new InviteUser($inviteData));

                // make changes to the database
                $hashedRandomPassword = Hash::make($randomPassword);
                $this->userRepo->changeInvitedData($user->id, $hashedRandomPassword);
            }
        }
    }
}
