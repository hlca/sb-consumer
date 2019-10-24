<?php
namespace App\Console;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class Grades {
	public static function list() {
		$tokenGenerator = GenerateToken::run();
		$client = new Client;
		$request = $client->request('GET', getenv('API_URL') . '/api/grade', [
			'headers' => [
				'Authorization' => $tokenGenerator->data->token,
			],
		]);

		return $request->getBody();
	}

	public static function create($grades) {
		echo json_encode($grades);
		$tokenGenerator = GenerateToken::run();
		try {
			$client = new Client;
			var_dump($tokenGenerator->data->token);
			$request = $client->request('POST', getenv('API_URL') . '/api/grade', [
				'headers' => [
					'Authorization' => $tokenGenerator->data->token,
					'Content-Type' => 'application/x-www-form-urlencoded',
				],
				'form_params' => [
					'grades' => json_encode($grades),
				],
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