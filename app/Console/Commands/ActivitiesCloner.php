<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Activity;
use App\Course;
use App\Grade;


class ActivitiesCloner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity:cloner {source? : source course id} {destiny? : destiny course id} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clone the activities from one Grade to another matching by course\'s name';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $source = Grade::find($this->argument('source'));
        $destiny = Grade::find($this->argument('destiny'));


        if(!$source) {
            $grades = Grade::select('id', 'name')->pluck('name', 'id')->all();
            $name = $this->choice('¿Cual es el curso de origen?', $grades);

            $id = array_search($name, $grades);

            $source = Grade::find($id);
        }

        if(!$destiny) {
            $grades = Grade::where('id', "!=", $source->id)->select('id', 'name')->pluck('name', 'id')->all();
            $name = $this->choice('¿Cual es el curso de destino?', $grades);

            $id = array_search($name, $grades);

            $destiny = Grade::find($id);
        }


        foreach($source->courses as $course) {
            $destinyCourse = Course::where('name', $course->name)
                                    // ->where('id', '!=', $course->id)
                                    ->where('grade_id', $destiny->id)
                                    ->first();
            if(!$destinyCourse) {
                $this->info('Ignorando el curso ' . $course->name);
                continue;
            }

            foreach($course->activities as $activity) {
                $destinyActivity = Activity::where('title', $activity->title)
                        ->where('course_id', $destinyCourse->id)
                        ->first();

                if($destinyActivity != null) continue;

                $this->info( $course->name . " > " . $activity->title );

                $data = $activity->toArray();
                $data['course_id'] = $destinyCourse->id;
                Activity::create($data);
            }
        }


    }
}
