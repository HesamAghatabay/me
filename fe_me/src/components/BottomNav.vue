<template>
  <!--
    Mobile / tablet bottom navigation.

    Shown only below 1024px (the same threshold at which the desktop nav appears),
    and it slides away while scrolling down so it never covers content.
  -->
  <nav
    class="bottom-nav lt-lg"
    :class="{ 'is-hidden': chromeHidden }"
    :aria-label="t('nav.bottom_nav')"
  >
    <ul class="bottom-nav-list">
      <li v-for="item in barItems" :key="item.id" class="bottom-nav-item">
        <a
          class="bottom-nav-link"
          :class="{ 'is-active': activeSection === item.id }"
          :href="`#${item.id}`"
          :aria-current="activeSection === item.id ? 'true' : undefined"
          @click.prevent="scrollToSection(item.id)"
        >
          <span class="bottom-nav-icon">
            <q-icon :name="item.icon" size="21px" />
          </span>
          <span class="bottom-nav-label">{{ item.label }}</span>
        </a>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
import { barItems, useAutoHideChrome, useSectionNav } from '@/composables/useSectionNav'

const { t } = useI18n({ useScope: 'global' })

const { activeSection, chromeHidden, scrollToSection } = useSectionNav()

// Slides this bar away while scrolling down and restores it on scroll-up.
useAutoHideChrome()
</script>

<style scoped>
.bottom-nav {
  position: fixed;
  inset-block-end: 0;
  inset-inline: 0;
  z-index: 1100;
  padding-inline: 12px;
  /* Respect the iOS home indicator. */
  padding-block-end: max(10px, env(safe-area-inset-bottom));
  transition:
    transform 0.3s cubic-bezier(0.22, 1, 0.36, 1),
    opacity 0.3s ease;
}

.bottom-nav.is-hidden {
  transform: translateY(calc(100% + 16px));
  opacity: 0;
  pointer-events: none;
}

.bottom-nav-list {
  display: flex;
  align-items: stretch;
  justify-content: space-between;
  gap: 2px;
  max-width: 560px;
  margin-inline: auto;
  padding: 6px;
  list-style: none;
  border-radius: 22px;
  background: rgba(15, 23, 42, 0.86);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid var(--app-border-strong);
  box-shadow: 0 18px 44px -18px rgba(0, 0, 0, 0.9);
}

.bottom-nav-item {
  flex: 1 1 0;
  min-width: 0;
}

.bottom-nav-link {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 3px;
  padding: 7px 2px;
  border-radius: 16px;
  color: var(--app-text-muted);
  transition:
    color 0.22s ease,
    background 0.22s ease,
    transform 0.22s ease;
}

.bottom-nav-link:active {
  transform: scale(0.94);
}

.bottom-nav-icon {
  display: grid;
  place-items: center;
  width: 34px;
  height: 30px;
  border-radius: 11px;
  transition:
    background 0.22s ease,
    color 0.22s ease,
    box-shadow 0.22s ease;
}

.bottom-nav-label {
  font-size: 0.66rem;
  font-weight: 600;
  line-height: 1.2;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100%;
}

/* Active tab: filled accent pill around the icon, brightened label. */
.bottom-nav-link.is-active {
  color: var(--app-text);
}

.bottom-nav-link.is-active .bottom-nav-icon {
  color: #fff;
  background: linear-gradient(135deg, var(--app-accent), var(--app-accent-2));
  box-shadow: 0 8px 20px -8px rgba(59, 130, 246, 0.9);
}

@media (max-width: 380px) {
  .bottom-nav {
    padding-inline: 8px;
  }

  .bottom-nav-list {
    padding: 5px;
    border-radius: 20px;
  }

  .bottom-nav-label {
    font-size: 0.6rem;
  }

  .bottom-nav-icon {
    width: 30px;
    height: 28px;
  }
}

@media (prefers-reduced-motion: reduce) {
  .bottom-nav {
    transition: none;
  }

  .bottom-nav-link:active {
    transform: none;
  }
}
</style>
