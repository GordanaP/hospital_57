<?php

namespace App\Providers;

use App\Repositories\Doctor\DoctorRepositoryInterface;
use App\Repositories\Doctor\EloquentDoctorRepository;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, EloquentDoctorRepository::class);
    }
}
