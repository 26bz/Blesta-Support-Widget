<?php

class SupportWidgetPlugin extends Plugin
{
  public function __construct()
  {
    $this->loadConfig(dirname(__FILE__) . DS . "config.json");
  }

  public function install($plugin_id)
  {
    return true;
  }

  public function uninstall($plugin_id, $last_instance)
  {
    return true;
  }

  public function upgrade($current_version, $plugin_id)
  {
    return true;
  }

  public function getActions()
  {
    return [
      [
        'action' => 'widget_staff_home',
        'uri' => 'plugin/support_widget/admin_main/index/',
        'name' => 'Support Tickets',
        'enabled' => 1
      ]
    ];
  }
}
