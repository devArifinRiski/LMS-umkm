<?php

namespace App\Http\Controllers\Front;

use App\Models\Materi;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class   materiFrontController extends Controller
{
    public function index(){
        $Materi = DB::table('m_materi')->get();
        $Notifikasi = DB::table('notifikasis')->get();
            if ($Materi) {
                return view("user.lowongan",compact('Materi', 'Notifikasi'));
            }else {
                return response()->json(['message'=>'Tidak Ada Data'], 200);
            }
            // return view("user.exam",compact('Materi'));
            return view("user.lowongan",compact('Materi', 'Notifikasi'));
    }

    public function lowonganHomeExam($id){
        $Materi = DB::table('m_materi')->find($id);
        $subMateri = DB::table('t_sub_materi')
        ->select('t_sub_materi.*', 't_sub_materi_file.file_location')
        ->leftJoin('t_sub_materi_file', 't_sub_materi.id', '=', 't_sub_materi_file.id_sub_materi')
        ->where('t_sub_materi.aktif', 1)
        ->where('t_sub_materi.id_materi', $id)
        ->get();
        if ($Materi) {
            return view("user.lowonganHomeExam",compact('Materi', 'subMateri'));
        }else {
            return response()->json(['message'=>'Tidak Ada Data'], 200);
        }
        // return view("user.exam",compact('Materi'));
        return view("user.lowonganHomeExam",compact('Materi'));
    }
    // public function notifikasi(){
    //     $Notifikasi = Notifikasi::latest()->get();
    //         if ($Notifikasi) {
    //             return view("user.lowongan",compact('Notifikasi'));
    //         }else {
    //             return response()->json(['message'=>'Tidak Ada Data'], 200);
    //         }
    //         // return view("user.exam",compact('Notifikasi'));
    //         return view("user.lowongan",compact('Notifikasi'));
    // }
}
