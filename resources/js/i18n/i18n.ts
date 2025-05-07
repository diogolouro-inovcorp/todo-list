import { createI18n } from 'vue-i18n'
import pt from './pt'
import en from './en'
import es from './es'

const savedLocale = localStorage.getItem('locale') || 'pt'

export const i18n = createI18n({
    legacy: false,
    locale: savedLocale,
    fallbackLocale: 'pt',
    messages: {
        pt,
        en,
        es,
    },
})
