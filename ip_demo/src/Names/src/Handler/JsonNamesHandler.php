<?php
declare(strict_types=1);

namespace Names\Handler;

use Names\Domain\ListService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class JsonNamesHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    protected $renderer;
    /**
     * @var ListService
     */
    protected $service;

    public function __construct(ListService $service)
    {
        $this->service  = $service;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $names = $this->service->getNames();
        // Render and return a response:
        return new JsonResponse(['data' => $names]);
    }
}
