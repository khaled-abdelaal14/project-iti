<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords=[
            ['name'=>'khaled','password'=>bcrypt(123456789),'email'=>'khaled@admin.com','city'=>'aga','phone'=>12154,'image'=>'sfdsfds','type'=>'admin'],
        ];
        Admin::insert($adminRecords);
        $userRecords=[
            ['name'=>'khaled','password'=>bcrypt(123456789),'email'=>'admin@admin.com','city'=>'aga','phone'=>12154,'image'=>'sfdsfds'],
        ];
        User::insert($userRecords);

        $bookRecords=[
            ['title'=>'sdfsdf','auther'=>'ana','body'=>'sdfsdfsd','published_year'=>'2024-05-01'],
            ['title'=>'jl','auther'=>'dfs','body'=>'ds','published_year'=>'2024-06-01'],
        ];
        Book::insert($bookRecords);
    }
}
