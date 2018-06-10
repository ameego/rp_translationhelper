<?php

class RpTranslationhelper_Template extends PerchAPI_TemplateHandler
{
    public $tag_mask = 'translate';

    public function render($vars, $html, $Template) {
      $lang = $vars['lang'];

      if(strpos($html, 'perch:translate') !== false) {
        $translatedValues = array();
        $tags = $Template->find_all_tags('translate');

        foreach($tags as $Tag) {
          $translatedValues[$Tag->id] = $vars[$Tag->$lang] ? $vars[$Tag->$lang] : $Tag->$lang;
        }

        $html = $Template->replace_content_tags('translate', $translatedValues, $html);
      }

      return $html;
    }
}