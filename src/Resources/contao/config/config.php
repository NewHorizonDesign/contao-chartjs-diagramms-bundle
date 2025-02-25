<?php

/*
 * This file is part of Contao ChartJS Diagramms.
 *
 * (c) Newhorizondesign 2025 <service@newhorizon-design.de>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/Newhorizondesign/contao-chartjs-diagramms
 */

use Newhorizondesign\ContaoChartjsDiagrammsBundle\Model\NewhorizondesignChartjsDiagrammsModel;

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['chartjs']['chartjs_collection'] = [
    'tables' => ['tl_nhd_chartjs_diagramms']
];

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_nhd_chartjs_diagramms'] = NewhorizondesignChartjsDiagrammsModel::class;
