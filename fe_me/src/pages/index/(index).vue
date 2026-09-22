<template>
  <q-page class="bg-transparent text-app q-px-md q-py-xl">
    <main class="app-container">
      <!-- 1. HERO SECTION RESPONSIVE -->
      <section id="hero" class="hero-section q-py-lg q-py-md-xl">
        <div class="row items-center q-col-gutter-y-xl q-col-gutter-md-xl">
          <!-- Text Column -->
          <header class="col-12 col-md-7 text-center text-md-start">
            <div class="badge-pill inline-block q-mb-md">
              <span class="status-dot"></span>
              {{ t('hero.badge') }}
            </div>

            <!-- تنها H1 صفحه اصلی -->
            <h1 class="hero-main-title text-weight-bolder text-app q-mb-xs">
              {{ t('hero.title_before') }}
              <span class="text-neon-blue">{{ t('hero.title_accent') }}</span>
              {{ t('hero.title_after') }}
            </h1>

            <p class="hero-sub-title text-weight-bold text-indigo-4 q-mb-md dir-ltr">
              {{ t('brand.role_long') }}
            </p>

            <p
              class="text-body2 text-md-body1 text-app-muted q-mb-lg line-relaxed max-w-text q-mx-auto q-mx-md-none"
            >
              {{ t('hero.lead') }}
            </p>

            <!-- CTA Buttons -->
            <div class="row q-gutter-sm justify-center justify-md-start q-mb-lg">
              <q-btn
                unelevated
                rounded
                color="primary"
                icon="rocket_launch"
                :label="t('actions.view_projects')"
                class="glow-button col-12 col-sm-auto q-px-lg q-py-sm"
                @click="scrollTo('projects')"
              />
              <q-btn
                outline
                rounded
                icon="download"
                :label="t('actions.download_resume')"
                class="btn-muted-outline col-12 col-sm-auto q-px-lg q-py-sm"
                href="/HesamAghatabayResume.pdf"
                download="HesamAghatabayResume.pdf"
                target="_blank"
                @click="downloadResume"
              />
            </div>

            <!-- Socials -->
            <div class="row q-gutter-xs justify-center justify-md-start items-center">
              <q-btn
                v-for="s in socials"
                :key="s.labelKey"
                flat
                round
                dense
                :icon="s.icon"
                :href="s.href"
                target="_blank"
                class="social-btn icon-ghost-btn"
                :aria-label="t(s.labelKey)"
              >
                <q-tooltip>{{ t(s.labelKey) }}</q-tooltip>
              </q-btn>
            </div>
          </header>

          <!-- Graphic / Avatar Column -->
          <div class="col-12 col-md-5 flex flex-center order-first order-md-last">
            <div class="hero-avatar-box">
              <div class="avatar-glow-ring"></div>
              <div class="avatar-inner-card">
                <q-img
                  src="/images/me.jpg"
                  alt="Hesam Aghatabay"
                  fit="cover"
                  class="hero-inner-img full-width full-height"
                >
                  <template #loading>
                    <q-spinner-dots color="primary" />
                  </template>
                </q-img>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 2. SKILLS TICKER -->
      <section class="ticker-wrapper q-my-xl" aria-label="Skills">
        <div class="ticker-scroll">
          <div v-for="skill in tickerSkills" :key="skill.id" class="ticker-pill">
            <span>{{ localize(skill.name) }}</span>
          </div>
        </div>
      </section>

      <!-- 3. ABOUT & STATS -->
      <section id="about" class="q-py-xl" aria-labelledby="about-heading">
        <div class="section-title-box text-center q-mb-xl">
          <span class="text-caption text-indigo-4 text-weight-bold block">{{
            t('about.eyebrow')
          }}</span>
          <h2 id="about-heading" class="text-h4 text-weight-bold text-app q-mt-xs">
            {{ t('about.heading') }}
          </h2>
        </div>

        <div class="row q-col-gutter-xl items-center q-mb-xl">
          <div class="col-12 col-md-7 text-app-muted text-body1 line-relaxed">
            <p>{{ t('about.body_p1') }}</p>
            <p>{{ t('about.body_p2') }}</p>
          </div>

          <div class="col-12 col-md-5">
            <div class="row q-col-gutter-md">
              <div v-for="st in stats" :key="st.labelKey" class="col-6">
                <q-card flat class="glass-card app-hover-lift text-center q-pa-md">
                  <div class="text-h4 text-weight-bolder text-neon-blue">{{ st.display }}</div>
                  <div class="text-caption text-app-muted q-mt-xs">{{ t(st.labelKey) }}</div>
                </q-card>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 4. PROJECTS -->
      <section id="projects" class="q-py-xl" aria-labelledby="projects-heading">
        <div class="section-title-box text-center q-mb-xl">
          <span class="text-caption text-indigo-4 text-weight-bold block">{{
            t('projects.eyebrow')
          }}</span>
          <h2 id="projects-heading" class="text-h4 text-weight-bold text-app q-mt-xs">
            {{ t('projects.heading') }}
          </h2>
        </div>

        <div class="row q-col-gutter-xl">
          <div v-for="prj in projects" :key="prj.id" class="col-12 col-sm-6 col-md-4">
            <article class="glass-card app-hover-lift modern-project-card column justify-between">
              <div class="card-top-content">
                <div class="project-showcase-box">
                  <span v-if="prj.is_featured" class="showcase-badge">
                    <q-icon name="star" size="13px" class="text-amber q-mr-xs" />
                    {{ t('projects.featured') }}
                  </span>

                  <div class="project-logo-frame flex flex-center">
                    <q-img
                      v-if="prj.cover_image"
                      :src="prj.cover_image"
                      :alt="localize(prj.title)"
                      fit="contain"
                      class="project-inner-img"
                    >
                      <template #loading>
                        <q-spinner-dots color="primary" />
                      </template>
                    </q-img>

                    <q-icon v-else name="terminal" size="44px" class="text-neon" />
                  </div>
                </div>

                <div class="q-pa-lg">
                  <h3 class="text-h6 text-weight-bolder text-app q-mb-xs project-heading">
                    {{ localize(prj.title) }}
                  </h3>

                  <p class="text-body2 text-app-muted project-summary q-mb-md">
                    {{ localize(prj.summary) }}
                  </p>

                  <div class="row q-gutter-xs items-center">
                    <span v-for="sk in prj.skills" :key="sk.id" class="modern-tech-pill">
                      {{ localize(sk.name) }}
                    </span>
                  </div>
                </div>
              </div>

              <div class="card-footer-action row items-center justify-between q-px-lg q-py-md">
                <q-btn
                  flat
                  dense
                  no-caps
                  class="action-link-btn"
                  :icon-right="isRtl ? 'arrow_forward' : 'arrow_back'"
                  :label="t('actions.case_study')"
                  @click="goToProject(prj.slug)"
                />

                <div class="row q-gutter-xs items-center">
                  <q-btn
                    v-if="prj.github_url"
                    flat
                    round
                    dense
                    icon="code"
                    class="icon-ghost-btn"
                    :href="prj.github_url"
                    target="_blank"
                    :aria-label="`Source code for ${localize(prj.title)}`"
                  >
                    <q-tooltip>GitHub</q-tooltip>
                  </q-btn>

                  <q-btn
                    v-if="prj.demo_url"
                    flat
                    round
                    dense
                    icon="open_in_new"
                    class="icon-ghost-btn"
                    :href="prj.demo_url"
                    target="_blank"
                    :aria-label="`Live demo of ${localize(prj.title)}`"
                  >
                    <q-tooltip>Demo</q-tooltip>
                  </q-btn>
                </div>
              </div>
            </article>
          </div>
        </div>
      </section>

      <!-- 5. SERVICES -->
      <section id="services" class="q-py-xl" aria-labelledby="services-heading">
        <div class="section-title-box text-center q-mb-xl">
          <span class="text-caption text-indigo-4 text-weight-bold block">{{
            t('services.eyebrow')
          }}</span>
          <h2 id="services-heading" class="text-h4 text-weight-bold text-app q-mt-xs">
            {{ t('services.heading') }}
          </h2>
        </div>

        <div class="row q-col-gutter-lg">
          <div v-for="srv in services" :key="srv.id" class="col-12 col-sm-6 col-md-4">
            <article class="glass-card app-hover-lift service-card q-pa-lg">
              <div class="service-icon-box q-mb-md">
                <q-icon :name="srv.icon" size="28px" color="white" />
              </div>
              <h3 class="text-subtitle1 text-weight-bold text-app q-mb-xs">
                {{ localize(srv.title) }}
              </h3>
              <p class="text-caption text-app-muted line-relaxed q-mb-none">
                {{ localize(srv.description) }}
              </p>
            </article>
          </div>
        </div>
      </section>

      <!-- 6. EXPERIENCE -->
      <section id="experience" class="q-py-xl" aria-labelledby="experience-heading">
        <div class="section-title-box text-center q-mb-xl">
          <span class="text-caption text-indigo-4 text-weight-bold block">{{
            t('experience.eyebrow')
          }}</span>
          <h2 id="experience-heading" class="text-h4 text-weight-bold text-app q-mt-xs">
            {{ t('experience.heading') }}
          </h2>
        </div>

        <div class="max-w-timeline q-mx-auto">
          <q-timeline color="blue-5" :dark="isDark">
            <q-timeline-entry
              v-for="exp in experiences"
              :key="exp.id"
              :title="localize(exp.role)"
              :subtitle="`${localize(exp.company)} | ${experiencePeriod(exp)}`"
            >
              <div class="glass-card q-pa-md q-mt-sm">
                <p class="text-body2 text-app-muted line-relaxed q-mb-none">
                  {{ localize(exp.description) }}
                </p>
              </div>
            </q-timeline-entry>
          </q-timeline>
        </div>
      </section>

      <!-- 7. CONTACT SECTION -->
      <section id="contact" class="q-py-xl contact-section" aria-labelledby="contact-heading">
        <div class="contact-ambient-glow"></div>

        <div class="section-title-box text-center q-mb-xl">
          <div class="badge-pill inline-block q-mb-xs">
            <span class="status-dot"></span>
            {{ t('contact.badge') }}
          </div>
          <h2 id="contact-heading" class="text-h4 text-weight-bolder text-app q-mt-xs">
            {{ t('contact.heading') }}
          </h2>
          <p class="text-caption text-app-muted q-mt-sm">
            {{ t('contact.intro') }}
          </p>
        </div>

        <div class="modern-contact-card glass-panel">
          <div class="row q-col-gutter-xl items-stretch">
            <div class="col-12 col-md-5 column justify-between">
              <div>
                <h3 class="text-subtitle1 text-weight-bold text-app q-mb-xs">
                  {{ t('contact.channels') }}
                </h3>
                <p class="text-caption text-app-muted q-mb-lg">
                  {{ t('contact.channels_hint') }}
                </p>

                <div class="q-gutter-y-md">
                  <a href="mailto:hesam@example.com" class="contact-tile">
                    <div class="tile-icon-box bg-blue-glow">
                      <q-icon name="mail" size="20px" class="text-neon" />
                    </div>
                    <div class="tile-info">
                      <span class="tile-label">{{ t('contact.email_label') }}</span>
                      <span class="tile-val dir-ltr">program.h.p.2023@gmail.com</span>
                    </div>
                  </a>

                  <a href="tel:+989123456789" class="contact-tile">
                    <div class="tile-icon-box bg-purple-glow">
                      <q-icon name="phone" size="20px" class="text-indigo" />
                    </div>
                    <div class="tile-info">
                      <span class="tile-label">{{ t('contact.phone_label') }}</span>
                      <span class="tile-val dir-ltr">09398175140</span>
                    </div>
                  </a>

                  <div class="contact-tile">
                    <div class="tile-icon-box bg-teal-glow">
                      <q-icon name="bolt" size="20px" class="text-teal" />
                    </div>
                    <div class="tile-info">
                      <span class="tile-label">{{ t('contact.response_label') }}</span>
                      <span class="tile-val">{{ t('contact.response_value') }}</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="social-quick-row q-mt-md">
                <span class="text-caption text-app-muted q-ml-sm">{{ t('contact.socials') }}</span>
                <q-btn
                  v-for="s in socials"
                  :key="s.labelKey"
                  flat
                  round
                  dense
                  :icon="s.icon"
                  :href="s.href"
                  target="_blank"
                  class="social-btn icon-ghost-btn"
                  :aria-label="t(s.labelKey)"
                />
              </div>
            </div>

            <!-- فرم پیام -->
            <div class="col-12 col-md-7">
              <q-form @submit.prevent="submitContact" class="contact-inner-form">
                <div class="row q-col-gutter-md q-mb-md">
                  <div class="col-12 col-sm-6">
                    <q-input
                      v-model="form.name"
                      outlined
                      dense
                      :label="t('contact.form_name')"
                      class="modern-input"
                      :rules="[requiredRule]"
                    />
                  </div>
                  <div class="col-12 col-sm-6">
                    <q-input
                      v-model="form.email"
                      outlined
                      dense
                      type="email"
                      :label="t('contact.form_email')"
                      class="modern-input"
                      :rules="[requiredRule]"
                    />
                  </div>
                </div>

                <q-input
                  v-model="form.subject"
                  outlined
                  dense
                  :label="t('contact.form_subject')"
                  class="modern-input q-mb-md"
                />

                <q-input
                  v-model="form.message"
                  outlined
                  dense
                  type="textarea"
                  rows="4"
                  :label="t('contact.form_message')"
                  class="modern-input q-mb-lg"
                  :rules="[requiredRule]"
                />

                <q-btn
                  unelevated
                  rounded
                  color="primary"
                  :label="t('contact.form_submit')"
                  icon-right="send"
                  type="submit"
                  :loading="isSubmitting"
                  class="full-width q-py-sm glow-button submit-btn"
                />
              </q-form>
            </div>
          </div>
        </div>
      </section>
    </main>
  </q-page>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { useQuasar, useMeta } from 'quasar'
