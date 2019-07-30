<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Purchase;
use App\Deal;
use App\Room;
use App\User;
use App\File;
use App\Client;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    public function dataProcess()
    {
        $deals = Deal::with('creator', 'client', 'dealState', 'room')->where('deal_state_id', 2)->orderBy('id', 'DESC')->get();

        return DataTables::of($deals)
            ->addColumn('actions', function ($deal) {
                return '<a href="'.url('negocio/documentacion/' . $deal->id).'" class="btn btn-sm btn-primary">Documentación</a> <a href="'.url('negocio/editar/' . $deal->id).'" class="btn btn-sm btn-warning">Editar</a>';
            })->editColumn('created_at', function ($deal) {
                return $deal->created_at->format('d-m-Y');
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function indexProcess()
    {
        return view('frontEnd.deals.indexProcess');
    }

    public function dataClosed()
    {
        $deals = Deal::with('creator', 'client', 'dealState', 'room')->where('deal_state_id', 3)->orderBy('id', 'DESC')->get();

        return DataTables::of($deals)
            ->addColumn('actions', function ($deal) {
                return '<a href="'.url('negocio/documentacion/' . $deal->id).'" class="btn btn-sm btn-primary">Documentación</a> <a href="'.url('negocio/historial-conversacion/' . $deal->id).'" class="btn btn-sm btn-info">Online Meeting</a> <a href="'.url('negocio/reapertura/' . $deal->id).'" class="btn btn-sm btn-warning">Re-Apertura</a>';
            })->editColumn('created_at', function ($deal) {
                return $deal->created_at->format('d-m-Y');
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function indexClosed()
    {
        return view('frontEnd.deals.indexClosed');
    }

    public function dataFinalized()
    {
        $deals = Deal::with('creator', 'client', 'dealState', 'room')->where('deal_state_id', 4)->orderBy('id', 'DESC')->get();

        return DataTables::of($deals)
            ->addColumn('actions', function ($deal) {
                return '<a href="'.url('negocio/documentacion/' . $deal->id).'" class="btn btn-sm btn-primary">Documentación</a>';
            })->editColumn('created_at', function ($deal) {
                return $deal->created_at->format('d-m-Y');
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function indexFinalized()
    {
        return view('frontEnd.deals.indexFinalized');
    }

    public function create()
    {
    	$users = User::pluck('full_name', 'id');
    	$clients = Client::pluck('full_name', 'id');

    	return view('frontEnd.deals.create', compact('users', 'clients'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'title' => 'required|unique:rooms,name',
    		'client_id' => 'required',
    		'room_name' => 'required',
    		'room_description' => 'required',
    		'room_users' => 'required'
    	]);

        $client = Client::where('rut', explode(' - ', $request->input('client_id'))[1])->first();

    	$deal = Deal::create([
            'title' => $request->input('title'),
    		'creator_id' => Auth::user()->id,
    		'client_id' => $client->id,
    		'deal_state_id' => 2
    	]);

    	$room = Room::create([
    		'name' => $request->input('room_name'),
            'slug' => str_slug($request->input('room_name')),
    		'description' => $request->input('room_description'),
    		'deal_id' => $deal->id
    	]);

    	$room->users()->sync($request->input('room_users'));

    	return redirect('negocios')->with('success', 'Guardado con éxito!');
    }

    public function edit($id)
    {
        $deal = Deal::find($id);
        $users = User::all();
        $clients = Client::pluck('full_name', 'id');
        $roomUsers = [];

        foreach ($deal->room->users as $user) {
            $roomUsers[] = $user->id;
        }  

        return view('frontEnd.deals.edit', compact('deal', 'users', 'clients', 'roomUsers'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:rooms,name,' . $id,
            'client_id' => 'required'
        ]);

        $client = Client::where('rut', explode(' - ', $request->input('client_id'))[1])->first();

        $deal = Deal::find($id);
        $deal->title = $request->input('title');
        $deal->client_id = $client->id;
        $deal->save();

        $room = Room::find($request->room_id);
        $room->name = $request->input('room_name');
        $room->description = $request->input('room_description');
        $room->slug = str_slug($request->input('room_name'));
        $room->users()->sync($request->input('room_users'));
        $room->save();

        return redirect('negocios')->with('success', 'Guardado con éxito!');
    }

    public function destroy($id)
    {
        $deal = Deal::find($id);
        $deal->delete();

        return redirect('negocios')->with('success', 'Eliminado con éxito!');
    }

    public function documentation($id)
    {
        $deal = Deal::find($id);
        return view('frontEnd.deals.documentation', compact('deal'));
    }

    public function closeDealView($id)
    {
        $deal = Deal::find($id);

        return view('frontEnd.deals.closedeal', compact('deal'));
    }

    public function closeDealStore($id, Request $request)
    {
        $this->validate($request, [
            'bills' => 'required',
            'purchases' => 'required'
        ], [
            'bills.*.required' => 'Facturas obligatoria',
            'purchases.*.required' => 'Órden de compra obligatoria'
        ]);

        $deal = Deal::find($id);

        if ($request->file('bills')) {
            foreach ($request->file('bills') as $bill) {
                $fileName = "/uploads/deals/{$deal->id}/bills/" . time() . '-' . $bill->getClientOriginalName();
                $bill->move(public_path("/uploads/deals/{$deal->id}/bills/"), $fileName);

                $bill = Bill::create([
                    'name' => $fileName
                ]);

                $deal->bills()->attach($bill->id);
            }
        }

        if ($request->file('purchases')) {
            foreach ($request->file('purchases') as $purchase) {
                $fileName = "/uploads/deals/{$deal->id}/purchases/" . time() . '-' . $purchase->getClientOriginalName();
                $purchase->move(public_path("/uploads/deals/{$deal->id}/purchases/"), $fileName);

                $purchase = Purchase::create([
                    'name' => $fileName
                ]);

                $deal->purchases()->attach($purchase->id);
            }
        }

        $deal->deal_state_id = 3;
        $deal->save();

        return redirect('negocios')->with('success', 'Negocio cerrado con éxito!');
    }

    public function historyRoomChat($id)
    {
        $deal = Deal::find($id);

        return view('frontEnd.deals.historyroomchat', compact('deal'));
    }

    public function changeStateDeal($id)
    {
        $deal = Deal::find($id);
        $deal->deal_state_id = 2;
        $deal->save();

        return redirect('negocios')->with('success', 'El Negocio a sido abierto nuevamente con éxito!');
    }
    
}
