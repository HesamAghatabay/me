<template>
  <q-page class="landing-page bg-dark-navy text-slate-100 q-px-md q-py-xl">
    <div class="app-container">
      <!-- 1. HERO SECTION RESPONSIVE -->
      <section id="hero" class="hero-section q-py-lg q-py-md-xl">
        <div class="row items-center q-col-gutter-y-xl q-col-gutter-md-xl">
          <!-- Text Column -->
          <div class="col-12 col-md-7 text-center text-md-right">
            <div class="badge-pill inline-block q-mb-md">
              <span class="status-dot"></span>
              آماده پذیرش پروژه‌های جدید
            </div>

            <h1 class="hero-main-title text-weight-bolder text-white q-mb-xs">
              سلام، من <span class="text-neon-blue">حسام</span> هستم
            </h1>

            <div class="hero-sub-title text-weight-bold text-indigo-4 q-mb-md dir-ltr">
              Full-Stack Developer (Laravel & Vue.js)
            </div>

            <p
              class="text-body2 text-md-body1 text-grey-5 q-mb-lg line-relaxed max-w-text q-mx-auto q-mx-md-none"
            >
              متمرکز روی طراحی دیتابیس‌های بهینه، پیاده‌سازی RESTful APIهای مقیاس‌پذیر در لاراول، و
              خلق رابط‌های کاربری مدرن و واکنش‌گرا با Vue و Quasar.
            </p>

            <!-- CTA Buttons -->
            <div class="row q-gutter-sm justify-center justify-md-start q-mb-lg">
              <q-btn
                unelevated
                rounded
                color="primary"
                icon="rocket_launch"
                label="مشاهده پروژه‌ها"
                class="glow-button col-12 col-sm-auto q-px-lg q-py-sm"
                @click="scrollTo('projects')"
              />
              <q-btn
                outline
                rounded
                color="grey-4"
                icon="download"
                label="دانلود رزومه"
                class="col-12 col-sm-auto q-px-lg q-py-sm"
                @click="downloadResume"
              />
            </div>

            <!-- Socials -->
            <div class="row q-gutter-xs justify-center justify-md-start items-center">
              <q-btn
                v-for="s in socials"
                :key="s.label"
                flat
                round
                dense
                color="grey-4"
                :icon="s.icon"
                :href="s.href"
                target="_blank"
                class="social-btn"
              >
                <q-tooltip>{{ s.label }}</q-tooltip>
              </q-btn>
            </div>
          </div>

          <!-- Graphic / Avatar Column -->
          <div class="col-12 col-md-5 flex flex-center order-first order-md-last">
            <div class="hero-avatar-box">
              <div class="avatar-glow-ring"></div>
              <div class="avatar-inner-card flex flex-center">
                <q-icon name="terminal" size="64px" color="blue-4" />
                <div class="text-caption text-grey-4 text-weight-medium q-mt-sm">
                  Full-Stack Architect
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
            <q-icon :name="skill.icon" size="18px" color="blue-4" class="q-ml-xs" />
            <span>{{ skill.name }}</span>
          </div>
        </div>
      </section>

      <!-- 3. ABOUT & STATS -->
      <section id="about" class="q-py-xl">
        <div class="section-title-box text-center q-mb-xl">
          <div class="text-caption text-indigo-4 text-weight-bold">درباره من</div>
          <h3 class="text-h4 text-weight-bold text-white q-mt-xs">مهندسی نرم‌افزار و خلق محصول</h3>
        </div>

        <div class="row q-col-gutter-xl items-center q-mb-xl">
          <div class="col-12 col-md-7 text-grey-4 text-body1 line-relaxed">
            <p>
              بیش از چند سال است که به‌صورت متمرکز در حال توسعه سامانه‌های وب هستم. هدف من همیشه
              نوشتن کدی تمیز، قابل نگهداری و ارائه خروجی پایدار تحت بارهای ترافیکی بالاست.
            </p>
            <p>
              تسلط بر معماری دیتابیس، نوشتن کوئری‌های بهینه و درک دقیق از اکوسیستم فرانت‌اند و
              فریم‌ورک‌های مدرن به من اجازه می‌دهد تا ایده را از نقطه صفر به یک وب‌اپلیکیشن کاربردی
              و سریع تبدیل کنم.
            </p>
          </div>

          <div class="col-12 col-md-5">
            <div class="row q-col-gutter-md">
              <div v-for="st in stats" :key="st.label" class="col-6">
                <q-card flat class="glass-card text-center q-pa-md">
                  <div class="text-h4 text-weight-bolder text-neon-blue">{{ st.display }}</div>
                  <div class="text-caption text-grey-4 q-mt-xs">{{ st.label }}</div>
                </q-card>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 4. PROJECTS -->
      <section id="projects" class="q-py-xl">
        <div class="section-title-box text-center q-mb-xl">
          <div class="text-caption text-indigo-4 text-weight-bold">نمونه‌کارها</div>
          <h3 class="text-h4 text-weight-bold text-white q-mt-xs">پروژه‌های شاخص</h3>
        </div>

        <div class="row q-col-gutter-lg">
          <div v-for="prj in projects" :key="prj.id" class="col-12 col-sm-6 col-md-4">
            <q-card flat class="glass-card project-card flex column justify-between">
              <div>
                <div class="project-cover flex flex-center" :style="{ background: prj.gradient }">
                  <q-icon name="devices" size="40px" color="white" />
                  <span v-if="prj.is_featured" class="featured-badge">ویژه</span>
                </div>
                <div class="q-pa-md">
                  <div class="text-subtitle1 text-weight-bold text-white q-mb-xs">
                    {{ prj.title }}
                  </div>
                  <p class="text-caption text-grey-5 line-clamp-3 q-mb-md">{{ prj.summary }}</p>

                  <div class="row q-gutter-xs q-mb-md">
                    <q-badge
                      v-for="sk in prj.skills"
                      :key="sk.id"
                      color="blue-10"
                      text-color="blue-2"
                      rounded
                      class="q-px-sm"
                    >
                      {{ sk.name }}
                    </q-badge>
                  </div>
                </div>
              </div>

              <div class="q-pa-md border-top-glass row items-center justify-between">
                <q-btn
                  flat
                  dense
                  no-caps
                  color="blue-4"
                  icon-right="arrow_back"
                  label="مطالعه موردی"
                  @click="goToProject(prj.slug)"
                />
                <div class="row q-gutter-xs">
                  <q-btn
                    v-if="prj.github_url"
                    flat
                    round
                    dense
                    icon="code"
                    color="grey-4"
                    :href="prj.github_url"
                    target="_blank"
                  />
                  <q-btn
                    v-if="prj.demo_url"
                    flat
                    round
                    dense
                    icon="open_in_new"
                    color="grey-4"
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
          <div class="text-caption text-indigo-4 text-weight-bold">خدمات</div>
          <h3 class="text-h4 text-weight-bold text-white q-mt-xs">راهکارهای فنی و اجرایی</h3>
        </div>

        <div class="row q-col-gutter-lg">
          <div v-for="srv in services" :key="srv.id" class="col-12 col-sm-6 col-md-4">
            <q-card flat class="glass-card service-card q-pa-lg">
              <div class="service-icon-box q-mb-md">
                <q-icon :name="srv.icon" size="28px" color="white" />
              </div>
              <div class="text-subtitle1 text-weight-bold text-white q-mb-xs">{{ srv.title }}</div>
              <div class="text-caption text-grey-5 line-relaxed">{{ srv.description }}</div>
            </q-card>
          </div>
        </div>
      </section>

      <!-- 6. EXPERIENCE -->
      <section id="experience" class="q-py-xl">
        <div class="section-title-box text-center q-mb-xl">
          <div class="text-caption text-indigo-4 text-weight-bold">سوابق</div>
          <h3 class="text-h4 text-weight-bold text-white q-mt-xs">تجربه‌های کاری</h3>
        </div>

        <div class="max-w-timeline q-mx-auto">
          <q-timeline color="blue-5" dark>
            <q-timeline-entry
              v-for="exp in experiences"
              :key="exp.id"
              :title="exp.role"
              :subtitle="`${exp.company} | ${exp.start_date} ${exp.is_current ? 'تا اکنون' : 'تا ' + exp.end_date}`"
            >
              <q-card flat class="glass-card q-pa-md q-mt-sm">
                <div class="text-body2 text-grey-4 line-relaxed">{{ exp.description }}</div>
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
            ارتباط مستقیم
          </div>
          <h3 class="text-h4 text-weight-bolder text-white q-mt-xs">بیایید همکاری را شروع کنیم</h3>
          <p class="text-caption text-grey-5 q-mt-sm">
            ایده یا پروژه‌ای دارید؟ یک پیام کوتاه بفرستید، سریعاً پاسخ می‌دهم.
          </p>
        </div>

        <div class="modern-contact-card glass-panel">
          <div class="row q-col-gutter-xl items-stretch">
            <!-- سمت اطلاعات ارتباطی (کارت‌های تعاملی) -->
            <div class="col-12 col-md-5 column justify-between">
              <div>
                <div class="text-subtitle1 text-weight-bold text-white q-mb-xs">راه‌های تماس</div>
                <p class="text-caption text-grey-5 q-mb-lg">
                  همیشه از طریق این کانال‌ها در دسترسم:
                </p>

                <div class="q-gutter-y-md">
                  <!-- ایمیل -->
                  <a href="mailto:hesam@example.com" class="contact-tile">
                    <div class="tile-icon-box bg-blue-glow">
                      <q-icon name="mail" size="20px" color="blue-4" />
                    </div>
                    <div class="tile-info">
                      <span class="tile-label">پست الکترونیک</span>
                      <span class="tile-val dir-ltr">hesam@example.com</span>
                    </div>
                  </a>

                  <!-- موقعیت -->
                  <div class="contact-tile">
                    <div class="tile-icon-box bg-purple-glow">
                      <q-icon name="location_on" size="20px" color="indigo-4" />
                    </div>
                    <div class="tile-info">
                      <span class="tile-label">موقعیت مکانی</span>
                      <span class="tile-val">ایران، تهران (آماده همکاری ریموت)</span>
                    </div>
                  </div>

                  <!-- وضعیت کاری -->
                  <div class="contact-tile">
                    <div class="tile-icon-box bg-teal-glow">
                      <q-icon name="bolt" size="20px" color="teal-4" />
                    </div>
                    <div class="tile-info">
                      <span class="tile-label">زمان پاسخ‌گویی</span>
                      <span class="tile-val">کمتر از ۲۴ ساعت در روزهای کاری</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="social-quick-row q-mt-xl">
                <span class="text-caption text-grey-5 q-ml-sm">شبکه‌های اجتماعی:</span>
                <q-btn
                  v-for="s in socials"
                  :key="s.label"
                  flat
                  round
                  dense
                  color="grey-4"
                  :icon="s.icon"
                  :href="s.href"
                  target="_blank"
                  class="social-btn"
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
                      dark
                      outlined
                      dense
                      label="نام شما *"
                      placeholder="مثلاً علی رضایی"
                      class="modern-input"
                      :rules="[(v) => !!v || 'الزامی است']"
                    />
                  </div>
                  <div class="col-12 col-sm-6">
                    <q-input
                      v-model="form.email"
                      dark
                      outlined
                      dense
                      type="email"
                      label="آدرس ایمیل *"
                      placeholder="example@mail.com"
                      class="modern-input"
                      :rules="[(v) => !!v || 'الزامی است']"
                    />
                  </div>
                </div>

                <q-input
                  v-model="form.subject"
                  dark
                  outlined
                  dense
                  label="موضوع همکاری (اختیاری)"
                  placeholder="طراحی وب‌سایت، توسعه بک‌اند، ..."
                  class="modern-input q-mb-md"
                />

                <q-input
                  v-model="form.message"
                  dark
                  outlined
                  dense
                  type="textarea"
                  rows="4"
                  label="توضیحات پروژه یا پیام شما *"
                  placeholder="مختصری از هدف یا نیاز فنی‌تان را بنویسید..."
                  class="modern-input q-mb-lg"
                  :rules="[(v) => !!v || 'الزامی است']"
                />

                <q-btn
                  unelevated
                  rounded
                  color="primary"
                  label="ارسال پیام"
                  icon-right="send"
                  type="submit"
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
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useQuasar } from 'quasar'