import { storeToRefs } from 'pinia'
import { useLocale } from '@/composables/useLocale'
import { useTheme } from '@/composables/useTheme'
import { usePortfolioStore } from '@/stores/portfolio'

const router = useRouter()
const $q = useQuasar()
const { t, locale } = useI18n({ useScope: 'global' })
const { isRtl } = useLocale()
const { isDark } = useTheme()

// ۱. اتصال به استور پینیا
const portfolioStore = usePortfolioStore()
const { tickerSkills, projects, services, experiences } = storeToRefs(portfolioStore)

const requiredRule = (value) => !!value || t('contact.required')

// ۲. تعریف تابع ترجمه
function localize(field) {
  if (!field) return ''
  if (typeof field === 'string') return field
  return field[locale.value] || field.fa || field.en || ''
}

const socials = [
  { labelKey: 'socials.github', icon: 'fab fa-github', href: 'https://github.com/HesamAghatabay' },
  {
    labelKey: 'socials.linkedin',
    icon: 'fab fa-linkedin',
    href: 'https://www.linkedin.com/in/hesam-aghatabay-364a712a8',
  },
  { labelKey: 'socials.telegram', icon: 'fab fa-telegram', href: 'https://t.me/Hesamaghatabay' },
]

const stats = [
  { labelKey: 'stats.projects', display: '+25' },
  { labelKey: 'stats.years', display: '+4' },
  { labelKey: 'stats.satisfaction', display: '100%' },
  { labelKey: 'stats.quality', display: 'A+' },
]

