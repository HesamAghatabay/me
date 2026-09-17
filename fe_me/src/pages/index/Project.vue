<template>
  <q-page class="bg-transparent text-app q-px-md q-py-lg q-py-md-xl">
    <div class="app-container">
      <!-- Breadcrumb Navigation -->
      <nav class="row items-center justify-between q-mb-lg">
        <div class="row items-center text-caption text-app-muted breadcrumb-row">
          <router-link to="/" class="nav-crumb-link">خانه</router-link>
          <q-icon name="chevron_left" size="16px" class="q-mx-xs" />
          <router-link to="/#projects" class="nav-crumb-link">پروژه‌ها</router-link>
          <q-icon name="chevron_left" size="16px" class="q-mx-xs" />
          <span class="text-app-dim">{{ project.title }}</span>
        </div>

        <q-btn
          flat
          dense
          rounded
          no-caps
          icon="arrow_forward"
          label="بازگشت به خانه"
          to="/"
          class="q-px-sm link-arrow-btn"
        />
      </nav>

      <!-- Project Header Card -->
      <header class="glass-panel q-pa-lg q-pa-md-xl q-mb-xl">
        <div class="row items-center justify-between q-col-gutter-lg">
          <div class="col-12 col-md-8">
            <div class="row items-center q-gutter-sm q-mb-sm">
              <span v-if="project.is_featured" class="badge-featured">
                <q-icon name="star" size="14px" class="q-ml-xs" />
                پروژه برگزیده
              </span>
              <span class="badge-status">تکمیل‌شده</span>
            </div>

            <h1 class="text-h4 text-md-h3 text-weight-bolder text-app q-mb-sm leading-tight">
              {{ project.title }}
            </h1>
            <p class="text-body1 text-app-muted line-relaxed q-mb-md">
              {{ project.summary }}
            </p>

            <div class="row q-gutter-xs">
              <span v-for="sk in project.skills" :key="sk.id" class="skill-tag">
                <q-icon :name="sk.icon" size="15px" class="q-ml-xs text-neon" />
                {{ sk.name }}
              </span>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="column q-gutter-y-sm">
              <q-btn
                v-if="project.demo_url"
                unelevated
                rounded
                color="primary"
                icon-right="open_in_new"
                label="مشاهده دموی آنلاین"
                :href="project.demo_url"
                target="_blank"
                class="glow-button full-width q-py-sm"
              />
              <q-btn
                v-if="project.github_url"
                outline
                rounded
                icon-right="code"
                label="مشاهده سورس در گیت‌هاب"
                :href="project.github_url"
                target="_blank"
                class="full-width q-py-sm btn-muted-outline"
              />
            </div>
          </div>
        </div>
      </header>

      <!-- Cover Showcase Banner (Fixed Render) -->
      <section class="cover-container glass-panel q-mb-xl overflow-hidden">
        <div class="cover-media-box" :style="{ background: project.gradient }">
          <div class="cover-content-inner flex flex-center column text-center q-pa-lg">
            <q-icon name="devices" size="64px" color="white" class="q-mb-md" />
            <div class="text-h5 text-weight-bold text-white">{{ project.title }}</div>
            <div class="text-caption text-blue-2 q-mt-xs">معماری و توسعه فول‌استک</div>
          </div>
        </div>
      </section>

      <!-- Main Grid: Two Column Layout (Content & Sticky Sidebar) -->
      <div class="row q-col-gutter-xl items-start q-mb-xl">
        <!-- Case Study Content Column (70%) -->
        <main class="col-12 col-md-8">
          <article class="glass-panel q-pa-lg q-pa-md-xl">
            <section class="q-mb-xl">
              <h2 class="section-heading text-weight-bold text-app q-mb-md">
                <span class="heading-accent"></span>
                صورت مسئله و اهداف پروژه
              </h2>
              <div class="text-body1 text-app-muted line-relaxed">
                {{ project.summary }}
              </div>
            </section>

            <!-- Rich Content Area -->
            <section class="case-study-html line-relaxed">
              <div v-html="project.description"></div>
            </section>

            <!-- Gallery Section -->
            <section v-if="project.media && project.media.length" class="q-mt-xl">
              <h2 class="section-heading text-weight-bold text-app q-mb-lg">
                <span class="heading-accent"></span>
                تصاویر و اسکرین‌شات‌های محیط برنامه
              </h2>

              <div class="row q-col-gutter-md">
                <div v-for="(img, idx) in project.media" :key="idx" class="col-12 col-sm-6">
                  <div class="gallery-card" @click="openLightbox(img.file_path)">
                    <div class="gallery-thumb flex flex-center app-sunken">
                      <q-icon name="dashboard" size="36px" class="text-neon" />
                    </div>
                    <div class="gallery-overlay flex flex-center">
                      <q-icon name="zoom_in" size="30px" color="white" />
                    </div>
                  </div>
                  <div class="text-caption text-app-muted q-mt-xs text-center">
                    {{ img.alt_text }}
                  </div>
                </div>
              </div>
            </section>
          </article>
        </main>

        <!-- Sticky Sidebar Column (30%) -->
        <aside class="col-12 col-md-4 sticky-sidebar">
          <div class="glass-panel q-pa-lg q-mb-md">
            <h3 class="text-subtitle1 text-weight-bold text-app q-mb-md">مشخصات و متاداده</h3>

            <div class="meta-list">
              <div class="meta-row">
                <span class="meta-title">نقش در پروژه</span>
                <span class="meta-val">توسعه‌دهنده فول‌استک</span>
              </div>
              <div class="meta-row">
                <span class="meta-title">موقعیت معماری</span>
                <span class="meta-val dir-ltr">Monolith / REST API</span>
              </div>
              <div class="meta-row">
                <span class="meta-title">تکنولوژی‌های اصلی</span>
                <span class="meta-val dir-ltr">Laravel, Vue, MySQL</span>
              </div>
              <div class="meta-row">
                <span class="meta-title">دسترسی دمو</span>
                <span class="meta-val text-teal-4">{{
                  project.demo_url ? 'آنلاین' : 'خصوصی'
                }}</span>
              </div>
            </div>

            <q-separator class="q-my-md app-hairline opacity-10" />

            <div class="row items-center justify-between">
              <span class="text-caption text-app-muted">اشتراک‌گذاری:</span>
              <div class="row q-gutter-xs">
                <q-btn
                  flat
                  round
                  dense
                  icon="content_copy"
                  class="icon-ghost-btn"
                  @click="copyProjectLink"
                >
                  <q-tooltip>کپی لینک</q-tooltip>
                </q-btn>
                <q-btn flat round dense icon="share" class="icon-ghost-btn" @click="shareProject">
                  <q-tooltip>اشتراک‌گذاری</q-tooltip>
                </q-btn>
              </div>
            </div>
          </div>

          <!-- Quick CTA Card -->
          <div class="glass-panel q-pa-lg text-center cta-sidebar-card">
            <q-icon name="rocket_launch" size="32px" class="text-neon q-mb-xs" />
            <div class="text-subtitle1 text-weight-bold text-app q-mb-xs">
              پروژه‌ای مشابه دارید؟
            </div>
            <p class="text-caption text-app-muted q-mb-md">
              برای بررسی نیازمندی‌ها و تخمین زمان پیاده‌سازی گفتگو کنیم.
            </p>
            <q-btn
              unelevated
              rounded
              color="primary"
              label="درخواست همکاری"
              to="/#contact"
              class="full-width glow-button q-py-xs"
            />
          </div>
        </aside>
      </div>

      <!-- Navigation Pagination -->
      <section class="row q-col-gutter-md q-mb-xl">
        <div class="col-12 col-sm-6">
          <div
            class="nav-project-card glass-panel q-pa-md cursor-pointer"
            @click="navigateToOther('analytics-dashboard')"
          >
            <div class="text-caption text-app-muted row items-center q-mb-xs">
              <q-icon name="arrow_forward" size="14px" class="q-ml-xs" />
              پروژه قبلی
            </div>
            <div class="text-subtitle2 text-weight-bold text-app">داشبورد آنالیز و فروش</div>
          </div>
        </div>

        <div class="col-12 col-sm-6 text-left">
          <div
            class="nav-project-card glass-panel q-pa-md cursor-pointer"
            @click="navigateToOther('marketplace-app')"
          >
            <div class="text-caption text-app-muted row items-center justify-end q-mb-xs">
              پروژه بعدی
              <q-icon name="arrow_back" size="14px" class="q-mr-xs" />
            </div>
            <div class="text-subtitle2 text-weight-bold text-app text-right">
              پلتفرم چندفروشندگی آنلاین
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Lightbox Modal -->
    <q-dialog v-model="lightboxOpen">
      <q-card class="app-glass-strong app-shadow q-pa-md text-center" style="min-width: 320px">
        <q-icon name="image" size="100px" class="text-neon q-my-lg" />
        <div class="text-caption text-app-muted">پیش‌نمایش تصویر در محیط تست</div>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useQuasar } from 'quasar'

