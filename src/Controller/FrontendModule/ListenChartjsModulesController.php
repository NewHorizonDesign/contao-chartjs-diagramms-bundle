<?php

declare(strict_types=1);

/*
 * This file is part of Contao ChartJS Diagramms Bundle.
 *
 * (c) Newhorizondesign 2025 <service@newhorizon-design.de>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/Newhorizondesign/contao-chartjs-diagramms-bundle
 */

namespace Newhorizondesign\ContaoChartjsDiagrammsBundle\Controller\FrontendModule;

use Contao\BackendTemplate;
use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
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

#[AsFrontendModule(category: 'ChartJS', template: 'listen_chartjs_modules')]
class ListenChartjsModulesController extends AbstractFrontendModuleController
{
    public const TYPE = 'listen_chartjs_modules';

    public function __construct(
        private Environment $twig,
        public TranslatorInterface $trans,
        protected ScopeMatcher $scopeMatcher
    )
    {
        System::loadLanguageFile('tl_nhd_chartjs_diagramms', 'de');
    }

    public function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $chartID = $model->configSelect;
        $chartNumber = $model->configSelect.$model->tstamp;
        ${'chartModel'.$chartNumber} = NewhorizondesignChartjsDiagrammsModel::findByID($chartID);

        $titleObject = ${'chartModel'.$chartNumber} ? StringUtil::deserialize(${'chartModel'.$chartNumber}->title) : '';

        if ($this->scopeMatcher->isBackendRequest($request)) {
            $template = new BackendTemplate('be_wildcard');
            $template->wildcard = ${'chartModel'.$chartNumber} ? "~ {$titleObject['value']} ~" : "<span style='color:red;'>~ ChartModule ohne Chartauswahl ~</span>";
    
            return $template->getResponse();
        }

        if (!${'chartModel'.$chartNumber} && $this->scopeMatcher->isFrontendRequest($request)) {
            return new Response();
        }

        $size = StringUtil::deserialize(${'chartModel'.$chartNumber}->size) ?? [0, 0];
        $canvasWidth = $size[0] ?? 300;
        $canvasHeight = $size[1] ?? 150;

        $template->chartID = $chartNumber;
        $template->titleUnit = $titleObject['unit'] ?? 'span';
        $template->title = $titleObject['value'] ?? '';
        $template->cssID = ${'chartModel'.$chartNumber}->cssID."-".$chartNumber;
        $template->cssClass = ${'chartModel'.$chartNumber}->cssClass;
        $template->chartWidth = $canvasWidth;
        $template->chartHeight = $canvasHeight;
        $template->chartType = ${'chartModel'.$chartNumber}->chartType;
        $template->chartData = json_encode(
            array_map('htmlspecialchars_decode', StringUtil::deserialize(${'chartModel'.$chartNumber}->chartDatasets)),
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        );
        $template->chartOptions = StringUtil::decodeEntities(${'chartModel'.$chartNumber}->chartOptions);
        $template->chartAnimation = ${'chartModel'.$chartNumber}->activeAnimation ? 'false' : 'true';
        $template->responsiveWidth = ${'chartModel'.$chartNumber}->responsiveWidth ? 'true' : 'false';
        $template->maintainAspectRatio = ${'chartModel'.$chartNumber}->maintainAspectRatio ? 'true' : 'false';

        return $template->getResponse();
    }
}
