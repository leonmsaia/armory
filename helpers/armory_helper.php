<?php

function getRaceName($id)
{
    $races = [
        1 => 'Humano',
        2 => 'Orco',
        3 => 'Enano',
        4 => 'Elfo de la noche',
        5 => 'No-muerto',
        6 => 'Tauren',
        7 => 'Gnomo',
        8 => 'Trol',
        10 => 'Elfo de sangre',
        11 => 'Draenei'
    ];
    return isset($races[$id]) ? $races[$id] : 'Desconocido';
}

function getClassName($id)
{
    $classes = [
        1 => 'Guerrero',
        2 => 'Paladín',
        3 => 'Cazador',
        4 => 'Pícaro',
        5 => 'Sacerdote',
        6 => 'Caballero de la Muerte',
        7 => 'Chamán',
        8 => 'Mago',
        9 => 'Brujo',
        11 => 'Druida'
    ];
    return isset($classes[$id]) ? $classes[$id] : 'Desconocido';
}

function getSlotName($slot)
{
    $slots = [
        0 => 'Munición',
        1 => 'Cabeza',
        2 => 'Cuello',
        3 => 'Hombros',
        4 => 'Camisa',
        5 => 'Pecho',
        6 => 'Cintura',
        7 => 'Piernas',
        8 => 'Pies',
        9 => 'Muñecas',
        10 => 'Manos',
        11 => 'Anillo 1',
        12 => 'Anillo 2',
        13 => 'Abalorio 1',
        14 => 'Abalorio 2',
        15 => 'Capa',
        16 => 'Mano principal',
        17 => 'Mano secundaria',
        18 => 'Rango'
    ];

    return isset($slots[$slot]) ? $slots[$slot] : "Slot $slot";
}

function get_item_data($itemEntry)
{
    $cacheDir = APPPATH . 'cache/armory_items/';
    if (!file_exists($cacheDir)) {
        mkdir($cacheDir, 0755, true);
    }

    $cacheFile = $cacheDir . $itemEntry . '.json';

    // Leer del caché si ya existe
    if (file_exists($cacheFile)) {
        return json_decode(file_get_contents($cacheFile), true);
    }

    // Obtener XML desde WowHead
    $url = "https://www.wowhead.com/item=$itemEntry&xml";
    $xmlData = @file_get_contents($url);

    if (!$xmlData) {
        return [
            'icon' => 'inv_misc_questionmark',
            'name' => 'Desconocido'
        ];
    }

    // Convertir a objeto SimpleXML
    $xml = @simplexml_load_string($xmlData);
    if (!$xml || !isset($xml->item)) {
        return [
            'icon' => 'inv_misc_questionmark',
            'name' => 'Desconocido'
        ];
    }

    // Extraer datos
    $icon = (string) $xml->item->icon ?? 'inv_misc_questionmark';
    $name = (string) $xml->item->name ?? 'Desconocido';

    $data = [
        'icon' => $icon,
        'name' => $name
    ];

    // Guardar en caché
    file_put_contents($cacheFile, json_encode($data));

    return $data;
}

function get_class_icon_url($classId, $size = 'medium')
    {
        $map = [
            1 => 'class_warrior',
            2 => 'class_paladin',
            3 => 'class_hunter',
            4 => 'class_rogue',
            5 => 'class_priest',
            6 => 'class_deathknight',
            7 => 'class_shaman',
            8 => 'class_mage',
            9 => 'class_warlock',
            10 => 'class_monk',
            11 => 'class_druid',
        ];

        $icon = $map[$classId] ?? 'inv_misc_questionmark';
        return "https://wow.zamimg.com/images/wow/icons/$size/$icon.jpg";
    }
function get_race_icon_url($raceId, $gender, $size = 'medium')
{
    // Se usa misma estructura que en item icons
    return "https://wow.zamimg.com/images/wow/icons/$size/race_{$raceId}_{$gender}.jpg";
}

function get_faction_icon_url($raceId, $size = 'medium')
{
    $alliance = [1, 3, 4, 7, 11];
    $horde = [2, 5, 6, 8, 10];

    if (in_array($raceId, $alliance)) {
        return "https://wow.zamimg.com/images/wow/icons/$size/ui_allianceicon.jpg";
    } elseif (in_array($raceId, $horde)) {
        return "https://wow.zamimg.com/images/wow/icons/$size/ui_hordeicon.jpg";
    }

    return "https://wow.zamimg.com/images/wow/icons/$size/inv_misc_questionmark.jpg";
}