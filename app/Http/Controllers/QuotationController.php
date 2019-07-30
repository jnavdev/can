<?php

namespace App\Http\Controllers;

use App\Bill;
use App\File;
use App\Client;
use DataTables;
use App\Purchase;
use App\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function dataValid()
    {
        $quotations = Quotation::with('client', 'client.paymentMethod')->where('state', 'Vigente')->orderBy('id', 'DESC')->get();

        return DataTables::of($quotations)
            ->editColumn('created_at', function ($quotation) {
                return date('d-m-Y', strtotime($quotation->created_at));
            })->addColumn('actions', function ($quotation) {
                return '<a href="'.url('cotizacion/documentacion/' . $quotation->id).'" class="btn btn-sm btn-primary">Documentación</a> <a href="'.url('cotizacion/factura/' . $quotation->id).'" class="btn btn-sm btn-info">Facturar</a> <a href="'.url('cotizacion-simple/editar/' . $quotation->id).'" class="btn btn-sm btn-warning">Editar</a>';
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function indexValid()
    {
        return view('frontEnd.quotations.indexValid');
    }

    public function dataClosed()
    {
        $quotations = Quotation::with('client', 'client.paymentMethod')->where('state', 'Cerrada')->orderBy('id', 'DESC')->get();

        return DataTables::of($quotations)
            ->editColumn('created_at', function ($quotation) {
                return date('d-m-Y', strtotime($quotation->created_at));
            })->addColumn('actions', function ($quotation) {
                return '<a href="'.url('cotizacion/documentacion/' . $quotation->id).'" class="btn btn-sm btn-primary">Documentación</a> ';
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function indexClosed()
    {
        return view('frontEnd.quotations.indexClosed');
    }

    public function dataExpired()
    {
        $quotations = Quotation::with('client', 'client.paymentMethod')->where('state', 'Caducada')->orderBy('id', 'DESC')->get();

        return DataTables::of($quotations)
            ->editColumn('created_at', function ($quotation) {
                return date('d-m-Y', strtotime($quotation->created_at));
            })->addColumn('actions', function ($quotation) {
                return '<a href="'.url('cotizacion/documentacion/' . $quotation->id).'" class="btn btn-sm btn-primary">Documentación</a> ';
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function indexExpired()
    {
        return view('frontEnd.quotations.indexExpired');
    }

    public function create()
    {
    	$clients = Client::pluck('full_name', 'id');

    	return view('frontEnd.quotations.create', compact('clients'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'client_id' => 'required'
    	]);

        $client = Client::where('rut', explode(' - ', $request->input('client_id'))[1])->first();

    	$quotation = Quotation::create([
    		'client_id' => $client->id,
    		'state' => 'Vigente'
    	]);

        $expirationData = Carbon::parse($quotation->created_at);
        
        $quotation->expiration_date = $expirationData->addDays(5)->format('Y-m-d');
        $quotation->save();

    	if ($request->file('files')) {
    		foreach ($request->file('files') as $f) {
                $fileName = "/uploads/quotations/{$quotation->id}/" . time() . '-' . $f->getClientOriginalName();
                $f->move(public_path("/uploads/quotations/{$quotation->id}/"), $fileName);

                $file = new File([
                    'name' => $fileName
                ]);

                $quotation->files()->save($file);
            }
    	}

    	return redirect('cotizaciones')->with('success', 'Guardado con éxito!');
    }

    public function edit($id)
    {
        $quotation = Quotation::find($id);
        $client = Client::find($quotation->client_id);

        return view('frontEnd.quotations.edit', compact('quotation', 'client'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'client_id' => 'required'
        ]);

        $client = Client::where('rut', explode(' - ', $request->input('client_id'))[1])->first();

        $quotation = Quotation::find($id);
        $quotation->client_id = $client->id;

        if ($request->file('files')) {
    		foreach ($request->file('files') as $f) {
                $fileName = "/uploads/quotations/{$quotation->id}/" . time() . '-' . $f->getClientOriginalName();
                $f->move(public_path("/uploads/quotations/{$quotation->id}/"), $fileName);

                $file = new File([
                    'name' => $fileName
                ]);

                $quotation->files()->save($file);
            }
    	}

        $quotation->save();

        return redirect('cotizaciones')->with('success', 'Guardado con éxito!');
    }

    public function destroy($id)
    {
        $quotation = Quotation::find($id);
        $quotation->delete();

        return redirect('cotizaciones')->with('success', 'Eliminado con éxito!');
    }

    public function documentation($id)
    {
        $quotation = Quotation::find($id);

        return view('frontEnd.quotations.documentation', compact('quotation'));
    }

    public function bills($id)
    {
        $quotation = Quotation::find($id);

        return view('frontEnd.quotations.bills', compact('quotation'));
    }

    public function storeBills($id, Request $request)
    {
        $this->validate($request, [
            'bills' => 'required',
        ], [
            'bills.*.required' => 'Las facturas son obligatorias',
        ]);

        $quotation = Quotation::find($id);

        if ($request->file('bills')) {
            foreach ($request->file('bills') as $bill) {
                $fileName = "/uploads/quotations/{$quotation->id}/bills/" . time() . '-' . $bill->getClientOriginalName();
                $bill->move(public_path("/uploads/quotations/{$quotation->id}/bills/"), $fileName);

                $bill = Bill::create([
                    'name' => $fileName
                ]);

                $quotation->bills()->attach($bill->id);
            }
        }

        if ($request->file('purchases')) {
            foreach ($request->file('purchases') as $purchase) {
                $fileName = "/uploads/quotations/{$quotation->id}/purchases/" . time() . '-' . $purchase->getClientOriginalName();
                $purchase->move(public_path("/uploads/quotations/{$quotation->id}/purchases/"), $fileName);

                $purchase = Purchase::create([
                    'name' => $fileName
                ]);

                $quotation->purchases()->attach($purchase->id);
            }
        }

        $quotation->state = 'Cerrada';
        $quotation->save();
            
        return redirect('cotizaciones')->with('success', 'Cotización facturada con éxito!');
    }
}