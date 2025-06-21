<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderitemResource extends JsonResource
{
   public $resource;
   public $message;
   public $status;

   public function __construct($resource, $message, $status)
   {
       parent::__construct($resource);
       $this->status = $status;
       $this->message = $message;
   }

    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->resource
        ];
    }
}
