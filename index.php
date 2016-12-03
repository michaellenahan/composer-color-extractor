<?php

require 'vendor/autoload.php';

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

// Some images from Creative Commons on Flickr.
// https://www.flickr.com/search/?text=&license=2%2C3%2C4%2C5%2C6%2C9&sort=interestingness-desc
$images = [
  [
    'file' => './images/30642470585_068c41e612_z.jpg',
    'title' => 'Osaka, Japan - Sunset from Umeda City',
    'source' => 'https://www.flickr.com/photos/pedrosz/30642470585/',
    'author_name' => 'Pedro Szekely',
    'author_profile' => 'https://www.flickr.com/photos/pedrosz/',
    'license' => 'CC BY-SA 2.0',
    'license_link' => 'https://creativecommons.org/licenses/by-sa/2.0/',
  ],
  [
    'file' => './images/30533863645_561f2b6dfa_z.jpg',
    'title' => 'Autumn Colours, Landgoed Voorstonden, Brummen, Netherlands - 1032',
    'source' => 'https://www.flickr.com/photos/hereistom/30533863645',
    'author_name' => 'Tom Jutte',
    'author_profile' => 'https://www.flickr.com/photos/hereistom/',
    'license' => 'CC BY-NC-ND 2.0',
    'license_link' => 'https://creativecommons.org/licenses/by-nc-nd/2.0/',
  ],
];

$number_of_colors_to_extract = 8;

foreach ($images as $image) {

  $palette = Palette::fromFilename($image['file']);

  // an extractor is built from a palette
  $extractor = new ColorExtractor($palette);

  // it defines an extract method which return the most “representative” colors
  $colors = $extractor->extract($number_of_colors_to_extract);

  // Creative commons attribution.
  // See: https://wiki.creativecommons.org/wiki/best_practices_for_attribution#This_is_an_ideal_attribution
  $title = "<a href='" . $image['source'] . "'>" . $image['title'] . "</a>";
  $author = "<a href='" . $image['author_profile'] . "'>" . $image['author_name'] . "</a>";
  $license = "<a href='" . $image['license_link'] . "'>" . $image['license'] . "</a>";
  $attribution = "$title<br>by $author<br>is licensed under $license";

  echo "<table><tr><td>";
  echo "<img src='" . $image['file'] . "' />";
  echo "<p>$attribution</p>";
  echo "</td><td>";

  foreach ($colors as $key => $color) {
    $hex_code = Color::fromIntToHex($color);
    echo "<h1 style='color: $hex_code'>$key: $hex_code</h1>";
  }

  echo "</td></tr></table>";

}
