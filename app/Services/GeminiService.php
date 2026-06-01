<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected ?string $apiKey;
    protected string $model = 'gemini-1.5-flash';

    public function __construct()
    {
        // Load API key from services config or env directly
        $this->apiKey = config('services.gemini.key') ?? env('GEMINI_API_KEY');
    }

    /**
     * Call Google Gemini API to generate content.
     *
     * @param string $prompt
     * @param string|null $systemInstruction
     * @return string
     */
    public function generateContent(string $prompt, ?string $systemInstruction = null): string
    {
        if (empty($this->apiKey) || $this->apiKey === 'PLACEHOLDER') {
            Log::warning('Gemini API key is not set. Running in simulation mode.');
            return $this->getSimulationResponse($prompt, $systemInstruction);
        }

        try {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";

            $body = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ];

            if ($systemInstruction) {
                $body['systemInstruction'] = [
                    'parts' => [
                        ['text' => $systemInstruction]
                    ]
                ];
            }

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, $body);

            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak dapat merumuskan jawaban saat ini.';
            }

            Log::error('Gemini API request failed', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return "[CacaoCare AI - Gangguan Jaringan]\nMaaf, sistem AI sedang mengalami gangguan konektivitas ke server Google Gemini. Silakan coba sesaat lagi.";

        } catch (\Exception $e) {
            Log::error('Exception during Gemini API request', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return "[CacaoCare AI - Error]\nTerjadi kesalahan internal saat menghubungi asisten AI: " . $e->getMessage();
        }
    }

    /**
     * Provide a highly detailed, intelligent simulation response when Gemini API key is missing.
     */
    protected function getSimulationResponse(string $prompt, ?string $systemInstruction): string
    {
        $promptLower = strtolower($prompt);
        
        // Context-aware simulation responses
        if (str_contains($promptLower, 'aroma') || str_contains($promptLower, 'asam')) {
            return "[CacaoCare AI - Mode Simulasi Perkebunan]\n\nHalo! Saya mendeteksi Anda bertanya mengenai masalah **Aroma (Asam/Kurang Baik)** pada biji kakao Anda.\n\nPada proses fermentasi kakao, aroma asam yang terlalu menusuk biasanya disebabkan oleh terbentuknya asam asetat berlebih akibat kurangnya sirkulasi udara (*aerasi*) di dalam peti fermentasi. Berikut tips praktis untuk mengatasinya:\n1. **Pembalikan Biji:** Lakukan pembalikan tumpukan biji kakao setiap 24 jam sekali secara disiplin pada kotak kayu.\n2. **Drainase Kotak:** Pastikan lubang pembuangan cairan di dasar kotak peti tidak tersumbat agar cairan pulp asam segera mengalir keluar.\n3. **Durasi Fermentasi:** Jangan membiarkan fermentasi melebiperbihi 5-6 hari, karena setelah itu bakteri pembusuk akan aktif dan merusak aroma cokelat khas.\n\n*Catatan: Pasang kunci `GEMINI_API_KEY` di berkas `.env` untuk menghubungkan asisten AI secara real-time.*";
        }
        
        if (str_contains($promptLower, 'jamur') || str_contains($promptLower, 'hama')) {
            return "[CacaoCare AI - Mode Simulasi Perkebunan]\n\nHalo! Masalah **Biji Berjamur** sangat memengaruhi mutu fisik dan cita rasa kakao.\n\nJamur biasanya tumbuh jika kadar air biji masih di atas 7.5% saat disimpan atau akibat penjemuran yang terlalu lambat. Cara pencegahannya:\n1. **Kecepatan Pengeringan:** Usahakan biji langsung dijemur di bawah sinar matahari segera setelah fermentasi selesai. Pada hari pertama dan kedua, tebarkan biji tipis-tipis.\n2. **Kadar Air Sasaran:** Keringkan biji hingga kadar air mencapai standar SNI yaitu **7% hingga 7.5%** (biji berbunyi nyaring/gemerisik jika diremas).\n3. **Sanitasi Alas Jemur:** Gunakan alas jemur bersih (terpal bersih atau para-para) dan jangan meletakkan biji kakao langsung di atas tanah.\n\n*Catatan: Pasang kunci `GEMINI_API_KEY` di berkas `.env` untuk menghubungkan asisten AI secara real-time.*";
        }

        if (str_contains($promptLower, 'draf') || str_contains($promptLower, 'edukasi') || str_contains($promptLower, 'artikel')) {
            return "<h3>Cara Optimal Fermentasi Biji Kakao untuk Aroma Cokelat Khas</h3>\n<p>Fermentasi adalah tahapan krusial dalam membentuk prekursor cita rasa cokelat khas. Tanpa fermentasi yang tepat, biji kakao akan terasa pahit dan sepat.</p>\n<h4>Langkah-Langkah Praktis:</h4>\n<ul>\n<li><strong>Gunakan Kotak Kayu:</strong> Masukkan biji kakao basah ke dalam kotak kayu berlubang di dasarnya. Tutup dengan daun pisang bersih untuk menjaga suhu tetap hangat (45-50°C).</li>\n<li><strong>Pembalikan Berkala:</strong> Lakukan pembalikan biji setiap 24 jam sekali mulai hari kedua agar panas dan sirkulasi oksigen merata.</li>\n<li><strong>Waktu Selesai:</strong> Hentikan fermentasi setelah 4 hingga 5 hari. Biji yang difermentasi dengan baik akan menunjukkan perubahan warna keping biji dari ungu menjadi cokelat dengan rongga di dalamnya.</li>\n</ul>";
        }

        return "[CacaoCare AI - Mode Simulasi Perkebunan]\n\nHalo! Saya adalah asisten botani Anda. Saat ini sistem berjalan dalam **Mode Simulasi** karena kunci `GEMINI_API_KEY` belum terpasang di file `.env` proyek Anda.\n\nNamun, sebagai saran botani umum:\n- **Suhu Ideal:** Jaga suhu tumpukan biji kakao selama fermentasi tetap stabil di kisaran 45°C - 50°C untuk mematikan lembaga biji secara alami.\n- **Kadar Air Penyimpanan:** Pastikan kadar air biji di bawah 7.5% sebelum dimasukkan ke dalam karung goni bersih agar terhindar dari jamur.\n\nSilakan daftarkan `GEMINI_API_KEY` di file `.env` Anda untuk berkonsultasi secara interaktif dan cerdas menggunakan kecerdasan buatan Google Gemini!";
    }
}
