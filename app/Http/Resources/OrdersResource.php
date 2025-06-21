<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    public $message;
    public $status;
    public $resource;

    public function __construct($resource, $message, $status)
    {
        parent::__construct($resource);
        $this->message = $message;
        $this->status = $status;
    }

    public function toArray(Request $request): array
    {
        return [
            'message' => $this->message,
            'status' => $this->status,
            'data' => $this->resource
        ];
    }
}
