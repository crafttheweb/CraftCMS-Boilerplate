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

class CodeBlocksPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Code Blocks');
    }

    public function getVersion()
    {
        return '1.0';
    }

    public function getDeveloper()
    {
        return 'Sascha Merkofer';
    }

    public function getDeveloperUrl()
    {
        return 'http://spaceman.agency';
    }
}
