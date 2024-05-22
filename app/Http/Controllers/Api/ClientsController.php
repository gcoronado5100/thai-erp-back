<?php

namespace App\Http\Controllers\Api;

use App\Events\NewClientEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CiampiClients;
use App\Models\FreddoClients;
use App\Models\GlasseClients;


class ClientsController extends Controller
{
    /**
     * CREATE
     * Create a new client or return an existing one
     * if the phone number already exists for any PDV
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createClient(Request $request)
    {
        $pdv_id = $request->pdv;

        // Check if a PDV is provided
        if (!$pdv_id) {
            return response()->json([
                "message" => "A PDV is required"
            ], 400);
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string'
        ]);

        // Return an error if the request is invalid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Check if the client already exists
        switch ($pdv_id) {
            case 1:
                $client = FreddoClients::where('phone', $request->phone)->first();
                break;
            case 2:
                $client = GlasseClients::where('phone', $request->phone)->first();
                break;
            case 3:
                $client = CiampiClients::where('phone', $request->phone)->first();
                break;
            default:
                $client = null;
        }

        // Return the client if it already exists
        if ($client) {
            return response()->json([
                "message" => "Client already exists",
                "client" => $client
            ], 200);
        }

        // Create a new client
        switch ($pdv_id) {
            case 1:
                $client = new FreddoClients();
                break;
            case 2:
                $client = new GlasseClients();
                break;
            case 3:
                $client = new CiampiClients();
                break;
        }

        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address_street = $request->address_street;
        $client->address_int = $request->address_int;
        $client->address_ext = $request->address_ext;
        $client->address_col = $request->address_col;
        $client->address_town = $request->address_town;
        $client->address_state = $request->address_state;
        $client->address_zip = $request->address_zip;
        $client->registered_by = $request->user_id;

        $client->save();
        NewClientEvent::dispatch();

        return response()->json([
            "message" => "Client created successfully",
            "client" => $client
        ], 201);
    }

    /**
     * READ
     * Get all clients for a specific PDV
     * 
     * @param \Illuminate\Http\Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClients(Request $req)
    {
        $pdv_id = $req->pdv_id;
        $user_id = $req->user_id;

        if (!$pdv_id || !$user_id) {
            return response()->json([
                "message" => (!$pdv_id ? "A PDV is required" : "") . " / " . (!$user_id ? "A user is required" : "")
            ], 400);
        }

        switch ($pdv_id) {
            case 1:
                $clients = FreddoClients::all();
                break;
            case 2:
                $clients = GlasseClients::all();
                break;
            case 3:
                $clients = CiampiClients::all();
                break;
            default:
                $clients = null;
        }

        return response()->json([
            $clients
        ], 200);
    }

    /**
     * READ
     * Get a single client by ID on a specific PDV
     * 
     * @param \Illuminate\Http\Request $req
     * @param int $id
     */
    public function getSingleClient(Request $req, int $id)
    {
        $pdv_id = $req->pdv_id;
        $client_id = $id;

        if (!$pdv_id || !$client_id) {
            return response()->json([
                "message" => (!$pdv_id ? "A PDV is required" : "") . " / " . (!$client_id ? "A client is required" : "")
            ], 400);
        }

        switch ($pdv_id) {
            case 1:
                $client = FreddoClients::find($client_id);
                break;
            case 2:
                $client = GlasseClients::find($client_id);
                break;
            case 3:
                $client = CiampiClients::find($client_id);
                break;
            default:
                $client = null;
        }

        return response()->json([
            $client ? $client : "Client not found"
        ], 200);
    }

    /**
     * READ
     * Search for clients by name or phone number
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchClients(Request $request, string $search)
    {
        $pdv_id = $request->pdv_id;

        if (!$pdv_id) {
            return response()->json([
                "message" => "A PDV is required"
            ], 400);
        }

        switch ($pdv_id) {
            case 1:
                $clients = FreddoClients::where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->get();
                break;
            case 2:
                $clients = GlasseClients::where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->get();
                break;
            case 3:
                $clients = CiampiClients::where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->get();
                break;
            default:
                $clients = null;
        }

        return response()->json(
            $clients,
            200
        );
    }

    /**
     * UPDATE
     * Update a client's information
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateClient(Request $request)
    {
        $pdv_id = $request->pdv;

        // Check if a PDV is provided
        if (!$pdv_id) {
            return response()->json([
                "message" => "A PDV is required"
            ], 400);
        }

        // Check if the client already exists
        switch ($pdv_id) {
            case 1:
                $client = FreddoClients::where('phone', $request->phone)->first();
                break;
            case 2:
                $client = GlasseClients::where('phone', $request->phone)->first();
                break;
            case 3:
                $client = CiampiClients::where('phone', $request->phone)->first();
                break;
            default:
                return response()->json([
                    "message" => "Client not found"
                ], 404);
        }

        // Update the client's information
        $client->first_name = $request->first_name !== null ? $request->first_name : $client->first_name;
        $client->last_name = $request->last_name !== null ? $request->last_name : $client->last_name;
        $client->email = $request->email !== null ? $request->email : $client->email;
        $client->phone = $request->phone !== null ? $request->phone : $client->phone;
        $client->address_street = $request->address_street !== null ? $request->address_street : $client->address_street;
        $client->address_int = $request->address_int !== null ? $request->address_int : $client->address_int;
        $client->address_ext = $request->address_ext !== null ? $request->address_ext : $client->address_ext;
        $client->address_col = $request->address_col !== null ? $request->address_col : $client->address_col;
        $client->address_town = $request->address_town !== null ? $request->address_town : $client->address_town;
        $client->address_state = $request->address_state !== null ? $request->address_state : $client->address_state;
        $client->address_zip = $request->address_zip !== null ? $request->address_zip : $client->address_zip;
        $client->registered_by = $request->user_id !== null ? $request->user_id : $client->registered_by;

        $client->save();

        return response()->json([
            "message" => "Client Updated successfully",
            "client" => $client
        ], 201);
    }
}
