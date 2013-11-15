<?php
/**
 * Governs localisation and internationalisation.
 *
 * Note: this is overengineered and can be scaled back easily, unless we want a
 * Welsh translation?
 *
 * @file
 */

/**
 * Returns a localised string.
 *
 * @param identifier The string to localise
 * @param language the language code to localise into, as defined by RFC 5646
 * @return String the localised string
 */
function t( $identifier, $lang ) {

  if ( empty( $lang ) ) {
    # no explicit language specified; use default
    $lang = $config['defaultLanguage'];
  }

  try {
    $ROOT = '/home/zuzak/git/group-project/server/';
    $l10nPath = "$ROOT/localization/$lang.json";
    $l10nJSON = file_get_contents( $l10nPath );
    $phrases = json_decode( $l10nJSON, true );
  } catch (Exception $e) {
    // TODO: fail nicely (but better than silently)
  }

  $phrase =  $phrases[$identifier];

  if ( !$phrase ) {
    # unable to find phrase

    if ( $lang == 'en-GB' ) {
      # no phrase in English; give a placeholder instead
      $phrase = "<% MISSING - $identifier %>";
    } else {
      # phrase not localised, try English
      $phrase = t($identifier, 'en-GB');
    }
  }
  return $phrase;
}


