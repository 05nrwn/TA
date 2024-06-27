<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CSVImportController extends Controller
{
    public function showImportForm()
    {
        return view('import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'Invalid file upload.');
        }

        // Load the spreadsheet file
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // Get the header row
        $header = $sheetData[0];
        unset($sheetData[0]);

        // Loop through the rows
        foreach ($sheetData as $row) {
            Student::create([
                'email' => $row[0],
                'kode_perguruan_tinggi' => $row[1],
                'program_studi' => $row[2],
                'nim' => $row[3],
                'nama_lengkap' => $row[4],
                'tahun_lulus' => $row[5],
                'sumber_dana' => $row[6],
                'status_saat_ini' => $row[7],
                'mendapat_pekerjaan_sebelum_lulus' => $row[8],
                'bulan_pekerjaan_sebelum_lulus' => $row[9],
                'bulan_pekerjaan_setelah_lulus' => $row[10],
                'pendapatan_per_bulan' => $row[11],
                'lokasi_provinsi_bekerja' => $row[12],
                'lokasi_kab_kota_bekerja' => $row[13],
                'jenis_perusahaan' => $row[14],
                'nama_perusahaan' => $row[15],
                'posisi_wiraswasta' => $row[16],
                'tingkatan_tempat_kerja' => $row[17],
                'hubungan_bidang_studi_pekerjaan' => $row[18],
                'tingkat_pendidikan_sesuai_pekerjaan' => $row[19],
                'sumber_biaya_studi_lanjut' => $row[20],
                'nama_pt_studi_lanjut' => $row[21],
                'program_studi_lanjut' => $row[22],
                'tanggal_masuk_studi_lanjut' => $row[23],
                'etika1' => $row[24],
                'keahlian_bidang_ilmu1' => $row[25],
                'bahasa_inggris1' => $row[26],
                'penggunaan_ti1' => $row[27],
                'komunikasi1' => $row[28],
                'kerja_sama_tim1' => $row[29],
                'pengembangan_diri1' => $row[30],
                'etika2' => $row[31],
                'keahlian_bidang_ilmu2' => $row[32],
                'bahasa_inggris2' => $row[33],
                'penggunaan_ti2' => $row[34],
                'komunikasi2' => $row[35],
                'kerja_sama_tim2' => $row[36],
                'pengembangan_diri2' => $row[37],
                'perkuliahan' => $row[38],
                'demonstrasi' => $row[39],
                'partisipasi_proyek_riset' => $row[40],
                'magang' => $row[41],
                'praktikum' => $row[42],
                'kerja_lapangan' => $row[43],
                'diskusi' => $row[44],
                'mencari_pekerjaan_sebelum_lulus' => $row[45],
                'mencari_pekerjaan_setelah_lulus' => $row[46],
                'cara_mencari_pekerjaan' => $row[47],
                'jumlah_lamaran' => $row[48],
                'jumlah_respon' => $row[49],
                'jumlah_undangan_wawancara' => $row[50],
                'aktif_mencari_pekerjaan' => $row[51],
                'alasan_pekerjaan_tidak_sesuai' => $row[52],
            ]);
        }

        return redirect()->back()->with('success', 'CSV data imported successfully.');
    }
}
