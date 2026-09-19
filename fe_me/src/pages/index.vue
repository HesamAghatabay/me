<template>
  <q-layout view="lHh Lpr lFf" class="app-shell text-app">
    <!-- Sticky Glass Header -->
    <q-header elevated class="header-glass q-py-xs">
      <q-toolbar class="app-container justify-between">
        <!-- Logo / Brand -->
        <router-link to="/" class="row items-center brand-link no-decoration">
          <div class="logo-icon-box q-mr-sm">
            <q-icon name="terminal" size="20px" color="white" />
          </div>
          <div class="column">
            <span class="text-subtitle1 text-weight-bolder text-app brand-title">
              {{ t('brand.name') }}
            </span>
            <span class="text-caption text-neon font-mono brand-subtitle">
              {{ t('brand.role') }}
            </span>
          </div>
        </router-link>

        <!-- Desktop Navigation Links -->
        <nav class="gt-sm row items-center q-gutter-x-xs nav-pill-wrapper">
          <q-btn
            v-for="item in navLinks"
            :key="item.id"
            flat
            rounded
            dense
            no-caps
            class="nav-tab-btn"
            :label="t(item.labelKey)"
            @click="handleNavigation(item.id)"
          />
        </nav>

        <!-- CTA & Locale switch & Theme switch & Mobile Drawer Toggle -->
        <div class="row items-center q-gutter-sm">
          <q-btn
            unelevated
            rounded
            color="primary"
            icon-right="mail"
            :label="t('actions.contact_me')"
            class="glow-cta-btn q-px-md gt-sm"
            @click="handleNavigation('contact')"
          />

          <!--
            Locale switch: shows the language a click switches *to*, which is
            the convention users expect from a compact FA / EN control. The
            whole swap (copy, direction, fonts, Quasar packs) happens through
            `setLocale`, with no page reload.
          -->
          <q-btn
            flat
            round
            dense
            class="locale-switch-btn"
            :aria-label="`${t('theme.switch_language')}: ${alternateLabel}`"
            @click="toggleLocale"
          >
            <span class="locale-switch-label" dir="ltr">{{ alternateCode.toUpperCase() }}</span>
            <q-tooltip>{{ t('theme.switch_language') }}</q-tooltip>
          </q-btn>

          <!--
            Dark / light switch. The icon announces the current theme, and a
            click flips it through Quasar's Dark plugin (`$q.dark.toggle()`),
            which also stores the choice so a refresh keeps it.
          -->
          <q-btn
            flat
            round
            dense
            class="theme-toggle-btn"
            :icon="isDark ? 'dark_mode' : 'light_mode'"
            :aria-label="isDark ? t('theme.to_light') : t('theme.to_dark')"
            :aria-pressed="isDark ? 'true' : 'false'"
            @click="toggleTheme"
          >
            <q-tooltip>{{ isDark ? t('theme.light') : t('theme.dark') }}</q-tooltip>
          </q-btn>

          <!-- Mobile Hamburger Menu Button -->
          <q-btn
            flat
            round
            dense
            class="icon-ghost-btn lt-md"
            icon="menu"
            :aria-label="t('nav.open_menu')"
            @click="drawerOpen = !drawerOpen"
          />
        </div>
      </q-toolbar>
    </q-header>

    <!--
      Mobile Drawer Navigation.

      `side` is derived from the active direction: RTL puts the drawer on the
      right, LTR on the left, so it always opens from the "natural" edge of the
      reading direction instead of a hard-coded physical side.
    -->
    <q-drawer
      v-model="drawerOpen"
      :side="drawerSide"
      overlay
      behavior="mobile"
      class="mobile-drawer q-pa-md"
    >
      <div class="row items-center justify-between q-mb-xl">
        <span class="text-subtitle1 text-weight-bold text-app">{{ t('nav.menu') }}</span>
        <q-btn flat round dense icon="close" class="icon-ghost-btn" @click="drawerOpen = false" />
      </div>

      <q-list class="q-gutter-y-sm">
        <q-item
          v-for="item in navLinks"
          :key="item.id"
          clickable
          v-ripple
          class="drawer-item rounded-borders"
          @click="handleDrawerNavigation(item.id)"
        >
          <q-item-section avatar>
            <q-icon :name="item.icon" class="text-neon" />
          </q-item-section>
          <q-item-section class="text-weight-medium">{{ t(item.labelKey) }}</q-item-section>
        </q-item>

        <q-item
          clickable
          v-ripple
          class="drawer-item drawer-cta rounded-borders q-mt-md"
          @click="handleDrawerNavigation('contact')"
        >
          <q-item-section avatar>
            <q-icon name="send" color="white" />
          </q-item-section>
          <q-item-section class="text-white text-weight-bold">
            {{ t('actions.start_collaboration') }}
          </q-item-section>
        </q-item>
      </q-list>
    </q-drawer>

    <!-- Main Content Container -->
    <q-page-container>
      <router-view />
    </q-page-container>

    <!-- Modern Footer -->
    <footer class="app-footer border-top-glass q-pt-xl q-pb-lg">
      <div class="app-container q-px-md">
        <div class="row q-col-gutter-xl items-start justify-between q-mb-xl">
          <!-- Column 1: Info & Vision -->
          <div class="col-12 col-md-5">
            <div class="row items-center brand-link q-mb-md">
              <div class="logo-icon-box q-mr-sm">
                <q-icon name="terminal" size="20px" color="white" />
              </div>
              <span class="text-h6 text-weight-bolder text-app">{{ t('brand.name') }}</span>
            </div>
            <p class="text-body2 text-app-muted line-relaxed q-mb-md" style="max-width: 420px">
              {{ t('footer.tagline') }}
            </p>
            <div class="row items-center text-caption text-app-dim">
              <span class="status-dot q-ml-xs"></span>
              {{ t('footer.available') }}
            </div>
          </div>

          <!-- Column 2: Quick Links -->
          <div class="col-6 col-md-3">
            <div class="text-subtitle2 text-weight-bold text-app q-mb-md">
              {{ t('footer.quick_links') }}
            </div>
            <div class="column q-gutter-y-sm">
              <a
                v-for="link in navLinks"
                :key="link.id"
                class="footer-text-link"
                @click.prevent="handleNavigation(link.id)"
              >
                {{ t(link.labelKey) }}
              </a>
            </div>
          </div>

          <!-- Column 3: Direct Connect -->
          <div class="col-6 col-md-4">
            <div class="text-subtitle2 text-weight-bold text-app q-mb-md">
              {{ t('footer.direct_contact') }}
            </div>
            <div class="column q-gutter-y-sm text-body2 text-app-muted">
              <span class="dir-ltr text-start">hesam@example.com</span>
              <span>{{ t('footer.location') }}</span>
              <div class="row q-gutter-xs q-mt-sm">
                <q-btn
                  v-for="link in socials"
                  :key="link.labelKey"
                  flat
                  round
                  dense
                  :icon="link.icon"
                  :href="link.href"
                  target="_blank"
                  class="icon-ghost-btn"
                  :aria-label="t(link.labelKey)"
                />
              </div>
            </div>
          </div>
        </div>

        <!-- Copyright Bottom Bar -->
        <div
          class="footer-bottom-bar border-top-glass q-pt-md row items-center justify-between text-caption text-app-dim"
        >
          <div>{{ t('footer.rights', { year: new Date().getFullYear() }) }}</div>
          <div class="row items-center">
            {{ t('footer.built_with') }}
            <span class="text-neon q-mx-xs">Quasar & Vue 3</span>
          </div>
        </div>
      </div>
    </footer>
  </q-layout>
