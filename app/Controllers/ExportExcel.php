<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportExcel extends Controller
{
    public function ExportGuru()
    {
        $guru = new GuruModel();
        $data_guru = $guru->findAll();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama')
            ->setCellValue('B1', 'NIP')
            ->setCellValue('C1', 'Tempat Lahir')
            ->setCellValue('D1', 'Tanggal Lahir')
            ->setCellValue('E1', 'Jenis Kelamin')
            ->setCellValue('F1', 'Agama')
            ->setCellValue('G1', 'Alamat')
            ->setCellValue('H1', 'Nomor Telepon');

        $column = 2;
        // tulis data ke cell
        foreach ($data_guru as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['nama'])
                ->setCellValue('B' . $column, strval($data['nip']))
                ->setCellValue('C' . $column, $data['tempat_lahir'])
                ->setCellValue('D' . $column, $data['tanggal_lahir'])
                ->setCellValue('E' . $column, $data['jenis_kelamin'])
                ->setCellValue('F' . $column, $data['agama'])
                ->setCellValue('G' . $column, $data['alamat'])
                ->setCellValue('H' . $column, $data['no_telp']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Download';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function ExportSiswa()
    {
        $siswa = new SiswaModel();
        $data_siswa = $siswa->findAll();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama')
            ->setCellValue('B1', 'NISN')
            ->setCellValue('C1', 'Tempat Lahir')
            ->setCellValue('D1', 'Tanggal Lahir')
            ->setCellValue('E1', 'Jenis Kelamin')
            ->setCellValue('F1', 'Agama')
            ->setCellValue('G1', 'Alamat')
            ->setCellValue('H1', 'Nomor Telepon')
            ->setCellValue('I1', 'Nama Orang Tua');

        $column = 2;
        // tulis data ke cell
        foreach ($data_siswa as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['nama'])
                ->setCellValue('B' . $column, strval($data['nisn']))
                ->setCellValue('C' . $column, $data['tempat_lahir'])
                ->setCellValue('D' . $column, $data['tanggal_lahir'])
                ->setCellValue('E' . $column, $data['jenis_kelamin'])
                ->setCellValue('F' . $column, $data['agama'])
                ->setCellValue('G' . $column, $data['alamat'])
                ->setCellValue('H' . $column, $data['no_telp'])
                ->setCellValue('I' . $column, $data['orang_tua_asuh']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Download';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