const router = useRouter()
const $q = useQuasar()

const socials = [
  { label: 'GitHub', icon: 'code', href: 'https://github.com' },
  { label: 'LinkedIn', icon: 'work', href: 'https://linkedin.com' },
  { label: 'Telegram', icon: 'send', href: 'https://telegram.org' },
]

const form = reactive({ name: '', email: '', message: '' })

function scrollTo(id) {
  document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' })
}

function goToProject(slug) {
  router.push(`/project/${slug}`)
}

function downloadResume() {
  $q.notify({ type: 'info', message: 'لینک رزومه آماده دانلود شد.' })
}

function submitContact() {
  $q.notify({ type: 'positive', message: 'پیام شما دریافت شد. به‌زودی تماس می‌گیرم.' })
  form.name = ''
  form.email = ''
  form.message = ''
}

const stats = [
  { label: 'پروژه موفق', display: '+۲۵' },
  { label: 'سال سابقه کار', display: '+۴' },
  { label: 'رضایت کارفرما', display: '۱۰۰٪' },
  { label: 'کد تمیز و تست‌شده', display: 'A+' },
]

const tickerSkills = ref([
  { id: 1, name: 'Laravel', icon: 'dns' },
  { id: 2, name: 'Vue.js', icon: 'code' },
  { id: 3, name: 'Quasar', icon: 'dashboard' },
  { id: 4, name: 'MySQL', icon: 'storage' },
  { id: 5, name: 'Redis', icon: 'memory' },
  { id: 6, name: 'Tailwind CSS', icon: 'palette' },
  { id: 7, name: 'Docker', icon: 'inventory_2' },
  { id: 8, name: 'Git', icon: 'commit' },
])