</template>

<script setup>
import { computed, nextTick, ref, watch } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { useTheme } from '@/composables/useTheme'
import { otherLocales, useLocale } from '@/composables/useLocale'

const router = useRouter()
const route = useRoute()
const drawerOpen = ref(false)
const { t, locale } = useI18n({ useScope: 'global' })

/**
 * Theme state comes from the shared composable so the header and the boot
 * file agree on one implementation: `auto` until the visitor picks a side.
 */
const { isDark, toggleTheme } = useTheme()

/** Locale state (copy + direction) comes from the same kind of shared owner. */
const { currentLocale, isRtl, toggleLocale } = useLocale()

/**
 * Bilingual SEO: the delivered `index.html` only carries the Persian title and
 * description, so both are re-applied whenever the locale changes.
 */
watch(
  locale,
  () => {
    document.title = t('seo.title')

    const description = document.querySelector('meta[name="description"]')
    description?.setAttribute('content', t('seo.description'))
  },
  { immediate: true },
)

/**
 * The switch advertises the target language: in Persian it reads "EN", in
 * English "FA". That is more useful than echoing the active one, which the
 * page content already shows.
 */
const alternateCode = computed(() => otherLocales(currentLocale.value)[0] ?? 'en')
const alternateLabel = computed(() => (alternateCode.value === 'fa' ? 'فارسی' : 'English'))

