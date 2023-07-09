<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => 'Logistic',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Logistic Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
	'defaultCssFile'        => base_path('vendor/mpdf/mpdf/data/mpdf.css'),
	'font_path' => base_path('public/fonts/'),
	'font_data' => [
		'Aljazeera' => [
			'R'  => 'Aljazeera.ttf',    // regular font
			// 'B'  => 'ExampleFont-Bold.ttf',       // optional: bold font
			// 'I'  => 'ExampleFont-Italic.ttf',     // optional: italic font
			// 'BI' => 'ExampleFont-Bold-Italic.ttf' // optional: bold-italic font
			//'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			//'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
		]
	]
];
