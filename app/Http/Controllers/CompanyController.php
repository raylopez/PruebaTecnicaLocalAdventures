<?php

namespace App\Http\Controllers;

use App\Models\Client;
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

    public function getCompanyyId(int $id)
    {
        $company = Company::find($id);
        if (!isset($company))
            return response()->json([ 'message' => 'Company not found' ], JsonResponse::HTTP_NOT_FOUND);

        return response()->json($company);
    }

    public function clientsByCompany(int $id)
    {
        $company = Company::with('clients')->find($id);
        if (!isset($company))
            return response()->json([ 'message' => 'Company not found' ], JsonResponse::HTTP_NOT_FOUND);

        return response()->json($company);
    }

    public function getClientsInvoices(int $id) {
        $client = Client::where('company_id','=', $id)->with('invoices')->get();

        if (!isset($client))
            return response()->json(['message' => 'No hay clientes para esta compañía']);

        return response()->json($client);
    }
}
