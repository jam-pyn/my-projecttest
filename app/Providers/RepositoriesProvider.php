<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Eloquent\MasterRepository;
use App\Repositories\MasterRepositoryInterface;

use App\Repositories\Eloquent\RolesRepository;
use App\Repositories\RolesRepositoryInterface;

use App\Repositories\Eloquent\UserRepository;
use App\Repositories\UserRepositoryInterface;


use App\Repositories\Eloquent\RawMaterialsRepository;
use App\Repositories\RawMaterialsRepositoryInterface;

use App\Repositories\Eloquent\ReplacementRawMaterialsRepository;
use App\Repositories\ReplacementRawMaterialsRepositoryInterface;

//ไฟล์นี้ใช้ในการ setup Interface/Repositories ที่สร้างเพื่อให้สามารถเรียกใช้ได้ผ่าน Controllers 

class RepositoriesProvider extends ServiceProvider // เก็บคลาส Service providers
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //bind: เป็นการบอก Laravel ว่าเมื่อมีการร้องขอ MasterRepositoryInterface ให้ใช้ MasterRepository แทน

        //MasterRepositoryInterface::class: คือตัวอินเตอร์เฟสที่ใช้กำหนดว่าคลาสไหนจะต้องใช้งาน

        //MasterRepository::class: คือคลาสที่จริงที่จะถูกใช้เมื่อมีการร้องขออินเตอร์เฟสนั้น
        $this->app->bind(MasterRepositoryInterface::class, MasterRepository::class);
        $this->app->bind(RolesRepositoryInterface::class, RolesRepository::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
