<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function closeModalAgreement(Request $request): JsonResponse
    {
        session()->push('app.agreement', true);

        return response()->json(['success' => true]);

    }
}
