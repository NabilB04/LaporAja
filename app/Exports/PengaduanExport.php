<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PengaduanExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $tanggalMulai;
    protected $tanggalAkhir;
    protected $kategoriId;
    protected $statusId;

    public function __construct($tanggalMulai = null, $tanggalAkhir = null, $kategoriId = null, $statusId = null)
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalAkhir = $tanggalAkhir;
        $this->kategoriId = $kategoriId;
        $this->statusId = $statusId;
    }

    public function query()
    {
        $query = Pengaduan::query()
            ->with(['warga', 'kategori', 'status']);

        if ($this->tanggalMulai) {
            $query->whereDate('created_at', '>=', $this->tanggalMulai);
        }

        if ($this->tanggalAkhir) {
            $query->whereDate('created_at', '<=', $this->tanggalAkhir);
        }

        if ($this->kategoriId) {
            $query->where('kategori_id', $this->kategoriId);
        }

        if ($this->statusId) {
            $query->where('status_id', $this->statusId);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Deskripsi',
            'Kategori',
            'Pelapor',
            'Lokasi',
            'Status',
            'Tanggal Dibuat',
            'Tanggal Diupdate'
        ];
    }

    public function map($pengaduan): array
    {
        return [
            $pengaduan->id,
            $pengaduan->judul,
            $pengaduan->deskripsi,
            $pengaduan->kategori->nama_kategori ?? 'N/A',
            $pengaduan->warga->nama ?? 'N/A',
            $pengaduan->lokasi,
            $pengaduan->status->nama_status ?? 'N/A',
            $pengaduan->created_at->format('d/m/Y H:i'),
            $pengaduan->updated_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
