<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class GuruSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // $data = [
        //     'username' => 'darth',
        //     'email'    => 'darth@theempire.com',
        // ];

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            $name = $faker->name;
            $date = $faker->dayOfMonth($max = 'now');
            $month = $faker->monthName($max = 'now');
            $year = $faker->year($max = 'now');

            $data = [
                'nama' => $name,
                'slug_nama' => url_title($name, '-', true),
                'nip' => $faker->numerify('##########'),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $date . ' ' . $month . ' ' . $year,
                'jenis_kelamin' => $faker->randomElement($array = array('Laki-Laki', 'Perempuan')),
                'agama' => $faker->randomElement($array = array('Islam', 'Kristen', 'Hindhu')),
                'alamat' => $faker->address,
                'no_telp' => $faker->phoneNumber,
                'role_id' => 2,
                'is_active' => 0,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now()
            ];
            $this->db->table('guru')->insert($data);
        }
        // Simple Queries
        // $this->db->query(
        //     "INSERT INTO users (username, email) VALUES(:username:, :email:)",
        //     $data
        // );

        // Using Query Builder
    }
}