const form = reactive({ name: '', email: '', subject: '', message: '' })
const isSubmitting = ref(false)

// ۳. متاتگ‌ها و JSON-LD (اینجا تمام متغیرها مقداردهی شده‌اند)
useMeta(() => {
  const pageTitle = t('seo.title') || 'حسام آق آتابای — توسعه‌دهنده فول‌استک'
  const pageDescription = t('seo.description') || t('hero.lead')
  const siteUrl = typeof window !== 'undefined' ? window.location.origin : 'https://yolbash.ir'

  const schemaData = {
    '@context': 'https://schema.org',
    '@graph': [
      {
        '@type': 'WebSite',
        '@id': `${siteUrl}/#website`,
        url: siteUrl,
        name: pageTitle,
        description: pageDescription,
        inLanguage: locale.value,
      },
      {
        '@type': 'Person',
        '@id': `${siteUrl}/#person`,
        name: 'حسام آق آتابای',
        alternateName: 'Hesam Agh Atabay',
        jobTitle: 'Full-Stack Web Developer',
        url: siteUrl,
        sameAs: ['https://github.com', 'https://linkedin.com'],
        knowsAbout: (tickerSkills.value || []).map((s) => localize(s.name)),
      },
    ],
  }

  return {
    title: pageTitle,
    meta: {
      description: { name: 'description', content: pageDescription },
      ogTitle: { property: 'og:title', content: pageTitle },
      ogDescription: { property: 'og:description', content: pageDescription },
      ogType: { property: 'og:type', content: 'website' },
      ogUrl: { property: 'og:url', content: siteUrl },
      twitterCard: { name: 'twitter:card', content: 'summary_large_image' },
      twitterTitle: { name: 'twitter:title', content: pageTitle },
      twitterDescription: { name: 'twitter:description', content: pageDescription },
    },
    script: {
      ldJson: {
        type: 'application/ld+json',
        innerHTML: JSON.stringify(schemaData),
      },
      link: {
        canonical: {
          rel: 'canonical',
          href: siteUrl,
        },
        faAlt: {
          rel: 'alternate',
          hreflang: 'fa',
          href: `${siteUrl}?lang=fa`,
        },
        enAlt: {
          rel: 'alternate',
          hreflang: 'en',
          href: `${siteUrl}?lang=en`,
        },
        defaultAlt: {
          rel: 'alternate',
          hreflang: 'x-default',
          href: siteUrl,
        },
      },
    },
    htmlAttr: {
      lang: locale.value,
      dir: isRtl.value ? 'rtl' : 'ltr',
    },
  }
})

