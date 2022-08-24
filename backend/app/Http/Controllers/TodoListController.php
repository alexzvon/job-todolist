<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Repositories\TodoListRepository;

use App\Events\TodoListChange;


class TodoListController extends Controller
{
    private $todoListRepository;

    public function __construct()
    {
        $this->todoListRepository = app(TodoListRepository::class);
    }

    public function LoadViewTodoList()
    {
        $list = $this->todoListRepository->SelectAll();

        return Inertia::render('TodoList', ['list' => $list]);
    }

    public function AllTodoList()
    {
        return $this->todoListRepository->SelectAll();
    }

    public function DeleteTodoList($id) 
    {
        $result = $this->todoListRepository->Delete($id);

        TodoListChange::dispatch();

        return $result;
    }

    public function AddTodoList(Request $request)
    {
        $result = $this->todoListRepository->Create($request->name);

        TodoListChange::dispatch();

        return $result;
    }
}
