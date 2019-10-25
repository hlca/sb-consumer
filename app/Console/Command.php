<?php
namespace App\Console;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class Command {
	protected static $token = '';

	protected static function generateToken() {
		$tokenGenerator = GenerateToken::run();
		self::$token = $tokenGenerator->data->token;
	}

	protected static function requestJSON($method, $url, $json) {
		self::generateToken();
		try {
			$client = new Client;
			$request = $client->request($method, getenv('API_URL') . $url, [
				'headers' => [
					'Authorization' => self::$token,
					'Content-Type' => 'application/json',
				],
				'json' => $json,
			]);

			return json_decode($request->getBody()->getContents(), true);
		} catch (ClientException $e) {
			$responseBody = json_decode($e->getResponse()->getBody()->getContents(), true);
		} catch (ServerException $e) {
			$responseBody = json_decode($e->getResponse()->getBody()->getContents(), true);
		} catch (Exception $e) {
			return 'failed';
		}
		return $responseBody;
	}
}