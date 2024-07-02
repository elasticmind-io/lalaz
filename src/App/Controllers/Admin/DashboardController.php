<?php declare(strict_types=1);

namespace App\Controllers\Admin;

use Lalaz\Http\Controller;

class DashboardController extends Controller
{
    public function index($req, $res)
    {
        $userId = $req->user->id;
        $data = [
            'userId' => $userId,
            'userName' => $req->user->name
        ];
        $res->render('admin/dashboard/index', $data);
    }
}
