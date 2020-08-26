<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSecurity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $list;
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * ProcessSecurity constructor.
     * @param $list
     * @param string $baseUrl
     */
    public function __construct( string $list, string $baseUrl)
    {
        $this->list = $list;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

    }


}
