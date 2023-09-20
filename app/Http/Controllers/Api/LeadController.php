<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Services\LeadGenerator\LeadGenerator;
use http\Env\Response;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use Mockery\Exception;

class LeadController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'birthday' => 'required|date',
            'phone' => 'required|string|min:17|max:17',
            'email' => 'required|email',
            'comment' => 'required|string'
        ]);

        try {
            $lead = Lead::query()->create($validated);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }

        $response = (new LeadGenerator($lead))->generate();

        return response()->json(['message' => $response]);
    }
}
