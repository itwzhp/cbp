<?php
namespace App\Http\Controllers;

use App\Domains\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected ?User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    protected function responseOK(): JsonResponse
    {
        return JsonResponse::fromJsonString(['ok'], 200);
    }
}
