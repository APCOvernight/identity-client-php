<?php
require_once(__DIR__ . '/vendor/autoload.php');
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;

/**
 * Authentication class for obtaining an identity token from identity.apc-overnight.com
 */
class Identity {
    /**
     * Wuthenticate and get an APC OAuth Token.
     *
     * @param [type] $client_id
     * @param [type] $client_secret
     * @param [type] $scope
     * @param [type] $endpoint
     * @return void
     */
    public static function Authenticate( $client_id, $client_secret, $scope, $endpoint ) {
        $client = new Client( );
        $headers = ['Authorization' => 'Bearer', 'Accept'=> '*/*'];
        $res = $client->request('POST', $endpoint, [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'scope' => $scope
                ]
            ]
        );

        $returnObj = json_decode((string)$res->getBody());
        return $returnObj;
    }
}
