import { computed, ref } from 'vue'

/**
 * Dark / light theme controller built on Quasar's official Dark plugin.
 *
 * The plugin itself owns the hard part: `$q.dark.set('auto')` installs its own
 * `prefers-color-scheme` listener and paints `<body>` with `body--dark` /
 * `body--light`, which is what every token in `app.scss` keys off. This module
 * adds the two things the plugin deliberately leaves to the app:
 *
 *   1. remembering the visitor's choice across reloads (localStorage),
 *   2. a small API for the header toggle.
 *
 * Nothing here re-implements the OS listener, so the site follows a live OS
 * theme change for free while it is in `auto` mode.
 */

/**
 * The same key Quasar's own `dark: 'auto'` config would use, so a theme set by
 * either path is picked up by the other.
 */
export const THEME_STORAGE_KEY = 'q-dark'

/** `'auto'` means "no explicit pick" — follow the operating system. */
const AUTO_VALUE = 'auto'
const STORED_DARK = 'true'
const STORED_LIGHT = 'false'

/**
 * Quasar's `$q` is captured once from the boot file rather than through
 * `useQuasar()`, so the same instance drives both the install-time theme and
 * later component toggles.
 */
const $qRef = ref(null)

/**
 * Guarded localStorage access: private-mode Safari and blocked third-party
 * storage both throw on read/write, and a theme is never worth an exception.
 */
function readStored() {
  try {
    return window.localStorage.getItem(THEME_STORAGE_KEY)
  } catch {
    return null
  }
}

function writeStored(value) {
  try {
    window.localStorage.setItem(THEME_STORAGE_KEY, value)
  } catch {
    /* storage unavailable — the session still works, it just won't persist */
  }
}

/**
 * `'true'` / `'false'` are the visitor's explicit picks. Anything else (no key,
 * `'auto'`, or a foreign value) resolves to `auto`.
 */
function readPreference() {
  const stored = readStored()

  if (stored === STORED_DARK) return true
  if (stored === STORED_LIGHT) return false

  return AUTO_VALUE
}

/**
 * Applies the initial theme. Runs from the boot file, before the app mounts,
 * so the first paint already has the right palette:
 * first visit → `auto`, returning visit → the saved pick.
 *
 * `$q` is not part of the boot-file context in this Quasar version — it is the
 * Vue global property that `app.use(Quasar, …)` installs, so it is read from
 * there (Quasar installs its plugins before any boot file runs).
 */
export function initTheme(app) {
  const $q = app?.config.globalProperties.$q
  if ($q === undefined || $q === null) return

  $qRef.value = $q
  $q.dark.set(readPreference())
}

/**
 * Short-lived attribute that lets the stylesheet fade the colour tokens for a
 * moment. It is removed again so hovers and scrolling never inherit a
 * transition afterwards.
 */
function beginThemeTransition() {
  const { body } = document

  body.setAttribute('data-theme-transition', '')
  window.setTimeout(() => body.removeAttribute('data-theme-transition'), 340)
}

export function useTheme() {
  /** Resolved state: in `auto` mode this is what the OS currently asks for. */
  const isDark = computed(() => $qRef.value?.dark.isActive === true)

  /**
   * Flips dark ⇄ light and stores the result. Clicking is an explicit choice,
   * so the site leaves `auto` mode for good at that point; there is no UI that
   * clears the key and hands control back to the OS.
   */
  function toggleTheme() {
    const $q = $qRef.value
    if ($q === null) return

    const next = !isDark.value

    beginThemeTransition()

    $q.dark.set(next)
    writeStored(next ? STORED_DARK : STORED_LIGHT)
  }

  return { isDark, toggleTheme }
}
