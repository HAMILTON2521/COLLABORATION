<?php

namespace App\Jobs;

use App\Models\LorawanRechargeRequest;
use App\Traits\HttpHelper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendHttpRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HttpHelper;

    public string $data;
    public LorawanRechargeRequest $lorawanRechargeRequest;

    /**
     * Create a new job instance.
     */
    public function __construct(string $data, LorawanRechargeRequest $lorawanRechargeRequest)
    {
        $this->data = $data;
        $this->lorawanRechargeRequest = $lorawanRechargeRequest;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $response = $this->sendHttpRequest($this->data);

            Log::info('SendHttpRequestJob success', [
                'response' => $response,
            ]);
            if ($response) {
                $this->lorawanRechargeRequest->update([
                    'error_code' => $response['errcode'],
                    'error_message' => $response['errmsg'],
                    'order_id' => $response['orderId'],
                    'status' => $response['errcode'] === "0" ? "Success" : "Failed"
                ]);
            }

        } catch (Throwable $e) {
            Log::error('SendHttpRequestJob failed', [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);

            throw $e; // so the queue can retry
        }
    }

    public $tries = 5;
    public $backoff = [10, 30, 60, 120];
}
