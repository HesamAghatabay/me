import { defineBoot } from '#q-app'
import { createI18n } from 'vue-i18n'
import messages from '@/i18n'
import { DEFAULT_LOCALE, initLocale } from '@/composables/useLocale'

/**
 * Installs vue-i18n and resolves the starting locale before the app mounts.
 *
 * `legacy: false` (Composition API mode) is what makes `locale` a reactive ref,
 * so switching it re-renders every `$t()` without a page reload.
 *
 * `initLocale` runs here rather than in a component so the very first paint is
 * already in the right language and direction — no LTR→RTL flash on load.
 */
export default defineBoot(({ app }) => {
  const i18n = createI18n({
    legacy: false,
    locale: DEFAULT_LOCALE,
    fallbackLocale: DEFAULT_LOCALE,
    globalInjection: true,
    messages,
  })

  initLocale(i18n)

  app.use(i18n)
})
