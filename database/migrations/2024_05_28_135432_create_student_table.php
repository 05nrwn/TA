<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('email');
        $table->string('kode_perguruan_tinggi');
        $table->string('program_studi');
        $table->string('nim')->nullable();
        $table->string('nama_lengkap');
        $table->string('tahun_lulus');
        $table->string('sumber_dana');
        $table->string('status_saat_ini');
        $table->string('mendapat_pekerjaan_sebelum_lulus')->nullable();
        $table->string('bulan_pekerjaan_sebelum_lulus')->nullable();
        $table->string('bulan_pekerjaan_setelah_lulus')->nullable();
        $table->string('pendapatan_per_bulan')->nullable();
        $table->string('lokasi_provinsi_bekerja')->nullable();
        $table->string('lokasi_kab_kota_bekerja')->nullable();
        $table->string('jenis_perusahaan')->nullable();
        $table->string('nama_perusahaan')->nullable();
        $table->string('posisi_wiraswasta')->nullable();
        $table->string('tingkatan_tempat_kerja')->nullable();
        $table->string('hubungan_bidang_studi_pekerjaan')->nullable();
        $table->string('tingkat_pendidikan_sesuai_pekerjaan')->nullable();
        $table->string('sumber_biaya_studi_lanjut')->nullable();
        $table->string('nama_pt_studi_lanjut')->nullable();
        $table->string('program_studi_lanjut')->nullable();
        $table->string('tanggal_masuk_studi_lanjut')->nullable();
        $table->string('etika1')->nullable();
        $table->string('keahlian_bidang_ilmu1')->nullable();
        $table->string('bahasa_inggris1')->nullable();
        $table->string('penggunaan_ti1')->nullable();
        $table->string('komunikasi1')->nullable();
        $table->string('kerja_sama_tim1')->nullable();
        $table->string('pengembangan_diri1')->nullable();
        $table->string('etika2')->nullable();
        $table->string('keahlian_bidang_ilmu2')->nullable();
        $table->string('bahasa_inggris2')->nullable();
        $table->string('penggunaan_ti2')->nullable();
        $table->string('komunikasi2')->nullable();
        $table->string('kerja_sama_tim2')->nullable();
        $table->string('pengembangan_diri2')->nullable();
        $table->string('perkuliahan')->nullable();
        $table->string('demonstrasi')->nullable();
        $table->string('partisipasi_proyek_riset')->nullable();
        $table->string('magang')->nullable();
        $table->string('praktikum')->nullable();
        $table->string('kerja_lapangan')->nullable();
        $table->string('diskusi')->nullable();
        $table->string('mencari_pekerjaan_sebelum_lulus')->nullable();
        $table->string('mencari_pekerjaan_setelah_lulus')->nullable();
        $table->text('cara_mencari_pekerjaan')->nullable();
        $table->text('jumlah_lamaran')->nullable();
        $table->string('jumlah_respon')->nullable();
        $table->string('jumlah_undangan_wawancara')->nullable();
        $table->string('aktif_mencari_pekerjaan')->nullable();
        $table->text('alasan_pekerjaan_tidak_sesuai')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('students');
}
};
