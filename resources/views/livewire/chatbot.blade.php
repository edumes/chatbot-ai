<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-6xl mx-auto">

    <!-- Chatbot Header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">

        <!-- Left: Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Chatbot Assistant</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Chat with the virtual assistant</p>
        </div>

        <!-- Right: Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
            <button wire:click="clearChat"
                class="btn bg-gray-500 text-white hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 cursor-pointer">
                <svg class="fill-current shrink-0" width="16" height="16" viewBox="0 0 16 16">
                    <path
                        d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z" />
                </svg>
                <span class="ml-2">Reset Chat</span>
            </button>
        </div>

    </div>

    <!-- Quick Suggestions -->
    @if (count($suggestions) > 0 && count($messages) <= 1)
        <div class="mb-6">
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">frequently asked questions:</h3>
            <div class="flex flex-wrap gap-2">
                @foreach ($suggestions as $suggestion)
                    <button wire:click="quickAction('{{ $suggestion }}')"
                        class="px-3 py-2 text-sm bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors border border-gray-200 dark:border-gray-600">
                        {{ $suggestion }}
                    </button>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Chat Container -->
    <div
        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 h-[600px] flex flex-col overflow-hidden">

        <!-- Chat Messages Area -->
        <div class="flex-1 overflow-y-auto p-6 space-y-1" id="chat-messages">

            @foreach ($messages as $message)
                @if ($message['sender'] === 'user')
                    <!-- User Message - Right Side -->
                    <div class="flex justify-end message-fade-in">
                        <div class="flex items-end space-x-2 max-w-xs lg:max-w-md">
                            <div class="bg-blue-500 text-white rounded-2xl rounded-br-md px-4 py-3 shadow-sm">
                                <p class="text-sm leading-relaxed">{{ $message['text'] }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mr-12">{{ $message['timestamp'] }}</p>
                    </div>
                @else
                    <!-- Bot Message - Left Side -->
                    <div class="flex justify-start message-fade-in">
                        <div class="flex items-start space-x-2 max-w-xs lg:max-w-md">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div
                                class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-2xl rounded-bl-md px-4 py-3 shadow-sm">
                                <p class="text-sm leading-relaxed">{{ $message['text'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-start">
                        <p class="text-xs text-gray-500 dark:text-gray-400 ml-12">{{ $message['timestamp'] }}</p>
                    </div>
                @endif
            @endforeach

            <!-- Typing Indicator -->
            @if ($isTyping)
                <div class="flex justify-start typing-indicator">
                    <div class="flex items-start space-x-2">
                        <div class="flex-shrink-0">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl rounded-bl-md px-4 py-3 shadow-sm">
                            <div class="flex items-center space-x-1">
                                <div class="w-2 h-2 bg-blue-400 rounded-full typing-dot"></div>
                                <div class="w-2 h-2 bg-blue-400 rounded-full typing-dot"></div>
                                <div class="w-2 h-2 bg-blue-400 rounded-full typing-dot"></div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Assistant is typing... 
                                @if($estimatedTime > 0)
                                    <span class="text-blue-500">(~{{ $estimatedTime }}s)</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <!-- Chat Input Area -->
        <div class="border-t border-gray-200 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800/50">
            <form wire:submit.prevent="sendMessage" class="flex space-x-3">
                <div class="flex-1">
                    <input type="text" wire:model.live="newMessage" placeholder="Type your message..."
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition-colors"
                        autocomplete="off">
                </div>
                <button type="submit"
                    class="px-6 py-3 cursor-pointer bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-sm"
                    wire:loading.attr="disabled" @if (empty(trim($newMessage))) disabled @endif>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24" wire:loading>
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </button>
            </form>
        </div>

    </div>

    <script>
        function scrollToBottom() {
            const chatMessages = document.getElementById('chat-messages');
            if (chatMessages) {
                chatMessages.scrollTo({
                    top: chatMessages.scrollHeight,
                    behavior: 'smooth'
                });
            }
        }

        function scrollToBottomImmediate() {
            const chatMessages = document.getElementById('chat-messages');
            if (chatMessages) {
                chatMessages.scrollTo({
                    top: chatMessages.scrollHeight,
                    behavior: 'auto'
                });
            }
        }

        function forceScrollToBottom() {
            const chatMessages = document.getElementById('chat-messages');
            if (chatMessages) {
                // Força o scroll para baixo de forma mais agressiva
                chatMessages.scrollTop = chatMessages.scrollHeight;
                // Dupla verificação após um pequeno delay
                setTimeout(() => {
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 10);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(scrollToBottom, 100);
            
            // Listener para o formulário de envio de mensagem
            const form = document.querySelector('form[wire\\:submit\\.prevent="sendMessage"]');
            if (form) {
                form.addEventListener('submit', () => {
                    // Scroll imediato quando o formulário for enviado
                    setTimeout(() => {
                        forceScrollToBottom();
                    }, 50);
                });
            }
            
            // Listener para o botão de envio
            const sendButton = document.querySelector('button[type="submit"]');
            if (sendButton) {
                sendButton.addEventListener('click', () => {
                    // Scroll imediato quando o botão for clicado
                    setTimeout(() => {
                        forceScrollToBottom();
                    }, 10);
                });
            }
            
            // Listener para mudanças no input de mensagem
            const messageInput = document.querySelector('input[wire\\:model\\.live="newMessage"]');
            if (messageInput) {
                messageInput.addEventListener('input', () => {
                    // Scroll suave quando o usuário digitar
                    setTimeout(() => {
                        scrollToBottom();
                    }, 100);
                });
            }
        });

        document.addEventListener('livewire:init', () => {
            // Scroll imediato quando mensagens são processadas
            Livewire.hook('message.processed', () => {
                forceScrollToBottom();
            });

            // Scroll imediato quando o componente for atualizado
            Livewire.hook('component.updated', (component) => {
                if (component.fingerprint.name === 'chatbot') {
                    forceScrollToBottom();
                }
            });

            // Listener para processar mensagens de forma assíncrona
            Livewire.on('process-message', (event) => {
                console.log('Process message event received:', event);
                // Scroll imediato e forçado quando começar a digitar
                forceScrollToBottom();
                
                // Simular um delay para mostrar a animação de digitação
                setTimeout(() => {
                    console.log('Calling processMessage with:', event.message);
                    @this.processMessage(event.message);
                }, 1000); // 1 segundo de delay para mostrar a animação
            });

            // Listener para quando o bot terminar de digitar
            Livewire.on('bot-finished-typing', () => {
                forceScrollToBottom();
            });

            // Listener para mudanças no estado de digitação
            Livewire.on('typing-state-changed', (event) => {
                // Sempre fazer scroll para baixo, independente do estado
                forceScrollToBottom();
            });

            // Listener adicional para quando o formulário for enviado
            Livewire.on('message-sent', () => {
                forceScrollToBottom();
            });
        });
    </script>

    <style>
        /* Animação personalizada para o indicador de digitação */
        @keyframes typing-dot {
            0%, 60%, 100% {
                transform: translateY(0);
                opacity: 0.4;
            }
            30% {
                transform: translateY(-8px);
                opacity: 1;
            }
        }

        .typing-dot {
            animation: typing-dot 1.4s infinite ease-in-out;
            display: inline-block;
        }

        .typing-dot:nth-child(1) { animation-delay: 0ms; }
        .typing-dot:nth-child(2) { animation-delay: 150ms; }
        .typing-dot:nth-child(3) { animation-delay: 300ms; }

        /* Animação suave para mensagens */
        .message-fade-in {
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Melhorar a animação de bounce */
        .animate-bounce {
            animation: bounce 1s infinite;
        }

        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                transform: translate3d(0, 0, 0);
            }
            40%, 43% {
                transform: translate3d(0, -8px, 0);
            }
            70% {
                transform: translate3d(0, -4px, 0);
            }
            90% {
                transform: translate3d(0, -2px, 0);
            }
        }

        /* Garantir que o indicador de digitação seja visível */
        .typing-indicator {
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

        .typing-indicator.hidden {
            opacity: 0;
        }
    </style>

</div>