const router = useRouter()
const $q = useQuasar()

const lightboxOpen = ref(false)

function openLightbox() {
  lightboxOpen.value = true
}

function copyProjectLink() {
  navigator.clipboard?.writeText(window.location.href)
  $q.notify({ type: 'positive', message: 'لینک پروژه کپی شد.' })
}

function shareProject() {
  if (navigator.share) {
    navigator.share({ title: project.title, text: project.summary, url: window.location.href })
  } else {
    copyProjectLink()
  }
}

function navigateToOther(slug) {
  router.push(`/project/${slug}`)
}

const project = reactive({
  id: 1,
  title: 'سامانه یکپارچه مدیریت سفارشات و انبارداری',
  slug: 'order-management-system',
  summary:
    'طراحی و پیاده‌سازی پلتفرم متمرکز پردازش بلادرنگ سفارش‌ها، انبارداری هوشمند و صدور خودکار فاکتورهای مالی با قابلیت تحمل ترافیک و مقیاس‌پذیری بالا.',
  gradient: 'linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #6366f1 100%)',
  is_featured: true,
  is_published: true,
  demo_url: 'https://example.com',
  github_url: 'https://github.com/example/order-system',
  skills: [
    { id: 1, name: 'Laravel 11', icon: 'dns' },
    { id: 2, name: 'Vue.js 3', icon: 'code' },
    { id: 3, name: 'Quasar Framework', icon: 'dashboard' },
    { id: 4, name: 'MySQL', icon: 'storage' },
    { id: 5, name: 'Redis Cache', icon: 'memory' },
    { id: 6, name: 'Docker', icon: 'inventory_2' },
  ],
  description: `
    <h3>چالش‌های اصلی پروژه</h3>
    <p>در مدل قدیمی این سیستم به دلیل تجمیع کوئری‌های سنگین گزارش‌گیری بر روی دیتابیس تراکنشی و قفل شدن جداول هنگام پردازش همزمان سفارش‌ها، زمان پاسخ‌دهی سرور به شدت افت می‌کرد.</p>

    <h3>راهکار فنی و معماری پیاده‌سازی‌شده</h3>
    <ul>
      <li>تفکیک لایه گزارش‌گیری با بهره‌گیری از جاب‌های پس‌زمینه در صف‌های Redis (Laravel Queues).</li>
      <li>طراحی معماری دیتابیس نرمال‌شده همراه با ایندکس‌گذاری دقیق روی ستون‌های پرتکرار جستجو.</li>
      <li>پیاده‌سازی فرانت‌اند ماژولار و بسیار سبک با فریم‌ورک کوازار و مدیریت حالت با Pinia.</li>
    </ul>

    <h3>نتایج و دستاوردهای عددی</h3>
    <p>پس از پیاده‌سازی و ریفکتور معماری، زمان پاسخ‌دهی APIها از ۱.۸ ثانیه به کمتر از ۱۲۰ میلی‌ثانیه کاهش یافت و فرآیند ثبت و صدور اسناد انبار به شکل کاملاً آنی درآمد.</p>
  `,
  media: [
    { file_path: '', alt_text: 'داشبورد نمودارهای فروش بلادرنگ' },
    { file_path: '', alt_text: 'فرم پیشرفته مدیریت آیتم‌های فاکتور' },
  ],
})
</script>

