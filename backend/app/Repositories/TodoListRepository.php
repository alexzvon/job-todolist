<?php
declare(strict_types=1);

namespace App\Repositories;

use Exception;

use App\Models\TodoList as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TodoListRepository extends CoreRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getModelClass(): string
    {
        return Model::class;
    }

    public function Create($name): int
    {
        $result = 0;

        try {
            DB::beginTransaction();

            $model = $this->startConditions()->create(['name' => $name]);

            DB::commit();

            $result = $model->id;

        } catch (Exception $exception) {
            DB::rollBack();
            log::Debug($exception);
            $result = 0;
        }

        return $result;
    }

    public function Delete($id): int
    {
        $result = false;

        try {
            DB::beginTransaction();

            $result = $this->startConditions()->destroy($id);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            log::Debug($exception);
            $result = false;
        }

        return $result;
    }

    public function SelectAll(): array
    {
        return $this->startConditions()->all()->toArray();

    }
}
