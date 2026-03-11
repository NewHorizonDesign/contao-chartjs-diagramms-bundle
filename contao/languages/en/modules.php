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

use Newhorizondesign\ContaoChartjsDiagrammsBundle\Controller\FrontendModule\ListenChartjsModulesController;

/**
 * Backend modules
 */
$GLOBALS['TL_LANG']['MOD']['chartjs_collection'] = ['Diagrams', 'Inserts any chart diagram.'];

/**
 * Frontend modules
 */
$GLOBALS['TL_LANG']['FMD'][ListenChartjsModulesController::TYPE] = ['ChartJS Diagram', 'Inserts any chart diagram.'];

/**
 * Content Module
 */
$GLOBALS['TL_LANG']['tl_module']['fields']['configSelect'] = ["Diagram selection","Select the chart you want to display here. Under CHARTJS > Configure charts!"];
