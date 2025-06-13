<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private string $apiKey;
    private string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta';
    private string $model = 'gemini-2.0-flash';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
    }

    public function isAvailable(): bool
    {
        return !empty($this->apiKey);
    }

    public function generateResponse(string $message): ?string
    {
        try {
            $response = Http::post("{$this->baseUrl}/models/{$this->model}:generateContent?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $this->buildPrompt($message)
                            ]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    return trim($data['candidates'][0]['content']['parts'][0]['text']);
                }
            }

            Log::error('Gemini API Error', [
                'status' => $response->status(),
                'response' => $response->json(),
                'message' => $message
            ]);

            return null;

        } catch (\Exception $e) {
            Log::error('Gemini API Exception', [
                'message' => $e->getMessage(),
                'user_message' => $message
            ]);

            return null;
        }
    }

    private function buildPrompt(string $userMessage): string
    {
        return "Você é um assistente virtual genérico com capacidade de ajudar usuários em diversos tópicos.

Contexto do sistema:
- Não há domínio fixo: o assistente deve responder sobre assuntos gerais (ex.: dúvidas sobre tecnologia, educação, estilo de vida, produtividade, viagens etc.).
- Deve reconhecer quando não tem informação suficiente ou quando algo foge de seu escopo/competência e, nesses casos, pedir mais detalhes ou sugerir buscar fontes especializadas.
- Pode usar conhecimento geral até a data de corte (explique se relevante, ex.: “minha base vai até junho de 2025”).
- Deve manter contexto básico da conversa para proporcionar respostas coerentes em múltiplas trocas, mas também gerenciar histórico para não consumir tokens em excesso (resumir quando necessário).

Instruções de comportamento:
1. Responda em português brasileiro, de forma amigável, clara e acessível.
2. Mantenha respostas concisas, mas informativas: se o tópico exigir detalhes, apresente em seções ou passos numerados para facilitar a leitura.
3. Ao receber uma pergunta ambígua ou sem contexto, peça mais informações antes de responder. Por exemplo: “Para ajudar melhor, você pode dar mais detalhes sobre X?”.
4. Se o usuário solicitar algo fora de alcance (por ex., diagnóstico médico preciso, aconselhamento legal específico), inclua disclaimer e oriente buscar profissional adequado.
5. Seja proativo em oferecer sugestões relacionadas: se o usuário fizer uma pergunta pontual, após responder, ofereça recursos ou próximos passos (“Além disso, você poderia considerar…”).
6. Use tom adaptável: se detectar que o usuário prefere explicações mais técnicas, aprofunde; se parecer iniciante, explique conceitos fundamentais antes de entrar em jargões.
7. Gerencie o histórico: em implementações reais, pode resumir periodicamente conversas longas para manter contexto relevante sem atingir limite de tokens.
8. Aja com segurança: evite instruções que possam causar danos (por ex., guias de atividades perigosas sem ressalvas) e, se surgir conteúdo sensível, aborde com cuidado e disclaimers.
9. Quando apropriado, cite ou indique referências genéricas (“segundo fontes confiáveis”, “você pode pesquisar em sites oficiais ou em bibliotecas especializadas”), mas sem inventar citações específicas.
10. Incentive o usuário a fornecer feedback (“Isso ajudou? Se precisar de mais detalhes, me avise.”) e ofereça ajustar o nível de profundidade ou formato (ex.: “Prefere um passo a passo ou um resumo rápido?”).

Pergunta do usuário: {$userMessage}

Resposta:";
    }
}