// ۴. دریافت داده‌ها و اکشن‌ها
onMounted(async () => {
  try {
    await portfolioStore.fetchPortfolioData()
  } catch (error) {
    $q.notify({
      type: 'negative',
      message: 'خطا در برقراری ارتباط با سرور',
    })
    console.error('Error fetching portfolio data:', error)
  }
})

function scrollTo(id) {
  document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' })
}

function goToProject(slug) {
  router.push(`/project/${slug}`)
}

async function submitContact() {
  isSubmitting.value = true
  try {
    await portfolioStore.sendMessage(form)
    $q.notify({ type: 'positive', message: t('contact.success') })
    form.name = ''
    form.email = ''
    form.subject = ''
    form.message = ''
  } catch (error) {
    const errorMsg = error.response?.data?.message || 'خطا در ارسال پیام'
    $q.notify({ type: 'negative', message: errorMsg })
  } finally {
    isSubmitting.value = false
  }
}

function experiencePeriod(exp) {
  const start = exp.start_date ? exp.start_date.split('-')[0] : ''
  const end = exp.end_date ? exp.end_date.split('-')[0] : ''

  return exp.is_current ? `${start} — ${t('experience.until_now')}` : `${start} — ${end}`
}

function downloadResume() {
  const resumeUrl = '/HesamAghatabayResume.pdf'
  const link = document.createElement('a')
  link.href = resumeUrl
  link.download = 'HesamAghatabayResume.pdf' // نام فایل دانلودی در سیستم کاربر
  document.body.appendChild(link)
  link.click()
  document.body.removeChild(link)

  $q.notify({
    type: 'positive',
    message: t('contact.resume_ready') || 'دانلود رزومه آغاز شد',
    icon: 'download_done',
  })
}
</script>