const projects = ref([
  {
    id: 1,
    title: 'سامانه مدیریت سفارشات',
    slug: 'order-management',
    summary: 'پلتفرم جامع ثبت و رهگیری بلادرنگ سفارشات به همراه داشبورد تحلیلی با لاراول و ویو.',
    gradient: 'linear-gradient(135deg, #1e3a8a, #3b82f6)',
    is_featured: true,
    github_url: 'https://github.com',
    demo_url: 'https://example.com',
    skills: [
      { id: 1, name: 'Laravel' },
      { id: 2, name: 'Vue.js' },
      { id: 3, name: 'MySQL' },
    ],
  },
  {
    id: 2,
    title: 'داشبورد آنالیز و فروش',
    slug: 'analytics-dashboard',
    summary: 'رابط کاربری پیشرفته مانیتورینگ نرخ تبدیل و فروش با نمودارهای بهینه‌شده.',
    gradient: 'linear-gradient(135deg, #312e81, #6366f1)',
    is_featured: true,
    github_url: 'https://github.com',
    demo_url: null,
    skills: [
      { id: 2, name: 'Vue 3' },
      { id: 4, name: 'Tailwind' },
    ],
  },
  {
    id: 3,
    title: 'پلتفرم چندفروشندگی آنلاین',
    slug: 'marketplace-app',
    summary: 'مارکت‌پلیس با درگاه پرداخت، سیستم انبارداری و پنل مجزا برای فروشندگان.',
    gradient: 'linear-gradient(135deg, #065f46, #10b981)',
    is_featured: false,
    github_url: null,
    demo_url: 'https://example.com',
    skills: [
      { id: 1, name: 'Laravel' },
      { id: 5, name: 'Redis' },
    ],
  },
])

