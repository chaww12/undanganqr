<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tamu;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TamuController extends Controller
{
    
    public function index()
    {
        $events = Event::all();

        return view('admin.tamu.index', [
            'title' => 'Daftar Tamu',
            'events' => $events
        ]);
    }

    public function supindex()
    {
        $events = Event::all();

        return view('superadmin.tamu.index', [
            'title' => 'Daftar Tamu',
            'events' => $events
        ]);
    }

    public function show($eventId)
    {
        $event = Event::findOrFail($eventId);
        $tamus = Tamu::where('idevent', $eventId)->get();
    
        return view('admin.tamu.show', [
            'title' => 'Daftar Tamu untuk ' . $event->namaevent,
            'event' => $event,
            'tamus' => $tamus,
        ]);
    }

    public function supshow($eventId)
    {
        $event = Event::findOrFail($eventId);
        $tamus = Tamu::where('idevent', $eventId)->get();
    
        return view('superadmin.tamu.show', [
            'title' => 'Daftar Tamu untuk ' . $event->namaevent,
            'event' => $event,
            'tamus' => $tamus,
        ]);
    }

    public function preview($id)
    {
        $event = Event::findOrFail($id);
        $tamuCount = Tamu::where('idevent', $id)->count(); 
    
        return view('admin.tamu.preview', compact('event', 'tamuCount')); 
    }    

    public function suppreview($id)
    {
        $event = Event::findOrFail($id);
        $tamuCount = Tamu::where('idevent', $id)->count(); 
    
        return view('superadmin.tamu.preview', compact('event', 'tamuCount')); 
    } 

    public function generateQrCodes($eventId)
    {
        $tamus = Tamu::where('idevent', $eventId)->get();

        $directory = storage_path('app/qrcodes');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    
        $filePaths = []; 
        
        foreach ($tamus as $tamu) {
            $qrCode = Builder::create()
                ->writer(new PngWriter())
                ->data($tamu->id) 
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(ErrorCorrectionLevel::High)
                ->size(200)
                ->margin(10)
                ->build();

            $fileName = 'qrcodes/' . $tamu->nama . '.png'; 
            Storage::put($fileName, $qrCode->getString());

            $filePaths[] = storage_path('app/private/' . $fileName); 
        }

        $zipFileName = 'qrcodes.zip';
        $zipFilePath = storage_path('app/private/' . $zipFileName);

        $zip = new \ZipArchive();
        if ($zip->open($zipFilePath, \ZipArchive::CREATE) !== TRUE) {
            return response()->json(['message' => 'Gagal membuat zip file.'], 500);
        }

        foreach ($filePaths as $filePath) {
            $zip->addFile($filePath, basename($filePath)); 
        }

        $zip->close();

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }    

    public function supgenerateQrCodes($eventId)
    {
        $tamus = Tamu::where('idevent', $eventId)->get();

        $directory = storage_path('app/qrcodes');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    
        $filePaths = []; 
        
        foreach ($tamus as $tamu) {
            $qrCode = Builder::create()
                ->writer(new PngWriter())
                ->data($tamu->id) 
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(ErrorCorrectionLevel::High)
                ->size(200)
                ->margin(10)
                ->build();

            $fileName = 'qrcodes/' . $tamu->nama . '.png'; 
            Storage::put($fileName, $qrCode->getString());

            $filePaths[] = storage_path('app/private/' . $fileName); 
        }

        $zipFileName = 'qrcodes.zip';
        $zipFilePath = storage_path('app/private/' . $zipFileName);

        $zip = new \ZipArchive();
        if ($zip->open($zipFilePath, \ZipArchive::CREATE) !== TRUE) {
            return response()->json(['message' => 'Gagal membuat zip file.'], 500);
        }

        foreach ($filePaths as $filePath) {
            $zip->addFile($filePath, basename($filePath)); 
        }

        $zip->close();

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }   

    public function scan()
    {
        return view('registrasi.index');
    }
    
    public function getGuestData($qrData)
    {
        if (empty($qrData)) {
            return response()->json(['message' => 'QR data tidak valid.'], 400);
        }

        $tamu = Tamu::find($qrData); 
    
        if (!$tamu) {
            return response()->json(['message' => 'Data tamu tidak ditemukan.'], 404);
        }
    
        if ($tamu->registrasi) {
            return response()->json(['message' => 'Tamu sudah melakukan registrasi.'], 400);
        }

        $tamu->registrasi = '1';
        $tamu->save();
    
        return response()->json([
            'message' => 'Data tamu berhasil ditemukan.',
            'tamu' => [
                'nama' => $tamu->nama,
                'jenistamu' => $tamu->jenistamu,
                'instansi' => $tamu->instansi,
                'alamat' => $tamu->alamat
            ]
        ]);
    }

    public function showImportForm($eventId)
    {
        return view('admin.tamu.import', compact('eventId'));
    }

    public function supshowImportForm($eventId)
    {
        return view('superadmin.tamu.import', compact('eventId'));
    }

    public function import(Request $request, $eventId)
    {
        Log::info('Import data tamu dipanggil untuk event ID: ' . $eventId);

        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ], [
            'file.mimes' => 'Format file salah! Harus berupa file CSV.',
        ]);

        $path = $request->file('file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        array_shift($data);
    
        $newCount = 0; 
    
        foreach ($data as $row) {
            if (count($row) >= 4) {
                try {
                    $this->storeTamu($row, $eventId);
                    $newCount++; 
                    Log::info('Data Tamu berhasil disimpan: ', $row);
                } catch (\Exception $e) {
                    Log::error('Gagal menyimpan data Tamu: ' . $e->getMessage());
                }
            } else {
                Log::warning('Baris tidak valid: ' . implode(',', $row));
            }
        }
        return redirect()->route('admin.tamu.show', $eventId)->with('success', "Data tamu berhasil diimpor. Jumlah tamu yang ditambahkan: $newCount.");
    }

    public function supimport(Request $request, $eventId)
    {
        Log::info('Import data tamu dipanggil untuk event ID: ' . $eventId);

        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ], [
            'file.mimes' => 'Format file salah! Harus berupa file CSV.',
        ]);

        $path = $request->file('file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        array_shift($data);
    
        $newCount = 0; 
    
        foreach ($data as $row) {
            if (count($row) >= 4) {
                try {
                    $this->supstoreTamu($row, $eventId);
                    $newCount++; 
                    Log::info('Data Tamu berhasil disimpan: ', $row);
                } catch (\Exception $e) {
                    Log::error('Gagal menyimpan data Tamu: ' . $e->getMessage());
                }
            } else {
                Log::warning('Baris tidak valid: ' . implode(',', $row));
            }
        }
        return redirect()->route('superadmin.tamu.show', $eventId)->with('success', "Data tamu berhasil diimpor. Jumlah tamu yang ditambahkan: $newCount.");
    }

    private function storeTamu($row, $eventId)
    {
        return Tamu::create([
            'idevent' => $eventId,
            'nama' => $row[0],
            'jenistamu' => $row[1],
            'instansi' => $row[2],
            'alamat' => $row[3],
        ]);
    }

    private function supstoreTamu($row, $eventId)
    {
        return Tamu::create([
            'idevent' => $eventId,
            'nama' => $row[0],
            'jenistamu' => $row[1],
            'instansi' => $row[2],
            'alamat' => $row[3],
        ]);
    }

    public function checkTamu($eventId)
    {
        $tamuExists = Tamu::where('idevent', $eventId)->exists();
    
        if (!$tamuExists) {
            return response()->json(['message' => 'Belum ada daftar tamu untuk event ini'], 404);
        }
    
        return response()->json(['message' => 'Tamu ditemukan'], 200);
    }

    public function supkehadiran($eventId)
    {
        $event = Event::findOrFail($eventId);
        $tamus = Tamu::where('registrasi', 1)
                    ->where('idevent', $eventId)
                    ->get();

        return view('superadmin.tamu.kehadiran', [
            'tamus' => $tamus,
            'event' => $event
        ]);
    }

    public function kehadiran($eventId)
    {
        $event = Event::findOrFail($eventId);
        $tamus = Tamu::where('registrasi', 1)
                    ->where('idevent', $eventId)
                    ->get();

        return view('admin.tamu.kehadiran', [
            'tamus' => $tamus,
            'event' => $event
        ]);
    }

    public function supunregister($tamuId)
    {
        $tamu = Tamu::findOrFail($tamuId);
        $tamu->registrasi = 0;
        $tamu->save();

        return redirect()->back()->with('success', 'Registrasi tamu berhasil dihapus.');
    }

    public function unregister($tamuId)
    {
        $tamu = Tamu::findOrFail($tamuId);
        $tamu->registrasi = 0;
        $tamu->save();

        return redirect()->back()->with('success', 'Registrasi tamu berhasil dihapus.');
    }

    
}
