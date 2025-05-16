export default {
    welcome: 'Bem-vindo à sua Lista de Tarefas!',
    language_selector:  {
        select: 'Por favor, selecione o seu idioma:',
        portuguese: 'Português',
        english: 'Inglês',
        spanish: 'Espanhol',
        french: 'Francês',
    },
    language_manager: {
        title: 'Gerir Idiomas',
        selectExportLanguage: 'Exportar Idioma',
        exportButton: 'Exportar',
        selectImportLanguage: 'Importar Idioma',
        importButton: 'Importar',
        noFileSelected: 'Nenhum ficheiro selecionado',
        importSuccess: 'Idioma importado com sucesso',
        importError: 'Erro ao importar o idioma'
    },

    //CreateTask
    create_task: {
        title: 'Criar Nova Tarefa',
        field_title: 'Título',
        field_description: 'Descrição',
        field_due_date: 'Data de Vencimento',
        field_priority: 'Prioridade',
        button: 'Criar Tarefa',
        success: 'Tarefa criada com sucesso!',
        priorities: {
            alta: 'Alta',
            media: 'Média',
            baixa: 'Baixa'
        }
    },
    //TaskStatsChart
    chart: {
        title: 'Estatísticas das Tarefas',
        labels: {
            pending: 'Pendentes',
            completed: 'Concluídas'
        }
    },
    //TaskList
    filters: {
        all_statuses: "Todos os estados",
        all_priorities: "Todas as prioridades",
        due_date: "Data de vencimento",
        sort_by_date: "Ordenar por data",
        sort_by_priority: "Ordenar por prioridade",
    },
    status: {
        pending: "Pendentes",
        completed: "Concluídas",
    },
    priority: {
        high: "Alta",
        medium: "Média",
        low: "Baixa",
        alta: "Alta",
        media: "Média",
        baixa: "Baixa",
    },
    tasks: {
        title: "Lista de Tarefas",
        loading: "A carregar...",
        due_date: "Vencimento",
    },
    buttons: {
        mark_done: "Marcar como concluída",
        mark_pending: "Marcar como pendente",
        edit: "Editar tarefa",
        delete: "Eliminar tarefa",
    },
    toastNotifications: {
        mark_done: "Tarefa marcada como concluída",
        mark_pending: "Tarefa marcada como pendente",
        edit: "Tarefa editada!",
        delete: "Tarefa eliminada!",
    },
    consoleError: {
        mark_done: "Erro ao marcar como concluída:",
        mark_pending: "Erro ao marcar como pendente:",
        edit: "Erro ao editar a terefa",
        delete: "Erro ao eliminar a tarefa:",
    },
    //TaskDetails
    taskDetails: {
        editTitle: "Editar Tarefa",
        title: "Título",
        description: "Descrição",
    },
    buttonsDetails: {
        cancel: "Cancelar",
        save: "Guardar",
    },

}
