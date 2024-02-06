<?php

namespace App\Http\Controllers;

use App\Models\persona;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class xmlController extends Controller
{
    public function index()
    {
        $persona = DB::table('persona')
        ->select('nombre','correo','descripcion')
        ->get();
    
        return view('welcome', compact('persona'));
    }
    
    

    public function upload(Request $request)
    {
        // Validar la solicitud y el archivo XML
        $request->validate([
            'xml_file' => 'required|mimes:xml|max:2048', // Ajusta las reglas de validación según tus necesidades
        ]);

        // Procesar el archivo XML
        $xmlData = simplexml_load_file($request->file('xml_file'));

        // Almacenar los datos en la base de datos
        foreach ($xmlData->persona as $personaData) {
            persona::create([
                'nombre' => (string)$personaData->nombre,
                'correo' => (string)$personaData->correo,
                'descripcion' => (string)$personaData->descripcion,
            ]);
        }

        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Archivo XML subido y procesado correctamente.');
    }

    public function download()
    {
        $personas = persona::all();
    
        // Generar el contenido del archivo XML
        $xmlContent = '<?xml version="1.0" encoding="UTF-8"?>';
        $xmlContent .= '<personas>';
    
        foreach ($personas as $persona) {
            $xmlContent .= '<persona>';
            $xmlContent .= '<nombre>' . $persona->nombre . '</nombre>';
            $xmlContent .= '<correo>' . $persona->correo . '</correo>';
            $xmlContent .= '<descripcion>' . $persona->descripcion . '</descripcion>';
            $xmlContent .= '</persona>';
        }
    
        $xmlContent .= '</personas>';
    
        // Descargar el archivo XML
        return response($xmlContent, 200, [
            'Content-Type' => 'text/xml',
            'Content-Disposition' => 'attachment; filename="personas.xml"',
        ]);
    }
}