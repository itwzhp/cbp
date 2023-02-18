<?php
namespace App\Http\Controllers;

use App\Domains\Users\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected ?User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    protected function responseOK()
    {
        
    }
}
