<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GetUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:get {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        //php artisan user:create --first_name=Parker --last_name=Dell --email=parkerdell94@gmail.com --password=password --admin=1
        $id = $this->option('id');



        if (! $id) {
            $this->error('Options are non-optional :)');
            return false;
        }



        $user = User::find($id);
        $user = User::all();

        dd($user->toArray());

        $this->info('User Created');



    }
}
