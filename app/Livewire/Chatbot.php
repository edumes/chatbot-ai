<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GeminiService;
use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Chatbot extends Component
{
    public $messages = [];
    public $newMessage = '';
    public $isTyping = false;
    public $useGemini = true;
    public $suggestions = [];
    public $estimatedTime = 0;
    public $chatId = null;
    public $chatTitle = null;

    private GeminiService $geminiService;
    private $chatModel = null;

    public function boot(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function mount($chatId = null)
    {
        $this->useGemini = $this->geminiService->isAvailable();
        $this->loadSuggestions();
        $this->chatId = $chatId;
        if ($chatId) {
            $this->chatModel = Chat::with('messages')->find($chatId);
            if ($this->chatModel) {
                $this->chatTitle = $this->chatModel->title;
                $this->messages = $this->chatModel->messages->map(function ($msg) {
                    return [
                        'id' => $msg->id,
                        'text' => $msg->text,
                        'sender' => $msg->sender,
                        'timestamp' => $msg->sent_at ? $msg->sent_at->format('H:i') : $msg->created_at->format('H:i'),
                    ];
                })->toArray();
            }
        }
        if (empty($this->messages)) {
            $this->startNewChat();
        }
    }

    private function startNewChat()
    {
        $user = Auth::user();
        $chat = Chat::create([
            'user_id' => $user ? $user->id : null,
            'title' => 'New Chat',
        ]);
        $this->chatId = $chat->id;
        $this->chatModel = $chat;
        $this->messages = [];
        $this->addBotMessage('Hello! I am your virtual assistant. How can I help you today?');
    }

    private function addBotMessage($text)
    {
        $msg = ChatMessage::create([
            'chat_id' => $this->chatId,
            'sender' => 'bot',
            'text' => $text,
            'sent_at' => now(),
        ]);
        $this->messages[] = [
            'id' => $msg->id,
            'text' => $msg->text,
            'sender' => $msg->sender,
            'timestamp' => $msg->sent_at->format('H:i'),
        ];
    }

    private function addUserMessage($text)
    {
        $msg = ChatMessage::create([
            'chat_id' => $this->chatId,
            'sender' => 'user',
            'text' => $text,
            'sent_at' => now(),
        ]);
        $this->messages[] = [
            'id' => $msg->id,
            'text' => $msg->text,
            'sender' => $msg->sender,
            'timestamp' => $msg->sent_at->format('H:i'),
        ];
    }

    private function loadSuggestions()
    {
        $this->suggestions = [
            'What can you help me with?',
            'Can you give me a quick tip?',
            'Tell me something interesting.'
        ];
    }

    public function sendMessage()
    {
        if (trim($this->newMessage) === '') {
            return;
        }
        $this->addUserMessage($this->newMessage);
        $userMessage = $this->newMessage;
        $this->newMessage = '';
        $this->dispatch('message-sent');
        $this->estimatedTime = rand(2, 4);
        $this->isTyping = true;
        $this->dispatch('typing-state-changed', isTyping: true);
        $this->dispatch('process-message', message: $userMessage);
    }

    public function processMessage($message)
    {
        try {
            $response = null;
            // if ($this->useGemini) {
            //     $response = $this->geminiService->generateResponse($message);
            // }
            if (!$response) {
                $response = $this->generateFakeBotResponse($message);
            }
            $this->addBotMessage($response);
        } catch (\Exception $e) {
            $this->addBotMessage('Sorry, I had a problem processing your message. How can I help you?');
        }
        $this->isTyping = false;
        $this->estimatedTime = 0;
        $this->dispatch('bot-finished-typing');
        $this->dispatch('typing-state-changed', isTyping: false);
    }

    private function generateFakeBotResponse($message)
    {
        $processingTime = rand(1000000, 3000000);
        usleep($processingTime);

        $intents = [
            'greeting' => [
                'keywords' => ['bom dia', 'boa tarde', 'boa noite', 'olá', 'ola', 'oi', 'e aí', 'ei', 'salve', 'hello', 'hi', 'hey'],
                'responses' => [
                    'Hello! How can I help you today?',
                    'Hi there! What can I assist you with?',
                    'Hey! How can I be of service to you?',
                ],
            ],
            'farewell' => [
                'keywords' => ['tchau', 'até logo', 'até mais', 'falou', 'adeus', 'bye', 'valeu', 'xau', 'goodbye', 'see you'],
                'responses' => [
                    'Goodbye! Feel free to come back if you need anything.',
                    'See you later! I\'ll be here when you need me.',
                    'Take care! Don\'t hesitate to reach out if you have questions.',
                ],
            ],
            'thanks' => [
                'keywords' => ['obrigado', 'obrigada', 'valeu', 'agradecido', 'agradecida', 'thank you', 'thanks', 'appreciate'],
                'responses' => [
                    'You\'re welcome! I\'m here to help.',
                    'No problem at all! Is there anything else I can assist you with?',
                    'My pleasure! Let me know if you need anything else.',
                ],
            ],
            'default' => [
                'keywords' => [],
                'responses' => [
                    'Thank you for your message! How can I help you?',
                    'I didn\'t quite understand. Could you rephrase that?',
                    'Interesting! Tell me more about what you\'re looking for.',
                    'I\'m here to help! What would you like to know?',
                    'That\'s a great question! Let me think about that...',
                ],
            ],
        ];

        $lowerMessage = mb_strtolower($message, 'UTF-8');

        foreach ($intents as $intentName => $intentData) {
            if ($intentName === 'default') {
                continue;
            }
            foreach ($intentData['keywords'] as $keyword) {
                if (mb_strpos($lowerMessage, mb_strtolower($keyword, 'UTF-8')) !== false) {
                    $responses = $intentData['responses'];
                    return $responses[array_rand($responses)];
                }
            }
        }

        $defaultResponses = $intents['default']['responses'];
        return $defaultResponses[array_rand($defaultResponses)];
    }

    public function clearChat()
    {
        if ($this->chatId) {
            Chat::where('id', $this->chatId)->delete();
        }
        $this->startNewChat();
    }

    public function quickAction($message)
    {
        $this->newMessage = $message;
        $this->sendMessage();
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}
