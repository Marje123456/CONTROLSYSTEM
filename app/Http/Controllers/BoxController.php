<?php

namespace App\Http\Controllers;

use App\Exports\CloseboxExport;
use App\Models\Closebox;
use App\Models\Receipt;
use App\Models\Statusmachine;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $closeboxs = Closebox::all();
        return view('box.index',compact('closeboxs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $iduserbox = auth()->user()->id;
        $date_close_box = Carbon::now()->format('Y-m-d');


        /* TOTAL MOUNT */
        $receipts_total = Receipt::where("userbox", $iduserbox)->get();
        $total_receipt = 0;

        if (isset($receipts_total)) 
        {
            foreach ($receipts_total as $receipt_total) 
            {
                $total_receipt = $total_receipt+$receipt_total->total_amount;
            }
        } else 
        {
            $total_receipt=0;
        }
        
        

        /* TOTAL CASH */
        $receipts_cash = Receipt::where("userbox", $iduserbox)
                                    ->where("paymenttype", 1)
                                    ->get();
        $total_cash = 0;
        if (isset($receipts_cash)) 
        {
            foreach ($receipts_cash as $receipt_cash) 
            {
                $total_cash = $total_cash+$receipt_cash->total_amount;
            }
        } else 
        {
            $total_cash=0;
        }


        /* TOTAL TRANS */
        $receipts_trans = Receipt::where("userbox", $iduserbox)
                                ->where("paymenttype", 2)
                                ->get();
        $total_trans = 0;
        if (isset($receipts_trans)) {
            foreach ($receipts_trans as $receipt_trans) 
            {
                $total_trans = $total_trans + $receipt_trans->total_amount;
            }
        } else {
            $total_trans = 0;
        }

        /* TOTAL QR */
        $receipts_qr = Receipt::where("userbox", $iduserbox)
                                ->where("paymenttype", 3)
                                ->get();
        $total_qr = 0;
        if (isset($receipts_qr)) {
            foreach ($receipts_qr as $receipt_qr) {
                $total_qr = $total_qr + $receipt_qr->total_amount;
            }
        } else {
            $total_qr = 0;
        }
        
        return view('box.closebox',compact('iduserbox','date_close_box','receipts_total','total_receipt','total_cash','total_trans','total_qr'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $iduserbox = auth()->user()->id;
        $closebox = new closebox;
        $closebox->userbox = $iduserbox;
        $closebox->close_date = $request->close_date;
        $closebox->total_amount = $request->total_amount;
        $closebox->total_cash = $request->total_cash;
        $closebox->total_trans = $request->total_trans;
        $closebox->total_qr = $request->total_qr;
        $closebox->save();

        return view('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function closemunicipality()
    {
        $closeboxs = Closebox::all();
        
        $total_amount=0;
        $total_cash=0;
        $total_trans=0;
        $total_QR=0;

        foreach ($closeboxs as $closebox) 
        {
            if (isset($closebox->total_amount)) 
            {
                $total_amount = $total_amount + $closebox->total_amount;
            }
            if (isset($closebox->total_cash)) 
            {
                $total_cash = $total_cash + $closebox->total_cash;
            }
            if (isset($closebox->total_trans)) 
            {
                $total_trans = $total_trans + $closebox->total_trans;
            }
            if (isset($closebox->total_QR)) 
            {
                $total_QR = $total_QR + $closebox->total_QR;
            }
        }

        $date_close_box = Carbon::now()->format('Y-m-d');

        $porcentconsult = Statusmachine::find(1);
        $porcentset = $porcentconsult->porcent_company;
        $porcentfor = $porcentset/100;
        $porcent_company = $porcentfor*$total_amount;

        return view('box.closemunicipatily',compact('closeboxs','total_amount','total_cash','total_trans','total_QR','date_close_box','porcent_company'));
    }


    public function closemunireceipt(Request $request)
    {
        $date_close_box = $request->date_close_box;
        $total_amount = $request->total_amount;
        $total_cash = $request->total_cash;
        $total_trans = $request->total_trans;
        $total_QR = $request->total_QR;
        $porcent_company = $request->porcent_company;

        $pdf = Pdf::loadView('box.municipalityreceipt', compact('date_close_box','total_amount','total_cash','total_trans','total_QR','porcent_company'))->setPaper('a6', 'portrait');
        return $pdf->stream('recibocierre.pdf');
    }

    public function closemunipdf(Request $request)
    {
        $date_close_box = $request->close_date;
        $total_amount = $request->total_amount;
        $total_cash = $request->total_cash;
        $total_trans = $request->total_trans;
        $total_QR = $request->total_qr;
        $porcent_company = $request->mount_company;

        $data = [
            'date_close_box'=>$date_close_box,
            'total_amount'=>$total_amount,
            'total_cash'=>$total_cash,
            'total_trans'=>$total_trans,
            'total_QR'=>$total_QR,
            'porcent_company'=>$porcent_company
        ];


        return view('box.closemunipdf',compact('data'));
    }


    public function indexpdf()
    {
        $closeboxs = Closebox::all();
        
        $pdf = Pdf::loadView('box.indexpdf', compact('closeboxs'))->setPaper('a4', 'portrait');
        return $pdf->stream('recibocierre.pdf');
    }


    public function payporcent()
    {
        $payporcent = Statusmachine::find(1);
        return view('box.payporcent', compact('payporcent'));
    }

    public function updatepayporcent(Request $request, Statusmachine $porcent_company)
    {
        $porcent_company = Statusmachine::find(1);
        $porcent_company->porcent_company = $request->porcent_company;
        $porcent_company->save();

        return redirect()->route('box.payporcent')->with('porcent','OK');
    }
   
    

}
