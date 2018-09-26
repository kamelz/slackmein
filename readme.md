# Slackmein

- A slack API integeration web application.
- I've added an application token and legacy token for API calls in .env.
- Create a slack workspace
- visit https://api.slack.com/ and it will ask you to sign in with your slack account
- Create a new app, it'll ask you to sign in to a workspace
- Go to your apps, select the app you just created.
- Add permissions to the application` ['channels.write','channels.read' ]`.
- Select install your apps to your workspace then authorize.
- Go to OAuth & Permissions on the left panel then copy the token and paste it in `.env` file `SLACK_WEB_TOCKEN = token`
- If the email invitation API returned `token_revoked` , then visit https://api.slack.com/custom-integrations/legacy-tokens and create a token then copy it into SLACK_LEGACY_TOKEN in `.env`


## Installation

- `git clone https://github.com/kamelz/slackmein.git`

- `cd slackmein`

- `composer install`

- `cp .env.example .env`

- `php artisan migrate`

- `php artisan serve`

## Features
-  Create channel
- Send invitation to a channel
- send invitation to the workspace by email
