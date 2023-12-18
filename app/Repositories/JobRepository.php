<?php

namespace App\Repositories;

use App\DTO\JobDTO;
use App\Jobs\SaveToRedis;
use Illuminate\Support\Facades\Redis;

class JobRepository
{
    /**
     * @param JobDTO $jobDTO
     *
     * @return array
     */
    public function store(JobDTO $jobDTO): array
    {
        $uniqueId = uniqid();
        SaveToRedis::dispatch($jobDTO, $uniqueId);
        return [
            'id' => $uniqueId
        ];
    }

    /**
     * @param string $getById
     *
     * @return JobDTO
     */
    public function getById(string $getById): JobDTO
    {
        $data = [
            'urls' => json_decode(Redis::hget($getById, 'urls'), true),
            'selectors' => json_decode(Redis::hget($getById, 'selectors'), true),
        ];
        return JobDTO::fromArray($data);
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function delete(string $id): bool
    {
       return Redis::hdel($id, 'urls', 'selectors');
    }

}