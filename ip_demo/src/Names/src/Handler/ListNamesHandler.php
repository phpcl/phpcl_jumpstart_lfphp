<?php
declare(strict_types=1);

namespace Names\Handler;

use Names\Domain\ListService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;

class ListNamesHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    protected $renderer;
    /**
     * @var ListService
     */
    protected $service;

    public function __construct(TemplateRendererInterface $renderer, ListService $service)
    {
        $this->renderer = $renderer;
        $this->service  = $service;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $names = $service->getNames();
        // Render and return a response:
        return new JsonResponse(['data' => $names]);
    }
}
