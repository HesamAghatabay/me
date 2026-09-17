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
            <span class="text-subtitle1 text-weight-bolder text-app brand-title"
              >حسام آق آتابای</span
            >
            <span class="text-caption text-neon font-mono brand-subtitle">Full-Stack Dev</span>
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
            :label="item.label"
            @click="handleNavigation(item.id)"
          />
        </nav>

        <!-- CTA & Theme Toggle & Mobile Drawer Toggle -->
        <div class="row items-center q-gutter-sm">
          <q-btn
            unelevated
            rounded
            color="primary"
            icon-right="mail"
            label="ارتباط با من"
            class="glow-cta-btn q-px-md gt-xs"
            @click="handleNavigation('contact')"
          />

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
            :aria-label="isDark ? 'روشن کردن حالت روز' : 'فعال‌سازی حالت شب'"
            :aria-pressed="isDark ? 'true' : 'false'"
            @click="toggleTheme"
          >
            <q-tooltip>{{ isDark ? 'حالت روشن' : 'حالت شب' }}</q-tooltip>
          </q-btn>

          <!-- Mobile Hamburger Menu Button -->
          <q-btn
            flat
            round
            dense
            class="icon-ghost-btn lt-md"
            icon="menu"
            @click="drawerOpen = !drawerOpen"
            aria-label="منو"
          />
        </div>
      </q-toolbar>
    </q-header>

    <!-- Mobile Drawer Navigation -->
    <q-drawer
      v-model="drawerOpen"
      side="right"
      overlay
      behavior="mobile"
      class="mobile-drawer q-pa-md"
    >
      <div class="row items-center justify-between q-mb-xl">
        <span class="text-subtitle1 text-weight-bold text-app">منوی ناوبری</span>
        <q-btn flat round dense icon="close" class="icon-ghost-btn" @click="drawerOpen = false" />
      </div>

      <q-list class="q-gutter-y-sm">
        <q-item
          v-for="item in navLinks"
          :key="item.id"
          clickable
          v-ripple
          class="drawer-item rounded-borders"
          @click="
            handleNavigation(item.id);
            drawerOpen = false
          "
        >
          <q-item-section avatar>
            <q-icon :name="item.icon" class="text-neon" />
          </q-item-section>
          <q-item-section class="text-weight-medium">{{ item.label }}</q-item-section>
        </q-item>

        <q-item
          clickable
          v-ripple
          class="drawer-item drawer-cta rounded-borders q-mt-md"
          @click="
            handleNavigation('contact');
            drawerOpen = false
          "
        >
          <q-item-section avatar>
            <q-icon name="send" color="white" />
          </q-item-section>
          <q-item-section class="text-white text-weight-bold">شروع همکاری</q-item-section>
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
              <span class="text-h6 text-weight-bolder text-app">حسام آق آتابای</span>
            </div>
            <p class="text-body2 text-app-muted line-relaxed q-mb-md" style="max-width: 420px">
              توسعه وب‌اپلیکیشن‌های سریع، مقیاس‌پذیر و امن با تکیه بر معماری تمیز و تکنولوژی‌های روز
              دنیا.
            </p>
            <div class="row items-center text-caption text-app-dim">
              <span class="status-dot q-ml-xs"></span>
              آماده برای موقعیت‌های شغلی و پروژه‌های جدید
            </div>
          </div>

          <!-- Column 2: Quick Links -->
          <div class="col-6 col-md-3">
            <div class="text-subtitle2 text-weight-bold text-app q-mb-md">دسترسی سریع</div>
            <div class="column q-gutter-y-sm">
              <a
                v-for="link in navLinks"
                :key="link.id"
                class="footer-text-link"
                @click.prevent="handleNavigation(link.id)"
              >
                {{ link.label }}
              </a>
            </div>
          </div>

          <!-- Column 3: Direct Connect -->
          <div class="col-6 col-md-4">
            <div class="text-subtitle2 text-weight-bold text-app q-mb-md">ارتباط مستقیم</div>
            <div class="column q-gutter-y-sm text-body2 text-app-muted">
              <span class="dir-ltr text-right">hesam@example.com</span>
              <span>ایران، تهران</span>
              <div class="row q-gutter-xs q-mt-sm">
                <q-btn
                  flat
                  round
                  dense
                  icon="code"
                  class="icon-ghost-btn"
                  href="https://github.com"
                  target="_blank"
                />
                <q-btn
                  flat
                  round
                  dense
                  icon="work"
                  class="icon-ghost-btn"
                  href="https://linkedin.com"
                  target="_blank"
                />
                <q-btn
                  flat
                  round
                  dense
                  icon="send"
                  class="icon-ghost-btn"
                  href="https://telegram.org"
                  target="_blank"
                />
              </div>
            </div>
          </div>
        </div>

        <!-- Copyright Bottom Bar -->
        <div
          class="footer-bottom-bar border-top-glass q-pt-md row items-center justify-between text-caption text-app-dim"
        >
          <div>© {{ new Date().getFullYear() }} حسام آق آتابای — تمامی حقوق محفوظ است.</div>
          <div class="row items-center">
            ساخته شده با <span class="text-neon q-mx-xs">Quasar & Vue 3</span>
          </div>
        </div>
      </div>
    </footer>
  </q-layout>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useTheme } from '@/composables/useTheme'

const router = useRouter()
const route = useRoute()
const drawerOpen = ref(false)

/**
 * Theme state comes from the shared composable so the header and the boot
 * file agree on one implementation: `auto` until the visitor picks a side.
 */
const { isDark, toggleTheme } = useTheme()

const navLinks = [
  { id: 'hero', label: 'صفحه نخست', icon: 'home' },
  { id: 'about', label: 'درباره من', icon: 'person' },
  { id: 'projects', label: 'پروژه‌ها', icon: 'devices' },
  { id: 'services', label: 'خدمات', icon: 'widgets' },
  { id: 'experience', label: 'سوابق', icon: 'timeline' },
  { id: 'contact', label: 'تماس', icon: 'mail' },
]

async function handleNavigation(sectionId) {
  // اگر در صفحه‌ای غیر از صفحه اصلی بودیم
  if (route.path !== '/') {
    await router.push('/')
    // کمی مکث تا صفحه نخست مونت شود
    setTimeout(() => {
      scrollToSection(sectionId)
    }, 150)
  } else {
    scrollToSection(sectionId)
  }
}

function scrollToSection(id) {
  if (id === 'hero') {
    window.scrollTo({ top: 0, behavior: 'smooth' })
    return
  }
  const target = document.getElementById(id)
  if (target) {
    target.scrollIntoView({ behavior: 'smooth', block: 'start' })
  }
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

/* Quasar pins the drawer from the inline-end edge under RTL, which on a
   `side="right"` drawer resolves to the wrong side — pin it explicitly. */
.mobile-drawer.q-drawer--on-top,
.mobile-drawer.q-drawer--mobile {
  inset: 0 0 0 auto;
  width: 290px;
  max-width: 86vw;
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
  .theme-toggle-btn:active,
  .footer-text-link:hover {
    transform: none;
  }
}
</style>
