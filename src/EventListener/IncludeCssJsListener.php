<?php

declare(strict_types=1);

namespace Newhorizondesign\ContaoChartjsDiagrammsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\FrontendTemplate;
use Contao\LayoutModel;
use Contao\PageModel;
use Contao\PageRegular;

#[AsHook('getPageLayout')]
final class IncludeCssJsListener
{
    public function __invoke(): void
    {
        $GLOBALS['TL_HEAD'][] = FrontendTemplate::generateScriptTag('bundles/newhorizondesigncontaochartjsdiagramms/js/chartjsfunctions.js');
        $GLOBALS['TL_HEAD'][] = FrontendTemplate::generateScriptTag('bundles/newhorizondesigncontaochartjsdiagramms/js/chart.js');
    }
}