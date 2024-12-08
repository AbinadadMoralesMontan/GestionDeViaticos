<?php

namespace App\Http\Controllers;

use App\Models\ComprobanteEntregado;
use Illuminate\Http\Request;

class ComprobanteEntregadoController extends Controller{
    public function index(){
        $comprobantes = ComprobanteEntregado::with('solicitudViatico')->paginate(10);
        return view('comprobantes.index', compact('comprobantes'));
    }

    public function edit($id){
        $comprobante = ComprobanteEntregado::findOrFail($id);
        return view('comprobantes.edit', compact('comprobante'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'categoria_gasto' => 'required|string|max:255',
            'monto' => 'nullable|numeric|min:0',
            'observaciones' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:2048', // Validación para PDF
            'xml' => 'nullable|file|mimes:xml|max:2048', // Validación para XML
        ]);

        $comprobante = ComprobanteEntregado::findOrFail($id);

        // Guardar archivos
        $pdfContenido = $request->file('pdf') ? file_get_contents($request->file('pdf')) : $comprobante->pdf;
        $xmlContenido = $request->file('xml') ? file_get_contents($request->file('xml')) : $comprobante->xml;

        $comprobante->update([
            'categoria_gasto' => $request->categoria_gasto,
            'monto' => $request->monto,
            'observaciones' => $request->observaciones,
            'pdf' => $pdfContenido,
            'xml' => $xmlContenido,
        ]);

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante actualizado exitosamente.');
    }

    public function downloadPdf($id){
        $comprobante = ComprobanteEntregado::findOrFail($id);

        if (!$comprobante->pdf) {
            return redirect()->route('comprobantes.index')->with('error', 'El archivo PDF no está disponible.');
        }

        return response($comprobante->pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="archivo.pdf"');
    }

    public function downloadXml($id){
        $comprobante = ComprobanteEntregado::findOrFail($id);

        if (!$comprobante->xml) {
            return redirect()->route('comprobantes.index')->with('error', 'El archivo XML no está disponible.');
        }

        return response($comprobante->xml)
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', 'attachment; filename="archivo.xml"');
    }

    public function viewPdf($id){
        $comprobante = ComprobanteEntregado::findOrFail($id);

        if (!$comprobante->pdf) {
            return redirect()->route('comprobantes.index')->with('error', 'El archivo PDF no está disponible.');
        }

        return response($comprobante->pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="archivo.pdf"');
    }

    public function create()
    {
        return view('comprobantes.create'); // Retorna la vista para crear comprobantes
    }

    public function destroy($id)
    {
        // Lógica para eliminar el comprobante
        $comprobante = Comprobante::findOrFail($id);
        $comprobante->delete();

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante eliminado correctamente.');
    }



}
