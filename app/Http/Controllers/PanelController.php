<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {

        return view('panel');
    }

    public function verDetalle($id) 
    {
        $notification = auth()->user()->notifications->where('id', $id)->first();
    
        if(!$notification) {
            $notification->markAsRead(); // Marca la notificación como leída
        }
    
        return redirect()->route('panel.index'); // Redirige al usuario de regreso al panel
    }
    
    
}
