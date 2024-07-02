<?php declare(strict_types=1);

namespace App\Controllers\Admin;

use Lalaz\Http\Controller;
use App\Models\User;

class LoginController extends Controller
{
    public function index($req, $res)
    {
        $res->render('admin/login/index');
    }

    public function create($req, $res)
    {
        $req->validateCsrfToken();

        ['username' => $username, 'password' => $password] = $req->body();

        $user = User::authenticate($username, $password);

        if (!$user) {
            $res->flash('loginError', 'Credenciais nao sao validas!', 'error')
                ->redirect('/admin');
        }

        $res->addSession('isAuthenticated', true);
        $res->addSession('user', $user->id);
        $res->redirect('/admin/dashboard');
    }

    public function destroy($req, $res)
    {
        $res->destroySession()->redirect('/admin');
    }
}
