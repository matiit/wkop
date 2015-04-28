[ ![Codeship Status for matiit/wkop](https://www.codeship.io/projects/db6b77d0-393d-0132-ffeb-4eb13bd0ee77/status)](https://www.codeship.io/projects/42178)

# Simple Wykop client library

## Instalation

You'll need to add the package to the require section of your app composer.json file:

    "matiit/wkop": "dev-master"

And execute

    composer update


## Usage

```php
    <?php

	use Wkop\Factory;

    $client = Factory::get('APP KEY', 'SECRET KEY');

    $client->setUserCredentials('USER LOGIN', 'USER ACCOUNT KEY');

    $client->logIn();

	// Read resources
	// Resource name, method parameters, api parameters
	$results = $client->get('stream', ['index'], ['page' => 1]);

	// Post to resources
	// Resource name, method parameters, api parameters, post parameters
	$result = $client->post('entries', ['add'], [], ['body' => "test"]);
```
```php
	<?php

	use Wkop\Factory;

	$url = Wkop\Helpers::Wkop\Helpers::getConnectUrl('REDIRECT URL', 'APP KEY, 'SECRET KEY');
	$client = Factory::get('APP KEY', 'SECRET KEY');

    /**
     * User should be redirected to that link.
	 * He'll be asked to accept permissions and will be able to connect.
	 * After clicking connect, he will be redirected back to your application to the REDIRECT URL
	 * Handling Response is up to you.
	 * Official Wykop documentation about response format:
	 * http://www.wykop.pl/dla-programistow/dokumentacja/#info6_7_5
	 *
     *
     * In result you'll acquire two variables:
     * User login
     * User token (also called user key)
     */

    // Here, get those variables.

    // And use them:
    $client->setUserCredentials('USER LOGIN', 'USER ACCOUNT KEY');
    $client->logIn();

    // From this moment, you will be able to make API calls as logged user.

## Ideas

Got an improvement idea? Mail me or send PullRequests.
