<?php

namespace App\Exports;

use App\Models\Service;
use Carbon\Carbon;
use App\Models\ServiceDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;


class HistoryExport implements FromQuery, WithHeadings, ShouldAutoSize, WithStyles, WithProperties, WithCustomStartCell, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // protected $kode_area, $tgl_awal, $tgl_akhir;
    use Exportable;

    function __construct(int $kode_area, String $tgl_awal, String $tgl_akhir)
    {
        $this->kode_area = $kode_area;
        $this->tgl_awal = $tgl_awal;
        $this->tgl_akhir = $tgl_akhir;
    }


    public function query()
    {
        $tgl_awal = $this->tgl_awal;
        $tgl_akhir = $this->tgl_akhir;
        $kode_area = $this->kode_area;

        if($kode_area == NULL ){
            return ServiceDetail::query()->join('service', 'rincian_service.no_service', '=', 'service.no_service')->join('kendaraan', 'service.nopol', '=', 'kendaraan.nopol')
            ->where('service.status', '!=', 'NULL')->whereBetween('service.tanggal', [$tgl_awal, $tgl_akhir])
            ->select('service.no_service', 'service.status','service.nopol','service.area', 'service.tanggal', 'service.pool',
            'kendaraan.r2_r4', 'kendaraan.ms_nms', 'kendaraan.merk', 'kendaraan.type', 'rincian_service.keterangan','rincian_service.harga', 'rincian_service.qty', 'rincian_service.subtotal');
        }else{
            return ServiceDetail::query()->join('service', 'rincian_service.no_service', '=', 'service.no_service')->join('kendaraan_lokal', 'service.nopol', '=', 'kendaraan_lokal.nopol')
            ->where('service.area', $kode_area)->whereNotNull('service.status')->where(function($q){
                $q->where('service.status', '!=','Decline')->orWhere('service.status', '!=','Cancel');
            })->whereBetween('service.tanggal', [$tgl_awal, $tgl_akhir])
            ->select('service.no_service', 'service.status','service.nopol','service.area', 'service.tanggal', 'service.pool', 'kendaraan_lokal.r2_r4', 'kendaraan_lokal.ms_nms', 'kendaraan_lokal.merk', 'kendaraan_lokal.type', 'rincian_service.keterangan','rincian_service.harga', 'rincian_service.qty', 'rincian_service.subtotal');

            // return ServiceDetail::query()->join('service', 'rincian_service.no_service', '=', 'service.no_service')->join('kendaraan', 'service.nopol', '=', 'kendaraan.nopol')
            // ->where('service.area', $kode_area)->select('service.no_service');
           
        }
       
    }

    public function headings(): array
    {
        return[
            'Nomor Service',
			'Status',
            'Nopol',
            'Area',
            'Tanggal',
            'Pool',
            'R2/R4',
            'MS/NMS',
            'Merk Kendaraan',
            'Tipe Kendaraan',
            'Nama Barang',
            'Harga',
            'Qty',
            'Subtotal',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            2    => ['font' => ['bold' => true]],
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => 'Klikbengkel Application',
            'title'          => 'Monthly Services Report',
        ];
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function title(): string
    {
        return 'Report Area ' . $this->kode_area;
    }
}
