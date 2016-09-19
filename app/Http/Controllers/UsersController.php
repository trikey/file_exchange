<?php

namespace App\Http\Controllers;

use Event;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Events\UserConfirmed;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('App\Http\Middleware\LangMiddleware');
        $this->middleware('auth'); // только авторизованные пользователи
        $this->middleware('App\Http\Middleware\AdminOrModeratorOnlyMiddleware'); // только администраторы и модераторы

        $this->create_view = 'users.create';
        $this->index_view = 'users.index';
        $this->edit_view = 'users.edit';

        $this->model = 'App\User';
        $this->list_page = 'users';
    }

    public function index()
    {
        $model = $this->model;
        if (Auth::user()->isAdmin) {
            $users = $model::paginate($this->items_per_page);
        }
        else {
            $users = $model::FindUsers()->paginate($this->items_per_page);
        }
        return view($this->index_view, compact('users'));
    }

    public function storeUser(UserRequest $request)
    {
        $model = $this->model;
        $user = new $model($request->all());
        $user->save();
        return redirect($this->list_page);
    }

    public function updateUser($id, UserRequest $request)
    {
        $model = $this->model;
        $user = $model::findOrFail($id);
        $data = $request->all();
        if (!strlen($data["password"])) { // проверяем заполнен ли пароль
            unset($data["password"]); // если не заполнен - убираем его из проверки
        }
        $user->update($data);
        return redirect($this->list_page);
    }

    public function editUser($id)
    {
        $model = $this->model;
        $user = $model::find($id);
        if ((Auth::user()->isModerator && !$user->isAdmin) && ($user->isAdmin || $user->isModerator)) {
            return redirect($this->list_page);
        }
        return view($this->edit_view, compact('user'));
    }

    public function search(Request $request)
    {
        $search = $request->get('query');
        $model = $this->model;
        if (Auth::user()->isAdmin) {
            $users = $model::paginate($this->items_per_page);
        } else {
            $users = $model::FindUsers()->paginate($this->items_per_page);
        }
        if (strlen($search) > 0)
        {
            $model = $this->model;
            if (Auth::user()->isAdmin) {
                $users = $model::FindUsersByName($search)->paginate($this->items_per_page);
            }
        }
        return view($this->index_view, compact('users', 'search'));
    }

    public function pendingConfirmation()
    {
        $model = $this->model;
        $users = $model::where('canAccess', '0')->where('isModerator', '0')->where('isAdmin', '0')->paginate($this->items_per_page);
        return view('users.pending', compact('users'));
    }

    public function confirm($id)
    {
        $model = $this->model;
        $user = $model::find($id);
        $user->canAccess = 1;
        $user->save();
        Event::fire(new UserConfirmed($user));
        return redirect(route('admin_users_unconfirmed'));
    }

    public function getUser()
    {
        return response()->json(Auth::user());
    }
}
