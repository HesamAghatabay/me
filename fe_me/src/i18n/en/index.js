/**
 * English dictionary.
 *
 * Keys are grouped by the section of the site that owns them. `fa/index.js`
 * must expose exactly the same shape: add a key to both files or to neither,
 * otherwise a locale silently falls back to the key name at runtime.
 *
 * `brand.*` and `seo.*` carry the Latin spelling used for SEO and link
 * previews, which is why they differ from the Persian dictionary.
 */
export default {
  // --- Identity & metadata -------------------------------------------------
  brand: {
    name: 'Hesam Aghatabay',
    role: 'Full-Stack Dev',
    role_long: 'Full-Stack Developer (Laravel & Vue.js)',
    avatar_caption: 'Full-Stack Web Architect',
  },

  seo: {
    title: 'Hesam Aghatabay — Full-Stack Developer',
    description:
      'Portfolio, skills and work history of Hesam Aghatabay — full-stack developer building fast, scalable and secure web applications with Laravel and Vue.js.',
  },

  // --- Shared chrome -------------------------------------------------------
  nav: {
    menu: 'Navigation menu',
    bottom_nav: 'Bottom navigation',
    open_menu: 'Menu',
    home: 'Home',
    about: 'About',
    projects: 'Projects',
    services: 'Services',
    experience: 'Experience',
    contact: 'Contact',
  },

  actions: {
    contact_me: 'Get in touch',
    start_collaboration: 'Start a collaboration',
    view_projects: 'View projects',
    download_resume: 'Download résumé',
    case_study: 'Read case study',
  },

  theme: {
    to_dark: 'Enable dark mode',
    to_light: 'Switch to light mode',
    dark: 'Dark mode',
    light: 'Light mode',
    switch_language: 'Switch language',
  },

  footer: {
    tagline:
      'Building fast, scalable and secure web applications on clean architecture and up-to-date tooling.',
    available: 'Open to new roles and projects',
    quick_links: 'Quick links',
    direct_contact: 'Direct contact',
    location: 'Tehran, Iran',
    rights: '© {year} Hesam Aghatabay — All rights reserved.',
    built_with: 'Built with',
  },

  // --- Landing page --------------------------------------------------------
  hero: {
    badge: 'Available for new projects',
    title_before: "Hi, I'm",
    title_accent: 'Hesam',
    title_after: '',
    lead: 'Focused on designing efficient database schemas, building scalable RESTful APIs with Laravel, and crafting modern, responsive interfaces with Vue and Quasar.',
  },

  about: {
    eyebrow: 'About me',
    heading: 'Software engineering and product craft',
    body_p1:
      'I have spent years building web systems with a single goal: writing clean, maintainable code that keeps performing under heavy traffic.',
    body_p2:
      'A solid grasp of database architecture, efficient query writing and a close read of the modern front-end ecosystem let me take an idea from zero to a fast, production-ready web application.',
  },

  stats: {
    projects: 'Successful projects',
    years: 'Years of experience',
    satisfaction: 'Client satisfaction',
    quality: 'Clean, tested code',
  },

  projects: {
    eyebrow: 'Portfolio',
    heading: 'Selected projects',
    featured: 'Featured',
    order_title: 'Order management system',
    order_summary:
      'An end-to-end platform for recording and tracking orders in real time, paired with an analytics dashboard built on Laravel and Vue.',
    analytics_title: 'Analytics & sales dashboard',
    analytics_summary:
      'An advanced interface for monitoring conversion and sales metrics with optimised, high-performance charts.',
    marketplace_title: 'Multi-vendor marketplace platform',
    marketplace_summary:
      'A marketplace with a payment gateway, inventory management and a dedicated panel for each vendor.',
  },

  services: {
    eyebrow: 'Services',
    heading: 'Technical and delivery solutions',
    web_title: 'Custom web application development',
    web_description:
      'Modular implementation from idea to full deployment, following modern agile practice.',
    api_title: 'Database architecture & REST API design',
    api_description:
      'Fast, secure and standards-compliant APIs that serve both mobile and web clients.',
    perf_title: 'Performance tuning & refactoring',
    perf_description:
      'Diagnosing slow queries, optimising server load and introducing Redis caching.',
  },

  experience: {
    eyebrow: 'Career',
    heading: 'Work experience',
    until_now: 'Present',
    until: 'until {date}',
    senior_role: 'Senior Laravel & Front-End Developer',
    senior_company: 'Pishro Technology',
    senior_start: '2023',
    senior_description:
      'Owned and redesigned the platform core, improved service response times and rolled out stable infrastructure.',
    fullstack_role: 'Full-Stack Developer',
    fullstack_company: 'Arka Software Studio',
    fullstack_start: '2021',
    fullstack_end: '2023',
    fullstack_description:
      'Delivered more than ten web systems, integrated bank payment gateways and implemented complex financial forms.',
  },

  contact: {
    badge: 'Direct line',
    heading: "Let's start working together",
    intro: 'Have an idea or a project? Send a short message and I will reply quickly.',
    channels: 'Ways to reach me',
    channels_hint: 'I am always reachable through these channels:',
    email_label: 'Email',
    location_label: 'Location',
    location_value: 'Tehran, Iran (available for remote work)',
    response_label: 'Response time',
    response_value: 'Under 24 hours on business days',
    socials: 'Social profiles:',
    form_name: 'Your name *',
    form_name_placeholder: 'e.g. John Doe',
    form_email: 'Email address *',
    form_subject: 'Subject (optional)',
    form_subject_placeholder: 'Website design, back-end development, …',
    form_message: 'Project details or your message *',
    form_message_placeholder: 'Briefly describe your goal or technical requirement…',
    form_submit: 'Send message',
    required: 'This field is required',
    success: 'Your message was received. I will get back to you shortly.',
    resume_ready: 'The résumé link is ready to download.',
    phone_label: 'Phone number',
  },

  // --- Project case study --------------------------------------------------
  project: {
    breadcrumb_home: 'Home',
    breadcrumb_projects: 'Projects',
    back_home: 'Back to home',
    featured: 'Featured project',
    status_done: 'Completed',
    cover_caption: 'Full-stack architecture and delivery',
    problem_heading: 'Problem statement and project goals',
    gallery_heading: 'Screenshots from inside the application',
    meta_heading: 'Details and metadata',
    meta_role: 'Role',
    meta_role_value: 'Full-stack developer',
    meta_architecture: 'Architecture',
    meta_architecture_value: 'Monolith / REST API',
    meta_stack: 'Core technologies',
    meta_stack_value: 'Laravel, Vue, MySQL',
    meta_demo: 'Live demo',
    meta_demo_online: 'Online',
    meta_demo_private: 'Private',
    demo_button: 'View live demo',
    source_button: 'View source on GitHub',
    share: 'Share:',
    share_copy: 'Copy link',
    share_action: 'Share',
    link_copied: 'Project link copied.',
    cta_title: 'Have a similar project?',
    cta_body: 'Let us talk through your requirements and estimate the delivery timeline.',
    cta_button: 'Request collaboration',
    prev_project: 'Previous project',
    next_project: 'Next project',
    lightbox_caption: 'Image preview in the test environment',
    media_dashboard: 'Real-time sales charts dashboard',
    media_invoice_form: 'Advanced invoice line-item management form',

    title: 'Unified order and inventory management system',
    summary:
      'Design and delivery of a centralised platform for real-time order processing, smart inventory control and automatic financial invoicing, built to absorb heavy traffic and scale horizontally.',

    body_challenges_heading: 'Main project challenges',
    body_challenges:
      'In the legacy model, heavy reporting queries ran against the transactional database and locked tables whenever orders were processed concurrently, so server response times collapsed.',
    body_solution_heading: 'Technical approach and architecture',
    body_solution_1:
      'Separated the reporting layer using background jobs on Redis queues (Laravel Queues).',
    body_solution_2:
      'Designed a normalised database schema with precise indexing on the most frequently searched columns.',
    body_solution_3:
      'Implemented a modular, very lightweight front end with the Quasar framework and Pinia for state management.',
    body_results_heading: 'Measurable results',
    body_results:
      'After the refactor, API response time dropped from 1.8 seconds to under 120 milliseconds and inventory documents began posting in real time.',
  },

  socials: {
    github: 'GitHub',
    linkedin: 'LinkedIn',
    telegram: 'Telegram',
  },
}
