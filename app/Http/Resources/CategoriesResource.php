<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{
   public $message;
   public $resource;
   public $status;

   public function __construct($resource, $status, $message)
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
