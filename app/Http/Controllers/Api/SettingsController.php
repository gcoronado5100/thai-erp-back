<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCapabilities;
use App\Models\UserCapabilitiesModel;
use App\Models\UserSettingsModel;
use App\Models\UserTypeModel;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // There's no need to creat a CRUD operator for this controller
    // We only need Reading and Updating

    /**
     * CREATE
     * No need to create a new settings record
     */

    /**
     * READ
     * Get the PDVs available for a given user
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPdvsAvailable(int $id)
    {
        if (!$id) {
            return response()->json(['error' => 'No se ha proporcionado un ID de usuario'], 400);
        }

        // find the user
        $usersPDVs = UserCapabilitiesModel::where('user_id', $id)->get();

        return response()->json([
            'settings' => $usersPDVs,
        ], 200);
    }

    /**
     * READ
     * Get the settings for a given user
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSettings(int $id)
    {
        if (!$id) {
            return response()->json(['error' => 'No se ha proporcionado un ID de usuario'], 400);
        }

        // find the user
        $userSettings = UserSettingsModel::where('user_id', $id)->first();
        $capabilities = UserCapabilitiesModel::where('user_id', $id)->where('pdv_id', $userSettings->pdv_id)->get();
        $permissions = UserTypeModel::where('id', $capabilities[0]->user_type_id)->first();

        return response()->json([
            'settings' => $userSettings,
            'permissions' => json_decode($permissions->capabilities, true)
        ], 200);
    }

    /**
     * UPDATE
     * Update the settings for a given user
     * 
     * @param \Illuminate\Http\Request $req
     * @param int $id
     */

    public function updateSettings(Request $req, int $id)
    {
        if (!$id) {
            return response()->json(['error' => 'No se ha proporcionado un ID de usuario'], 400);
        }

        // find the user
        $userSettings = UserSettingsModel::where('user_id', $id)->first();


        // update the settings
        $userSettings->pdv_id = $req->pdv_id ? $req->pdv_id : $userSettings->pdv_id;
        $userSettings->theme = $req->theme ? $req->theme : $userSettings->theme;
        $userSettings->showNews = $req->showNews ? $req->showNews : $userSettings->showNews;

        $capabilities = UserCapabilitiesModel::where('user_id', $id)->where('pdv_id', $req->pdv_id)->get();
        $permissions = UserTypeModel::where('id', $capabilities[0]->user_type_id)->first();

        return response()->json([
            'message' => 'Settings updated successfully',
            'settings' => $userSettings,
            'permissions' => json_decode($permissions->capabilities, true)
        ], 200);
    }
}
