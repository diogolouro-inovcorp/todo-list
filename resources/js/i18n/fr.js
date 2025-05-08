export default {
    welcome: 'Bienvenue dans votre liste de tâches !',
    language_selector : {
        select: 'Choisissez votre langue :',
        portuguese : 'Portugais',
        english : 'Anglais',
        spanish : 'Espagnol',
        french : 'Français',
    },
    language_manager: {
        title: 'Gérer les Langues',
        selectExportLanguage: 'Exporter la Langue',
        exportButton: 'Exporter',
        selectImportLanguage: 'Importer la Langue',
        importButton: 'Importer',
        noFileSelected: 'Aucun fichier sélectionné',
        importSuccess: 'Langue importée avec succès',
        importError: 'Erreur lors de l\'importation de la langue'
    },

    create_task: {
        title: 'Créer une nouvelle tâche',
        field_title: 'Titre',
        field_description: 'Description',
        field_due_date: 'Date d\'échéance',
        field_priority: 'Priorité',
        button: 'Créer la tâche',
        success: 'Tâche créée avec succès !',
        priorities: {
            alta: 'Élevée',
            media: 'Moyenne',
            baixa: 'Faible'
        }
    },

    chart: {
        title: 'Statistiques des tâches',
        labels: {
            pending: 'En attente',
            completed: 'Terminée'
        }
    },

    filters: {
        all_statuses: "Tous les états",
        all_priorities: "Toutes les priorités",
        due_date: "Date d'échéance",
        sort_by_date: "Trier par date",
        sort_by_priority: "Trier par priorité",
    },
    status: {
        pending: "En attente",
        completed: "Terminée",
    },
    priority: {
        high: "Élevée",
        medium: "Moyenne",
        low: "Faible",
        alta: "Élevée",
        media: "Moyenne",
        baixa: "Faible",
    },
    tasks: {
        title: "Liste des tâches",
        loading: "Chargement...",
        due_date: "Date d'échéance",
    },
    buttons: {
        mark_done: "Marquer comme terminée",
        mark_pending: "Marquer comme en attente",
        edit: "Modifier la tâche",
        delete: "Supprimer la tâche",
    },

    taskDetails: {
        editTitle: "Modifier la tâche",
        title: "Titre",
        description: "Description",
    },
    buttonsDetails: {
        cancel: "Annuler",
        save: "Enregistrer",
    },
}
