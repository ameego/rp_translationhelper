<?php

class RpTranslationhelper_Template extends PerchAPI_TemplateHandler
{
    public $tag_mask = 'translate';

    public function render($vars, $html, $Template) {
      $lang = PerchSystem::get_var('lang');

      // Explicit mode not enabled by default
      $explicit_mode = false;
      if(defined('RP_TRANSLATION_HELPER_EXPLICIT_MODE')) $explicit_mode = RP_TRANSLATION_HELPER_EXPLICIT_MODE;

      if(strpos($html, 'perch:translate') !== false) {
        $translatedValues = array();
        $tags = $Template->find_all_tags('translate');

        foreach($tags as $Tag) {
          $value = $lang_id = '';

          // explicit mode enabled on $Tag or in config
          if($Tag->explicit || $explicit_mode) {

            if(substr($Tag->$lang, 0, 1) === '{') {

              $lang_id = trim($Tag->$lang, '{}');

              if(isset($vars[$lang_id])) {
                $value = $vars[$lang_id];
              } elseif(isset($vars[$Tag->id])) {
                $value = $vars[$Tag->id];
              }
              
            } else {
              $value = $Tag->$lang;
            }

          } else {
            $value = isset($vars[$Tag->$lang]) ? $vars[$Tag->$lang] : $Tag->$lang;
          }
          
          
          $translatedValues[$Tag->id] = $value;
        }

        $html = $Template->replace_content_tags('translate', $translatedValues, $html);
      }

      return $html;
    }
}