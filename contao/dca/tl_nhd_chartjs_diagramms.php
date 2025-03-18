<?php

/*
 * This file is part of Contao ChartJS Diagramms Bundle.
 *
 * (c) Newhorizondesign 2025 <service@newhorizon-design.de>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/Newhorizondesign/contao-chartjs-diagramms-bundle
 */

use Contao\Backend;
use Contao\Controller;
use Contao\Database;
use Contao\DataContainer;
use Contao\DC_Table;
use Contao\Environment;
use Contao\Input;

$GLOBALS['TL_DCA']['tl_nhd_chartjs_diagramms'] = [
    'config'      => [
        'dataContainer'    => DC_Table::class,
        'enableVersioning' => true,
        'sql'              => [
            'keys' => [
                'id' => 'primary'
            ]
        ],
        'onload_callback' => [
            ['tl_nhd_chartjs_diagramms', 'reloadOnLoad']
        ]
    ],
    'list'        => [
        'sorting'           => [
            'mode'        => 1,
            'fields'      => ['chartGroup','title'],
            'flag'        => 1,
            'panelLayout' => 'filter;sort,search,limit',
            'group_callback' => ['tl_nhd_chartjs_diagramms']
        ],
        'label'             => [
            'fields' => ['id','title'],
            'showColumns'  => true,
            'format' => '%s',
        ],
        'global_operations' => [
            'all' => [
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ]
        ],
        'operations'        => [
            'edit'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.svg'
            ],
            'copy'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.svg'
            ],
            'delete' => [
                'label'      => &$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\'))return false;Backend.getScrollOffset()"'
            ],
            'show'   => [
                'label'      => &$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['show'],
                'href'       => 'act=show',
                'icon'       => 'show.svg',
                'attributes' => 'style="margin-right:3px"'
            ],
        ]
    ],
    'palettes'    => [
        '__selector__' => ['addSubpalette'],
        'default'      => '{first_legend},chartGroup,title,chartType,size,cssID,cssClass;{second_legend},activeAnimation,responsiveWidth,maintainAspectRatio,singleSRC,chartDatasets,chartOptions;'
    ],
    'fields'      => [
        'chartGroup'   => [
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'long clr'],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'id'             => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp'  => [
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],
        'title'          => [
            'inputType' => 'inputUnit',
            'options' => ['h2', 'h3', 'h4', 'h5', 'h6'],
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'long clr'],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'chartType'    => [
            'inputType' => 'select',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'options'   => &$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['chartTypes']['options'],
            'eval'      => ['submitOnChange' => true, 'includeBlankOption' => false, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''",
        ],
        'size' => [
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => ['multiple' => true, 'size' => 2, 'decodeEntities' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'cssID'  => [
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'cssClass'  => [
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'activeAnimation'  => [
            'inputType'  => 'checkbox',
            'sql' => [
                'type'  => 'boolean',
                'default'  => false,
            ],
            'eval'  => ['tl_class' => 'long'],
        ],
        'responsiveWidth' => [
            'inputType' => 'checkbox',
            'sql' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'eval'  => ['tl_class' => 'long'],
        ],
        'maintainAspectRatio' => [
            'inputType' => 'checkbox',
            'sql' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'eval'  => ['tl_class' => 'long'],
        ],
        'chartDatasets'  => [
            'inputType' => 'multiTextWidget',
            'exclude'   => true,
            'eval'      => [
                'rte' => 'ace|js', 
                'tl_class' => 'long clr', 
                'allowHtml' => true, 
                'required' => true],
                'sql'       => "blob NULL"
            // 'load_callback' => [
            //     ['tl_nhd_chartjs_diagramms', 'datasetsCallback']
            // ]
        ],
        'chartOptions'  => [
            'inputType' => 'textarea',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => ['rte' => 'ace|js', 'mandatory' => true, 'multiple' => true,'tl_class' => 'long clr m12'],
            'sql'       => "text NOT NULL default ''",
            'load_callback' => [
                ['tl_nhd_chartjs_diagramms', 'chartOptionsCallback']
            ]
        ],
    ]
];

class tl_nhd_chartjs_diagramms extends Backend
{
    public function reloadOnLoad($dc)
    {
        if (!$dc->id) {
            return;
        }
    
        $db = Database::getInstance();

        // Datensatz aus der DB abrufen
        $record = $db->prepare("SELECT chartType, cssID, chartDatasets FROM tl_nhd_chartjs_diagramms WHERE id=?")
                    ->execute($dc->id)
                    ->fetchAssoc();

        // Falls `chartType` leer ist, Standardwert setzen
        if (empty($record['chartType'])) {
            $db->prepare("UPDATE tl_nhd_chartjs_diagramms SET chartType=? WHERE id=?")
            ->execute('bar', $dc->id);
        }

        // Falls `cssID` leer ist, Standardwert setzen
        if (empty($record['cssID'])) {
            $db->prepare("UPDATE tl_nhd_chartjs_diagramms SET cssID=? WHERE id=?")
            ->execute('default', $dc->id);
        }       
    }

    public function chartOptionsCallback($value, DataContainer $dc)
    {
        if ($value) {
            return $value;
        }

        return json_decode($GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['chartOptions']['default']);
    }

    public function datasetsCallback($value, DataContainer $dc)
    {
        $dataset = '';

        if (!$dc->activeRecord || !$dc->id) {
            $dataset = !empty($value) ? $value : '';
        }
        
        $db = Database::getInstance();
        $record = $db->prepare("SELECT chartType, chartDatasets FROM tl_nhd_chartjs_diagramms WHERE id=?")
                 ->execute($dc->id)
                 ->fetchAssoc();
        
        if (!$record) {
            return $this->getDefaultDatasets('bar');
        }
        
        if ($record['chartType'] !== $dc->activeRecord->chartType || empty($record['chartDatasets'])) {
            return $this->getDefaultDatasets($dc->activeRecord->chartType);
        }

        return $dataset;
    }

    private function getDefaultDatasets($chartType): string
    {
        return $GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['chartDatasets']['default'][$chartType] ?? '';
    }

}
