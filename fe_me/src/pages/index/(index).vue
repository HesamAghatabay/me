<template>
  <q-page class="bg-transparent text-app q-px-md q-py-xl">
    <div class="app-container">
      <!-- 1. HERO SECTION RESPONSIVE -->
      <section id="hero" class="hero-section q-py-lg q-py-md-xl">
        <div class="row items-center q-col-gutter-y-xl q-col-gutter-md-xl">
          <!-- Text Column -->
          <div class="col-12 col-md-7 text-center text-md-start">
            <div class="badge-pill inline-block q-mb-md">
              <span class="status-dot"></span>
              {{ t('hero.badge') }}
            </div>

            <h1 class="hero-main-title text-weight-bolder text-app q-mb-xs">
              {{ t('hero.title_before') }}
              <span class="text-neon-blue">{{ t('hero.title_accent') }}</span>
              {{ t('hero.title_after') }}
            </h1>

            <div class="hero-sub-title text-weight-bold text-indigo-4 q-mb-md dir-ltr">
              {{ t('brand.role_long') }}
            </div>

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
          </div>

          <!-- Graphic / Avatar Column -->
          <div class="col-12 col-md-5 flex flex-center order-first order-md-last">
            <div class="hero-avatar-box">
              <div class="avatar-glow-ring"></div>
              <div class="avatar-inner-card flex flex-center">
                <q-icon name="terminal" size="64px" class="text-neon" />
                <div class="text-caption text-app-muted text-weight-medium q-mt-sm">
                  {{ t('brand.avatar_caption') }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- 2. SKILLS TICKER -->
      <section class="ticker-wrapper q-my-xl">
        <div class="ticker-scroll">
          <div v-for="skill in tickerSkills" :key="skill.id" class="ticker-pill">
            <!-- <q-icon :name="skill.icon" size="18px" class="q-ml-xs text-neon" /> -->
            <span>{{ localize(skill.name) }}</span>
          </div>
        </div>
      </section>

      <!-- 3. ABOUT & STATS -->
      <section id="about" class="q-py-xl">
        <div class="section-title-box text-center q-mb-xl">
          <div class="text-caption text-indigo-4 text-weight-bold">{{ t('about.eyebrow') }}</div>
          <h3 class="text-h4 text-weight-bold text-app q-mt-xs">{{ t('about.heading') }}</h3>
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
      <section id="projects" class="q-py-xl">
        <div class="section-title-box text-center q-mb-xl">
          <div class="text-caption text-indigo-4 text-weight-bold">{{ t('projects.eyebrow') }}</div>
          <h3 class="text-h4 text-weight-bold text-app q-mt-xs">{{ t('projects.heading') }}</h3>
        </div>

        <div class="row q-col-gutter-lg">
          <div v-for="prj in projects" :key="prj.id" class="col-12 col-sm-6 col-md-4">
            <q-card flat class="glass-card app-hover-lift project-card flex column justify-between">
              <div>
                <!-- کاور بازطراحی‌شده با فریم و انیمیشن هوور -->
                <div class="project-cover-container">
                  <q-img
                    v-if="prj.cover_image"
                    :src="prj.cover_image"
                    :alt="prj.title"
                    fit="contain"
                    class="project-cover-img"
                  >
                    <template #loading>
                      <q-spinner-dots color="primary" />
                    </template>
                  </q-img>

                  <div v-else class="project-cover-placeholder flex flex-center">
                    <q-icon name="devices" size="48px" class="text-neon" />
                  </div>

                  <!-- گرادینت روی عکس برای ترکیب رنگ با کارت -->
                  <div class="project-cover-overlay"></div>

                  <!-- نشان ویژه -->
                  <span v-if="prj.is_featured" class="featured-badge">
                    <q-icon name="star" size="13px" class="q-mr-xs text-amber" />
                    {{ t('projects.featured') }}
                  </span>
                </div>

                <div class="text-subtitle1 text-weight-bold text-app q-mb-xs">
                  {{ localize(prj.title) }}
                </div>
                <p class="text-caption text-app-muted line-clamp-3 q-mb-md">
                  {{ localize(prj.summary) }}
                </p>

                <div class="row q-gutter-xs q-mb-md">
                  <q-badge v-for="sk in prj.skills" :key="sk.id" class="tech-badge">
                    {{ localize(sk.name) }}
                  </q-badge>
                </div>
              </div>

              <div class="q-pa-md border-top-glass row items-center justify-between">
                <q-btn
                  flat
                  dense
                  no-caps
                  class="link-arrow-btn"
                  :icon-right="isRtl ? 'arrow_forward' : 'arrow_back'"
                  :label="t('actions.case_study')"
                  @click="goToProject(prj.slug)"
                />
                <div class="row q-gutter-xs">
                  <q-btn
                    v-if="prj.github_url"
                    flat
                    round
                    dense
                    icon="code"
                    class="icon-ghost-btn"
                    :href="prj.github_url"
                    target="_blank"
                  />
                  <q-btn
                    v-if="prj.demo_url"
                    flat
                    round
                    dense
                    icon="open_in_new"
                    class="icon-ghost-btn"
                    :href="prj.demo_url"
                    target="_blank"
                  />
                </div>
              </div>
            </q-card>
          </div>
        </div>
      </section>

      <!-- 5. SERVICES -->
      <section id="services" class="q-py-xl">
        <div class="section-title-box text-center q-mb-xl">
          <div class="text-caption text-indigo-4 text-weight-bold">{{ t('services.eyebrow') }}</div>
          <h3 class="text-h4 text-weight-bold text-app q-mt-xs">{{ t('services.heading') }}</h3>
        </div>

        <div class="row q-col-gutter-lg">
          <div v-for="srv in services" :key="srv.id" class="col-12 col-sm-6 col-md-4">
            <q-card flat class="glass-card app-hover-lift service-card q-pa-lg">
              <div class="service-icon-box q-mb-md">
                <q-icon :name="srv.icon" size="28px" color="white" />
              </div>
              <div class="text-subtitle1 text-weight-bold text-app q-mb-xs">
                {{ localize(srv.title) }}
              </div>
              <div class="text-caption text-app-muted line-relaxed">
                {{ localize(srv.description) }}
              </div>
            </q-card>
          </div>
        </div>
      </section>

      <!-- 6. EXPERIENCE -->
      <section id="experience" class="q-py-xl">
        <div class="section-title-box text-center q-mb-xl">
          <div class="text-caption text-indigo-4 text-weight-bold">
            {{ t('experience.eyebrow') }}
          </div>
          <h3 class="text-h4 text-weight-bold text-app q-mt-xs">{{ t('experience.heading') }}</h3>
        </div>

        <div class="max-w-timeline q-mx-auto">
          <!-- `dark` is bound so the timeline ink follows the active theme. -->
          <q-timeline color="blue-5" :dark="isDark">
            <q-timeline-entry
              v-for="exp in experiences"
              :key="exp.id"
              :title="localize(exp.role)"
              :subtitle="`${localize(exp.company)} | ${experiencePeriod(exp)}`"
            >
              <q-card flat class="glass-card q-pa-md q-mt-sm">
                <div class="text-body2 text-app-muted line-relaxed">
                  {{ localize(exp.description) }}
                </div>
              </q-card>
            </q-timeline-entry>
          </q-timeline>
        </div>
      </section>

      <!-- 7. CONTACT SECTION (MODERN GLASSMORPHISM) -->
      <section id="contact" class="q-py-xl contact-section">
        <div class="contact-ambient-glow"></div>

        <div class="section-title-box text-center q-mb-xl">
          <div class="badge-pill inline-block q-mb-xs">
            <span class="status-dot"></span>
            {{ t('contact.badge') }}
          </div>
          <h3 class="text-h4 text-weight-bolder text-app q-mt-xs">{{ t('contact.heading') }}</h3>
          <p class="text-caption text-app-muted q-mt-sm">
            {{ t('contact.intro') }}
          </p>
        </div>

        <div class="modern-contact-card glass-panel">
          <div class="row q-col-gutter-xl items-stretch">
            <!-- سمت اطلاعات ارتباطی (کارت‌های تعاملی) -->
            <div class="col-12 col-md-5 column justify-between">
              <div>
                <div class="text-subtitle1 text-weight-bold text-app q-mb-xs">
                  {{ t('contact.channels') }}
                </div>
                <p class="text-caption text-app-muted q-mb-lg">
                  {{ t('contact.channels_hint') }}
                </p>

                <div class="q-gutter-y-md">
                  <!-- ایمیل -->
                  <a href="mailto:hesam@example.com" class="contact-tile">
                    <div class="tile-icon-box bg-blue-glow">
                      <q-icon name="mail" size="20px" class="text-neon" />
                    </div>
                    <div class="tile-info">
                      <span class="tile-label">{{ t('contact.email_label') }}</span>
                      <span class="tile-val dir-ltr">hesam@example.com</span>
                    </div>
                  </a>

                  <!-- موقعیت -->
                  <div class="contact-tile">
                    <div class="tile-icon-box bg-purple-glow">
                      <q-icon name="location_on" size="20px" class="text-indigo" />
                    </div>
                    <div class="tile-info">
                      <span class="tile-label">{{ t('contact.location_label') }}</span>
                      <span class="tile-val">{{ t('contact.location_value') }}</span>
                    </div>
                  </div>

                  <!-- وضعیت کاری -->
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

              <div class="social-quick-row q-mt-xl">
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

            <!-- سمت فرم پیام -->
            <div class="col-12 col-md-7">
              <q-form @submit.prevent="submitContact" class="contact-inner-form">
                <div class="row q-col-gutter-md q-mb-md">
                  <div class="col-12 col-sm-6">
                    <q-input
                      v-model="form.name"
                      outlined
                      dense
                      :label="t('contact.form_name')"
                      :placeholder="t('contact.form_name_placeholder')"
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
                      placeholder="example@mail.com"
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
                  :placeholder="t('contact.form_subject_placeholder')"
                  class="modern-input q-mb-md"
                />

                <q-input
                  v-model="form.message"
                  outlined
                  dense
                  type="textarea"
                  rows="4"
                  :label="t('contact.form_message')"
                  :placeholder="t('contact.form_message_placeholder')"
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
    </div>
  </q-page>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { useQuasar } from 'quasar'
import { useLocale } from '@/composables/useLocale'
import { api } from '@/boot/axios'
import { useTheme } from '@/composables/useTheme'

const { isDark } = useTheme()
const router = useRouter()
const $q = useQuasar()
const { t, locale } = useI18n({ useScope: 'global' })
const { isRtl } = useLocale()

const requiredRule = (value) => !!value || t('contact.required')
// دریافت متن بر اساس زبان فعال سیستم
function localize(field) {
  if (!field) return ''
  if (typeof field === 'string') return field
  return field[locale.value] || field.fa || field.en || ''
}
const socials = [
  { labelKey: 'socials.github', icon: 'code', href: 'https://github.com' },
  { labelKey: 'socials.linkedin', icon: 'work', href: 'https://linkedin.com' },
  { labelKey: 'socials.telegram', icon: 'send', href: 'https://telegram.org' },
]

const stats = [
  { labelKey: 'stats.projects', display: '+25' },
  { labelKey: 'stats.years', display: '+4' },
  { labelKey: 'stats.satisfaction', display: '100%' },
  { labelKey: 'stats.quality', display: 'A+' },
]

const form = reactive({ name: '', email: '', subject: '', message: '' })
const isSubmitting = ref(false)

// وضعیت‌های داده از API
const tickerSkills = ref([])
const projects = ref([])
const services = ref([])
const experiences = ref([])
const loading = ref(true)

async function fetchPortfolioData() {
  loading.value = true
  api.defaults.headers.common['Accept-Language'] = locale.value

  try {
    const [skillsRes, projectsRes, servicesRes, experiencesRes] = await Promise.all([
      api.get('/skills?ticker=1'),
      api.get('/projects'),
      api.get('/services'),
      api.get('/experiences'),
    ])

    tickerSkills.value = skillsRes.data
    projects.value = projectsRes.data
    services.value = servicesRes.data
    experiences.value = experiencesRes.data
  } catch (error) {
    $q.notify({
      type: 'negative',
      message: 'خطا در برقراری ارتباط با سرور',
    })
    console.error('Error fetching portfolio data:', error)
  } finally {
    loading.value = false
  }
}

// واکنش به تغییر زبان کاربر
// watch(locale, () => {
//   fetchPortfolioData()
// })

onMounted(() => {
  fetchPortfolioData()
})

function scrollTo(id) {
  document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' })
}

function goToProject(slug) {
  router.push(`/project/${slug}`)
}

function downloadResume() {
  $q.notify({ type: 'info', message: t('contact.resume_ready') })
}

async function submitContact() {
  isSubmitting.value = true
  try {
    await api.post('/messages', form)

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
</script>

<style scoped>
.app-container {
  max-width: 1140px;
  margin: 0 auto;
}

.text-neon-blue {
  color: var(--app-neon);
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
  background-color: #34d399;
  margin-left: 6px;
}

.glow-button {
  box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
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
  background: radial-gradient(circle, rgba(59, 130, 246, 0.4), transparent 70%);
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
  background: linear-gradient(135deg, #2563eb, #4f46e5);
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
  background: var(--app-accent-soft);
}

.bg-purple-glow {
  background: rgba(139, 92, 246, 0.14);
}

.bg-teal-glow {
  background: rgba(20, 184, 166, 0.14);
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
  box-shadow: 0 12px 30px -10px rgba(59, 130, 246, 0.25);
}

.project-cover-container {
  position: relative;
  height: 200px;
  width: 100%;
  overflow: hidden;
  background: radial-gradient(
    circle at center,
    rgba(37, 99, 235, 0.08) 0%,
    rgba(15, 23, 42, 0.6) 100%
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
  background: linear-gradient(to top, rgba(15, 23, 42, 0.5) 0%, transparent 60%);
  pointer-events: none;
}

.featured-badge {
  position: absolute;
  top: 12px;
  right: 12px;
  display: flex;
  align-items: center;
  background: rgba(15, 23, 42, 0.75);
  color: #f1f5f9;
  font-size: 0.72rem;
  font-weight: 600;
  padding: 3px 10px;
  border-radius: 999px;
  border: 1px solid rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(8px);
  z-index: 2;
}

.tech-badge {
  background: var(--app-accent-soft);
  color: var(--app-accent-ink);
  border: 1px solid var(--app-accent-border);
  border-radius: 6px;
  padding: 3px 8px;
  font-size: 0.72rem;
  font-weight: 500;
}
</style>
