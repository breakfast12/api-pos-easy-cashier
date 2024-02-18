<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $tokenResult = $this->createToken('userToken');
        $token = $tokenResult->accessToken;
        $expiration = Carbon::now()->addDays(7)->toDateTimeString();

        return [
            'name' =>  $this->name,
            'email' =>  $this->email,
            'token' => $token,
            'token_expires_at' => $expiration,
        ];
    }
}
