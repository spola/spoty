<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $grade_id = App\Grade::create(['name'=>'8B'])->id;
        App\User::create([ 'name'=> 'Paulette Arp', 'email' => 'paulette.arp@gmail.com', 'password'=>bcrypt('secret'), 'is_student'=>true, 'grade_id' => $grade_id]);

        App\Course::create(['name'=>'Artes', 'icon'=>'artes.png',  'grade_id' => $grade_id]);
        App\Course::create(['name'=>'Biología', 'icon'=>'biologia.png',  'grade_id' => $grade_id]);
        App\Course::create(['name'=>'Física', 'icon'=>'fisica.png',  'grade_id' => $grade_id]);
        App\Course::create(['name'=>'Geografía', 'icon'=>'geografia.png',  'grade_id' => $grade_id]);
        App\Course::create(['name'=>'Inglés', 'icon'=>'lengua-inglesa.png',  'grade_id' => $grade_id]);
        App\Course::create(['name'=>'Lenguaje', 'icon'=>'lenguaje.png',  'grade_id' => $grade_id]);
        App\Course::create(['name'=>'Matemática', 'icon'=>'matematicas.png',  'grade_id' => $grade_id, 'content' => '<img src="tablaResumen.jpg" alt="tabla resumen"><p>Intenta no imprimir las guías, así colaboramos con el medio ambiente.</p><p>Realice el desarrollo de cada ejercicio en su cuaderno.</p><p>No es necesario que anote el enunciado de cada problema, solo debe indicar el número de la guía y el del ejercicio.</p>']);
        App\Course::create(['name'=>'Ed. Física', 'icon'=>'musculo.png',  'grade_id' => $grade_id]);
        App\Course::create(['name'=>'Química', 'icon'=>'quimica.png',  'grade_id' => $grade_id]);
        App\Course::create(['name'=>'Tecnología', 'icon'=>'tecnologia.png',  'grade_id' => $grade_id]);

    }
}
