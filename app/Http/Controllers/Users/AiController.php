<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\GeminiService;
use App\Models\HasilAnalisis;
use App\Models\Edukasi;
use Illuminate\Http\Request;

class AiController extends Controller
{
    protected GeminiService $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }

    /**
     * Display the Farmer AI chatbot interface.
     */
    public function farmerIndex()
    {
        // Get user's latest analysis context
        $latestAnalysis = HasilAnalisis::where('user_id', auth()->id())
            ->latest()
            ->first();

        return view('petani.ai', compact('latestAnalysis'));
    }

    /**
     * Handle the Farmer Botanical AI chat message.
     */
    public function farmerChat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = trim((string) $request->input('message'));

        // Load latest analysis context
        $latestAnalysis = HasilAnalisis::where('user_id', auth()->id())
            ->latest()
            ->first();

        // Build context-aware system instruction
        $systemInstruction = "Anda adalah CacaoCare AI, asisten botani ahli pertanian kakao yang bersahabat dan profesional. Pengguna saat ini adalah seorang petani kakao terdaftar.";

        if ($latestAnalysis) {
            $choices = [];
            if (is_array($latestAnalysis->pilihan_user)) {
                foreach ($latestAnalysis->pilihan_user as $key => $val) {
                    $choices[] = str_replace('_', ' ', $key) . ': ' . str_replace('_', ' ', $val);
                }
            }
            $choicesStr = implode(', ', $choices);

            $systemInstruction .= "\n\nPetani ini baru saja menganalisis batch biji kakaonya pada tanggal " . $latestAnalysis->created_at->format('d M Y') . " dengan hasil:\n" .
                "- Grade Mutu: Grade " . $latestAnalysis->grade_hasil . "\n" .
                "- Persentase Keyakinan CF: " . number_format($latestAnalysis->persentase_cf, 1) . "%\n" .
                "- Karakteristik Terpilih: " . $choicesStr . "\n" .
                "- Saran Bawaan Sistem: " . $latestAnalysis->rekomendasi . "\n\n" .
                "PENTING: Gunakan informasi ini jika petani berkonsultasi mengenai saran peningkatan kualitas kakao mereka. Hubungkan jawaban Anda dengan aroma, ukuran, warna, tekstur, atau kondisi fisik batch terakhir mereka secara ramah perkebunan.";
        } else {
            $systemInstruction .= "\n\nPetani ini belum pernah melakukan analisis mutu kakao di platform ini. Sambut mereka secara hangat, berikan tips botani kakao mendasar, dan sarankan mereka mencoba menu 'Analisis' terlebih dahulu agar sistem dapat membaca karakteristik bijinya.";
        }

        // Call Gemini
        $reply = $this->gemini->generateContent($message, $systemInstruction);

        return response()->json([
            'reply' => $reply
        ]);
    }

    /**
     * Display the Admin AI Console interface.
     */
    public function adminIndex()
    {
        return view('Admin.ai');
    }

    /**
     * Generate educational article draft for Admin.
     */
    public function adminGenerate(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:200',
        ]);

        $topic = trim((string) $request->input('topic'));

        $systemInstruction = "Anda adalah penulis konten agronomi profesional bidang komoditas kakao. Tugas Anda adalah menyusun draf materi edukasi terstruktur berdasarkan topik kakao yang diminta.\n\n" .
            "Format Jawaban Anda HARUS merupakan HTML bersih yang valid, menggunakan tag h3, h4, p, strong, ul, dan li. Jangan pernah bungkus jawaban Anda dalam tanda markdown ```html atau ```. Tulis secara mendalam, informatif, mendidik, dan mudah dipraktikkan oleh petani.";

        $prompt = "Tulis draf artikel edukasi kakao yang lengkap mengenai topik: " . $topic;

        $content = $this->gemini->generateContent($prompt, $systemInstruction);

        // Derive title and summary dynamically
        $title = "Panduan Praktis: " . ucwords($topic);
        $summary = "Panduan ilmiah dan taktis mengenai " . strtolower($topic) . " untuk menaikkan mutu biji kakao.";

        return response()->json([
            'title' => $title,
            'summary' => $summary,
            'content' => $content
        ]);
    }
}
