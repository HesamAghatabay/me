// https://github.com/michael-ciniawsky/postcss-load-config

import autoprefixer from 'autoprefixer'
import rtlcss from 'postcss-rtlcss'
import { Mode } from 'postcss-rtlcss/options'

export default {
  plugins: [
    // https://github.com/postcss/autoprefixer
    autoprefixer({
      overrideBrowserslist: ['baseline widely available'],
    }),

    // https://github.com/elchininet/postcss-rtlcss
    // RTL support. `override` mode replaces physical left/right properties
    // with their logical equivalents, so a single stylesheet serves both
    // directions. Combined with quasar.config.js > framework > lang = 'fa-IR',
    // Quasar's own components flip to RTL too.
    rtlcss({ mode: Mode.Override }),
  ],
}
