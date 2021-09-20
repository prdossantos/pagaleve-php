<?php


	namespace Pagaleve\PHP;

	use Exception;
	use GuzzleHttp\Client;
	use GuzzleHttp\Exception\RequestException;

	class Helpers
	{
		/**
		 *
		 * @param       $method
		 * @param       $uri
		 * @param array $data
		 * @param array $headers
		 *
		 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
		 * @throws \GuzzleHttp\Exception\GuzzleException
		 */
		static public function http( $method, $uri, array $data = [], array $headers = [])
		{
			$http = new Client(['verify' => false]);

			try {

				$response = $http->request(strtoupper($method), $uri, [
					'headers' => $headers,
					'json' => $data
				]);

				try {
					return json_decode($response->getBody()->getContents(), true);

				} catch (Exception $exception ) {
                    return ['message' => $exception->getMessage(), 'code' => $exception->getCode()];
				}

			} catch ( RequestException $exception ) {
				if( $exception->getCode() < 500 ) {
					try {
						return json_decode($exception->getResponse()->getBody()->getContents(), true);
					} catch (Exception $exception ) {
						return ['message' => $exception->getMessage(), 'code' => $exception->getCode()];
					}
				}

				return ['message' => $exception->getMessage(), 'code' => $exception->getCode()];
			}
		}
	}
