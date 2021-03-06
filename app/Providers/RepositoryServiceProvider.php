<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\EloquentRepositoryInterface; 
use App\Repositories\Eloquent\BaseRepository;

use App\Repositories\Eloquent\Specialist\SpecialistRepositoryInterface; 
use App\Repositories\Eloquent\Specialist\SpecialistRepository; 

use App\Repositories\Eloquent\Patient\PatientRepositoryInterface; 
use App\Repositories\Eloquent\Patient\PatientRepository; 


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //binding all repository to interface
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(SpecialistRepositoryInterface::class, SpecialistRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
