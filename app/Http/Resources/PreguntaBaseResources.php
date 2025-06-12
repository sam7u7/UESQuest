<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PreguntaBaseResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pregunta' => $this->pregunta,
            'ponderacion' => $this->ponderacion,
            'created_by' => $this->created_by,
            'tipoPregunta' => new TipoPreguntaResources($this->tipoPregunta),

        ];
    }
}
