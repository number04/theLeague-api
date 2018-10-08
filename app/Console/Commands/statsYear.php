<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\CommandRepository;

class statsYear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theleague:stats-year';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update yearly stats';

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
        $command->statsYear();
    }
}
