<template>
  <q-layout view="lHh Lpr lFf" class="bg-dark-navy text-slate-100">

    <!-- Sticky Glass Header -->
    <q-header elevated class="header-glass q-py-xs">
      <q-toolbar class="app-container justify-between">

        <!-- Logo / Brand -->
        <router-link to="/" class="row items-center brand-link no-decoration">
          <div class="logo-icon-box q-mr-sm">
            <q-icon name="terminal" size="20px" color="white" />
          </div>
          <div class="column">
            <span class="text-subtitle1 text-weight-bolder text-white brand-title">حسام آق آتابای</span>
            <span class="text-caption text-blue-4 font-mono brand-subtitle">Full-Stack Dev</span>
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

        <!-- CTA & Mobile Drawer Toggle -->
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

          <!-- Mobile Hamburger Menu Button -->
          <q-btn
            flat
            round
            dense
            color="grey-4"
            icon="menu"
            class="lt-md"
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
      class="mobile-drawer bg-slate-900 text-white q-pa-md"
    >
      <div class="row items-center justify-between q-mb-xl">
        <span class="text-subtitle1 text-weight-bold">منوی ناوبری</span>
        <q-btn flat round dense icon="close" color="grey-4" @click="drawerOpen = false" />
      </div>

      <q-list class="q-gutter-y-sm">
        <q-item
          v-for="item in navLinks"
          :key="item.id"
          clickable
          v-ripple
          class="drawer-item rounded-borders"
          @click="handleNavigation(item.id); drawerOpen = false"
        >
          <q-item-section avatar>
            <q-icon :name="item.icon" color="blue-4" />
          </q-item-section>
          <q-item-section class="text-weight-medium">{{ item.label }}</q-item-section>
        </q-item>

        <q-item
          clickable
          v-ripple
          class="drawer-item rounded-borders bg-blue-10 q-mt-md"
          @click="handleNavigation('contact'); drawerOpen = false"
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

    <!-- Modern Dark Footer -->
    <footer class="app-footer border-top-glass q-pt-xl q-pb-lg">
      <div class="app-container q-px-md">
        <div class="row q-col-gutter-xl items-start justify-between q-mb-xl">

          <!-- Column 1: Info & Vision -->
          <div class="col-12 col-md-5">
            <div class="row items-center brand-link q-mb-md">
              <div class="logo-icon-box q-mr-sm">
                <q-icon name="terminal" size="20px" color="white" />
              </div>
              <span class="text-h6 text-weight-bolder text-white">حسام آق آتابای</span>
            </div>
            <p class="text-body2 text-grey-5 line-relaxed q-mb-md" style="max-width: 420px;">
              توسعه وب‌اپلیکیشن‌های سریع، مقیاس‌پذیر و امن با تکیه بر معماری تمیز و تکنولوژی‌های روز دنیا.
            </p>
            <div class="row items-center text-caption text-grey-4">
              <span class="status-dot q-ml-xs"></span>
              آماده برای موقعیت‌های شغلی و پروژه‌های جدید
            </div>
          </div>

          <!-- Column 2: Quick Links -->
          <div class="col-6 col-md-3">
            <div class="text-subtitle2 text-weight-bold text-white q-mb-md">دسترسی سریع</div>
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
            <div class="text-subtitle2 text-weight-bold text-white q-mb-md">ارتباط مستقیم</div>
            <div class="column q-gutter-y-sm text-body2 text-grey-4">
              <span class="dir-ltr text-right">hesam@example.com</span>
              <span>ایران، تهران</span>
              <div class="row q-gutter-xs q-mt-sm">
                <q-btn flat round dense icon="code" color="grey-4" href="https://github.com" target="_blank" />
                <q-btn flat round dense icon="work" color="grey-4" href="https://linkedin.com" target="_blank" />
                <q-btn flat round dense icon="send" color="grey-4" href="https://telegram.org" target="_blank" />
              </div>
            </div>
          </div>

        </div>

        <!-- Copyright Bottom Bar -->
        <div class="footer-bottom-bar border-top-glass q-pt-md row items-center justify-between text-caption text-grey-6">
          <div>© {{ new Date().getFullYear() }} حسام آق آتابای — تمامی حقوق محفوظ است.</div>
          <div class="row items-center">
            ساخته شده با <span class="text-blue-4 q-mx-xs">Quasar & Vue 3</span>
          </div>
        </div>
      </div>
    </footer>

  </q-layout>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'

const router = useRouter()
const route = useRoute()
const drawerOpen = ref(false)

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
.bg-dark-navy {
  background-color: #0b0f19;
}

.bg-slate-900 {
  background-color: #0f172a;
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
  border-top: 1px solid rgba(255, 255, 255, 0.08);
}

/* Header Glassmorphism */
.header-glass {
  background: rgba(11, 15, 25, 0.8) !important;
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
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
  background: rgba(255, 255, 255, 0.03);
  padding: 4px;
  border-radius: 999px;
  border: 1px solid rgba(255, 255, 255, 0.06);
}

.nav-tab-btn {
  font-size: 0.84rem;
  color: #94a3b8;
  padding: 4px 14px;
  transition: all 0.2s ease;
}

.nav-tab-btn:hover {
  color: #ffffff;
  background: rgba(255, 255, 255, 0.06);
}

.glow-cta-btn {
  box-shadow: 0 0 16px rgba(59, 130, 246, 0.35);
  font-weight: 600;
  font-size: 0.82rem;
}

/* Footer Styles */
.app-footer {
  background: rgba(8, 11, 20, 0.95);
}

.footer-text-link {
  color: #94a3b8;
  text-decoration: none;
  cursor: pointer;
  transition: color 0.2s ease, transform 0.2s ease;
  width: fit-content;
}

.footer-text-link:hover {
  color: #38bdf8;
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

.drawer-item {
  border-radius: 10px;
  color: #cbd5e1;
}
</style>
