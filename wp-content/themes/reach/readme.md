Reach
===================

# Requirements
- PHP >8.1 (composer dependencies)
- Node v16.13.0 (npm >8) (there is an .nvmrc file in the root of project)

# Project Setup
- Update `build/wordpress.js`

For installable web app functionality ('Add to Home Screen'), update the following files.
Remove them if the functionality isn't required.
- `_src/static/site.webmanifest`
- `_src/images/icon-512.png`
- `_src/images/icon-maskable-512.png`


# Getting Started
- create .env.js with a development url
- npm run setup (runs `npm install && composer install && gulp`)
- npm start (runs gulp watch)
- npm run deploy (runs a production build)

## Recommended Development Setup

## Extensions for inline code linting
- (Stylelint)[https://marketplace.visualstudio.com/items?itemName=stylelint.vscode-stylelint] (inline CSS linting)
- (ESLint)[https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint] (inline JS linting)
- (phpcs)[https://marketplace.visualstudio.com/items?itemName=shevaua.phpcs] (inline PHP linting)
