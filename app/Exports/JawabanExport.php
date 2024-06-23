<?php

namespace App\Exports;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class JawabanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;
    protected $pertanyaan_array;

    public function __construct(array $data, array $pertanyaan_array)
    {
        $this->data = $data;
        $this->pertanyaan_array = $pertanyaan_array;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        //tambahkan judul di excelnya: DATA ALUMNI TAHUN LULUS {{ Tahun Lulus - Tahun Lulus }}
        

        // Menggunakan pertanyaan_array sebagai headings
        return array_merge(['No'], [
            'Nama Alumni',
            'NISN',
            'Nama Jurusan',
            'Tahun Lulus',
            'Judul Kuesioner',
            'Nama Kategori'
        ], $this->pertanyaan_array);
    }

    public function map($row): array
    {
        $mappedRow = [
            $row['no'],
            $row['nama_alumni'],
            $row['nisn'],
            $row['nama_jurusan'],
            $row['tahun_lulus'],
            $row['judul_kuesioner'],
            $row['nama_kategori'],
        ];

        // Debugging: Log the raw row data
        Log::info('Raw row data: ', $row);

        // Pisahkan jawaban pertanyaan menjadi array asosiatif
        $jawabanPertanyaan = [];
        foreach ($this->pertanyaan_array as $pertanyaan) {
            $jawaban = isset($row[$pertanyaan]) ? $row[$pertanyaan] : '-';
            $jawabanPertanyaan[] = $jawaban;
        }

        // Gabungkan ke dalam data yang akan diekspor
        $mappedRow = array_merge($mappedRow, $jawabanPertanyaan);

        // Debugging: Log the final mapped row
        Log::info('Mapped row: ', $mappedRow);

        return $mappedRow;
    }
}
