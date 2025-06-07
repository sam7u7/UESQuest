<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EncuestaResource extends JsonResource
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
            'titulo' => $this->titulo,
            'objetivo' => $this->objetivo,
            'indicacion' => $this->indicacion,
            'fechaInicio' => $this->fechaInicio,
            'fechaFin' => $this->fechaFin,
            'created_by'=> $this->created_by,
            'updated_by'=> $this->updated_by,

            'grupo' => new GrupoMetaResource($this->whenLoaded('grupo')),
            'usuario' => new UsuarioResource($this->whenLoaded('usuario')),
        ];
    }
}
