<?php

namespace App\Jobs;

use App\DTO\JobDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class SaveToRedis implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public JobDTO $jobDTO;
    public string $uniqueId;

    /**
     * Create a new job instance.
     *
     * @param JobDTO $jobDTO
     */
    public function __construct(JobDTO $jobDTO, string $uniqueId)
    {
        $this->jobDTO = $jobDTO;
        $this->uniqueId = $uniqueId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Redis::hset($this->uniqueId, 'urls', $this->jobDTO->getUrls()->toJson(JSON_UNESCAPED_SLASHES));
        Redis::hset($this->uniqueId, 'selectors', $this->jobDTO->getSelectors()->toJson(JSON_UNESCAPED_SLASHES));
    }
}
