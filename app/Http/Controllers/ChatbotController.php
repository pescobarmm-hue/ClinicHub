<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $userMessage = $request->input('message');

        // CLAVE ESCRITA DIRECTAMENTE (la que funciona en curl)
        $apiKey = config('groq.api_key');
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'system', 'content' => 'Eres ClinicHub AI, asistente médico profesional. Responde SIEMPRE en español, de forma breve y útil. Máximo 2 oraciones.'],
                    ['role' => 'user', 'content' => $userMessage]
                ],
                'temperature' => 0.7,
                'max_tokens' => 200,
            ]);

            if ($response->successful()) {
                $reply = $response->json()['choices'][0]['message']['content'];
                return response()->json(['success' => true, 'reply' => $reply]);
            }

            return response()->json(['success' => false, 'reply' => 'Error HTTP: ' . $response->status()]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'reply' => 'Error: ' . $e->getMessage()]);
        }
    }
}