<style scoped>
.app-container {
  max-width: 1140px;
  margin: 0 auto;
}

.line-relaxed {
  line-height: 1.9;
}

/* Glass panel: translucent slate in dark mode, frosted white in light mode.
   The doubled class outranks Quasar's own `q-card` background. */
.glass-panel.glass-panel {
  background: var(--app-surface);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border: 1px solid var(--app-border);
  border-radius: 20px;
}

.nav-crumb-link {
  color: var(--app-text-muted);
  text-decoration: none;
}

.nav-crumb-link:hover {
  color: var(--app-neon);
}

.badge-featured {
  display: inline-flex;
  align-items: center;
  background: var(--app-badge-bg);
  border: 1px solid var(--app-badge-border);
  color: var(--app-badge-ink);
  font-size: 0.75rem;
  padding: 4px 10px;
  border-radius: 999px;
  font-weight: 600;
}

.badge-status {
  display: inline-flex;
  background: rgba(20, 184, 166, 0.15);
  border: 1px solid rgba(20, 184, 166, 0.3);
  color: var(--app-teal);
  font-size: 0.75rem;
  padding: 4px 10px;
  border-radius: 999px;
}

.skill-tag {
  display: inline-flex;
  align-items: center;
  background: var(--app-pill-bg);
  border: 1px solid var(--app-pill-border);
  color: var(--app-text-muted);
  padding: 5px 12px;
  border-radius: 8px;
  font-size: 0.8rem;
}

