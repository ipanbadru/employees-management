<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PegawaiResource extends JsonResource
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
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tanggal_lahir' => $this->tanggal_lahir,
            'no_telepon' => $this->no_telepon,
            'email' => $this->email,
            'alamat' => $this->alamat,
            'tanggal_bergabung' => $this->tanggal_bergabung,
            'jabatan' => $this->jabatan,
            'gaji' => $this->gaji,
            'foto' => $this->foto,
            'tanggal_lahir_formated' => Carbon::parse($this->tanggal_lahir)->format('d M Y'),
            'tanggal_bergabung_formated' => Carbon::parse($this->tanggal_bergabung)->format('d M Y'),
            'gaji_formated' => 'RP ' . number_format($this->gaji, 0, '.', '.'),
        ];
    }
}
