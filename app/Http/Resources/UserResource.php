<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
public $status;
public $message;
public $resource;

public function __construct($status, $message, $resource){
    parent::__construct($resource);
    $this->message = $message;
    $this->status = $status;
}
    public function toArray(Request $request): array
    {
        return[
            'succes' => $this->status,
            'message' => $this->message,
            'data' => $this->resource
        ];
    }
}
