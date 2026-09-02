# Sistema de Login com Lista de Tarefas (PHP)

Projeto desenvolvido para a atividade prática de **Desenvolvimento Backend** (PHP, HTML5 e CSS3), do módulo de Desenvolvimento de Sistemas.

O sistema conta com uma tela de login protegida por sessão (`$_SESSION`) e, após o acesso, um dashboard com uma funcionalidade interativa de **Lista de Tarefas (To-Do List)**.

## 🔑 Credenciais de acesso

Para fins de teste, as credenciais estão fixas (hardcoded) no código, conforme especificado na atividade:

- **E-mail:** `admin@sistema.com`
- **Senha:** `123456`

## 🚀 Funcionalidades

- Login com validação via `POST`
- Controle de sessão com `session_start()` e `$_SESSION`
- Bloqueio de acesso ao dashboard sem login
- Lista de tarefas: adicionar, concluir/reabrir e remover itens
- Contadores de tarefas (total, concluídas, pendentes)
- Logout com `session_destroy()`
- Interface responsiva com HTML5 e CSS3

## 📁 Estrutura de arquivos

```
├── index.php       # Tela de login e validação de credenciais
├── dashboard.php   # Área restrita com a lista de tarefas
├── logout.php      # Encerramento da sessão
└── style.css       # Estilos do projeto
```

## ▶️ Como rodar o projeto localmente

### Opção 1 — Usando XAMPP (recomendado)

1. Baixe e instale o [XAMPP](https://www.apachefriends.org/).
2. Abra o **XAMPP Control Panel** e clique em **Start** ao lado de **Apache**.
3. Copie os arquivos deste repositório para dentro da pasta:
   ```
   C:\xampp\htdocs\nome-do-projeto
   ```
4. No navegador, acesse:
   ```
   http://localhost/nome-do-projeto/index.php
   ```
5. Faça login com as credenciais informadas acima.

### Opção 2 — Usando o servidor embutido do PHP

Caso já tenha o PHP instalado no seu computador:

1. Abra o terminal dentro da pasta do projeto.
2. Execute o comando:
   ```
   php -S localhost:8000
   ```
3. Acesse no navegador:
   ```
   http://localhost:8000/index.php
   ```

## 🛠️ Tecnologias utilizadas

- PHP
- HTML5
- CSS3

## 📌 Observação

Este é um projeto acadêmico, feito para fins de aprendizado e avaliação. As credenciais fixas no código não devem ser usadas em aplicações reais — em produção, sempre utilize autenticação com senhas criptografadas e armazenamento seguro em banco de dados.
