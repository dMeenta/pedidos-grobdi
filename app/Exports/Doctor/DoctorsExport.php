<?php

namespace App\Exports\Doctor;

use App\Models\Doctor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DoctorsExport implements FromCollection, WithHeadings
{
    public function __construct(
        protected Collection $doctores
    ) {
    }

    public function collection(): Collection
    {
        return $this->doctores->map(function (Doctor $doctor) {
            $fullName = collect([
                $doctor->name,
                $doctor->first_lastname,
                $doctor->second_lastname,
            ])->filter()->implode(' ');

            $birthdate = Carbon::make($doctor->birthdate)?->format('Y-m-d') ?? '';

            return [
                'nombre' => $fullName,
                'cmp' => $doctor->CMP ?? '',
                'tipo_documento' => $doctor->type_document ?? '',
                'numero_documento' => $doctor->number_document ?? '',
                'cumpleanos' => $birthdate,
                'telefono' => $doctor->phone ?? '',
                'distrito' => optional($doctor->distrito)->name ?? '',
                'especialidad' => optional($doctor->especialidad)->name ?? '',
                'centro_salud' => optional($doctor->centrosalud)->name ?? '',
                'tipo_medico' => $doctor->tipo_medico ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'CMP',
            'Tipo documento',
            'Número documento',
            'Cumpleaños',
            'Teléfono',
            'Distrito',
            'Especialidad',
            'Centro de salud',
            'Tipo médico',
        ];
    }
}
