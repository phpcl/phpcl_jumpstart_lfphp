<?php
declare(strict_types=1);
namespace IpWhat\Handler;

use IpWhat\Entity\IpInfo;
use IpWhat\Service\IpWhatInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class IpHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    protected $renderer;
    /*
     * @var IpWhatInterface
     */
	protected $service;
	
    public function __construct(TemplateRendererInterface $renderer, IpWhatInterface $service)
    {
        $this->renderer = $renderer;
        $this->service  = $service;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
		// init vars
		$info = new IpInfo();
		// grab post params (if any)
		if ($request->getMethod() == 'post') {
			$params = $request->getParsedBody();
			$ip = $params['ip'] ?? '';	// other IP address (optional)
			$my = $params['my'] ?? '';	// button to get My Ipaddress
			if ($my) {
				$info = $this->service->getMyIp();
			} else {
				$info = $this->service->getCountryForIp($ip);
			}
			echo __LINE__;
		}
        return new HtmlResponse($this->renderer->render(
            'ip-what::ip',
            ['info' => $info] // parameters to pass to template
        ));
    }
}
