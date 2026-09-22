import { defineStore } from 'pinia'
import { ref } from 'vue'
import { api } from '@/boot/axios'

export const usePortfolioStore = defineStore('portfolio', () => {
  // State
  const tickerSkills = ref([])
  const projects = ref([])
  const services = ref([])
  const experiences = ref([])
  const currentProject = ref(null)
  const projectsCache = ref({}) // کش اختصاصی پروژه‌ها بر اساس slug: { 'yolbash': {...}, ... }
  const loading = ref(false)
  const isLoaded = ref(false)

  // Actions
  async function fetchPortfolioData(force = false) {
    if (isLoaded.value && !force) return

    loading.value = true
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
      isLoaded.value = true
    } finally {
      loading.value = false
    }
  }

  async function fetchProjectBySlug(slug, force = false) {
    // اگر پروژه از قبل فچ شده و در کش موجود است، بدون هیچ ریکوئستی آن را تحویل بده
    if (projectsCache.value[slug] && !force) {
      currentProject.value = projectsCache.value[slug]
      return currentProject.value
    }

    loading.value = true
    try {
      const res = await api.get(`/projects/${slug}`)
      // ذخیره در کش
      projectsCache.value[slug] = res.data
      currentProject.value = res.data
      return res.data
    } finally {
      loading.value = false
    }
  }

  async function sendMessage(formData) {
    return await api.post('/messages', formData)
  }

  return {
    tickerSkills,
    projects,
    services,
    experiences,
    currentProject,
    projectsCache,
    loading,
    isLoaded,
    fetchPortfolioData,
    fetchProjectBySlug,
    sendMessage,
  }
})
