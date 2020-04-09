<?php

declare(strict_types=1);

namespace Woda\MezzioModule\AssetManager\Middleware;

use Assetic\Asset\AssetInterface;
use Assetic\Asset\FileAsset;
use Laminas\Diactoros\Response;
use Laminas\View\Helper\BasePath;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ResolveAssetMiddleware implements MiddlewareInterface
{
    /** @var BasePath */
    private $basePath;
    /** @var array */
    private $pathMapping;

    public function __construct(BasePath $basePath, array $pathMapping)
    {
        $this->basePath = $basePath;
        $this->pathMapping = $pathMapping;
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $asset = $this->resolve($request);
        if ($asset === null) {
            return $handler->handle($request);
        }
        return $this->buildAssetResponse($asset);
    }

    private function resolve(ServerRequestInterface $request): ?AssetInterface
    {
        $uriPath = $request->getUri()->getPath();
        if ($uriPath === '/') {
            return null;
        }
        foreach ($this->pathMapping as $path) {
            $fullPath = $path . $uriPath;
            if (file_exists($fullPath)) {
                return new FileAsset($fullPath);
            }
        }
        return null;
    }

    private function buildAssetResponse(AssetInterface $asset): ResponseInterface
    {
        $mimeType = self::mimeType($asset->getSourceDirectory() . '/' . $asset->getSourcePath());
        $assetContents = $asset->dump();
        if (function_exists('mb_strlen')) {
            $contentLength = mb_strlen($assetContents, '8bit');
        } else {
            $contentLength = strlen($assetContents);
        }
        $response = (new Response())
            ->withStatus(200)
            ->withAddedHeader('Content-Transfer-Encoding', 'binary')
            ->withAddedHeader('Content-Type', $mimeType)
            ->withAddedHeader('Content-Length', $contentLength);
        $response->getBody()->write($assetContents);
        return $response;
    }

    private static function mimeType(string $string)
    {
        $mimeType = \Safe\mime_content_type($string);
        if ($mimeType !== 'text/plain') {
            return $mimeType;
        }
        ['extension' => $extension] = pathinfo($string);
        if ($extension === 'css') {
            return 'text/css';
        }
        if ($extension === 'js') {
            return 'text/javascript';
        }
        return $mimeType;
    }
}