<style scoped>
.app-container {
  max-width: 1140px;
  margin: 0 auto;
}

/* Accent line inside the hero H1 and the stat figures. The class name stays as
   the template spells it; the ink is now the gold accent, not neon blue. */
.text-neon-blue {
  color: var(--app-accent-ink);
}

.max-w-text {
  max-width: 580px;
}

.max-w-timeline {
  max-width: 780px;
}

.line-relaxed {
  line-height: 1.85;
}

/* Glass cards: translucent slate in dark mode, frosted white in light mode.
   The doubled class outranks Quasar's own `q-card` background. */
.glass-card.glass-card {
  background: var(--app-surface);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid var(--app-border);
  border-radius: 16px;
}

/* Larger glass surface used by the contact block. */
.glass-panel.glass-panel {
  background: var(--app-surface);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border: 1px solid var(--app-border);
  border-radius: 20px;
}

.border-top-glass {
  border-top: 1px solid var(--app-border);
}

.badge-pill {
  background: var(--app-accent-soft);
  border: 1px solid var(--app-accent-border);
  color: var(--app-accent-ink);
  padding: 6px 14px;
  border-radius: 9999px;
  font-size: 0.8rem;
}

.status-dot {
  display: inline-block;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background-color: var(--app-positive);
  margin-left: 6px;
}