/** Sections the nav points at; labels stay language-agnostic keys. */
const navLinks = [
  { id: 'hero', labelKey: 'nav.home', icon: 'home' },
  { id: 'about', labelKey: 'nav.about', icon: 'person' },
  { id: 'projects', labelKey: 'nav.projects', icon: 'devices' },
  { id: 'services', labelKey: 'nav.services', icon: 'widgets' },
  { id: 'experience', labelKey: 'nav.experience', icon: 'timeline' },
  { id: 'contact', labelKey: 'nav.contact', icon: 'mail' },
]

const socials = [
  { labelKey: 'socials.github', icon: 'code', href: 'https://github.com' },
  { labelKey: 'socials.linkedin', icon: 'work', href: 'https://linkedin.com' },
  { labelKey: 'socials.telegram', icon: 'send', href: 'https://telegram.org' },
]

/**
 * The mobile drawer always opens from the reading direction's own edge: the
 * right under RTL, the left under LTR.
 */
const drawerSide = computed(() => (isRtl.value ? 'right' : 'left'))

async function handleNavigation(sectionId) {
  // Coming from a project page: go home first, then scroll to the section.
  if (route.path !== '/') {
    await router.push('/')
  }

  // Wait for the landing page to render before measuring its sections.
  await nextTick()
  scrollToSection(sectionId)
}

/** Closes the drawer first so the scroll is measured against the settled page. */
function handleDrawerNavigation(sectionId) {
  drawerOpen.value = false
  void handleNavigation(sectionId)
}

function scrollToSection(id) {
  if (id === 'hero') {
    window.scrollTo({ top: 0, behavior: 'smooth' })
    return
  }

  document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' })
}
</script>

<style scoped>
/* The canvas colour itself lives on <body> (app.scss); the shell only needs to
   stay transparent so the ambient glow behind it shows through. */
.app-shell {
  background: transparent;
}

.app-container {
  max-width: 1140px;
  margin: 0 auto;
  width: 100%;
}

.no-decoration {
  text-decoration: none;
}

.border-top-glass {
  border-top: 1px solid var(--app-border);
}

/* Header Glassmorphism — tint flips with the theme, blur stays constant. */
.header-glass {
  background: var(--app-chrome);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border-bottom: 1px solid var(--app-border);
}

