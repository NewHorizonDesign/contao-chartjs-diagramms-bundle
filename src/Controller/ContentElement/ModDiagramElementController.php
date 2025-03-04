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

namespace Newhorizondesign\ContaoChartjsDiagrammsBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\StringUtil;
use Contao\System;
use Contao\Template;
use Newhorizondesign\ContaoChartjsDiagrammsBundle\Model\NewhorizondesignChartjsDiagrammsModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;

#[AsContentElement(category: 'diagram_element', nestedFragments: true)]
class ModDiagramElementController extends AbstractContentElementController
{
    public const TYPE = 'mod_diagram_element';
    public function __construct
    (
        private Environment $twig,
        public TranslatorInterface $trans
    ) {
        System::loadLanguageFile('tl_nhd_chartjs_diagramms', 'de');
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $template->setName('@NewhorizondesignContaoChartjsDiagramms/content_element/mod_diagram_element.html.twig');

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
                'chartAnimation'    => ${'chartModel'.$chartNumber}->activeAnimation ?? false,
                'responsiveWidth'   => ${'chartModel'.$chartNumber}->responsiveWidth ?? false,
                'maintainAspectRatio' => ${'chartModel'.$chartNumber}->maintainAspectRatio ?? false
            ]
        ));
    }
}
