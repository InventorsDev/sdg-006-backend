<?php   

namespace App\Repositories\Eloquent;   

use App\Repositories\EloquentRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class BaseRepository implements EloquentRepositoryInterface 
{     
    /**      
     * @var Model      
     */     
     protected $model;       

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }
 
    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, string $id): bool
    {
        $model = $this->find($id);
        return $model->update($attributes);
    }
 
    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
    * @return Collection
    */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
    * @return Collection
    */
    public function paginate($val=10)
    {
        return $this->model->paginate($val);
    }

    /**
    * @return Bool
    * @param $id
    */
    public function delete($id):bool
   {
        $this->find($id);
        return $this->model->destroy($id)? true : false;
   }

   public function deletePermanently($id):bool
   {
        $this->find($id)->trashed()->forceDelete()? true : false;
   }
}