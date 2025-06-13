# 🤖 Chatbot Assistant - Portfolio Project

Um sistema de chatbot inteligente desenvolvido com Laravel e Livewire, que permite conversas interativas com histórico persistente e interface moderna.

## ✨ Funcionalidades

### 🎯 Principais Recursos
- **Chat Interativo**: Conversas em tempo real com assistente virtual
- **Histórico Persistente**: Salva todas as conversas no banco de dados
- **Sidebar de Histórico**: Acesso rápido aos chats anteriores
- **Interface Responsiva**: Design moderno e adaptável para todos os dispositivos
- **Sistema de Autenticação**: Proteção de dados com login de usuários
- **Sugestões Rápidas**: Perguntas frequentes para iniciar conversas

### 🔧 Tecnologias Utilizadas
- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Livewire 3, Alpine.js, Tailwind CSS
- **Banco de Dados**: MySQL/PostgreSQL
- **Autenticação**: Laravel Fortify + Jetstream
- **IA**: Integração preparada para Gemini API (Google)

## 🚀 Instalação

### Pré-requisitos
- PHP 8.2 ou superior
- Composer
- Node.js e NPM
- MySQL ou PostgreSQL
- Git

### Passos de Instalação

1. **Clone o repositório**
```bash
git clone https://github.com/edumes/chatbot-ai.git
cd chatbot-ai
```

2. **Instale as dependências PHP**
```bash
composer install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure o banco de dados no .env**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chatbot_db
DB_USERNAME=root
DB_PASSWORD=
```

5. **Execute as migrações**
```bash
php artisan migrate
```

6. **Instale as dependências JavaScript**
```bash
npm install
```

7. **Compile os assets**
```bash
npm run build
```

8. **Inicie o servidor**
```bash
php artisan serve
```

## 📁 Estrutura do Projeto

```
chatbot-ai/
├── app/
│   ├── Livewire/
│   │   └── Chatbot.php          # Componente principal do chatbot
│   │   └── GeminiService.php    # Serviço de IA (preparado)
│   ├── Models/
│   │   ├── Chat.php             # Modelo para conversas
│   │   ├── ChatMessage.php      # Modelo para mensagens
│   │   └── User.php             # Modelo de usuário
│   └── Services/
│       └── GeminiService.php    # Serviço de IA (preparado)
├── database/
│   └── migrations/
│       ├── create_chats_table.php
│       └── create_chat_messages_table.php
├── resources/
│   └── views/
│       ├── livewire/
│       │   └── chatbot.blade.php # Interface do chatbot
│       └── components/
│           └── app/
│               └── sidebar.blade.php # Sidebar com histórico
└── routes/
    └── web.php                  # Rotas da aplicação
```

## 🎮 Como Usar

### 1. Acesse o Sistema
- Navegue para `http://localhost:8000`
- Faça login ou registre-se

### 2. Inicie uma Conversa
- Clique em "Chatbot" na sidebar
- Digite sua mensagem e pressione Enter
- O assistente responderá automaticamente

### 3. Gerencie o Histórico
- **Ver Histórico**: Chats anteriores aparecem na sidebar
- **Continuar Chat**: Clique em qualquer chat para continuar
- **Novo Chat**: Use "Reset Chat" para iniciar uma nova conversa

### 4. Sugestões Rápidas
- Use os botões de sugestões para iniciar conversas rapidamente
- Perguntas como "What can you help me with?" estão disponíveis

## 🔧 Configuração Avançada

### Integração com IA (Opcional)
Para usar o Gemini API do Google:

1. **Obtenha uma API Key**
   - Acesse [Google AI Studio](https://makersuite.google.com/app/apikey)
   - Crie uma nova API key

2. **Configure no .env**
```env
GEMINI_API_KEY=sua_api_key_aqui
```

### Personalização de Respostas
Edite o método `generateFakeBotResponse()` em `app/Livewire/Chatbot.php` para:
- Adicionar novos intents
- Modificar respostas existentes
- Implementar lógica personalizada

## 📊 Banco de Dados

### Tabelas Principais

**chats**
- `id` - ID único do chat
- `user_id` - ID do usuário (nullable)
- `title` - Título do chat
- `created_at` / `updated_at` - Timestamps

**chat_messages**
- `id` - ID único da mensagem
- `chat_id` - ID do chat relacionado
- `sender` - 'user' ou 'bot'
- `text` - Conteúdo da mensagem
- `sent_at` - Timestamp de envio

## 👨‍💻 Autor

**Eduardo Santarosa**
- GitHub: [@edumes](https://github.com/edumes)
- LinkedIn: [Eduardo Santarosa](https://linkedin.com/in/edumesz)

---
