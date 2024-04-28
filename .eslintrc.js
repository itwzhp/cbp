module.exports = {
    env: {
      node: true,
    },
    extends: [
      'eslint:recommended',
      'plugin:vue/vue3-recommended'
    ],
    globals: {
      'route': true,
      'Ziggy': true
    },
    rules: {
      'vue/require-default-prop': 'off',
      'vue/multi-word-component-names': 'off',
      'vue/require-prop-types': 'off',
      'vue/no-v-html': 'off',
      'no-unused-vars': ['error', { 'varsIgnorePattern': 'props' }],
      'quotes': [ 2, 'single' ]
    },
    overrides: [
      {
        'files': [ 'resources/js/**/*.vue' ],
      }
    ]
  }