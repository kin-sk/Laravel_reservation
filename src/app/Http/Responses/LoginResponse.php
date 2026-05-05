<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
      $user = $request->user();
      // 管理者ユーザー
      if ($user && $user->isAdmin()) {
        return redirect()->route('admin.reservations.index');
      }
      // 通常ユーザー
      return redirect('/dashboard');
    }
}