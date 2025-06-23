# 🤖 Chatbot Assistant

Um sistema de chatbot inteligente desenvolvido com Laravel e Livewire, que permite conversas interativas com histórico persistente e interface moderna.

![{C9609002-47CA-483F-9A3E-32AB40CEF9B8}](https://github.com/user-attachments/assets/15667603-ac8f-4e69-b926-4a50aed23b13)

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
- **Frontend**: Livewire 3, Tailwind CSS
- **Banco de Dados**: MySQL
- **Autenticação**: Laravel Fortify + Jetstream
- **IA**: Integração preparada para Gemini API (Google)

## 🚀 Instalação

### Pré-requisitos
- PHP 8.2 ou superior
- Composer
- Node.js e NPM
- MySQL

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

6. **Instale as dependências**
```bash
npm install
```

7. **Compile o frontend**
```bash
npm run build
```

8. **Inicie o servidor**
```bash
php artisan serve
```

2. **Configure no .env**
```env
GEMINI_API_KEY=sua_api_key_aqui
```

## 👨‍💻 Autor

**Eduardo Santarosa**
- GitHub: [@edumes](https://github.com/edumes)
- LinkedIn: [Eduardo Santarosa](https://linkedin.com/in/edumesz)

---
