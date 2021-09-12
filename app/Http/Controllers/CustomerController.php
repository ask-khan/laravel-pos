<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('customer.index');
    }

    /**
     * Get Customer Data.
     */
    public function get_customer_data(Request $request){
        $customers = Customer::latest()->paginate(5);
        return \Request::ajax() ?  response()->json($customers,Response::HTTP_OK) : abort(404);
    }

    /**
     * 
     * get Customer Sales.
     */
    function get_customer_sales ( Request $request ) {
        if ( $request->type == 1 ) {
            $noOfInvoice = Invoice::where('customerid', $request->id )->get();
            return \Request::ajax() ?  response()->json($noOfInvoice,Response::HTTP_OK) : abort(404);
        }
        else  if ( $request->type == 2 ) {
            $now = date('Y-m-d');
        
            $noOfInvoice = DB::table('invoices')
                ->whereDate('created_at', $now)
                ->get();
            return \Request::ajax() ?  response()->json($noOfInvoice,Response::HTTP_OK) : abort(404);
        } 
        
    }

    /**
     * Get Monthly Sales.
     */
    public function get_monthly_sales( Request $request ) { 
        if ( $request['typeId'] == 3 ) {

            $from = date("Y-m-d", strtotime($request['fromDate'])); 
            $to = date("Y-m-d", strtotime($request['toDate']));
            $noOfInvoice = Invoice::whereBetween('created_at', [$from, $to])->get();
            
            return \Request::ajax() ?  response()->json($noOfInvoice,Response::HTTP_OK) : abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        Customer::updateOrCreate(
        [
            'id' => $request->id
        ],
        [
            'name' => $request->name,
            'area' => $request->address,
            'phone_number' => $request->phoneNumber
        ]
        );

        return response()->json(
        [
        'success' => true,
        'message' => 'Data inserted successfully'
         ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update($id){
        
        $customer  = Customer::find($id);

        return response()->json([
         'data' => $customer
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $customer = Customer::find($id);

        $customer->delete();
    
        return response()->json([
          'message' => 'Data deleted successfully!'
        ]);
    }
}