/* Compact gold CTA used for the hero and the contact submit. The gradient,
   sheen, bevel and halo all come from the shared button gold in app.scss, so
   only the geometry is owned here — that keeps every primary button on one
   "polished gold" recipe instead of two drifting versions. */
.glow-button {
  font-weight: 600;
}

/* Avatar Box */
.hero-avatar-box {
  position: relative;
  width: 240px;
  height: 240px;
}

.avatar-glow-ring {
  position: absolute;
  inset: -10px;
  border-radius: 50%;
  background: radial-gradient(circle, var(--app-gold-soft), transparent 70%);
}

.avatar-inner-card {
  width: 100%;
  height: 100%;
  border-radius: 24px;
  background: var(--app-surface-strong);
  border: 1px solid var(--app-border);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  flex-direction: column;
}

/* Ticker */
.ticker-wrapper {
  overflow: hidden;
  border-block: 1px solid var(--app-border);
  padding: 16px 0;
}

.ticker-scroll {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
  justify-content: center;
}

.ticker-pill {
  display: flex;
  align-items: center;
  gap: 6px;
  background: var(--app-pill-bg);
  border: 1px solid var(--app-pill-border);
  padding: 6px 16px;
  border-radius: 9999px;
  font-size: 0.85rem;
}

/* Projects */
.project-card {
  min-height: 400px;
  overflow: hidden;
}

.project-cover {
  position: relative;
  height: 180px;
  width: 100%;
}

