<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminAIController extends Controller
{
    public function chat(Request $request)
    {
        try {
            $prompt = $request->input('prompt');
            $response = Http::withToken(env('OPENAI_API_KEY'))
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'Kamu adalah asisten bisnis kos profesional yang membantu menganalisa data dan memberikan saran untuk bisnis kos/coliving.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => 500,
                ]);
            
            if ($response->successful()) {
                return response()->json($response->json()['choices'][0]['message']['content']);
            } else {
                return response()->json('Maaf, terjadi kesalahan saat berkomunikasi dengan AI. Error: ' . $response->body(), 500);
            }
        } catch (\Exception $e) {
            return response()->json('Maaf, terjadi kesalahan: ' . $e->getMessage(), 500);
        }
    }

    public function predict(Request $request)
    {
        try {
            $data = $request->input('data');
            $prompt = "Berdasarkan data bisnis kos berikut, berikan analisis singkat dan saran untuk mengoptimalkan bisnis:
            - Total kamar: {$data['total_kamar']}
            - Kamar terisi: {$data['kamar_terisi']}
            - Pendapatan bulan ini: Rp " . number_format($data['pendapatan_bulan_ini'], 0, ',', '.') . "
            - Rata-rata harga kamar: Rp " . number_format($data['rata_rata_harga'], 0, ',', '.') . "
            - Total pelanggan: {$data['total_pelanggan']}
            - Pengeluaran bulan ini: Rp " . number_format($data['pengeluaran_bulan_ini'] ?? 0, 0, ',', '.') . "
            - Pertumbuhan pelanggan: {$data['pertumbuhan_pelanggan']}%
            - Pertumbuhan pendapatan: {$data['pertumbuhan_pendapatan']}%
            
            Tolong berikan:
            1. Analisis tingkat hunian dan performa bisnis
            2. Saran untuk meningkatkan okupansi dan pendapatan
            3. Prediksi bisnis bulan depan jika tren ini berlanjut
            
            Jawaban singkat tapi informatif, maksimal 4-5 paragraf.";
            
            $response = Http::withToken(env('OPENAI_API_KEY'))
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'Kamu adalah analis bisnis kos profesional yang memberikan analisis dan saran bisnis berdasarkan data.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => 500,
                ]);
            
            if ($response->successful()) {
                return response()->json($response->json()['choices'][0]['message']['content']);
            } else {
                return response()->json('Maaf, terjadi kesalahan saat menganalisa data. Error: ' . $response->body(), 500);
            }
        } catch (\Exception $e) {
            return response()->json('Maaf, terjadi kesalahan: ' . $e->getMessage(), 500);
        }
    }
} 