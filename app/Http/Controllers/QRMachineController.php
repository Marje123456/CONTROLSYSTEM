<?php

namespace App\Http\Controllers;
use App\Models\Machine;
use App\Models\Statusmachine;
use Carbon\Carbon;

use Illuminate\Http\Request;

class QRMachineController extends Controller
{
    //
    public function createqr(Machine $machine)
    {
        //
        return view('machine.createqr', compact('machine'));
    }

    public function activatemachine(Machine $machine)
    {
        //
        $machine = Machine::find($machine->id);
        
        $machine->qr_status = '3';
        $machine->active_status = '1';
        $machine->activation_date = Carbon::now()->format('Y-m-d');
        
        $dayactivate = Carbon::now()->format('d');
        $monthactivate = Carbon::now()->format('m');
        $yearactivate = Carbon::now()->format('Y');

        if ($monthactivate == 12) 
        {
            $montpayment = '01';
            $yearpayment = $yearactivate+1;
            $machinepayment_date = $yearpayment.'-'.$montpayment.'-02';
        } else {
            $montpayment = $monthactivate+1;
            $machinepayment_date = $yearactivate.'-'.$montpayment.'-02';
            
        }
        $paymentdate = Carbon::parse($machinepayment_date)->format('Y-m-d');
        $machine->payment_date = $paymentdate;

        $daysdebitactivation = 30-$dayactivate;
        $machine->daydebitactivation = $daysdebitactivation;

        $statusmachine = Statusmachine::find(1);
        $machinetax_day = $statusmachine->machine_tax / 30;
        $machinetax_day_format = number_format($machinetax_day, 2);
        $debitactivatione = $daysdebitactivation * $machinetax_day_format;
        $debitactivation =  $debitactivatione+$statusmachine->machine_tax;
        
        $machine->debitactivation = $debitactivation;

        $machine->save();

        return redirect()->route('machine.index');
    }

    public function qrorders()
    {
        //
        $machines = Machine::where("qr_status", 1)                         
        ->get();

        return view('machine.machineimp',compact('machines'));
    }

    public function changestatus1(Machine $machine)
    {
        //
        $machine = Machine::find($machine->id);
        
        $machine->qr_status = '1';
        $machine->save();

        return redirect()->route('machine.index');
    }

    public function changestatus2(Machine $machine)
    {
        //
        $machine = Machine::find($machine->id);
        
        $machine->qr_status = '2';
        $machine->save();

        return redirect()->route('machine.index');
    }
}
