<?php

namespace App\Http\Controllers;

use App\DTO\JobDTO;
use App\Http\Requests\JobRequest;
use App\Repositories\JobRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class JobsController extends Controller
{
    private JobRepository $jobRepository;

    /**
     * @param JobRepository $jobSource
     */
    public function __construct(JobRepository $jobSource)
    {
        $this->jobRepository = $jobSource;
    }

    /**
     * @param JobRequest $request
     *
     * @return JsonResponse
     */
    public function create(JobRequest $request): JsonResponse
    {
        $jobDTO = JobDTO::fromArray($request->validated());
        try {
            $response = $this->jobRepository->store($jobDTO);
            return response()->json([
                'status'  => 'ok',
                'body' => $response
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            Log::error((string)$e);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);;
        }
    }

    public function get(string $id = null): JsonResponse
    {
        try {
            $jobDTO = $this->jobRepository->getById($id);
            return response()->json([
                'status'  => 'ok',
                'body' => [
                    'url' => $jobDTO->getUrls(),
                    'selectors' => $jobDTO->getSelectors(),
                ]
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error((string)$e);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);;
        }
    }

    public function delete(string $id): JsonResponse
    {
        try {
            $isDeleted = $this->jobRepository->delete($id);
            if ($isDeleted) {
                return response()->json([
                    'status'  => 'ok',
                    'message' => 'Job is deleted.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Job not found in Redis. Resource may have already been deleted.',
                ], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            Log::error((string)$e);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
