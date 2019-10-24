<?php
namespace App\Console;

use GuzzleHttp\Client;

class GenerateToken {
	public static function run() {
		$client = new Client;

		$request = $client->request('POST', getenv('API_URL') . '/token', [
			'form_params' => [
				'username' => getenv('API_USERNAME'),
				'password' => getenv('API_PASSWORD'),
			],
		]);

		return json_decode($request->getBody()->getContents());
	}
}
