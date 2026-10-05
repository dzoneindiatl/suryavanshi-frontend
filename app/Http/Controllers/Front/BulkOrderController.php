<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BulkOrder;

class BulkOrderController extends Controller
{
    public function submitBulkOrder(Request $request)
    {
        $request->validate([
            'first_name'      => 'required|string|max:100',
            'phone'           => 'required|digits_between:10,12',
            'email'           => 'required|email|max:255',
            'quantity'        => 'required|integer|min:10',
            'customisation'   => 'required|in:Yes,No',
            'gst'             => 'required|in:Yes,No',
            'preferred_time'  => 'required|in:Morning,Afternoon,Evening',
            'details'         => 'required|string',
            "product_id"      => 'required'
        ]);

        BulkOrder::create([
            'first_name'      => $request->first_name,
            'phone'           => $request->phone,
            'email'           => $request->email,
            'quantity'        => $request->quantity,
            'customisation'   => $request->customisation,
            'gst'             => $request->gst,
            'preferred_time'  => $request->preferred_time,
            'details'         => $request->details,
            "product_id"      => $request->product_id
        ]);

        return response()->json(['success' => true, 'message' => 'Bulk order submitted successfully']);
    }
}
