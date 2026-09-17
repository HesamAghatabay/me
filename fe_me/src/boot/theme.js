import { defineBoot } from '#q-app'
import { initTheme } from '@/composables/useTheme'

/**
 * Runs before the app mounts so the very first paint already carries the
 * visitor's theme: the saved choice when one exists, otherwise `auto`, which
 * hands control to the operating system's colour scheme.
 *
 * The boot context exposes `app` (not `$q`); `$q` is the global property that
 * `app.use(Quasar, …)` has already installed by the time boot files run.
 */
export default defineBoot(({ app }) => {
  initTheme(app)
})