.logo-icon-box {
  width: 34px;
  height: 34px;
  border-radius: 10px;
  background: linear-gradient(135deg, #2563eb, #6366f1);
  display: flex;
  align-items: center;
  justify-content: center;
}

.brand-title {
  line-height: 1.2;
}

.brand-subtitle {
  font-size: 0.68rem;
  letter-spacing: 0.5px;
}

/* Navigation Pills */
.nav-pill-wrapper {
  background: var(--app-pill-bg);
  padding: 4px;
  border-radius: 999px;
  border: 1px solid var(--app-pill-border);
}

.nav-tab-btn {
  font-size: 0.84rem;
  color: var(--app-text-muted);
  padding: 4px 14px;
  transition: all 0.2s ease;
}

.nav-tab-btn:hover {
  color: var(--app-text);
  background: var(--app-surface-hover);
}

.glow-cta-btn {
  box-shadow: 0 0 16px rgba(59, 130, 246, 0.35);
  font-weight: 600;
  font-size: 0.82rem;
}

/* Locale switch: same shape as the theme switch, but the label carries the
   target language code, so it stays legible in both directions. */
.locale-switch-btn {
  color: var(--app-text);
  border: 1px solid transparent;
  transition:
    color 0.22s ease,
    background 0.22s ease,
    border-color 0.22s ease,
    transform 0.22s ease;
}

.locale-switch-btn:hover {
  color: var(--app-neon);
  background: var(--app-surface-hover);
  border-color: var(--app-accent-border);
}

.locale-switch-btn:active {
  transform: scale(0.92);
}

.locale-switch-label {
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  line-height: 1;
}

/* Theme switch: a minimal round icon button that matches the header glass. */
.theme-toggle-btn {
  color: var(--app-text);
  border: 1px solid transparent;
  transition:
    color 0.22s ease,
    background 0.22s ease,
    border-color 0.22s ease,
    transform 0.22s ease;
}

.theme-toggle-btn:hover {
  color: var(--app-neon);
  background: var(--app-surface-hover);
  border-color: var(--app-accent-border);
}

.theme-toggle-btn:active {
  transform: scale(0.92);
}

/* Ghost icon button: readable in both themes without a fixed Quasar shade. */
.icon-ghost-btn {
  color: var(--app-text-muted);
  transition:
    color 0.2s ease,
    background 0.2s ease;
}

.icon-ghost-btn:hover {
  color: var(--app-text);
  background: var(--app-surface-hover);
}

/* Footer Styles */
.app-footer {
  background: var(--app-footer-bg);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
}

.footer-text-link {
  color: var(--app-text-muted);
  text-decoration: none;
  cursor: pointer;
  transition:
    color 0.2s ease,
    transform 0.2s ease;
  width: fit-content;
}

.footer-text-link:hover {
  color: var(--app-neon);
  /* Logical axis: nudges the link "outward" in either direction. */
  transform: translateX(-4px);
}

.status-dot {
  display: inline-block;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background-color: #34d399;
}

.dir-ltr {
  direction: ltr;
}

/* Mobile drawer: a solid panel in both themes (it overlays page content, so a
   translucent surface here would smear the text underneath). */
.mobile-drawer {
  background: var(--app-drawer-bg) !important;
  color: var(--app-text);
  box-shadow: var(--app-shadow);
}

/* Pin the drawer explicitly: postcss-rtlcss rewrites physical insets, so the
   logical default would put a right-side drawer on the wrong edge under RTL. */
.mobile-drawer.q-drawer--on-top,
.mobile-drawer.q-drawer--mobile {
  width: 290px;
  max-width: 86vw;
}

.mobile-drawer.q-drawer--mobile.q-drawer--right,
.mobile-drawer.q-drawer--on-top.q-drawer--right {
  inset: 0 0 0 auto;
}

.mobile-drawer.q-drawer--mobile.q-drawer--left,
.mobile-drawer.q-drawer--on-top.q-drawer--left {
  inset: 0 auto 0 0;
}

.mobile-drawer .drawer-item {
  border-radius: 10px;
  color: var(--app-text-muted);
}

.mobile-drawer .drawer-item:hover,
.mobile-drawer .drawer-item:focus-visible {
  background: var(--app-surface-hover);
  color: var(--app-text);
}

/* Drawer CTA keeps the neon gradient in both themes. `body.body--light` remaps
   `.text-white` to dark ink, so the label colour is restated with a matching
   specificity (plus the icon via `color`) instead of relying on inheritance. */
.mobile-drawer .drawer-cta,
.mobile-drawer .drawer-cta:hover {
  background: linear-gradient(120deg, var(--app-accent), var(--app-accent-2)) !important;
  color: #fff;
  box-shadow: 0 10px 26px -14px rgba(59, 130, 246, 0.9);
}

.mobile-drawer .drawer-cta .q-item__section,
.mobile-drawer .drawer-cta .q-icon {
  color: #fff !important;
}

@media (prefers-reduced-motion: reduce) {
  .locale-switch-btn:active,
  .theme-toggle-btn:active,
  .footer-text-link:hover {
    transform: none;
  }
}
</style>