.featured-badge {
  position: absolute;
  top: 10px;
  right: 10px;
  background: var(--app-badge-bg);
  color: var(--app-badge-ink);
  font-size: 0.72rem;
  padding: 2px 8px;
  border-radius: 6px;
  border: 1px solid var(--app-badge-border);
  backdrop-filter: blur(6px);
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Services */
.service-icon-box {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  /* Gold tile; the `color="white"` icon ink is restated in app.scss. */
  background: linear-gradient(135deg, var(--app-accent-3), var(--app-accent));
  display: flex;
  align-items: center;
  justify-content: center;
}
/* --- Contact block -------------------------------------------------------
   Tiles, form and ambient glow read from the same tokens as the cards, so the
   whole section flips cleanly between dark glass and frosted white. */

.contact-section {
  position: relative;
}

.contact-ambient-glow {
  position: absolute;
  inset: auto 10% 5% 10%;
  height: 320px;
  pointer-events: none;
  z-index: 0;
  background: radial-gradient(60% 60% at 50% 50%, var(--app-ambient-1), transparent 70%);
  filter: blur(20px);
}

.modern-contact-card {
  position: relative;
  z-index: 1;
  padding: clamp(20px, 4vw, 40px);
}

/* Individual channel tile — a small glass card, not a plain row. */
.contact-tile {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 14px 16px;
  border-radius: var(--app-radius-sm);
  background: var(--app-surface);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid var(--app-border);
  color: inherit;
  text-decoration: none;
  transition:
    transform 0.22s ease,
    border-color 0.22s ease,
    background 0.22s ease;
}

.contact-tile:hover {
  transform: translateY(-2px);
  border-color: var(--app-accent-border);
  background: var(--app-surface-strong);
}

.tile-icon-box {
  display: grid;
  place-items: center;
  flex: 0 0 auto;
  width: 42px;
  height: 42px;
  border-radius: 12px;
  border: 1px solid var(--app-border);
}

.bg-blue-glow {
  /* Kept as the gold channel tint: the class name is the template's, the
     colour is theme-aware so it works on ivory as well as obsidian. */
  background: var(--app-accent-soft);
}

.bg-purple-glow {
  background: var(--app-gold-soft);
}

.bg-teal-glow {
  background: var(--app-positive-soft);
}

.tile-info {
  display: flex;
  flex-direction: column;
  gap: 2px;
  min-width: 0;
}

.tile-label {
  color: var(--app-text-dim);
  font-size: 0.74rem;
}

.tile-val {
  color: var(--app-text);
  font-size: 0.9rem;
  font-weight: 600;
  overflow-wrap: anywhere;
}

.social-quick-row {
  display: flex;
  align-items: center;
  gap: 6px;
}

/* Quasar paints the field chrome itself; only the sizing and the faint
   background are ours, which keeps both themes consistent. */
.contact-inner-form .modern-input :deep(.q-field__control) {
  border-radius: 12px;
  background: var(--app-surface-sunken);
}

.contact-inner-form .modern-input :deep(.q-field__label),
.contact-inner-form .modern-input :deep(.q-field__native),
.contact-inner-form .modern-input :deep(.q-field__input) {
  color: var(--app-text);
}

.contact-inner-form .modern-input :deep(.q-field__native::placeholder),
.contact-inner-form .modern-input :deep(.q-field__input::placeholder) {
  color: var(--app-text-dim);
  opacity: 1;
}

@media (prefers-reduced-motion: reduce) {
  .contact-tile:hover {
    transform: none;
  }
}

/* --- تایپوگرافی روان و بهینه برای موبایل --- */
.hero-main-title {
  font-size: clamp(2rem, 6vw, 3.2rem);
  line-height: 1.25;
}

.hero-sub-title {
  font-size: clamp(1.05rem, 3vw, 1.4rem);
  letter-spacing: -0.01em;
}

.dir-ltr {
  direction: ltr;
  display: inline-block;
}

/* اصلاح ابعاد آواتار در موبایل */
.hero-avatar-box {
  position: relative;
  width: min(200px, 60vw);
  height: min(200px, 60vw);
}

@media (min-width: 1024px) {
  .hero-avatar-box {
    width: 260px;
    height: 260px;
  }
}
/* Projects UI Polish */
.project-card {
  min-height: 440px;
  overflow: hidden;
  transition:
    transform 0.25s ease,
    border-color 0.25s ease,
    box-shadow 0.25s ease;
}

.project-card:hover {
  border-color: var(--app-accent-border);
  box-shadow: 0 12px 30px -10px rgba(245, 158, 11, 0.28);
}

.project-cover-container {
  position: relative;
  height: 200px;
  width: 100%;
  overflow: hidden;
  background: radial-gradient(
    circle at center,
    var(--app-accent-soft) 0%,
    var(--app-surface-strong) 100%
  );
  border-bottom: 1px solid var(--app-border);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 12px;
}

.project-cover-img {
  width: 100%;
  height: 100%;
  transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
  border-radius: 8px;
}

.project-card:hover .project-cover-img {
  transform: scale(1.05);
}

.project-cover-placeholder {
  width: 100%;
  height: 100%;
}

.project-cover-overlay {
  position: absolute;
  inset: 0;
  /* Warm scrim rather than the old navy one, so it works over ivory too. */
  background: linear-gradient(to top, rgba(28, 25, 23, 0.45) 0%, transparent 60%);
  pointer-events: none;
}

/* NOTE: the `Featured` pill actually rendered by the template is
   `.showcase-badge` above; the earlier `.featured-badge` block is the tokenised
   twin kept for the legacy markup. This duplicate was a hard-coded navy pill
   that silently overrode that tokenised block, so it is removed — the crimson
   `--app-badge-*` tokens now win in both themes. */

.tech-badge {
  background: var(--app-accent-soft);
  color: var(--app-accent-ink);
  border: 1px solid var(--app-accent-border);
  border-radius: 6px;
  padding: 3px 8px;
  font-size: 0.72rem;
  font-weight: 500;
}
/* --- Modern Project Card UI ------------------------------ */
.modern-project-card {
  border-radius: 20px;
  overflow: hidden;
  border: 1px solid var(--app-border);
  background: var(--app-surface);
  transition:
    transform 0.28s cubic-bezier(0.4, 0, 0.2, 1),
    border-color 0.28s cubic-bezier(0.4, 0, 0.2, 1),
    box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1);
}

