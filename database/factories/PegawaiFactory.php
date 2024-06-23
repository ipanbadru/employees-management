<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name,
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'tanggal_lahir' => fake()->date(),
            'no_telepon' => '08' . fake()->numerify('##########'),
            'email' => fake()->email,
            'alamat' => fake()->address,
            'tanggal_bergabung' => fake()->date(),
            'jabatan' => fake()->randomElement(['Manager', 'Staff', 'Kasir', 'Owner', 'Admin', 'Pimpinan', 'Karyawan']),
            'gaji' => fake()->numberBetween(1000000, 10000000),
            'foto' => null,
        ];
    }
}
