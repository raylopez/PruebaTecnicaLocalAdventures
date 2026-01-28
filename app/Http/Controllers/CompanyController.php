<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Obtener companias
     */
    public function index()
    {
        $companies = Company::all();

        return response()->json($companies);
    }

    public function clientsByCompany(int $id)
    {
        $company = Company::with('clients')->find($id);
        if (!isset($company))
            return response()->json([ 'message' => 'Company not found' ], JsonResponse::HTTP_NOT_FOUND);

        return response()->json($company);
    }
}
