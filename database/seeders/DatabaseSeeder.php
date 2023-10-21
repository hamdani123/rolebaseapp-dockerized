<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'imrancse94@gmail.com',
             'password'=>bcrypt('Nop@ss1234')
         ]);

         $current_datetime = now();


        $permission = "INSERT INTO `permissions` (`id`,`parent_id`,`is_index`,`key`, `name`, `icon`, `created_at`, `updated_at`) VALUES
                                (1, 0, 0,null,'Company', 'fa fa-list-ul', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (2, 1, 0,null,'Company Management', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (3, 2, 1,'company-index','Company List', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (4, 2, 0,'company-add','Add New Company', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (5, 2, 0,'company-edit','Modify Company', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (6, 2, 0,'company-delete','Delete Company', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (7, 2, 0,'company-view','View Company', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (8, 0, 0,null,'Master Data', 'fa fa-list-ul', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (9, 8, 0,null,'Module Management', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (10, 9, 1,'module-index','Module List', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (11, 9, 0,'module-add','Add New Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (12, 9, 0,'module-edit','Modify Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (13, 9, 0,'module-delete','Delete Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (14, 9, 0,'module-view','View Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (15, 8, 0,null,'Sub Module Management', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (16, 15, 1,'submodule-index','Sub Module List', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (17, 15, 0,'submodule-add','Add New Sub Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (18, 15, 0,'submodule-edit','Modify Sub Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (19, 15, 0,'submodule-delete','Delete Sub Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (20, 15, 0,'submodule-view','View Sub Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (21, 8, 0,null,'Page Management', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (22, 21, 1,'page-index','Page List', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (23, 21, 0,'page-add','Add New Page', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (24, 21, 0,'page-edit','Modify Page', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (25, 21, 0,'page-delete','Delete Page', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (26, 21, 0,'page-view','View Page', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (27, 0, 0,null,'Access Control', 'fa fa-list-ul', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (28, 27, 0,null,'User Management', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (29, 28, 1,'user-index','User List', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (30, 28, 0,'user-add','Add New User', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (31, 28, 0,'user-edit','Modify User', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (32, 28, 0,'user-delete','Delete User', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (33, 28, 0,'user-view','View User', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (34, 27, 0,null,'Role Management', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (35, 34, 1,'role-index','Role List', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (36, 34, 0,'role-add','Add New Role', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (37, 34, 0,'role-edit','Modify Role', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (38, 34, 0,'role-delete','Delete Role', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (39, 27, 0,null,'Usergroup Management', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (40, 39, 1,'usergroup-index','Usergroup List', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (41, 39, 0,'usergroup-add','Add New Usergroup', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (42, 39, 0,'usergroup-edit','Modify Usergroup', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (43, 39, 0,'usergroup-delete','Delete Usergroup', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (44, 27, 0,null,'Usergroup & Role Association', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (45, 44, 1,'usergroup-role-assoc','Usergroup & Role Association', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (46, 27, 0,null,'Role & Page Association', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (47, 46, 1,'role-page-assoc','Role & Page Association', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (48, 0, 0,null,'Configuration', 'fa fa-list-ul', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (49, 48, 0,null,'Site Settings', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (50, 49, 1,'site-settings','Site Settings', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33')";

        DB::insert($permission);


         \App\Models\Role::create([
             'name'=>'Role-1',
             'created_at'=>$current_datetime,
             'updated_at'=>$current_datetime,
         ]);

        \App\Models\UserRole::create([
            'user_id'=>1,
            'role_id'=>1,
            'created_at'=>$current_datetime,
            'updated_at'=>$current_datetime,
        ]);


        for($i=1;$i <= 50;$i++){
            $role_permission[] = [
                'role_id'=>1,
                'permission_id'=>$i,
                'created_at'=>$current_datetime,
                'updated_at'=>$current_datetime,
            ];
        }


        \App\Models\RolePermission::insert($role_permission);
    }
}
