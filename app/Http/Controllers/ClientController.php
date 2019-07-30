<?php

namespace App\Http\Controllers;

use App\Client;
use DataTables;
use Carbon\Carbon;
use App\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function data()
    {
        $clients = Client::with('paymentMethod');

        return DataTables::eloquent($clients)
            ->addColumn('actions', function ($client) {
                return '<a href="'.url('cliente/editar/' . $client->id).'" class="btn btn-sm btn-warning">Editar</a> <button data-id="'.$client->id.'" type="button" class="btn btn-sm btn-danger delete-client">Eliminar</button>';
            })->editColumn('created_at', function ($client) {
                return $client->created_at->format('d-m-Y');
            })->rawColumns(['actions'])->toJson();
    }

    public function index()
    {
        return view('frontEnd.clients.index');
    }

    public function create()
    {
        $paymentMethods = PaymentMethod::pluck('name', 'id');

        return view('frontEnd.clients.create', compact('paymentMethods'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'rut' => 'required',
            'full_name' => 'required',
            'address' => 'required',
            'activity' => 'required',
            'payment_method_id' => 'required'
        ]);

        $client = Client::create([
            'rut' => $request->input('rut'),
            'full_name' => $request->input('full_name'),
            'address' => $request->input('address'),
            'activity' => $request->input('activity'),
            'payment_method_id' => $request->input('payment_method_id')
        ]);

        return redirect('clientes')->with('success', 'Guardado con éxito!');
    }

    public function edit($id)
    {
        $client = Client::find($id);
        $paymentMethods = PaymentMethod::pluck('name', 'id');

        return view('frontEnd.clients.edit', compact('client', 'paymentMethods'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'rut' => 'required',
            'full_name' => 'required',
            'address' => 'required',
            'activity' => 'required',
            'payment_method_id' => 'required'
        ]);

        $client = Client::find($id);
        $client->rut = $request->input('rut');
        $client->full_name = $request->input('full_name');
        $client->address = $request->input('address');
        $client->activity = $request->input('activity');
        $client->payment_method_id = $request->input('payment_method_id');
        $client->save();

        return redirect('clientes')->with('success', 'Guardado con éxito!');
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return redirect('clientes')->with('success', 'Eliminado con éxito!');
    }

    public function search(Request $request)
    {
        $search = $request->term;

        $queries = Client::where('full_name', 'LIKE', '%'.$search.'%')->orWhere('rut', 'LIKE', '%'.$search.'%')->get();

        if (count($queries) == 0) {
            $result[] = ['id' => '', 'value' => 'No se encontraron resultados!'];
        } else {
            foreach ($queries as $query) {
                $result[] = ['id' => $query->id, 'value' => $query->full_name . ' - ' . $query->rut];
            }
        }

        return $result;
    }

}