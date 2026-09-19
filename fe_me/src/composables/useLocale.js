import { computed } from 'vue'
import { Lang as QuasarLang } from 'quasar'
import enLang from 'quasar/lang/en-US'
import faLang from 'quasar/lang/fa-IR'
import { useI18n } from 'vue-i18n'

/**
 * The single owner of "which language is the site in".
 *
 * Switching a locale touches four things that must stay in step, which is why
 * they live in one function instead of being spread over the components:
 *
 *   1. `vue-i18n`'s reactive locale → the copy re-renders with no page reload,
 *   2. Quasar's own language pack → its components (RTL maths, labels, number
 *      and date formatting) follow the site language,
 *   3. `<html dir>`/`<html lang>` → Quasar's `Lang.set` writes both, so the
 *      layout flips between RTL and LTR and the font stack in `app.scss`
 *      switches with it,
 *   4. `localStorage` → the choice survives a refresh.
 *
 * Dictionary keys are the plain codes `fa` / `en`; the Quasar packs and the
 * document attributes use the full locale tags mapped below.
 */

/** Same key Quasar's own `lang` config expects, so either path stays in sync. */
export const LOCALE_STORAGE_KEY = 'q-lang'

export const DEFAULT_LOCALE = 'fa'

/** Locales the switch can select, in cycle order. */
export const AVAILABLE_LOCALES = ['fa', 'en']

/** Full BCP 47 tag per dictionary code — used for `<html lang>`. */
const LOCALE_TAGS = { fa: 'fa-IR', en: 'en-US' }

/** Quasar component-language packs per dictionary code. */
const QUASAR_LANGS = { fa: faLang, en: enLang }

/** The vue-i18n instance, captured by `initLocale` for the boot-time switch. */
let i18nInstance = null

/**
 * Guarded storage: private-mode Safari and blocked third-party storage throw
 * on read/write, and a language is never worth an exception.
 */
function readStored() {
  try {
    return window.localStorage.getItem(LOCALE_STORAGE_KEY)
  } catch {
    return null
  }
}

function writeStored(value) {
  try {
    window.localStorage.setItem(LOCALE_STORAGE_KEY, value)
  } catch {
    /* storage unavailable — the session still works, it just won't persist */
  }
}

/** Narrows anything (stored value, `navigator.language`, …) to a supported code. */
export function normalizeLocale(value) {
  if (typeof value !== 'string') return null

  const code = value.toLowerCase().split(/[-_]/)[0]

  return AVAILABLE_LOCALES.includes(code) ? code : null
}

/** The locales a switch can move to from `current`. */
export function otherLocales(current) {
  return AVAILABLE_LOCALES.filter((code) => code !== current)
}

/** Applies a locale to Quasar, vue-i18n and the document. */
function applyLocale(code) {
  // `Lang.set` writes `dir` + `lang` on <html>; `rtl` comes from the pack.
  QuasarLang.set(QUASAR_LANGS[code])

  if (i18nInstance !== null) {
    i18nInstance.global.locale.value = code
  }

  const tag = LOCALE_TAGS[code]
  if (tag !== undefined) {
    document.documentElement.setAttribute('lang', tag)
  }
}

/**
 * Resolves and applies the starting locale. Called from the boot file, before
 * the app mounts, so the first paint is already in the right language and
 * direction.
 *
 * A stored choice always wins; otherwise the browser's preferred language is
 * used when it is one we ship, and Persian remains the fallback for everyone
 * else (the site's primary audience).
 */
export function initLocale(i18n) {
  i18nInstance = i18n

  const stored = normalizeLocale(readStored())
  const fromBrowser = typeof navigator === 'undefined' ? null : normalizeLocale(navigator.language)

  applyLocale(stored ?? fromBrowser ?? DEFAULT_LOCALE)
}

/**
 * The locale API used by components: the active locale, its direction, and the
 * switch itself.
 */
export function useLocale() {
  // `useI18n` is what makes translations reactive; the instance is installed
  // globally by the boot file.
  const { locale } = useI18n({ useScope: 'global' })

  const currentLocale = computed(() => locale.value)

  const isRtl = computed(() => (QUASAR_LANGS[currentLocale.value] ?? faLang).rtl === true)

  /** Applies a locale without a reload and remembers the choice. */
  function setLocale(code) {
    const next = normalizeLocale(code) ?? DEFAULT_LOCALE

    applyLocale(next)
    writeStored(next)
  }

  /** Cycles to the other locale — the header switch's click handler. */
  function toggleLocale() {
    setLocale(otherLocales(currentLocale.value)[0])
  }

  return { currentLocale, isRtl, setLocale, toggleLocale }
}
