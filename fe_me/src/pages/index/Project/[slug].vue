<template>
  <q-page class="bg-transparent text-app q-px-md q-py-lg q-py-md-xl">
    <div class="app-container">
      <!-- حالت لودینگ اولیه -->
      <div v-if="loading" class="flex flex-center q-py-xl" style="min-height: 50vh">
        <q-spinner-dots size="56px" color="primary" />
      </div>

      <template v-else-if="project">
        <!-- 1. مسیر و دکمه بازگشت (Breadcrumb) -->
        <nav class="row items-center justify-between q-mb-lg">
          <div class="row items-center text-caption text-app-muted breadcrumb-row">
            <router-link to="/" class="nav-crumb-link">
              {{ t('project.breadcrumb_home') }}
            </router-link>
            <q-icon :name="crumbIcon" size="16px" class="q-mx-xs" />
            <router-link to="/#projects" class="nav-crumb-link">
              {{ t('project.breadcrumb_projects') }}
            </router-link>
            <q-icon :name="crumbIcon" size="16px" class="q-mx-xs" />
            <span class="text-app-dim text-weight-medium">{{ localize(project.title) }}</span>
          </div>

          <q-btn
            flat
            dense
            rounded
            no-caps
            :icon="backIcon"
            :label="t('project.back_home')"
            to="/"
            class="q-px-sm link-arrow-btn"
          />
        </nav>

        <!-- 2. بنر شاخص شیشه‌ای (Hero Showcase) -->
        <header class="glass-panel project-hero-card q-pa-lg q-pa-md-xl q-mb-xl">
          <div class="row items-center q-col-gutter-xl">
            <!-- ستون متن و مشخصات پروژه -->
            <div class="col-12 col-md-7">
              <div class="row items-center q-gutter-sm q-mb-md">
                <span v-if="project.is_featured" class="badge-featured">
                  <q-icon name="star" size="13px" class="q-ml-xs text-amber" />
                  {{ t('projects.featured') }}
                </span>
                <span class="badge-status">
                  <span class="status-dot q-ml-xs"></span>
                  {{ t('project.status_done') }}
                </span>
              </div>

              <h1 class="text-h3 text-weight-bolder text-app q-mb-md leading-tight">
                {{ localize(project.title) }}
              </h1>

              <p class="text-body1 text-app-muted line-relaxed q-mb-lg">
                {{ localize(project.summary) }}
              </p>

              <!-- لیست تگ‌های مهارت -->
              <div class="row q-gutter-xs items-center q-mb-xl">
                <span v-for="sk in project.skills" :key="sk.id" class="modern-tech-pill">
                  {{ localize(sk.name) }}
                </span>
              </div>

              <!-- دکمه‌های اکشن اصلی -->
              <div class="row q-gutter-sm items-center">
                <q-btn
                  v-if="project.demo_url"
                  unelevated
                  rounded
                  color="primary"
                  icon-right="open_in_new"
                  :label="t('project.demo_button')"
                  :href="project.demo_url"
                  target="_blank"
                  class="glow-button q-px-xl q-py-sm"
                />

                <q-btn
                  v-if="project.github_url"
                  outline
                  rounded
                  icon-right="code"
                  :label="t('project.source_button')"
                  :href="project.github_url"
                  target="_blank"
                  class="btn-muted-outline q-px-lg q-py-sm"
                />
              </div>
            </div>

            <!-- ستون تصویر شاخص شناور -->
            <div class="col-12 col-md-5 flex flex-center">
              <div class="hero-image-frame">
                <q-img
                  v-if="primaryImage"
                  :src="primaryImage.url"
                  :alt="localize(project.title)"
                  fit="contain"
                  class="hero-inner-img cursor-pointer"
                  @click="openLightbox(primaryImageIndex)"
                >
                  <template #loading>
                    <q-spinner-dots color="primary" />
                  </template>
                </q-img>

                <div v-else class="flex flex-center full-height">
                  <q-icon name="terminal" size="80px" class="text-neon" />
                </div>
              </div>
            </div>
          </div>
        </header>

        <!-- 3. بدنه اصلی (مطالعه موردی فنی + نوار کناری مشخصات) -->
        <div class="row q-col-gutter-xl items-start q-mb-xl">
          <!-- ستون مطالعه موردی فنی (Case Study Body) -->
          <main class="col-12 col-md-8">
            <article class="glass-panel q-pa-lg q-pa-md-xl">
              <div class="section-title-row q-mb-lg">
                <div class="heading-accent"></div>
                <h2 class="text-h5 text-weight-bold text-app q-my-none">
                  {{ t('actions.case_study') }}
                </h2>
              </div>

              <!-- محتوای HTML چندزبانه که در دیتابیس ثبت شده -->
              <div
                class="case-study-html line-relaxed"
                v-html="localize(project.description)"
              ></div>
            </article>
          </main>

          <!-- سایدبار چسبان مشخصات واقعی و اشتراک‌گذاری -->
          <aside class="col-12 col-md-4 sticky-sidebar">
            <div class="glass-panel q-pa-lg q-mb-md">
              <h3 class="text-subtitle1 text-weight-bold text-app q-mb-md">
                {{ t('project.meta_heading') }}
              </h3>

              <div class="meta-list">
                <div class="meta-row">
                  <span class="meta-title">{{ t('project.meta_demo') }}</span>
                  <span
                    class="meta-val"
                    :class="project.demo_url ? 'text-teal-4' : 'text-app-muted'"
                  >
                    {{
                      t(project.demo_url ? 'project.meta_demo_online' : 'project.meta_demo_private')
                    }}
                  </span>
                </div>

                <div class="meta-row">
                  <span class="meta-title">GitHub</span>
                  <span
                    class="meta-val"
                    :class="project.github_url ? 'text-indigo-3' : 'text-app-muted'"
                  >
                    {{
                      project.github_url
                        ? t('project.source_button')
                        : t('project.meta_demo_private')
                    }}
                  </span>
                </div>

                <div class="meta-row">
                  <span class="meta-title">{{ t('skills.heading') || 'تکنولوژی‌ها' }}</span>
                  <span class="meta-val">{{ project.skills?.length || 0 }} مورد</span>
                </div>
              </div>

              <q-separator class="q-my-md app-hairline opacity-10" />

              <!-- اشتراک گذاری -->
              <div class="row items-center justify-between">
                <span class="text-caption text-app-muted">{{ t('project.share') }}</span>
                <div class="row q-gutter-xs">
                  <q-btn
                    flat
                    round
                    dense
                    icon="content_copy"
                    class="icon-ghost-btn"
                    :aria-label="t('project.share_copy')"
                    @click="copyProjectLink"
                  >
                    <q-tooltip>{{ t('project.share_copy') }}</q-tooltip>
                  </q-btn>
                  <q-btn
                    flat
                    round
                    dense
                    icon="share"
                    class="icon-ghost-btn"
                    :aria-label="t('project.share_action')"
                    @click="shareProject"
                  >
                    <q-tooltip>{{ t('project.share_action') }}</q-tooltip>
                  </q-btn>
                </div>
              </div>
            </div>

            <!-- کارت شروع همکاری -->
            <div class="glass-panel q-pa-lg text-center cta-sidebar-card">
              <q-icon name="rocket_launch" size="32px" class="text-neon q-mb-xs" />
              <div class="text-subtitle1 text-weight-bold text-app q-mb-xs">
                {{ t('project.cta_title') }}
              </div>
              <p class="text-caption text-app-muted q-mb-md">
                {{ t('project.cta_body') }}
              </p>
              <q-btn
                unelevated
                rounded
                color="primary"
                :label="t('project.cta_button')"
                to="/#contact"
                class="full-width glow-button q-py-xs"
              />
            </div>
          </aside>
        </div>

        <!-- 4. سکشن تمام‌عرض گالری تصاویر محیط نرم‌افزار -->
        <section v-if="project.gallery && project.gallery.length" class="gallery-section q-mb-xl">
          <div class="glass-panel q-pa-lg q-pa-md-xl">
            <div class="row items-center justify-between q-mb-lg">
              <div class="section-title-row">
                <div class="heading-accent"></div>
                <div>
                  <h3 class="text-h5 text-weight-bold text-app q-my-none">
                    {{ t('project.gallery_heading') || 'گالری و محیط اپلیکیشن' }}
                  </h3>
                  <span class="text-caption text-app-muted q-mt-xs block">
                    برای مشاهده در ابعاد بزرگ روی تصاویر کلیک کنید
                  </span>
                </div>
              </div>

              <div class="badge-pill inline-block">{{ project.gallery.length }} تصویر</div>
            </div>

            <!-- اصلاح ردیف گرید ۳ ستونه تصاویر -->
            <div class="row q-col-gutter-lg">
              <div
                v-for="(img, index) in project.gallery"
                :key="img.id"
                class="col-12 col-sm-6 col-md-4"
              >
                <div class="modern-gallery-card cursor-pointer" @click="openLightbox(index)">
                  <div class="gallery-img-wrapper">
                    <q-img
                      :src="img.url"
                      :alt="localize(img.alt_text)"
                      class="gallery-image"
                      fit="cover"
                    >
                      <template #loading>
                        <q-spinner-dots color="primary" />
                      </template>
                    </q-img>

                    <div class="gallery-hover-veil flex flex-center">
                      <div class="zoom-icon-circle flex flex-center">
                        <q-icon name="zoom_in" size="26px" color="white" />
                      </div>
                    </div>

                    <span v-if="img.is_primary" class="primary-badge">شاخص</span>
                  </div>

                  <div
                    v-if="img.alt_text"
                    class="q-pa-sm text-center text-caption text-app-muted text-weight-medium ellipsis"
                  >
                    {{ localize(img.alt_text) }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </template>
    </div>

    <!-- مودال لایت‌باکس مجهز به ناوبری قبلی / بعدی -->
    <q-dialog v-model="lightboxOpen" backdrop-filter="blur(10px)" @keydown="handleKeydown">
      <div class="lightbox-wrapper column items-center justify-center">
        <!-- نوار هدر لایت‌باکس: شمارنده عکس و دکمه بستن -->
        <div class="row items-center justify-between full-width q-mb-sm q-px-xs">
          <div class="lightbox-counter-badge">
            {{ activeLightboxIndex + 1 }} / {{ project.gallery.length }}
          </div>
          <q-btn flat round dense color="white" icon="close" class="bg-dark-glass" v-close-popup />
        </div>

        <!-- بدنه اسلایدر با دکمه‌های شناور چپ و راست -->
        <div class="lightbox-stage full-width row items-center justify-between no-wrap">
          <!-- دکمه قبلی -->
          <q-btn
            flat
            round
            dense
            icon="chevron_right"
            size="18px"
            class="lightbox-nav-btn nav-prev"
            :disable="project.gallery.length <= 1"
            @click.stop="prevImage"
          />

          <!-- فریم تصویر نمایش داده شده -->
          <div class="lightbox-img-card flex flex-center">
            <transition name="fade-slide" mode="out-in">
              <q-img
                :key="currentLightboxImage?.url"
                :src="currentLightboxImage?.url"
                fit="contain"
                class="full-width full-height"
                spinner-color="primary"
              />
            </transition>
          </div>

          <!-- دکمه بعدی -->
          <q-btn
            flat
            round
            dense
            icon="chevron_left"
            size="18px"
            class="lightbox-nav-btn nav-next"
            :disable="project.gallery.length <= 1"
            @click.stop="nextImage"
          />
        </div>

        <!-- کپشن و عنوان عکس فعال -->
        <div
          v-if="currentLightboxImage?.alt_text"
          class="text-caption text-app-muted q-mt-sm text-center"
        >
          {{ localize(currentLightboxImage.alt_text) }}
        </div>
      </div>
    </q-dialog>
  </q-page>
</template>

<script setup>
import { computed, ref, onMounted, watch } from 'vue'
import { useRoute } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { useQuasar } from 'quasar'
import { storeToRefs } from 'pinia'
import { useLocale } from '@/composables/useLocale'
import { usePortfolioStore } from '@/stores/portfolio'

const route = useRoute()
const $q = useQuasar()
const { t, locale } = useI18n({ useScope: 'global' })
const { isRtl } = useLocale()

// اتصال به استور
const portfolioStore = usePortfolioStore()
const { currentProject: project, loading } = storeToRefs(portfolioStore)

const lightboxOpen = ref(false)
const activeLightboxIndex = ref(0)

const crumbIcon = computed(() => (isRtl.value ? 'chevron_left' : 'chevron_right'))
const backIcon = computed(() => (isRtl.value ? 'arrow_forward' : 'arrow_back'))

function localize(field) {
  if (!field) return ''
  if (typeof field === 'string') return field
  return field[locale.value] || field.fa || field.en || ''
}

const primaryImageIndex = computed(() => {
  if (!project.value?.gallery?.length) return 0
  const index = project.value.gallery.findIndex((img) => img.is_primary)
  return index !== -1 ? index : 0
})

const primaryImage = computed(() => {
  if (!project.value?.gallery?.length) return null
  return project.value.gallery[primaryImageIndex.value]
})

const currentLightboxImage = computed(() => {
  if (!project.value?.gallery?.length) return null
  return project.value.gallery[activeLightboxIndex.value]
})

async function loadProjectData() {
  const slug = route.params.slug
  try {
    await portfolioStore.fetchProjectBySlug(slug)
  } catch (error) {
    $q.notify({
      type: 'negative',
      message: 'پروژه مورد نظر یافت نشد',
    })
    console.error('Error fetching project data:', error)
  }
}

watch(
  () => route.params.slug,
  () => {
    loadProjectData()
  },
)

onMounted(() => {
  loadProjectData()
})

function openLightbox(index) {
  activeLightboxIndex.value = typeof index === 'number' ? index : 0
  lightboxOpen.value = true
}

function nextImage() {
  if (!project.value?.gallery?.length) return
  if (activeLightboxIndex.value < project.value.gallery.length - 1) {
    activeLightboxIndex.value++
  } else {
    activeLightboxIndex.value = 0
  }
}

function prevImage() {
  if (!project.value?.gallery?.length) return
  if (activeLightboxIndex.value > 0) {
    activeLightboxIndex.value--
  } else {
    activeLightboxIndex.value = project.value.gallery.length - 1
  }
}

function handleKeydown(e) {
  if (!lightboxOpen.value) return
  if (e.key === 'ArrowRight') {
    isRtl.value ? nextImage() : prevImage()
  } else if (e.key === 'ArrowLeft') {
    isRtl.value ? prevImage() : nextImage()
  }
}

function copyProjectLink() {
  navigator.clipboard?.writeText(window.location.href)
  $q.notify({ type: 'positive', message: t('project.link_copied') })
}

function shareProject() {
  if (navigator.share) {
    navigator.share({
      title: localize(project.value.title),
      text: localize(project.value.summary),
      url: window.location.href,
    })
  } else {
    copyProjectLink()
  }
}
</script>

<style scoped>
.app-container {
  max-width: 1140px;
  margin: 0 auto;
}

.line-relaxed {
  line-height: 1.9;
}

.glass-panel.glass-panel {
  background: var(--app-surface);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border: 1px solid var(--app-border);
  border-radius: 20px;
}

.project-hero-card {
  position: relative;
  overflow: hidden;
}

.hero-image-frame {
  width: 220px;
  height: 220px;
  border-radius: 32px;
  background: #ffffff;
  padding: 18px;
  box-shadow:
    0 20px 45px -10px rgba(0, 0, 0, 0.45),
    0 0 0 1px rgba(255, 255, 255, 0.25);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.hero-image-frame:hover {
  transform: scale(1.05) rotate(-1deg);
}

.hero-inner-img {
  width: 100%;
  height: 100%;
  border-radius: 18px;
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
  background: rgba(15, 23, 42, 0.78);
  border: 1px solid rgba(255, 255, 255, 0.14);
  color: #f8fafc;
  font-size: 0.75rem;
  padding: 4px 12px;
  border-radius: 999px;
  font-weight: 600;
}

.badge-status {
  display: inline-flex;
  align-items: center;
  background: rgba(20, 184, 166, 0.15);
  border: 1px solid rgba(20, 184, 166, 0.3);
  color: var(--app-teal);
  font-size: 0.75rem;
  padding: 4px 12px;
  border-radius: 999px;
}

.status-dot {
  display: inline-block;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background-color: #34d399;
}

.modern-tech-pill {
  display: inline-block;
  background: var(--app-pill-bg);
  border: 1px solid var(--app-pill-border);
  color: var(--app-accent-ink);
  font-size: 0.78rem;
  font-weight: 500;
  padding: 4px 12px;
  border-radius: 8px;
}

.section-title-row {
  display: flex;
  align-items: center;
  gap: 12px;
}

.heading-accent {
  width: 4px;
  height: 22px;
  background: #3b82f6;
  border-radius: 4px;
}

.case-study-html :deep(h3) {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--app-text);
  margin-top: 2rem;
  margin-bottom: 0.85rem;
}

.case-study-html :deep(p) {
  color: var(--app-text-muted);
  font-size: 1rem;
  margin-bottom: 1.25rem;
}

.case-study-html :deep(ul) {
  padding-inline-start: 1.5rem;
  margin-bottom: 1.5rem;
  color: var(--app-text-muted);
  list-style-type: disc;
}

.case-study-html :deep(li) {
  margin-bottom: 0.6rem;
  line-height: 1.85;
}

.sticky-sidebar {
  position: sticky;
  top: 90px;
}

.meta-list {
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.meta-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.88rem;
}

.meta-title {
  color: var(--app-text-muted);
}

.meta-val {
  color: var(--app-text);
  font-weight: 600;
}

.cta-sidebar-card {
  border: 1px dashed var(--app-accent-border);
  background: var(--app-accent-soft) !important;
}

/* Gallery Component Styles */
.modern-gallery-card {
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid var(--app-border);
  background: var(--app-surface-strong);
  cursor: pointer;
  transition:
    transform 0.25s ease,
    border-color 0.25s ease,
    box-shadow 0.25s ease;
}

.modern-gallery-card:hover {
  transform: translateY(-4px);
  border-color: var(--app-accent-border);
  box-shadow: 0 14px 28px -10px rgba(59, 130, 246, 0.28);
}

.gallery-img-wrapper {
  position: relative;
  width: 100%;
  height: 220px;
  overflow: hidden;
}

.gallery-image {
  width: 100%;
  height: 100%;
  transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.modern-gallery-card:hover .gallery-image {
  transform: scale(1.06);
}

.gallery-hover-veil {
  position: absolute;
  inset: 0;
  background: rgba(11, 15, 25, 0.5);
  backdrop-filter: blur(2px);
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.25s ease;
}

.modern-gallery-card:hover .gallery-hover-veil {
  opacity: 1;
}

.zoom-icon-circle {
  width: 46px;
  height: 46px;
  border-radius: 50%;
  background: var(--app-neon);
  box-shadow: 0 0 20px rgba(59, 130, 246, 0.6);
}

.primary-badge {
  position: absolute;
  top: 10px;
  left: 10px;
  background: rgba(15, 23, 42, 0.8);
  color: #38bdf8;
  font-size: 0.7rem;
  font-weight: 600;
  padding: 2px 8px;
  border-radius: 6px;
  border: 1px solid rgba(56, 189, 248, 0.3);
  backdrop-filter: blur(6px);
}

.badge-pill {
  background: var(--app-accent-soft);
  border: 1px solid var(--app-accent-border);
  color: var(--app-accent-ink);
  padding: 4px 12px;
  border-radius: 9999px;
  font-size: 0.78rem;
  font-weight: 600;
}

/* Lightbox Modal Styles */
.lightbox-wrapper {
  width: 95vw;
  max-width: 1200px;
}

.lightbox-stage {
  position: relative;
  gap: 16px;
}

.lightbox-img-card {
  flex: 1;
  height: 78vh;
  border-radius: 20px;
  overflow: hidden;
  background: rgba(15, 23, 42, 0.94);
  border: 1px solid rgba(255, 255, 255, 0.14);
  box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.85);
  padding: 14px;
}

.lightbox-counter-badge {
  background: rgba(15, 23, 42, 0.75);
  border: 1px solid rgba(255, 255, 255, 0.15);
  color: #94a3b8;
  font-size: 0.8rem;
  font-weight: 600;
  padding: 4px 12px;
  border-radius: 999px;
  backdrop-filter: blur(6px);
}

.lightbox-nav-btn {
  background: rgba(15, 23, 42, 0.75) !important;
  color: #ffffff !important;
  border: 1px solid rgba(255, 255, 255, 0.18);
  backdrop-filter: blur(8px);
  width: 46px;
  height: 46px;
  transition:
    transform 0.2s ease,
    background 0.2s ease,
    border-color 0.2s ease;
  flex-shrink: 0;
}

.lightbox-nav-btn:hover:not(:disabled) {
  transform: scale(1.1);
  background: var(--app-neon) !important;
  border-color: var(--app-neon);
}

.bg-dark-glass {
  background: rgba(15, 23, 42, 0.75) !important;
  border: 1px solid rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(6px);
}

.fade-slide-enter-active,
.fade-slide-leave-active {
  transition:
    opacity 0.22s ease,
    transform 0.22s ease;
}

.fade-slide-enter-from {
  opacity: 0;
  transform: scale(0.97);
}

.fade-slide-leave-to {
  opacity: 0;
  transform: scale(1.03);
}
</style>
