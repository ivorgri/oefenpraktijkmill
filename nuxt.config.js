module.exports = {
  /*
  ** Axios
  */
  modules: [
    '@nuxtjs/axios',
  ],
  axios: {
    debug: true,
  },
  /*
  ** CSS
  */
  css: [
    '@/assets/normalize.css',
    '@/assets/style.scss',
  ],
  /*
  ** Headers of the page
  */
  head: {
    title: 'Oefenpraktijk Mill',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Praktijk website Dianne' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  /*
  ** Customize the progress bar color
  */
  loading: { color: '#3B8070' },
  /*
  ** Build configuration
  */
  build: {
    /*
    ** Run ESLint on save
    */
    extend (config, { isDev, isClient }) {
      if (isDev && isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }
    }
  }
}

