<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use App\Grade;
use App\Mail\TeacherReported;
use App\Services\ITeacherService;
use App\Services\DTO\TeacherReportedData;


class TeacherReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teacher:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia el reporte de desempeño diario';

    /**
     * Teacher Service
     */
    private ITeacherService $teacherService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ITeacherService $teacherService)
    {
        parent::__construct();
        $this->teacherService = $teacherService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info("Started command: " . $this->signature);
        try {

            $grades = Grade::whereNotNull('teacher_id')->get();

            foreach($grades as $grade) {

                $data = $this->teacherService->DailyReport($grade);

                Mail::to($data->teacher)
                    ->send(new TeacherReported($data));
            }

        } catch(Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
