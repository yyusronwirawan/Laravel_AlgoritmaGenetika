<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\DaySchedule;
use App\Models\TimeSchedule;
use Illuminate\Http\Request;
use App\Models\CourseSchedule;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use Illuminate\Support\Facades\Artisan;

class CourseScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']      = 'Course Schedule Page';
        $data['schedule']   = CourseSchedule::orderBy('day_id','ASC')->get();
        return view('admin.schedule.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rnd            = mt_rand(1,10)/10; // Random Number Decimal 0-1
        $times          = TimeSchedule::all();
        $days           = DaySchedule::where('id','!=',6)->where('id','!=',7)->get();
        $rooms          = Room::all();
        $classrooms     = Classroom::all();
        $courses        = Course::all();
        $teachers       = Teacher::where('user_id','!=',1)->get();
        $schedules      = CourseSchedule::all();

        // Menghapus jadwal yang sudah ada
        if (count($schedules) > 0) {
            Artisan::call('migrate:fresh --seed');
        }

        // Membuat data semester (Ganjil atau Genap)
        $month  = (int)(date('m'));
        $smt    = ($month <= 6) ? 'Semester Genap' : 'Semester Ganjil';
        // Membuat tahun pelajaran
        $now_year       = (int)(date('Y'));
        // Membuat jumlah kelas
        $total_class = count($classrooms) * count($times);
        // Menghitung jumlah mata pelajaran seluruh kelas atau Menghitung total posisi yang harus dicapai
        // $crommosom          = count($classrooms) * count($times) * count($days) * (count($courses)*3);
        $crommosom          = count($classrooms) * count($times) * count($days);
        $data['crommosom']  = $crommosom;

        // Definisi parameter PSO
        $particleCount  = $total_class; // Jumlah partikel
        $iterationCount = $crommosom; // Jumlah iterasi
        $w              = 0.5; // Inertia weight
        $c1             = 1.5; // Cognitive constant
        $c2             = 1.5; // Social constant

        // Inisialisasi partikel (solusi awal)
        $particles = [];
        $newParticles = [];
        for ($i = 0; $i < $particleCount; $i++) {
            // Inisialisasi partikel dengan jadwal acak
            $particle = generateRandomSchedule($courses,$teachers,$classrooms,$times,$days); // Anda perlu mengimplementasikan ini
            $particles[] = $particle;
        }
        for ($i = 0; $i < $particleCount; $i++) {
            $newParticle = generateRandomParticle($courses,$teachers,$classrooms,$times,$days); // Function to generate a random particle
            $newParticles[] = $newParticle;
        }

        // Inisialisasi pbest (best personal position)
        $pBests = $particles;
        $_pBests = $newParticles;
        // Inisialisasi gbest (best global position)
        $gBest = $pBests[0]; // Pilih salah satu partikel awal sebagai gbest
        $_gBest = $_pBests[0]; // Pilih salah satu partikel awal sebagai gbest

        // Mulai iterasi PSO
        for ($iteration = 0; $iteration < $iterationCount/$particleCount; $iteration++) {
            foreach ($particles as $index => $particle) {
                // Evaluasi kualitas partikel saat ini
                $currentFitness = evaluateFitness($particle); // Anda perlu mengimplementasikan ini

                // Update pbest jika ditemukan yang lebih baik
                if ($currentFitness < evaluateFitness($pBests[$index])) {
                    $pBests[$index] = $particle;
                }

                // Update gbest jika ditemukan yang lebih baik
                if ($currentFitness < evaluateFitness($gBest)) {
                    $gBest = $particle;
                }

                // Update pbest jika ditemukan yang lebih baik
                if ($currentFitness < evaluateFitness($_pBests[$index]['position'])) {
                    $_pBests[$index] = $particle;
                }

                // Update gbest jika ditemukan yang lebih baik
                if ($currentFitness < evaluateFitness($_gBest['position'])) {
                    $_gBest = $particle;
                }

                // Update kecepatan dan posisi partikel
                // Anda perlu mengimplementasikan rumus PSO yang sesuai dengan konteks Anda
                // Berdasarkan kecepatan, pbest, gbest, dan posisi saat ini
                $velocity = $newParticle['velocity']; // Kecepatan partikel saat ini
                $position = $newParticle['position']; // Posisi partikel saat ini

                $pBestPosition = $_pBests[$index]['position']; // Posisi pbest partikel saat ini
                $gBestPosition = $_gBest['position']; // Posisi gbest global

                $newVelocity = [];
                $newPosition = [];
                $maxVelocity = mt_rand(1,10)/10;
                $maxPosition = mt_rand(6,10)/10;
                $minPosition = mt_rand(1,5)/10;

                for ($i = 0; $i < count($velocity); $i++) {
                    // Rumus pembaruan kecepatan
                    $position = (int)($i);
                    $pBestPosition = (int)($i);
                    $gBestPosition = (int)($i);

                    $newVelocity[$i] = $w * $velocity[$i] + $c1 * $rnd * ($pBestPosition - $position) + $c2 * $rnd * ($gBestPosition - $position);

                    // Batasan pada kecepatan
                    if ($newVelocity[$i] > $maxVelocity) {
                        $newVelocity[$i] = $maxVelocity;
                    } elseif ($newVelocity[$i] < -$maxVelocity) {
                        $newVelocity[$i] = -$maxVelocity;
                    }

                    // Rumus pembaruan posisi
                    $newPosition[$i] = $position + $newVelocity[$i];

                    // Batasan pada posisi (misalnya, pastikan dalam rentang yang valid)
                    // Anda perlu menyesuaikan batasannya sesuai dengan kebutuhan Anda
                    if ($newPosition[$i] < $minPosition) {
                        $newPosition[$i] = $minPosition;
                    } elseif ($newPosition[$i] > $maxPosition) {
                        $newPosition[$i] = $maxPosition;
                    }
                }

                $newParticle['velocity'] = $newVelocity;
                $newParticle['position'] = $newPosition;
                $particles[$index] = $particle;
            }
        }

        for ($i = 0; $i < $total_class-1; $i++) {
            for ($iteration = 0; $iteration < count($courses)-1; $iteration++) {
                $atr = new CourseSchedule();
                $atr['course_id']       = $particles[$i][$iteration]['course_id'];
                $atr['teacher_id']      = $particles[$i][$iteration]['teacher_id'];
                $atr['classroom_id']    = $particles[$i][$iteration]['classroom_id'];
                $atr['time_id']         = $particles[$i][$iteration]['time_id'];
                $atr['day_id']          = $particles[$i][$iteration]['day_id'];
                $atr['semester']        = $smt;
                $atr['year']            = $now_year;
                $atr->save();
            }
        }

        return back();
    }
}

