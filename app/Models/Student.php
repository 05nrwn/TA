<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'id';


    protected $fillable = [
        'email', 'kode_perguruan_tinggi', 'program_studi', 'nim', 'nama_lengkap', 'tahun_lulus',
        'sumber_dana', 'status_saat_ini', 'mendapat_pekerjaan_sebelum_lulus', 'bulan_pekerjaan_sebelum_lulus',
        'bulan_pekerjaan_setelah_lulus', 'pendapatan_per_bulan', 'lokasi_provinsi_bekerja', 'lokasi_kab_kota_bekerja',
        'jenis_perusahaan', 'nama_perusahaan', 'posisi_wiraswasta', 'tingkatan_tempat_kerja', 'hubungan_bidang_studi_pekerjaan',
        'tingkat_pendidikan_sesuai_pekerjaan', 'sumber_biaya_studi_lanjut', 'nama_pt_studi_lanjut', 'program_studi_lanjut',
        'tanggal_masuk_studi_lanjut', 'etika1', 'keahlian_bidang_ilmu1', 'bahasa_inggris1', 'penggunaan_ti1', 'komunikasi1',
        'kerja_sama_tim1', 'pengembangan_diri1', 'etika2', 'keahlian_bidang_ilmu2', 'bahasa_inggris2', 'penggunaan_ti2',
        'komunikasi2', 'kerja_sama_tim2', 'pengembangan_diri2', 'perkuliahan', 'demonstrasi', 'partisipasi_proyek_riset',
        'magang', 'praktikum', 'kerja_lapangan', 'diskusi', 'mencari_pekerjaan_sebelum_lulus', 'mencari_pekerjaan_setelah_lulus',
        'cara_mencari_pekerjaan', 'jumlah_lamaran', 'jumlah_respon', 'jumlah_undangan_wawancara', 'aktif_mencari_pekerjaan',
        'alasan_pekerjaan_tidak_sesuai'
    ];

    public static function getCountAll()
    {
        return DB::table('students')
            ->select('program_studi', DB::raw('count(*) as count'))
            ->groupBy('program_studi')
            ->get();
    }

    public static function countQuery()
    {
        return DB::table('students')
            ->select('tahun_lulus', DB::raw('count(*) as count'))
            ->groupBy('tahun_lulus')
            ->get();
    }

    public static function getTIF()
    {
        return DB::table('students')
            ->where('program_studi', '=', 'Teknik Informatika (55301)')
            ->count();
    }

    static function getTKK()
    {
        return DB::table('students')
            ->where('program_studi', '=', 'Teknik Komputer (56401)')
            ->count();
    }

    static function getMIF()
    {
        return DB::table('students')
            ->where('program_studi', '=', 'Manajemen Informatika (57401)')
            ->count();
    }

    static function getStatusNow($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('status_saat_ini', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('status_saat_ini')->get();
    }

    static function getWorkBeforeGraduate($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('mendapat_pekerjaan_sebelum_lulus', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus)
            ->whereNotNull('mendapat_pekerjaan_sebelum_lulus');

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('mendapat_pekerjaan_sebelum_lulus')->get();
    }

    static function getWorkBeforeGraduateMonth($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('bulan_pekerjaan_sebelum_lulus', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus)
            ->whereNotNull('bulan_pekerjaan_sebelum_lulus');

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('bulan_pekerjaan_sebelum_lulus')
            ->orderBy(DB::raw('CAST(bulan_pekerjaan_sebelum_lulus AS UNSIGNED)'), 'asc')
            ->get();
    }


    static function getWorkAfterGraduateMonth($tahunLulus, $studyProgram)
    {

        $query = DB::table('students')
            ->select('bulan_pekerjaan_setelah_lulus', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus)
            ->whereNotNull('bulan_pekerjaan_setelah_lulus');

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }
        return $query->groupBy('bulan_pekerjaan_setelah_lulus')
            ->orderBy(DB::raw('CAST(bulan_pekerjaan_setelah_lulus AS UNSIGNED)'), 'asc')
            ->get();
    }

    static function getSalary($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('pendapatan_per_bulan', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('pendapatan_per_bulan')->get();
    }

    static function getWorkingPlaceProvince($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('lokasi_provinsi_bekerja', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('lokasi_provinsi_bekerja')->get();
    }

    static function getWorkingPlaceRegency($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('lokasi_kab_kota_bekerja', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('lokasi_kab_kota_bekerja')->get();
    }

    static function getInstanceType($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('jenis_perusahaan', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('jenis_perusahaan')->get();
    }

    static function getIfSelfEmployeed($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('posisi_wiraswasta', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('posisi_wiraswasta')->get();
    }

    static function getWorkGrade($tahunLulus, $studyProgram)
    {
        //berbadan hukum atau tidak
        $query = DB::table('students')
            ->select('tingkatan_tempat_kerja', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('tingkatan_tempat_kerja')->get();
    }

    static function getWorkCorrelation($tahunLulus, $studyProgram)
    {
        //seberapa erat hubungan pekerjaan dengan jurusan
        $query = DB::table('students')
            ->select('hubungan_bidang_studi_pekerjaan', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('hubungan_bidang_studi_pekerjaan')->get();
    }

    static function getWorkGradeAppropriate($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('tingkat_pendidikan_sesuai_pekerjaan', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('tingkat_pendidikan_sesuai_pekerjaan')->get();
    }

    static function getFurtherStudyCost($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('sumber_biaya_studi_lanjut', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus)
            ->whereNotNull('program_studi_lanjut')
            ->where('program_studi_lanjut', '!=', 'null');

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('sumber_biaya_studi_lanjut')->get();
    }

    static function getCountFurtherStudy($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('program_studi_lanjut', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus ?? null)
            ->whereNotNull('program_studi_lanjut');

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('program_studi_lanjut')->get();
    }


    static function getFindWorkBeforeGraduate($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('mencari_pekerjaan_sebelum_lulus', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('mencari_pekerjaan_sebelum_lulus')->get();
    }

    static function getFindWorkAfterGraduate($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('mencari_pekerjaan_setelah_lulus', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('mencari_pekerjaan_setelah_lulus')->get();
    }

    static function getGotJobBeforeGraduateAndCorrelated($tahunLulus, $studyProgram)
    {
        // Mendapat pekerjaan sebelum lulus dan korelasi
        $query = DB::table('students')
            ->select('hubungan_bidang_studi_pekerjaan', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('hubungan_bidang_studi_pekerjaan')
            ->where("mendapat_pekerjaan_sebelum_lulus", "=", "1 - Ya")
            ->get();
    }


    static function getEthics($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('etika1', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus)
            ->where('etika1', '!=', '1/16/2023');

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('etika1')->get();
    }

    static function getSkill($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('keahlian_bidang_ilmu1', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('keahlian_bidang_ilmu1')->get();
    }

    static function getEnglish($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('bahasa_inggris1', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('bahasa_inggris1')->get();
    }

    static function getTIUsage($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('penggunaan_ti1', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('penggunaan_ti1')->get();
    }

    static function getCommunication($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('komunikasi1', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('komunikasi1')->get();
    }

    static function getTeamWork($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('kerja_sama_tim1', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('kerja_sama_tim1')->get();
    }

    static function getSelfImprovement($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('pengembangan_diri1', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('pengembangan_diri1')->get();
    }

    static function getEthics2($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('etika2', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('etika2')->get();
    }

    static function getSkill2($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('keahlian_bidang_ilmu2', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('keahlian_bidang_ilmu2')->get();
    }

    static function getEnglish2($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('bahasa_inggris2', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('bahasa_inggris2')->get();
    }

    static function getTIUsage2($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('penggunaan_ti2', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('penggunaan_ti2')->get();
    }

    static function getCommunication2($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('komunikasi2', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('komunikasi2')->get();
    }

    static function getTeamWork2($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('kerja_sama_tim2', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('kerja_sama_tim2')->get();
    }

    static function getSelfImprovement2($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('pengembangan_diri2', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('pengembangan_diri2')->get();
    }

    static function getLectures($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('perkuliahan', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('perkuliahan')->get();
    }

    static function getDemonstration($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('demonstrasi', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('demonstrasi')->get();
    }

    static function getResearchProjectParticipation($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('partisipasi_proyek_riset', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('partisipasi_proyek_riset')->get();
    }

    static function getInternship($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('magang', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('magang')->get();
    }

    static function getInternshipTest()
    {
        return DB::table('students')
            ->select('magang', DB::raw('count(*) as count'))
            ->groupBy('magang')->get();
    }

    static function getPractice($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('praktikum', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('praktikum')->get();
    }

    static function getFieldWork($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('kerja_lapangan', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('kerja_lapangan')->get();
    }

    static function getDiscussion($tahunLulus, $studyProgram)
    {
        $query = DB::table('students')
            ->select('diskusi', DB::raw('count(*) as count'))
            ->where('tahun_lulus', $tahunLulus);

        if ($studyProgram != 'All') {
            $query->where('program_studi', $studyProgram);
        }

        return $query->groupBy('diskusi')->get();
    }
}
