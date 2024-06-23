<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:70',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'no_telepon' => ['required', 'string', 'max_digits:20', 'numeric', Rule::unique('pegawai')->ignore($this->pegawai)],
            'email' => ['required', 'email', Rule::unique('pegawai')->ignore($this->pegawai)],
            'alamat' => 'required|string',
            'tanggal_bergabung' => 'required|date',
            'jabatan' => 'required|string|max:70',
            'gaji' => 'required|numeric',
            'foto' => 'nullable|file|image|max:2048',
        ];
    }
}
