import { onBeforeUnmount, ref } from 'vue'

/**
 * Shared scroll-navigation state for the site chrome.
 *
 * Both the desktop header and the mobile bottom bar need the same section list
 * and the same "which section am I in" answer, so that state lives here rather
 * than being duplicated (and drifting) in two components.
 *
 * The refs are module-level on purpose: `activeSection` must be a single source
 * of truth no matter how many components ask for it.
 */

/**
 * Sections that the chrome navigates to.
 *
 * `inBar` marks the items promoted to the mobile bottom bar. There is only room
 * for five there, so "خدمات" stays reachable by scrolling but is not pinned.
 */
export const navItems = [
  { id: 'hero', label: 'صفحه نخست', icon: 'home', inBar: true },
  { id: 'about', label: 'درباره من', icon: 'person', inBar: true },
  { id: 'projects', label: 'پروژه‌ها', icon: 'grid_view', inBar: true },
  { id: 'services', label: 'خدمات', icon: 'widgets', inBar: false },
  { id: 'experience', label: 'سوابق', icon: 'timeline', inBar: true },
  { id: 'contact', label: 'تماس', icon: 'mail', inBar: true },
]

/** Items shown in the bottom bar, in order. */
export const barItems = navItems.filter((item) => item.inBar)

const activeSection = ref('hero')
const chromeHidden = ref(false)

/**
 * Scrolls to a section. No-ops when the section is absent, which happens on
 * routes rendered by this layout that are not the landing page.
 */
export function scrollToSection(id) {
  document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' })
}

/**
 * Observes the page sections and reports only the one currently in view.
 *
 * This is deliberately NOT tied to any component life cycle: it is called from
 * two components at once, and a per-component cleanup would tear the shared
 * observer down while the other consumer is still alive. The layout owns the
 * observer for as long as the app is mounted, so there is nothing to release.
 */
export function observeActiveSection() {
  if (!('IntersectionObserver' in window)) return

  const sections = navItems
    .map((item) => document.getElementById(item.id))
    .filter((el) => el !== null)

  if (sections.length === 0) return

  const observer = new IntersectionObserver(
    (entries) => {
      const visible = entries
        .filter((entry) => entry.isIntersecting)
        .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0]

      if (visible) activeSection.value = visible.target.id
    },
    { threshold: [0.25, 0.5], rootMargin: '-20% 0px -55% 0px' },
  )

  sections.forEach((el) => observer.observe(el))
}

export function useSectionNav() {
  return {
    navItems,
    barItems,
    activeSection,
    chromeHidden,
    scrollToSection,
  }
}

/**
 * Hides the bottom bar while scrolling down and brings it back on any upward
 * scroll or when the page is near the top.
 *
 * Only the bottom bar calls this, so the listener is bound exactly once and
 * released with that component.
 */
export function useAutoHideChrome() {
  let lastScrollY = 0

  function onScroll() {
    const y = window.scrollY
    const delta = y - lastScrollY

    // Ignore small jitter so the bar does not flicker.
    if (Math.abs(delta) > 6) {
      chromeHidden.value = delta > 0 && y > 120
      lastScrollY = y
    }
  }

  onBeforeUnmount(() => {
    window.removeEventListener('scroll', onScroll)
  })

  lastScrollY = window.scrollY
  window.addEventListener('scroll', onScroll, { passive: true })
}
