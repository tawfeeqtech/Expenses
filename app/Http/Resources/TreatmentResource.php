<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class TreatmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'currency' => $this->currency,
            'balance' => $this->balance,
            'wallet' => $this->wallet,
            'section' => $this->section,
            'subsection' => $this->subsection,
            'notes' => $this->notes,
            'date' => $this->date,
            'contact' => $this->contact,
        ];
    }
}
