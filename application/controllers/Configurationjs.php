<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class Configurationjs extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    function index() {
        echo '{"versionPlatform":"unknown","editorParameters":{},"imageFormat":"svg","CASEnabled":false,"parseModes":["latex"],"editorToolbar":"","editorAttributes":"width=570, height=450, scroll=no, resizable=yes","base64savemode":"default","modalWindow":true,"version":"7.29.0.1452","enableAccessibility":true,"saveMode":"xml","saveHandTraces":false,"editorUrl":"http://www.wiris.net/demo/editor/editor","editorEnabled":true,"chemEnabled":true,"CASMathmlAttribute":"alt","CASAttributes":"width=640, height=480, scroll=no, resizable=yes","modalWindowFullScreen":false,"imageMathmlAttribute":"data-mathml","hostPlatform":"unknown","wirisPluginPerformance":true}';
    }
}
