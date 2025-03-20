<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;

class AdminController extends Controller
{
    public function home() {
        $listadmin = User::where('role', 'admin')->get();
        return view('admin.home', compact('listadmin'));
    }
    
    public function denah() {
        // Mengambil semua data kamar dan mengubah format nomor kamar
        $rooms = Room::all()->map(function($room) {
            // Mengubah format nomor kamar dari angka (misalnya 101) menjadi format denah (1AA)
            $floor = substr($room->room_number, 0, 1); // Ambil angka pertama untuk lantai
            $position = substr($room->room_number, 1, 2); // Ambil 2 angka terakhir untuk posisi
            
            // Konversi posisi angka ke format huruf (01-07 -> AA-AG, 08-14 -> BA-BG, dst)
            $positionNum = intval($position);
            $section = ceil($positionNum / 7); // Menentukan bagian (A, B, C, dst)
            $index = ($positionNum - 1) % 7; // Menentukan indeks dalam bagian (0-6 -> A-G)
            
            $sectionLetter = chr(64 + $section); // A=1, B=2, dst
            $indexLetter = chr(65 + $index); // A=0, B=1, dst
            
            $denahNumber = $floor . $sectionLetter . $indexLetter;
            
            // Tambahkan nomor denah ke data kamar
            $room->denah_number = $denahNumber;
            
            return $room;
        })->keyBy('denah_number'); // Gunakan nomor denah sebagai key
        
        return view('admin.denah.denah', compact('rooms'));
    }
}
