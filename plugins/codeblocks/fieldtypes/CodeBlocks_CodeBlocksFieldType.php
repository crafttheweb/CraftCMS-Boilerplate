<?php

/**
 * Code Blocks FieldType by Sascha Merkofer
 *
 * Based on Ace Freely Plugin by Brandon Haslip (http://brandonhaslip.com)
 *
 * @package   Code Blocks
 * @author    Sascha Merkofer
 * @copyright Copyright 2015, Sascha Merkofer
 * @link      http://spaceman.agency
 * @license   MIT License (http://saschame.mit-license.org)
 */

namespace Craft;

class CodeBlocks_CodeBlocksFieldType extends BaseFieldType
{
    /**
     * Get the name of this fieldtype
     */
    public function getName()
    {
        return Craft::t('Code Blocks');
    }

    /**
     * Get this fieldtype's column type.
     *
     * @return string
     */
    public function defineContentAttribute()
    {
        return array(AttributeType::Mixed, 'model' => 'CodeBlocksModel');
    }


    /**
     * Get this fieldtype's form HTML
     *
     * @param  string $name
     * @param  mixed  $value
     * @return string
     */
    public function getInputHtml($name, $value)
    {

        $modes = array(
            'bash' => 'Bash',
            'css' => 'CSS',
            'markup' => 'HTML',
            'javascript' => 'JavaScript',
            'markdown' => 'Markdown',
            'php' => 'PHP',
            'scss' => 'SCSS',
            'swift' => 'Swift',
            'twig' => 'Twig',
            'yaml' => 'YAML',
        );

        // Reformat the input name into something that looks more like an ID
        $id = craft()->templates->formatInputId($name);

        // Figure out what that ID is going to look like once it has been namespaced
        $namespacedId = craft()->templates->namespaceInputId($id);

        // Get settings
        $settings = $this->getSettings();
        $useTabs  = $settings->useTabs ? 1 : 0;
        $theme    = $settings->theme;

        // set default mode
        $mode = $settings->mode;

        if (!empty($value))
        {
            $blocksModel = CodeBlocksModel::populateModel($value);

            if (!empty($blocksModel->mode)) {
                $mode = $blocksModel->mode;
            }

        } else {
            $blocksModel = new CodeBlocksModel;
            $blocksModel->handle = $name;
        }

        // Include JavaScript
        craft()->templates->includeJsResource('codeblocks/ace/ace.js');
        craft()->templates->includeJsResource('codeblocks/ace/ext-language_tools.js');
        craft()->templates->includeJsResource('codeblocks/ace.codeblocks.js');
        craft()->templates->includeCssResource('codeblocks/ace.codeblocks.css');

        craft()->templates->includeJs('AceCodeBlocks.init("' . $namespacedId . '","' . $namespacedId . 'mode' . '","' . $mode . '","' . $theme . '",' . $useTabs . ',' . $settings->tabSize . ');');

        return craft()->templates->render('codeblocks/input', array(
            'name'     => $name,
            'model'    => $blocksModel->getAttributes(),
            'settings' => $settings,
            'modes'     => $modes,
            'mode'     => $mode,
            'theme'    => $theme
        ));
    }

    /**
     * Modify the fieldtype's data, before using
     */
    public function prepValueFromPost($value)
    {
        // output is html-encoded. Even <pre><code>. Need to debug…
        // $output = craft()->templates->render('codeblocks/output', array(
        //     'mode'     => $value['mode'],
        //     'text'     => $value['text']
        // ));
        // $value['output'] = $output;
        return $value;
    }

    /**
     * Modify the fieldtype's data, before using
     */
    public function prepValue($value)
    {
        // possibly do something with $value->output
        return $value;
    }

    protected function defineSettings()
    {
        return array(
            'mode'      => array(AttributeType::Enum,   'values'  => array(
                'bash',
                'css',
                'markup',
                'javascript',
                'markdown',
                'php',
                'scss',
                'swift',
                'twig',
                'yaml'
                ), 'default' => 'html'),
            'theme'      => array(AttributeType::Enum,   'values'  => array(
                'ambiance',
                'chaos',
                'chrome',
                'clouds_midnight',
                'clouds',
                'cobalt',
                'crimson_editor',
                'dawn',
                'dreamweaver',
                'eclipse',
                'github',
                'idle_fingers',
                'katzenmilch',
                'kr_theme',
                'kuroir',
                'merbivore_soft',
                'merbivore',
                'mono_industrial',
                'monokai',
                'pastel_on_dark',
                'solarized_dark',
                'solarized_light',
                'terminal',
                'textmate',
                'tomorrow_night_blue',
                'tomorrow_night_bright',
                'tomorrow_night_eighties',
                'tomorrow_night',
                'tomorrow',
                'twilight',
                'vibrant_ink',
                'xcode'
                ), 'default' => 'chrome'),
            'height'     => array(AttributeType::Number, 'default' => 200),
            'useTabs'    => array(AttributeType::Bool,   'default' => 1),
            'tabSize'    => array(AttributeType::Number, 'default' => 4)
        );
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('codeblocks/settings', array(
            'settings' => $this->getSettings()
        ));
    }
}
