<?php declare(strict_types=1);

namespace App\Controllers;

use Lalaz\Controller;
use Lalaz\Route;

class HomeController extends Controller 
{
    public function index($req, $res) {
        $res->render('home/index', [
            'title' => 'Lalaz Framework'
        ]);
    }

    public function show($req, $res) {
        // $res->flash('teste', 'erro de teste', 'error')->redirect('/about');
        $res->render('home/index', ['id' => $req->params('id')]);
    }
}