const services = ref([
  {
    id: 1,
    title: 'توسعه وب‌اپلیکیشن اختصاصی',
    description: 'پیاده‌سازی ماژولار از ایده تا استقرار کامل بر پایه متدهای مدرن چابک.',
    icon: 'web',
  },
  {
    id: 2,
    title: 'طراحی معماری دیتابیس و REST API',
    description: 'نوشتن APIهای فوق سریع، امن و استاندارد برای ارتباط با موبایل و وب.',
    icon: 'api',
  },
  {
    id: 3,
    title: 'بهینه‌سازی کارایی و ریفکتور',
    description: 'حل مشکل کندی کوئری‌ها، بهینه‌سازی بار سرور و پیاده‌سازی کشینگ با Redis.',
    icon: 'speed',
  },
])

const experiences = ref([
  {
    id: 1,
    role: 'توسعه‌دهنده ارشد لاراول و فرانت‌اند',
    company: 'شرکت فناوری پیشرو',
    start_date: '۱۴۰۲',
    end_date: null,
    is_current: true,
    description:
      'مدیریت و بازطراحی هسته پلتفرم، ارتقای سرعت پاسخ‌دهی سرویس‌ها و استقرار زیرساخت‌های پایدار.',
  },
  {
    id: 2,
    role: 'برنامه‌نویس فول‌استک',
    company: 'استودیو نرم‌افزار آرکا',
    start_date: '۱۴۰۰',
    end_date: '۱۴۰۲',
    is_current: false,
    description:
      'توسعه بیش از ۱۰ سامانه تحت وب، اتصال به درگاه‌های پرداخت بانکی و پیاده‌سازی فرم‌های پیچیده مالی.',
  },
])
</script>

<style scoped>
.bg-dark-navy {
  background-color: #0b0f19;
}

.app-container {
  max-width: 1140px;
  margin: 0 auto;
}

.text-neon-blue {
  color: #38bdf8;
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

.glass-card {
  background: rgba(30, 41, 59, 0.6) !important;
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
}

.border-top-glass {
  border-top: 1px solid rgba(255, 255, 255, 0.08);
}

.badge-pill {
  background: rgba(59, 130, 246, 0.12);
  border: 1px solid rgba(59, 130, 246, 0.3);
  color: #93c5fd;
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
  background: rgba(15, 23, 42, 0.8);
  border: 1px solid rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  flex-direction: column;
}

/* Ticker */
.ticker-wrapper {
  overflow: hidden;
  border-block: 1px solid rgba(255, 255, 255, 0.06);
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
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.07);
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
  background: rgba(0, 0, 0, 0.6);
  color: #fbbf24;
  font-size: 0.72rem;
  padding: 2px 8px;
  border-radius: 6px;
  border: 1px solid rgba(251, 191, 36, 0.4);
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
/* تایپوگرافی روان و بهینه برای موبایل */
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
</style>
