<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $rooms = [
        //     "Ruang Kelas",
        //     "Ruang Laboratorium",
        //     "Ruang Komputer",
        //     "Ruang Perpustakaan",
        //     "Ruang Unit Kesehatan Sekolah (UKS)",
        //     "Ruang Kegiatan Ekstrakurikuler",
        //     "Ruang Gudang",
        //     "Ruang Kantin, Koperasi, Dsb",
        //     "Ruang Seni Musik",
        //     "Ruang Kepala Sekolah",
        //     "Ruang Wakil Kepala Sekolah",
        //     "Ruang Kepala Tata Usaha (TU)",
        //     "Ruang Guru",
        //     "Ruang Guru BP (Bimbingan Penyuluhan)",
        //     "Ruang Praktek",
        //     "Ruang Serba Guna",
        //     "Ruang Toilet / WC",
        //     "Ruang Osis (Organisasi Siswa Intra Sekolah)",
        //     "Ruang Sholat (Masjid / Musholla)",
        //     "Ruang Parkir",
        //     "Ruang Satpam / Penjagaan",
        // ];

        // foreach ($rooms as $room) {
        //     Room::create(['name' => Str::upper($room)]);
        // }

        $no_room    = 6;
        for ($i=1; $i <= $no_room; $i++) {
            if ($i<10) {
                Room::create([
                    'name' => 'R-0'.$i,
                ]);
            } else {
                Room::create([
                    'name' => 'R-'.$i,
                ]);
            }
        }
    }
}
