<?php
declare(strict_types = 1);

namespace App\Tests\Behat;

use GuzzleHttp\Psr7;

class ApiContext extends \Imbo\BehatApiExtension\Context\ApiContext
{
    /**
     * Update the path of the request
     *
     * @param string $path The path to request
     * @return self
     */
    protected function setRequestPath($path) {
        // Resolve the path with the base_uri set in the client
        // TODO: refactor this code going deeper in Guzzle URI resolver
        $uri = Psr7\UriResolver::resolve($this->client->getConfig('base_uri'), Psr7\uri_for($this->client->getConfig('base_uri')->getPath() . $path));
        $this->request = $this->request->withUri($uri);

        return $this;
    }
}