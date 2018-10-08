<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\CommandRepository;

class injury extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theleague:injury';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update injury status';

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
        $command->injury();
    }
}
