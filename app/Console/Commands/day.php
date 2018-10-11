<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\CommandRepository;

class day extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theleague:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change days';

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
    public function handle(CommandRepository $command)
    {
        $command->day();
    }
}
