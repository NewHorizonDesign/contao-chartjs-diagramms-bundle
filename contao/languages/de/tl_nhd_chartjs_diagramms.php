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

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['first_legend'] = "Basis Einstellungen";
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['second_legend'] = "Erweiterte Einstellungen";

/**
 * Operations
 */
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['edit'] = ["Datensatz mit ID: %s bearbeiten", "Datensatz mit ID: %s bearbeiten"];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['copy'] = ["Datensatz mit ID: %s kopieren", "Datensatz mit ID: %s kopieren"];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['delete'] = ["Datensatz mit ID: %s löschen", "Datensatz mit ID: %s löschen"];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['show'] = ["Datensatz mit ID: %s ansehen", "Datensatz mit ID: %s ansehen"];

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['chartGroup'] = ["Gruppe", "Geben Sie den eine Übergruppe an um Diagramme zu gruppieren (optional)"];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['title'] = ["Titel", "Geben Sie den Titel ein"];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['chartType'] = ["Diagrammauswahl", "Wählen Sie Ihr gewünschtes Diagramm aus."];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['checkboxField'] = ["Chosen Feld", "Wählen Sie aus."];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['size'] = ["Diagrammgröße definieren", "Geben Sie die Werte Breite und Höhe in px ein"];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['addSubpalette'] = ["Erweiterte Einstellungen", "Hier können Sie die erweiterten Einstellungen aktivieren."];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['cssID'] = ["CSS ID", "Hier können Sie eine ID eingeben."];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['cssClass'] = ["CSS Klasse", "Hier können Sie beliebig viele Klassen eingeben."];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['activeAnimation'] = ["Animationen deaktivieren?", "Falls zuviele Diagramme auf einer Seite existieren, sollte diese Option aktiviert werden!"];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['responsiveWidth'] = ["Responsive Breite aktivieren?", "Soll der Chart auf die maximal mögliche Breite erstellt werden?"];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['maintainAspectRatio'] = ["Beibehaltung des Seitenverhältnisses", "Soll das Verhältnis Breite gleich Höhe eingestellt werden?"];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['chartDatasets'] = ["Datensatz für Diagramm", "Definiere hier den Datensatz. Mehr Informationen unter https://www.chartjs.org/docs/latest/charts/"];
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['chartOptions'] = ["Optionen für Diagramm", "Definiere hier deine Optionen. Mehr Informationen unter https://www.chartjs.org/docs/latest/charts/"];

/**
 * Errors
 */
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['error']['noModuleGiven'] = "Kein ChartType definiert / ausgewählt!";

/**
 * Options
 */
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['chartTypes']['options'] = [
    'bar' => 'Bar Diagramm',
    'bubble' => 'Blasen Diagramm',
    'line' => 'Linien Diagramm',
    'scatter' => 'Streu Diagramm',
    'pie' => 'Pie Diagramm',
    'doughnut' => 'Donut Diagramm'
];

/**
 * Defaults
 */
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['chartOptions']['default'] = json_encode("
plugins: {
	legend: {
        // if Display True is set, the legend is displayed in the canvas and deactivated outside of it on Template!
        display: false,
		align: 'start',
		position: 'bottom',
        labels: {
            position: 'bottom',
            usePointStyle: true,
            font: {
                size: 10
            },
            generateLabels(chart) {
                const labels = chart.data.labels;
                return labels.map(function(label, i) {
                    const value = chart.Rdata.datasets[0].data[i];
                    const meta = chart.getDatasetMeta(0);
                    const style = meta.controller.getStyle(i);
                    return {
                        text: labels[i],
                        fillStyle: style.backgroundColor,
                        strokeStyle: style.borderColor,
                        lineWidth: style.borderWidth,
                        hidden: !chart.getDataVisibility(i),
                        index: i
                    }
                });
                return [];
            }
        }
	},
	tooltip: {
		position: 'nearest',
		yAlign: 'top',
		xAlign: 'center',
        titleFont: {
			size: 10
		},
		bodyFont: {
			size: 11 
		},
		callbacks: {
            label: function(context) {
                let label = context.label || '';
                let value = context.raw || '';
                return value + '%';
            }
        }
	}
}
");
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['chartDatasets']['default']['bar'] = "
data: [ // fill with Values same Count into Label
	6,
	39.20,
	1.20,
	12.90,
	28.90,
	11.80
],
backgroundColor: [
	'#ececec',
	'#2c9094',
	'#ececec',
	'#6e9def',
	'#ececec',
	'#163263'
],
borderWidth: 0,
hoverOffset: 6,
borderWidth: 0,
hoverBorderWidth: 0
";
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['chartDatasets']['default']['area'] = "{
    {fill: 'origin'},      // 0: fill to 'origin'
    {fill: '+2'},          // 1: fill to dataset 3
    {fill: 1},             // 2: fill to dataset 1
    {fill: false},         // 3: no fill
    {fill: '-2'},          // 4: fill to dataset 2
    {fill: {value: 25}}    // 5: fill to axis value 25
}";
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['chartDatasets']['default']['bubble'] = "
data: [{
    x: 20,
    y: 30,
    r: 15
}, {
    x: 40,
    y: 10,
    r: 10
}],
backgroundColor: 'rgb(255, 99, 132)'
";
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['chartDatasets']['default']['line'] = "
data: [65, 59, 80, 81, 56, 55, 40],
fill: false,
borderColor: 'rgb(75, 192, 192)',
tension: 0.1
";
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['chartDatasets']['default']['scatter'] = "
data: [{
    x: -10,
    y: 0
}, {
    x: 0,
    y: 10
}, {
    x: 10,
    y: 5
}, {
    x: 0.5,
    y: 5.5
}],
backgroundColor: 'rgb(255, 99, 132)'
";
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['chartDatasets']['default']['pie'] = "
data: [
    300,
    50,
    100
],
backgroundColor: [
  'rgb(255, 99, 132)',
  'rgb(54, 162, 235)',
  'rgb(255, 205, 86)'
],
hoverOffset: 4
";
$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['chartDatasets']['default']['doughnut'] = "
data: [
    300,
    50,
    100
],
backgroundColor: [
  'rgb(255, 99, 132)',
  'rgb(54, 162, 235)',
  'rgb(255, 205, 86)'
],
hoverOffset: 4
";