// Fungsi untuk inisialisasi kecepatan dan posisi partikel secara acak
function generateRandomParticle($courses, $teachers, $classrooms, $times, $days) {
    $schedule = generateRandomSchedule($courses, $teachers, $classrooms, $times, $days);

    // Misalkan setiap jadwal diwakili oleh array dari angka (misal, ID pelajaran, ruang kelas, guru, dll.)
    // Maka kecepatan awal untuk setiap angka tersebut adalah 0.

    $velocity = array_fill(0, count($schedule), 0);

    $particle = [
        'position' => $schedule,  // ini adalah solusi jadwal awal
        'velocity' => $velocity   // kecepatan awal diatur ke nol untuk setiap elemen di 'position'
    ];

    return $particle;
}

// Fungsi untuk menghasilkan jadwal acak
function generateRandomSchedule($courses,$teachers,$classrooms,$times,$days) {
    // Generate solusi jadwal acak
    $randomSchedule = [];

    foreach ($courses as $course) {
        $teacher = CourseTeacher::where('course_id', $course->id)->first();
        $randomSchedule[] = [
            'course_id' => $course->id,
            // 'teacher_id' => $teachers->random()->id,
            'teacher_id' => $teacher->teacher_id,
            'classroom_id' => $classrooms->random()->id,
            'time_id' => $times->random()->id,
            'day_id' => $days->random()->id,
        ];
    }

    return $randomSchedule;
}

// Fungsi untuk mengevaluasi kualitas jadwal
function evaluateFitness($schedule) {
    // Hitung konflik atau kriteria evaluasi lainnya
    $conflictCount = 0;

    foreach ($schedule as $entry) {
        // Cek konflik dalam jadwal, misalnya bentrok waktu atau ruang
        // Hitung jumlah konflik dan beri nilai yang sesuai
        // Anda perlu mengimplementasikan ini sesuai dengan aturan penjadwalan

        // Contoh sederhana: hitung jumlah konflik
        // Jika satu dosen memiliki lebih dari satu jadwal dalam satu waktu
        $teacherConflict = CourseSchedule::where('teacher_id', $entry['teacher_id'])
            ->where('time_id', $entry['time_id'])
            ->where('day_id', $entry['day_id'])
            ->count();

        // Jika satu ruangan memiliki lebih dari satu jadwal dalam satu waktu
        $classroomConflict = CourseSchedule::where('classroom_id', $entry['classroom_id'])
            ->where('time_id', $entry['time_id'])
            ->where('day_id', $entry['day_id'])
            ->count();

        $conflictCount += $teacherConflict + $classroomConflict;
    }

    // Nilai evaluasi: semakin sedikit konflik, semakin baik jadwalnya
    // Anda perlu menyesuaikan ini dengan tujuan penjadwalan Anda
    return $conflictCount;
}
