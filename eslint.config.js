import globals from 'globals';
import eslintPluginVue from 'eslint-plugin-vue';

export default [
    {
        files: ['**/*.js', '**/*.vue'],
        languageOptions: {
            ecmaVersion: 2020,
            sourceType: 'module',
            globals: {
                ...globals.browser,
                ...globals.amd,
                ...globals.es2021,
                AudioWorkletGlobalScope: 'readonly',
            },
        },
        plugins: {
            vue: eslintPluginVue,
        },
        rules: {
            indent: ['error', 4],
            'comma-dangle': ['warn', 'always-multiline'],
            'vue/multi-word-component-names': 'off',
            'vue/max-attributes-per-line': 'off',
            'vue/no-v-html': 'off',
            'vue/require-default-prop': 'off',
            'vue/singleline-html-element-content-newline': 'off',
            'vue/html-self-closing': [
                'warn',
                {
                    html: {
                        void: 'always',
                        normal: 'always',
                        component: 'always',
                    },
                },
            ],
        },
    },
];
