<?php

namespace App\Console\Commands;

use App\Http\Controllers\CrawalPostController;
use Illuminate\Console\Command;

class CrawalPostByF319 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'f319:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawal new comment and post of F319 website';

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
     * @return int
     */
    public function handle(CrawalPostController $crawalPostController)
    {
        $crawalPostController->crawalNewPostOfF319();
    }
}
