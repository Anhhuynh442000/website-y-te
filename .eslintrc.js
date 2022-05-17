module.exports = {
    env: {
        browser: true,
        es2021: true
    },
    extends: [
        'eslint:recommended',
        'plugin:@typescript-eslint/recommended',
        'plugin:@typescript-eslint/eslint-recommended',
        'prettier'
    ],
    parser: '@typescript-eslint/parser',
    parserOptions: {
        ecmaVersion: 12,
        sourceType: 'module'
    },
    plugins: ['@typescript-eslint', 'prettier'],
    rules: {
        indent: ['error', 4],
        'linebreak-style': ['error', 'unix'],
        quotes: ['error', 'single'],
        semi: ['error', 'always'],
        'prettier/prettier': ['error'],
        "no-unused-vars": "off",
        "@typescript-eslint/no-unused-vars": ["error"],
        "@typescript-eslint/no-explicit-any": "off"
    },
    ignorePatterns: ['webpack.config.js', '.eslintrc.js', 'entry.js']
};
