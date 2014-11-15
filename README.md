[ ![Codeship Status for matiit/wkop](https://www.codeship.io/projects/db6b77d0-393d-0132-ffeb-4eb13bd0ee77/status)](https://www.codeship.io/projects/42178)

# Simple Wykop client library

## Instalation

You'll need to add the package to the require section of your app composer.json file:

    "matiit/wkop": "dev-master"

And execute

    composer update


## Usage

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