.modern-project-card:hover {
  transform: translateY(-6px);
  border-color: var(--app-accent-border);
  box-shadow: 0 16px 36px -12px rgba(245, 158, 11, 0.26);
}

/* ویترین شیب‌دار شیشه‌ای بالای کارت */
.project-showcase-box {
  position: relative;
  width: 100%;
  height: 190px;
  background: radial-gradient(
    120% 120% at 50% 10%,
    var(--app-gold-soft) 0%,
    var(--app-surface-strong) 100%
  );
  border-bottom: 1px solid var(--app-border);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px;
}

/* قاب شناور لوگو برای رفع زنندگی پس‌زمینه سفید */
.project-logo-frame {
  width: 110px;
  height: 110px;
  border-radius: 22px;
  /* The frame hosts arbitrary brand logos, so it stays a true light plate in
     both themes — but a warm ivory one, with a soft gold-tinted rim. */
  background: #fffdf9;
  padding: 10px;
  box-shadow:
    0 12px 28px -6px rgba(63, 48, 16, 0.38),
    0 0 0 1px rgba(212, 175, 55, 0.28);
  transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.modern-project-card:hover .project-logo-frame {
  transform: scale(1.08) rotate(-1.5deg);
}

.project-inner-img {
  width: 100%;
  height: 100%;
  border-radius: 12px;
}

/* نشان Featured — the limited crimson accent ("پروژه ویژه"). This is the one
   highlight in the palette that is deliberately not gold. */
.showcase-badge {
  position: absolute;
  top: 14px;
  right: 14px;
  display: inline-flex;
  align-items: center;
  background: var(--app-crimson-soft);
  color: var(--app-badge-ink-strong);
  font-size: 0.72rem;
  font-weight: 600;
  padding: 4px 11px;
  border-radius: 999px;
  border: 1px solid var(--app-crimson-border);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  z-index: 2;
}

/* تایپوگرافی کارت */
.project-heading {
  font-size: 1.18rem;
  line-height: 1.35;
  letter-spacing: -0.01em;
}

.project-summary {
  font-size: 0.88rem;
  line-height: 1.6;
  min-height: 44px;
}

/* بج‌های تگ تکنولوژی */
.modern-tech-pill {
  display: inline-block;
  background: var(--app-pill-bg);
  border: 1px solid var(--app-pill-border);
  color: var(--app-accent-ink);
  font-size: 0.74rem;
  font-weight: 500;
  padding: 3px 10px;
  border-radius: 8px;
  transition:
    background-color 0.2s ease,
    border-color 0.2s ease;
}

.modern-tech-pill:hover {
  background: var(--app-surface-hover);
  border-color: var(--app-accent-border);
}

/* فوتر و دکمه مطالعه موردی */
.card-footer-action {
  border-top: 1px solid var(--app-border);
  background: var(--app-surface-strong);
}

.action-link-btn {
  font-size: 0.86rem;
  font-weight: 600;
  color: var(--app-neon);
  padding: 4px 10px;
  border-radius: 8px;
  transition: transform 0.2s ease;
}

.action-link-btn:hover {
  transform: translateX(-3px);
}
.hero-avatar-box {
  position: relative;
  width: 280px;
  height: 280px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.avatar-inner-card {
  width: 100%;
  height: 100%;
  border-radius: 28px;
  overflow: hidden; /* بسیار مهم: برای اینکه گوشه‌های عکس بیرون نزند */
  border: 1px solid var(--app-border);
  background: var(--app-surface);
  position: relative;
  z-index: 2;
  box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
}

.hero-inner-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
