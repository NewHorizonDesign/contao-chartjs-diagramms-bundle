<?php

declare(strict_types=1);

/*
 * This file is part of Contao ChartJS Diagramms.
 *
 * (c) Newhorizondesign 2025 <service@newhorizon-design.de>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/Newhorizondesign/contao-chartjs-diagramms
 */

namespace Newhorizondesign\ContaoChartjsDiagrammsBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\ModuleModel;
use Contao\StringUtil;
use Contao\System;
use Contao\Template;
use Doctrine\DBAL\Connection;
use Newhorizondesign\ContaoChartjsDiagrammsBundle\Model\NewhorizondesignChartjsDiagrammsModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;

#[AsFrontendModule(category: 'ChartJS')]
class ListenChartjsModulesController extends AbstractFrontendModuleController
{
    public const TYPE = 'listen_chartjs_modules';

    public function __construct(
        private Environment $twig,
        public TranslatorInterface $trans
    )
    {
        System::loadLanguageFile('tl_nhd_chartjs_diagramms', 'de');
    }

    /**
     * Lazyload services
     */
    public static function getSubscribedServices(): array
    {
        $services = parent::getSubscribedServices();

        $services['contao.framework'] = ContaoFramework::class;
        $services['database_connection'] = Connection::class;
        $services['contao.routing.scope_matcher'] = ScopeMatcher::class;
        $services['security.helper'] = Security::class;
        $services['translator'] = TranslatorInterface::class;

        return $services;
    }

    public function getResponse(Template $template, ModuleModel $model, Request $request): Response
    {
        $chartID = $template->configSelect;
        $chartNumber = $template->configSelect.$template->tstamp;
        ${'chartModel'.$chartNumber} = NewhorizondesignChartjsDiagrammsModel::findByID($chartID);
        
        if (!${'chartModel'.$chartNumber}) {
            return new Response($this->trans->trans('tl_nhd_chartjs_diagramms.error.noModuleGiven', [], 'contao_default'));
        }

        $titleObject = StringUtil::deserialize(${'chartModel'.$chartNumber}->title);
        $size = StringUtil::deserialize(${'chartModel'.$chartNumber}->size) ?? [0, 0];
        $canvasWidth = $size[0] ?? 300;
        $canvasHeight = $size[1] ?? 150;

        return new Response($this->twig->render(
            '@NewhorizondesignContaoChartjsDiagramms/dynamicChart.html.twig',
            [
                'chartID'           => $chartNumber,
                'titleUnit'         => $titleObject['unit'] ?? 'span',
                'title'             => $titleObject['value'] ?? '',
                'cssID'             => ${'chartModel'.$chartNumber}->cssID."-".$chartNumber,
                'cssClass'          => ${'chartModel'.$chartNumber}->cssClass,
                'chartWidth'        => $canvasWidth,
                'chartHeight'       => $canvasHeight,
                'chartType'         => ${'chartModel'.$chartNumber}->chartType,
                'chartData'         => StringUtil::decodeEntities(${'chartModel'.$chartNumber}->jsonInput),
                'chartLabel'        => StringUtil::decodeEntities(${'chartModel'.$chartNumber}->jsonInputLabels),
                'chartOptions'      => StringUtil::decodeEntities(${'chartModel'.$chartNumber}->jsonInputOptions),
                'chartAnimation'    => (${'chartModel'.$chartNumber}->activeAnimation) ? true: false,
                'responsiveWidth'   => (${'chartModel'.$chartNumber}->responsiveWidth) ? true: false,
            ]
        ));
    }
}
