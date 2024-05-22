<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\CiampiOrderModel;
use App\Models\CiampiQuotesModel;
use App\Models\CiampiSalesModel;
use App\Models\FreddoOrderModel;
use App\Models\GlasseOrderModel;
use App\Models\UserCapabilitiesModel;
use App\Models\UserTypeModel;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * CREATE
     * Create a new Order as a Quote for a Given PDV and Client
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function createNewQuote(Request $request)
    {
        // Validate the request data for Required Fields
        $validator = Validator::make($request->all(), [
            'created_by' => 'required|integer',
            'id_cliente' => 'required|integer',
            'pdv' => 'required|integer',
            'productos' => 'required|array',
            'total' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Validate the user has permission to create a Quote
        $capability = UserCapabilitiesModel::where('user_id', $request->created_by)->where('pdv_id', $request->pdv)->first();
        $role = UserTypeModel::where('id', $capability->user_type_id)->first();
        $permissions = json_decode($role->capabilities);

        if ($permissions->create_order == false) {
            return response()->json(['error' => 'User does not have permission to create a Quote'], 400);
        }

        // Create a Dummy variable to store the Order
        $order = null;

        // Validate the PDV
        switch ($request->pdv) {
            case 1:
                $order = new FreddoOrderModel();
                break;
            case 2:
                $order = new GlasseOrderModel();
                break;
            case 3:
                $order = new CiampiOrderModel();
                break;
        }

        // If the Order is null, return an error
        if ($order == null) {
            return response()->json(['error' => 'PDV not valid'], 400);
        }

        // Create a new Quote
        $folio = new CiampiQuotesModel();
        $folio->save();

        // Store the Order Data into the Variable
        $order->created_by = $request->created_by;
        $order->pdv = $request->pdv;
        $order->id_cliente = $request->id_cliente;
        $order->productos = json_encode($request->productos);
        $order->descuentos = json_encode($request->descuentos);
        $order->folio_status_id = 1;
        $order->folio_cotizacion_id = $folio->id;
        $order->subtotal_productos = json_encode($request->subtotal_productos);
        $order->subtotal_promos = $request->subtotal_promos;
        $order->detalle_anticipo = json_encode($request->detalles_anticipo);
        $order->detalles_pago = json_encode($request->detalles_pago);
        $order->observaciones = $request->observaciones;
        $order->detalles_envio = json_encode($request->detalles_envio);
        $order->total = $request->total;

        // Save the Order in the Database
        $order->save();

        // Return the Order Json
        return response()->json([
            'message' => 'Order Created Successfully',
            'order' => $order
        ], 200);
    }

    /**
     * READ
     * Get all the Quotes for a given user on a PDV
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllQuotes(Request $request)
    {
        // Validate the request data for Required Fields
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'pdv_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Validate the user has permission to see Quote(s)
        $capability = UserCapabilitiesModel::where('user_id', $request->user_id)->where('pdv_id', $request->pdv_id)->first();
        $role = UserTypeModel::where('id', $capability->user_type_id)->first();
        $permissions = json_decode($role->capabilities);

        if ($permissions->read_order == false) {
            return response()->json(['error' => 'User does not have permission to see Quote(s)'], 400);
        }

        // Create a Dummy variable to store the Orders
        $orders = null;

        /**
         * Get the Quotes
         * if the user is a "Seller" (id 5) then only get the Orders created by the user
         * Else get all the Orders of the provided PDV
         */
        if ($capability->user_type_id !== 5) {
            $orders = CiampiOrderModel::where('folio_status_id', 1)->where('pdv', $request->pdv_id)->get();
        } else {
            $orders = CiampiOrderModel::where('folio_status_id', 1)->where('created_by', $request->user_id)->where('pdv', $request->pdv_id)->get();
        }

        // Decode the JSON fields
        foreach ($orders as $order) {
            $order->productos = json_decode($order->productos);
            $order->descuentos = json_decode($order->descuentos);
            $order->subtotal_productos = json_decode($order->subtotal_productos);
            $order->detalle_anticipo = json_decode($order->detalle_anticipo);
            $order->detalles_pago = json_decode($order->detalles_pago);
            $order->detalles_envio = json_decode($order->detalles_envio);
        }

        // Return the Orders Json
        return response()->json([
            'message' => 'Orders Retrieved Successfully',
            'orders' => $orders
        ], 200);
    }

    /**
     * READ
     * Get all the Sales for a given user on a PDV
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllSales(Request $request)
    {
        // Validate the request data for Required Fields
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'pdv_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Validate the user has permission to see Quote(s)
        $capability = UserCapabilitiesModel::where('user_id', $request->user_id)->where('pdv_id', $request->pdv_id)->first();
        $role = UserTypeModel::where('id', $capability->user_type_id)->first();
        $permissions = json_decode($role->capabilities);

        if ($permissions->read_order == false) {
            return response()->json(['error' => 'User does not have permission to see Quote(s)'], 400);
        }

        // Create a Dummy variable to store the Orders
        $orders = null;

        /**
         * Get the Quotes
         * if the user is a "Seller" (id 5) then only get the Orders created by the user
         * Else get all the Orders of the provided PDV
         */
        if ($capability->user_type_id !== 5) {
            $orders = CiampiOrderModel::where('folio_status_id', 2)->where('pdv', $request->pdv_id)->get();
        } else {
            $orders = CiampiOrderModel::where('folio_status_id', 2)->where('created_by', $request->user_id)->where('pdv', $request->pdv_id)->get();
        }

        // Decode the JSON fields
        foreach ($orders as $order) {
            $order->productos = json_decode($order->productos);
            $order->descuentos = json_decode($order->descuentos);
            $order->subtotal_productos = json_decode($order->subtotal_productos);
            $order->detalle_anticipo = json_decode($order->detalle_anticipo);
            $order->detalles_pago = json_decode($order->detalles_pago);
            $order->detalles_envio = json_decode($order->detalles_envio);
        }

        // Return the Orders Json
        return response()->json([
            'message' => 'Orders Retrieved Successfully',
            'orders' => $orders
        ], 200);
    }

    /**
     * READ
     * Get all the Cancelled orders for a given user on a PDV
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCancelled(Request $request)
    {
    }

    /**
     * READ
     * Get a Single Order either a Quote or a Sale or a Cancelled Order
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSingleOrder(Request $request, int $id)
    {
    }

    /**
     * READ
     * Search Orders either a Quote or a Sale or a Cancelled Order by a given criteria
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function SearchOrders(Request $request, string $term)
    {
        // Validate the search term
        if ($term == null) {
            return response()->json(['error' => 'No search term was provided'], 400);
        }

        // Validate the request data for Required Fields
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'pdv_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Validate the user has permission to see Quote(s)
        $capability = UserCapabilitiesModel::where('user_id', $request->user_id)->where('pdv_id', $request->pdv_id)->first();
        $role = UserTypeModel::where('id', $capability->user_type_id)->first();
        $permissions = json_decode($role->capabilities);

        if ($permissions->read_order == false) {
            return response()->json(['error' => 'User does not have permission to see Quote(s)'], 400);
        }

        // Create a Dummy variable to store the Orders
        $orders = null;

        /**
         * Get the Quotes
         * if the user is a "Seller" (id 5) then only get the Orders created by the user
         * Else get all the Orders of the provided PDV
         */

        if ($capability->user_type_id !== 5) {
            switch ($request->pdv_id) {
                case 1:
                    $orders = FreddoOrderModel::where('pdv', $request->pdv_id)
                        ->where('folio_cotizacion_id', 'like', '%' . $term . '%')
                        ->orWhere('folio_nota_venta_id', 'like', '%' . $term . '%')
                        ->orWhereHas('FreddoClients', function ($query) use ($term) {
                            $query->where('first_name', 'like', '%' . $term . '%')
                                ->orWhere('last_name', 'like', '%' . $term . '%')
                                ->orWhere('email', 'like', '%' . $term . '%')
                                ->orWhere('phone', 'like', '%' . $term . '%');
                        })
                        ->get();
                    break;
                case 2:
                    $orders = GlasseOrderModel::where('pdv', $request->pdv_id)
                        ->where('folio_cotizacion_id', 'like', '%' . $term . '%')
                        ->orWhere('folio_nota_venta_id', 'like', '%' . $term . '%')
                        ->orWhereHas('GlasseClients', function ($query) use ($term) {
                            $query->where('first_name', 'like', '%' . $term . '%')
                                ->orWhere('last_name', 'like', '%' . $term . '%')
                                ->orWhere('email', 'like', '%' . $term . '%')
                                ->orWhere('phone', 'like', '%' . $term . '%');
                        })
                        ->get();
                    break;
                case 3:
                    $orders = CiampiOrderModel::where('pdv', $request->pdv_id)
                        ->where('folio_cotizacion_id', 'like', '%' . $term . '%')
                        ->orWhere('folio_nota_venta_id', 'like', '%' . $term . '%')
                        ->orWhereHas('ciampiClients', function ($query) use ($term) {
                            $query->where('first_name', 'like', '%' . $term . '%')
                                ->orWhere('last_name', 'like', '%' . $term . '%')
                                ->orWhere('email', 'like', '%' . $term . '%')
                                ->orWhere('phone', 'like', '%' . $term . '%');
                        })
                        ->get();
                    break;
            }
        } else {
            switch ($request->pdv_id) {
                case 1:
                    $orders = FreddoOrderModel::where('pdv', $request->pdv_id)
                        ->where('folio_cotizacion_id', 'like', '%' . $term . '%')
                        ->orWhere('folio_nota_venta_id', 'like', '%' . $term . '%')
                        ->orWhereHas('ciampiClients', function ($query) use ($term) {
                            $query->where('first_name', 'like', '%' . $term . '%')
                                ->orWhere('last_name', 'like', '%' . $term . '%')
                                ->orWhere('email', 'like', '%' . $term . '%')
                                ->orWhere('phone', 'like', '%' . $term . '%');
                        })
                        ->where('created_by', $request->user_id)
                        ->get();
                    break;
                case 2:
                    $orders = GlasseOrderModel::where('pdv', $request->pdv_id)
                        ->where('folio_cotizacion_id', 'like', '%' . $term . '%')
                        ->orWhere('folio_nota_venta_id', 'like', '%' . $term . '%')
                        ->orWhereHas('ciampiClients', function ($query) use ($term) {
                            $query->where('first_name', 'like', '%' . $term . '%')
                                ->orWhere('last_name', 'like', '%' . $term . '%')
                                ->orWhere('email', 'like', '%' . $term . '%')
                                ->orWhere('phone', 'like', '%' . $term . '%');
                        })
                        ->where('created_by', $request->user_id)
                        ->get();
                    break;
                case 3:
                    $orders = CiampiOrderModel::where('pdv', $request->pdv_id)
                        ->where('folio_cotizacion_id', 'like', '%' . $term . '%')
                        ->orWhere('folio_nota_venta_id', 'like', '%' . $term . '%')
                        ->orWhereHas('ciampiClients', function ($query) use ($term) {
                            $query->where('first_name', 'like', '%' . $term . '%')
                                ->orWhere('last_name', 'like', '%' . $term . '%')
                                ->orWhere('email', 'like', '%' . $term . '%')
                                ->orWhere('phone', 'like', '%' . $term . '%');
                        })
                        ->where('created_by', $request->user_id)
                        ->get();
                    break;
            }
        }

        // Decode the JSON fields
        foreach ($orders as $order) {
            $order->productos = json_decode($order->productos);
            $order->descuentos = json_decode($order->descuentos);
            $order->subtotal_productos = json_decode($order->subtotal_productos);
            $order->detalle_anticipo = json_decode($order->detalle_anticipo);
            $order->detalles_pago = json_decode($order->detalles_pago);
            $order->detalles_envio = json_decode($order->detalles_envio);
        }

        // Return the Orders Json
        return response()->json([
            'message' => 'Orders Retrieved Successfully',
            'orders' => $orders
        ], 200);
    }

    /**
     * UPDATE
     * Edit a Quote Order
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editOrder(Request $request, int $id)
    {
        // Validate the Order ID
        if ($id == null) {
            return response()->json(['error' => 'Order ID is required'], 400);
        }

        // Validate the request data for Required Fields
        $validator = Validator::make($request->all(), [
            'created_by' => 'required|integer',
            'id_cliente' => 'required|integer',
            'pdv' => 'required|integer',
            'edited_by' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Validate the user has permission to edit a Order
        $capability = UserCapabilitiesModel::where('user_id', $request->edited_by)->where('pdv_id', $request->pdv)->first();
        $role = UserTypeModel::where('id', $capability->user_type_id)->first();
        $permissions = json_decode($role->capabilities);

        // Create a Dummy variable to store the Order
        $order = null;

        // Validate the PDV and search for the Order 
        switch ($request->pdv) {
            case 1:
                $order = FreddoOrderModel::where('id', $id)->first();
                break;
            case 2:
                $order = GlasseOrderModel::where('id', $id)->first();
                break;
            case 3:
                $order = CiampiOrderModel::where('id', $id)->first();
                break;
        }

        // If the Order is null, return an error
        if ($order == null) {
            return response()->json(['error' => 'Order Not Found'], 404);
        }

        // Check if the User has permission to edit the Order depending on the Order Status
        if ($order->folio_status_id === 1) {
            if ($permissions->update_quote == false) {
                return response()->json(['error' => 'User does not have permission to edit an Order'], 400);
            }
        } else if ($order->folio_status_id === 2) {
            if ($permissions->update_sale == false) {
                return response()->json(['error' => 'User does not have permission to edit an Order'], 400);
            }
        } else {
            return response()->json(['error' => 'This order is no longer editable'], 400);
        }

        // Store the Order Data into the Variable
        $order->edited_by = $request->edited_by;
        $order->id_cliente = $request->id_cliente ? $request->id_cliente : $order->id_cliente;
        $order->productos = json_encode($request->productos) ? json_encode($request->productos) : $order->productos;
        $order->descuentos = json_encode($request->descuentos) ? json_encode($request->descuentos) : $order->descuentos;
        $order->subtotal_productos = json_encode($request->subtotal_productos) ? json_encode($request->subtotal_productos) : $order->subtotal_productos;
        $order->subtotal_promos = $request->subtotal_promos ? $request->subtotal_promos : $order->subtotal_promos;
        $order->detalle_anticipo = json_encode($request->detalles_anticipo) ? json_encode($request->detalles_anticipo) : $order->detalle_anticipo;
        $order->detalles_pago = json_encode($request->detalles_pago) ? json_encode($request->detalles_pago) : $order->detalles_pago;
        $order->observaciones = $request->observaciones ? $request->observaciones : $order->observaciones;
        $order->detalles_envio = json_encode($request->detalles_envio) ? json_encode($request->detalles_envio) : $order->detalles_envio;
        $order->total = $request->total ? $request->total : $order->total;

        // Save the Order in the Database
        $order->save();

        // Return the Order Json
        return response()->json([
            'message' => 'Order Edited Successfully',
            'order' => $order
        ], 200);
    }

    /**
     * UPDATE
     * Turn a Quote into a Sale
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function turnToSale(Request $request, int $id)
    {
        // Validate the Order ID
        if ($id == null) {
            return response()->json(['error' => 'Order ID is required'], 400);
        }

        // Validate the request data for Required Fields
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'pdv_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Validate the user has permission to create a Sale
        $capability = UserCapabilitiesModel::where('user_id', $request->user_id)->where('pdv_id', $request->pdv_id)->first();
        $role = UserTypeModel::where('id', $capability->user_type_id)->first();
        $permissions = json_decode($role->capabilities);

        if ($permissions->create_order == false) {
            return response()->json(['error' => 'User does not have permission to Create a Sale Order'], 400);
        }

        // Get the Order
        $order = CiampiOrderModel::where('id', $id)->first();

        // Validate the Order
        if ($order == null) {
            return response()->json(['error' => 'Order not found'], 400);
        }

        // Validate the Order is a Quote
        if ($order->folio_status_id !== 1) {
            return response()->json(['error' => 'Order is not a Quote'], 400);
        }

        // Create a new Sale
        $folio = new CiampiSalesModel();
        $folio->save();

        // Update the Order to a Sale
        $order->folio_status_id = 2;
        $order->folio_nota_venta_id = $folio->id;
        $order->edited_by = $request->user_id;
        $order->save();

        // Decode the JSON fields
        $order->productos = json_decode($order->productos);
        $order->descuentos = json_decode($order->descuentos);
        $order->subtotal_productos = json_decode($order->subtotal_productos);
        $order->detalle_anticipo = json_decode($order->detalle_anticipo);
        $order->detalles_pago = json_decode($order->detalles_pago);
        $order->detalles_envio = json_decode($order->detalles_envio);


        // Return the Order Json
        return response()->json([
            'message' => 'Sale Created Successfully',
            'order' => $order
        ], 200);
    }

    /**
     * UPDATE
     * Approve an Order depending on the User Role
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveOrder(Request $request, int $id)
    {
        // Validate the Order ID
        if ($id == null) {
            return response()->json(['error' => 'Order ID is required'], 400);
        }

        // Validate the request data for Required Fields
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Validate the user has permission to Approve an Order
        $capability = UserCapabilitiesModel::where('user_id', $request->edited_by)->where('pdv_id', $request->pdv)->first();
        $role = UserTypeModel::where('id', $capability->user_type_id)->first();
        $permissions = json_decode($role->capabilities);

        if ($permissions->appove_order == false) {
            return response()->json(['error' => 'User does not have permission to Approve an Order'], 400);
        }

        // Get the Order
        $order = CiampiOrderModel::where('id', $id)->first();

        // Validate the Order
        if ($order == null) {
            return response()->json(['error' => 'Order not found'], 400);
        }

        // Validate the Order is a Sale
        if ($order->folio_status_id !== 2) {
            return response()->json(['error' => 'Order is not a Sale, Can not be approved'], 400);
        }

        // Approve the Order depending on the User Role
        switch ($role->id) {
            case 6:
                // PDV Manager Approval
                $order->pdv_approval = true;
                break;
            case 7:
                // Head Assitant Approval
                if ($order->pdv_approval === true) {
                    $order->assitant_approval = true;
                } else {
                    return response()->json(['error' => 'PDV Manager Approval is required'], 400);
                }
                break;
            case 3:
                // Manager Approval
                if ($order->pdv_approval === true && $order->assitant_approval === true) {
                    $order->manager_approval = true;
                } else {
                    return response()->json(['error' => 'PDV Manager and Head Assitant Approval is required'], 400);
                }
                break;
            case 4:
                // Manager Approval also Applies for Sub Manager User Type
                if ($order->pdv_approval === true && $order->assitant_approval === true) {
                    $order->manager_approval = true;
                } else {
                    return response()->json(['error' => 'PDV Manager and Head Assitant Approval is required'], 400);
                }
                break;
            case 2:
                // CEO Approval
                if ($order->pdv_approval === true && $order->assitant_approval === true && $order->manager_approval === true) {
                    $order->ceo_approval = true;
                } else {
                    return response()->json(['error' => 'PDV Manager, Head Assitant and Manager Approval is required'], 400);
                }
                break;
            default:
                return response()->json(['error' => 'User Role not permitted'], 400);
        }

        // Save the Order in the Database
        $order->save();

        // Return the Order Json
        return response()->json([
            'message' => 'Order Approved Successfully',
            'order' => $order
        ], 200);
    }

    /**
     * DELETE - It's not a real DELETE, it's a SOFT DELETE (UPDATE)
     * Cancel an Order
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelOrder(Request $request, int $id)
    {
    }
}
