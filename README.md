# 📚 Documentação do Projeto — Aplicação To-Do List (Laravel + Vue + Inertia)

## 🧾 Descrição Geral
Aplicação de gestão de tarefas desenvolvida com **Laravel**, **Vue**, **Inertia.js** e **Tailwind CSS**. Permite a criação, listagem, edição, marcação como concluída e eliminação de tarefas, com filtros e ordenação.

---

## 🛠️ Tecnologias Usadas

- **Backend:** Laravel
- **Frontend:** Vue + TypeScript
- **Ligação Front/Back:** Inertia.js
- **CSS:** Tailwind CSS
- **Autenticação:** Starter Kit (com autenticação e verificação de email)
- **Base de Dados:** MySQL

---

## 📁 Estrutura de Ficheiros Relevantes

```
app/Http/Controllers/
  └── TaskController.php    # Controlador da aplicação
  
app/Models/
  └── Task.php              # Modelo da aplicação
  
routes/
  └── web.php               # Rotas da aplicação

resources/js/
  ├── Pages/
  │   └── Dashboard.vue         # Página principal com layout
  ├── Components/
  │   ├── CreateTask.vue        # Criar as tarefas
  │   ├── TaskList.vue          # Listagem das tarefas
  │   ├── TaskStatsChart.vue    # Grafico para visualizar as tarefas
  │   └── TaskDetails.vue       # Detalhes das tarefas
  └── layouts/
      └── AppLayout.vue         # Layout principal
  
tests/
  └── Feature/
      ├── DeleteTask.php            # Teste de apagar a tarefa
      ├── EditTask.php              # Teste de editar tarefa
      ├── CompletedTaskTest.php     # Teste de completar tarefa
      └── TaskTest.php              # Teste para criar uma tarefa
```

---

## 📌 Funcionalidades Implementadas

### ✅ Tarefas
- Criar tarefas com:
  - Título
  - Descrição
  - Prioridade (alta, média, baixa)
  - Data de vencimento
- Listagem com scroll "touch-like"
- Filtros por:
  - Estado (pendente, concluída, todas)
  - Prioridade
  - Data de vencimento
- Ordenação automática por prioridade e data
- Marcar como concluída
- Eliminar tarefa
- Ver/editar tarefa (modal com formulário)
- Efeitos visuais:
  - Tarefa concluída: texto riscado e opaco
  - Cores diferentes por prioridade

---

## 🔒 Acesso
- Requer login (via `/login`)
- A dashboard está protegida com middleware `auth` e `verified`

---

## 🧪 Testes

### ✔️ Testes de Integração
- Criar, editar, eliminar tarefas com acesso real à base de dados

### ⚠️ Testes Unitários
- Só recomendados para métodos sem dependência de Eloquent (ex: `isOverdue()`)

---

## 🌍 Suporte Multilingue (i18n) na Aplicação Todo List
- Laravel será responsável pelas traduções de mensagens de backend, validações e respostas da API.
- Vue 3 usará a biblioteca vue-i18n para traduzir a interface do utilizador.

---

## 🔧 Controladores

**App\Http\Controllers\TaskController**
- `index()` — Listagem com filtros e ordenação
- `store()` — Criar nova tarefa
- `show()` — Ver detalhes
- `update()` — Atualizar tarefa
- `destroy()` — Eliminar tarefa

---

## 🗂️ API de Tarefas (via rotas `api.php`, se necessário mais tarde)
Atualmente é tudo feito via Inertia (rotas web).

---

## 📈 Próximos Passos Sugeridos

- Integração com Calendários
- Implementar notificações (toast) após editar ou eliminar tarefa
- Validação visual de formulário (ex: campos obrigatórios)
- Adicionar página de registo de atividades / histórico
- Exportação para CSV ou Excel