.cover-container {
  border-radius: 20px;
}

.cover-media-box {
  width: 100%;
  min-height: 260px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.section-heading {
  font-size: 1.2rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

.heading-accent {
  width: 4px;
  height: 20px;
  background: #3b82f6;
  border-radius: 4px;
}

/* Style list items & code blocks cleanly — the case study is injected with
   `v-html`, so these need a scoped :deep() hook to reach the inner nodes. */
.case-study-html :deep(h3) {
  font-size: 1.15rem;
  font-weight: 700;
  color: var(--app-text);
  margin-top: 1.75rem;
  margin-bottom: 0.75rem;
}

.case-study-html :deep(p) {
  color: var(--app-text-muted);
  font-size: 0.95rem;
  margin-bottom: 1.2rem;
}

.case-study-html :deep(ul) {
  padding-right: 1.25rem;
  margin-bottom: 1.5rem;
  color: var(--app-text-muted);
  list-style-type: disc;
}

.case-study-html :deep(li) {
  margin-bottom: 0.6rem;
  line-height: 1.8;
}

.gallery-card {
  position: relative;
  border-radius: 14px;
  overflow: hidden;
  cursor: pointer;
  border: 1px solid var(--app-border);
}

.gallery-thumb {
  height: 140px;
}

.gallery-overlay {
  position: absolute;
  inset: 0;
  background: rgba(11, 15, 25, 0.55);
  opacity: 0;
  transition: opacity 0.25s ease;
}

.gallery-card:hover .gallery-overlay {
  opacity: 1;
}

.sticky-sidebar {
  position: sticky;
  top: 90px;
}

.meta-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.meta-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.85rem;
}

.meta-title {
  color: var(--app-text-muted);
}

.meta-val {
  color: var(--app-text);
  font-weight: 600;
}

.dir-ltr {
  direction: ltr;
}

.cta-sidebar-card {
  border: 1px dashed var(--app-accent-border);
  background: var(--app-accent-soft) !important;
}

.nav-project-card {
  transition: all 0.2s ease;
}

.nav-project-card:hover {
  border-color: var(--app-accent-border);
  transform: translateY(-2px);
}

@media (prefers-reduced-motion: reduce) {
  .nav-project-card:hover {
    transform: none;
  }
}
</style>
